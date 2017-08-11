<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use Auth;
use Response;
use Carbon\Carbon;
// Model -------------------
use App\ChatBox;
use App\User;
//Events --------------------
use App\Events\PrivateMessage;

class ChatController extends Controller
{
    // This method is used when user visite messsage page.
    // if targetId is set we are jumping to the targetUserId chat section. If not set, we are opening the first user chat section.
    // After page loading we are loading messages using ajax of each client. If target id is set, ajax is called automatically after page loads.
    public function getChat($id = null){
    	if (session('userType') == "Client") {
            $LawyerId = $id;
    		$userId = Auth::id();
            if ($LawyerId == null || $LawyerId == "") {
                // When target client id is not set
                $LawyerList = ChatBox::where('senderId',$userId)
                                    ->orWhere('receiverId',$userId)
                                    ->distinct()
                                    ->get(['senderId','senderName','receiverId','receiverName']);
                // Common Data ------------------
                $UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
                // ------------------------------
                return view('Pages.Vidhikarya.Client.ChatBox',compact('LawyerList','UnreadMessagegs'));
            }
            else{
                // when target client id is set
                $TargetLawyerId = $LawyerId;

                // When target client id is set and correct.
                $LawyerList = ChatBox::where('senderId',$userId)
                                    ->orWhere('receiverId',$userId)
                                    ->distinct()
                                    ->get(['senderId','senderName','receiverId','receiverName']);
                // Common Data ------------------
                $UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
                // ------------------------------
                return view('Pages.Vidhikarya.Client.ChatBox',compact('LawyerList','TargetLawyerId','UnreadMessagegs'));
            }
    	}
    	elseif (session("userType") == "Lawyer") {
            $ClientID = $id;
    		$userId = Auth::id();
    		if ($ClientID == null || $ClientID == "") {
                // When target client id is not set
	    		$ClientList = ChatBox::where('senderId',$userId)
	    							->orWhere('receiverId',$userId)
	    							->distinct()
	    							->get(['senderId','senderName','receiverId','receiverName']);
                // Common Data ------------------
                $UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
                // ------------------------------
	    		return view('Pages.Vidhikarya.Lawyer.ChatBox',compact('ClientList','UnreadMessagegs'));	
    		}
    		else{
                // when target client id is set
    			$TargetClientId = $ClientID;

                // When target client id is set and correct.
    			$ClientList = ChatBox::where('senderId',$userId)
	    							->orWhere('receiverId',$userId)
	    							->distinct()
	    							->get(['senderId','senderName','receiverId','receiverName']);
                // Common Data ------------------
                $UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
                // ------------------------------
	    		return view('Pages.Vidhikarya.Lawyer.ChatBox',compact('ClientList','TargetClientId','UnreadMessagegs'));
    		}
    	}
    }

    // This method runs when target user id is set .... runs automatically after the chatbox page loads
    // Making unread messages as read -------------
    public function GetTargetMessages(Request $request){
        if (session('userType') == "Client") {
            $inputData = $request->all();
            $ClientId = session('userId');                      
            $LawyerId = $inputData['LawyerID'];

            // Getting User Name -----
            $user = User::find($LawyerId);

            // Getting Messages ---------
            $Messages = ChatBox::whereIn('receiverId',[$ClientId,$LawyerId])
                        ->whereIn('senderId',[$ClientId, $LawyerId])
                        ->get();

            // Making unread messages as read -------------
            ChatBox::where('senderId', $LawyerId)->where('receiverId',$ClientId)->update(['hasRead' => 1]);

            // Returning Messages ---------------
            return Response::json(array(
                'Status' => 'Loaded',
                'LawyerId' => $LawyerId,
                'LawyerName' => $user->name,
                'Messages' => $Messages
            ));
        }
        elseif (session("userType") == "Lawyer") {
            $inputData = $request->all();
            $LawyerId = session('userId');
            $ClientId = $inputData['ClientID'];

            // Getting User Name -----
            $user = User::find($ClientId);

            // Getting Messages ---------
            $Messages = ChatBox::whereIn('receiverId',[$ClientId,$LawyerId])
                        ->whereIn('senderId',[$ClientId, $LawyerId])
                        ->get();

            // Making unread messages as read -------------
            ChatBox::where('senderId', $ClientId)->where('receiverId',$LawyerId)->update(['hasRead' => 1]);

            // Returning Messages --------------- 
            return Response::json(array(
                'Status' => 'Loaded',
                'LawyerId' => $LawyerId,
                'ClientName' => $user->name,
                'Messages' => $Messages
            ));   
        }
    }

    // Runs when user clicks on the one of the user on his left side user list.
    // Marking unread messages as read
    public function GetMessages(Request $request){
        $inputData = $request->all();
        
        if (session('userType') == "Client") {
            $LawyerId = $inputData['LawyerID'];
            $ClientId = session('userId');
            $Messages = ChatBox::whereIn('receiverId',[$ClientId,$LawyerId])
                        ->whereIn('senderId',[$ClientId, $LawyerId])
                        ->get();

            // Making unread messages as read -------------
                ChatBox::where('senderId', $LawyerId)->where('receiverId',$ClientId)->update(['hasRead' => 1]);

            return Response::json(array(
                'Status' => 'Loaded',
                'LawyerId' => $LawyerId,
                'Messages' => $Messages
            ));
        }
        else{
            $ClientId = $inputData['ClientID'];
            $LawyerId = session('userId');
            $Messages = ChatBox::whereIn('receiverId',[$ClientId,$LawyerId])
                        ->whereIn('senderId',[$ClientId, $LawyerId])
                        ->get();

            // Making unread messages as read -------------
                ChatBox::where('senderId', $ClientId)->where('receiverId',$LawyerId)->update(['hasRead' => 1]);

            return Response::json(array(
                'Status' => 'Loaded',
                'LawyerId' => $LawyerId,
                'Messages' => $Messages
            ));
        }
    }

    // This function is used when a user send messages --
    // --------- Saving Message To The Database. Marking This As Unread.
    // --------- Using socket we are broadcasting the message to the target User
    public function SaveMessage(Request $request){
        if (session('userType') == "Client") {
            // Getting the client name ---
            $user = User::find(Auth::id());
            $SenderName = $user->name;

            $inputData = $request->all();            

            $now = \Carbon\Carbon::now();

            // Creating Message data
            $messageData = array(
                'message'      => $inputData['Message'],
                'senderId'     =>  Auth::id(),
                'senderName'  =>  $SenderName,
                'receiverName' => $inputData['LawyerName'],
                'receiverId' => $inputData['LawyerID'],
                'hasRead' => 0
            );
            $messageId = ChatBox::insertGetId($messageData);

            // Socket
            $lawyerId = (int)$inputData['LawyerID'];
            $socketId = Redis::get($lawyerId);
            // dd($lawyerId);
            event(new PrivateMessage($messageId, $inputData['Message'], Auth::id(), $socketId, $SenderName, $now));

            return Response::json(array(
                'Status' => 'Saved',
                'Time' => $now
            ));
        }
        elseif (session('userType') == "Lawyer") {
            // Getting the client name ---
            $user = User::find(Auth::id());
            $SenderName = $user->name;

            $inputData = $request->all();

            // Creating Message data
            $messageData = array(
                'message'      => $inputData['Message'],
                'senderId'     =>  Auth::id(),
                'senderName'  =>  $SenderName,
                'receiverName' => $inputData['ClientName'],
                'receiverId' => $inputData['ClientID'],
                'hasRead' => 0
            );
            $messageId = ChatBox::insertGetId($messageData);

            // Saving Message ---
            $now = \Carbon\Carbon::now();

            // Socket 
            $clientId = (int)$inputData['ClientID'];
            $socketId = Redis::get($clientId);
            event(new PrivateMessage($messageId, $inputData['Message'], Auth::id(), $socketId, $SenderName, $now));

            return Response::json(array(
                'Status' => 'Saved',
                'Time' => $now
            ));
        }
    }
}