<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
//Model --------------------------
use App\User;
use App\ClientDetails;
use App\MetaInfo;
use App\LawyerDetails;
use App\LawyerRating;
use App\ChatBox;
class Account extends Controller
{
	//Global ------------------------------------------------------------------------------
	public function LoadState(Request $request){
		$inputData = $request->all(); //Getting All Form Input Data
		$country = $inputData['country'];
		$state=MetaInfo::where('meta_category','State')->where('meta_key',$country)->get(['meta_value']);
		$states = [];
		foreach ($state as $value) {
			$states[] = $value->meta_value;
		}		
		return Response::json(array(
	          		'success' => true,
	          		'states' => json_encode($states)
	        	));
	}
    public function getProfileInformation(){
        if (session('userType') == "Client") {
            $userId = Auth::id();
            $clientDetails = ClientDetails::where('id',$userId)->get();
            $user = User::where('id',$userId)->get(['email','name']);
            $countries = MetaInfo::where('meta_category','Country')->get(['meta_value']);
            $states=MetaInfo::where('meta_category','State')->where('meta_key','India')->get(['meta_value']);
            // Common Data ----------------
            $UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
            return view("Pages.Vidhikarya.Client.profile",compact('user','clientDetails','countries','states','UnreadMessagegs'));
        }
        else if(session('userType') == "Lawyer"){
            $userId = Auth::id();
            $lawyerDetails = LawyerDetails::where('id',$userId)->get();
            $user = User::where('id',$userId)->get(['email','name']);
            $countries = MetaInfo::where('meta_category','Country')->get(['meta_value']);
            $states=MetaInfo::where('meta_category','State')->where('meta_key','India')->get(['meta_value']);
            // Rating and Review --------------------
            $tmpReviews = LawyerRating::where('lawyerId',$userId)->get(['rating','review']);
            $oneStar = 0;
            $twoStar = 0;
            $threeStar = 0;
            $fourStar = 0;
            $fiveStar = 0;
            $totalRating = 0;
            $totalReview = 0;
            $averageRating = 0;
            foreach ($tmpReviews as $rate) {
                if ($rate->rating == 1) {
                    $oneStar++;
                }
                elseif ($rate->rating == 2) {
                    $twoStar++;
                }
                elseif ($rate->rating == 3) {
                    $threeStar++;
                }
                elseif ($rate->rating == 4) {
                    $fourStar++;
                }
                elseif ($rate->rating == 5) {
                    $fiveStar++;
                }
                $totalRating++;
                if ($rate->review != "") {
                    $totalReview++;
                }
            }
            if ($totalRating == 0) {
                // 
            }
            else{
                $averageRating = (($oneStar*1) + ($twoStar*2) + ($threeStar*3) + ($fourStar*4) + ($fiveStar*5))/$totalRating;
            }
            $averageRating = round($averageRating,1);
            $LawyerReviews = LawyerRating::where('lawyerId',$userId)->take(2)->get();
            // ------- Common Data ---------------------------
            $UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
            // Rating and Review --------------- End
            return view('Pages.Vidhikarya.Lawyer.profile',compact('lawyerDetails','user','countries','states','LawyerReviews','oneStar','twoStar','threeStar','fourStar','fiveStar','totalRating','totalReview','averageRating','UnreadMessagegs'));
        }
        else{
        }
    }
    public function LoadReview(Request $request){
        $userId = Auth::id();
        $inputData = $request->all();
        $CurrentReviewLoaded = $inputData['currentReviewsLoaded'];
        $loadReview = LawyerRating::where('lawyerId',$userId)->skip($CurrentReviewLoaded)->take(2)->get();
        return Response::json(array(
                'Status' => "Loaded",
                'Reviews' => $loadReview
            ));
    }
    public function UpdateProfileInformation(Request $request){
    	$userId = Auth::id();
    	$inputData = $request->all();
    	$clientDetails = ClientDetails::find($userId);

    	$clientDetails->gender = $inputData['gender'];
    	$clientDetails->age = (int)$inputData['age'];
    	$clientDetails->occupation = $inputData['occupation'];
    	$clientDetails->educationLavel = $inputData['educationLavel'];

    	$clientDetails->save();
    }
    // Update Client ---------------------------------------------------------
    public function UpdateContactInformationforClient(Request $request){
    	$userId = Auth::id();
    	$inputData = $request->all();

        // Updating ClientDetails
    	$clientDetails = ClientDetails::find($userId);
    	$clientDetails->mobileNo = $inputData['mobileNo'];
    	$clientDetails->save();

        // Updating User
    	$user = User::find($userId);
    	$user->email = $inputData['email'];
    	$user->save();

    	return Response::json(array(
	          		'success' => true,
	        	));
    }
    public function UpdateAddressInformationforClient(Request $request){
        $userId = Auth::id();
        $inputData = $request->all();

        //Updating ClientDetails
        $clientDetails = ClientDetails::find($userId);
        $clientDetails->country = $inputData['country'];
        $clientDetails->address = $inputData['address'];
        $clientDetails->state = $inputData['state'];
        $clientDetails->city = $inputData['city'];

        $clientDetails->save();

        return Response::json(array(
                    'Status' => "Updated",
                ));
    }
    public function UpdateGeneralInformationforClient(Request $request){
        $userId = Auth::id();
        $inputData = $request->all();

        //Updating ClientDetails
        $clientDetails = ClientDetails::find($userId);
        $clientDetails->firstName = $inputData['firstName'];
        $clientDetails->middleName = $inputData['middleName'];
        $clientDetails->lastName = $inputData['lastName'];
        $clientDetails->gender = $inputData['gender'];
        $clientDetails->occupation = $inputData['occupation'];
        $clientDetails->age = $inputData['age'];
        $clientDetails->educationLavel = $inputData['educationLavel'];
        $clientDetails->save();

        // Updating User
        $user = User::find($userId);
        $user->name = $inputData['firstName']." ".$inputData['middleName']." ".$inputData['lastName'];
        $user->save();

        return Response::json(array(
                    'Status' => "Updated",
                ));
    }
    // Update Lawyer
    public function UpdateGeneralInformationforLawyer(Request $request){
        $userId = Auth::id();
        $inputData = $request->all();

        //Updating ClientDetails
        $lawyerDetails = LawyerDetails::find($userId);
        $lawyerDetails->firstName = $inputData['firstName'];
        $lawyerDetails->middleName = $inputData['middleName'];
        $lawyerDetails->lastName = $inputData['lastName'];
        $lawyerDetails->gender = $inputData['gender'];
        $lawyerDetails->save();

        // Updating User
        $user = User::find($userId);
        $user->name = $inputData['firstName']." ".$inputData['middleName']." ".$inputData['lastName'];
        $user->save();

        return Response::json(array(
                    'Status' => "Updated",
                ));
    }
    public function UpdateContactInformationforLawyer(Request $request){
        $userId = Auth::id();
        $inputData = $request->all();

        // Updating LawyerDetails
        $lawyerDetails = LawyerDetails::find($userId);
        $lawyerDetails->mobileNo = $inputData['mobileNo'];
        $lawyerDetails->save();

        // Updating User
        $user = User::find($userId);
        $user->email = $inputData['email'];
        $user->save();

        return Response::json(array(
                    'Status' => 'Updated',
                ));
    }
    public function UpdateAddressInformationforLawyer(Request $request){
        $userId = Auth::id();
        $inputData = $request->all();

        //Updating LawyerDetails
        $lawyerDetails = LawyerDetails::find($userId);
        $lawyerDetails->country = $inputData['country'];
        $lawyerDetails->state = $inputData['state'];
        $lawyerDetails->city = $inputData['city'];

        $lawyerDetails->save();

        return Response::json(array(
                    'Status' => "Updated",
                ));
    }
    public function UpdateEducationalInformationforLawyer(Request $request){
        $userId = Auth::id();
        $inputData = $request->all();

        //Updating LawyerDetails
        $lawyerDetails = LawyerDetails::find($userId);
        $lawyerDetails->experience = $inputData['experience'];
        $lawyerDetails->designation = $inputData['designation'];
        $lawyerDetails->education = $inputData['education'];
        $lawyerDetails->professionalSummary = $inputData['professionalSummary'];
        $lawyerDetails->stateBarCouncil = $inputData['stateBarCouncil'];
        $lawyerDetails->stateBarCouncil = $inputData['stateBarCouncil'];
        $lawyerDetails->barCouncilRegNo = $inputData['barCouncilRegNo'];
        $lawyerDetails->nameOfBarAssociation = $inputData['nameOfBarAssociation'];
        $lawyerDetails->courtName = $inputData['courtName'];

        $lawyerDetails->save();

        return Response::json(array(
                    'Status' => "Updated",
                ));
    }
    //The following method is for displaying information of lawyer's account to client
    public function LawyerProfile($id){
        $userId = Auth::id();
        $LawyerDetails = LawyerDetails::find($id);
        $LawyerReviews = LawyerRating::where('lawyerId',$id)->get();
        $LawyerDetailsFromUser = User::find($id);
        // --------- Common Data ---------
        $UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
        return view('Pages.Vidhikarya.Lawyer.LawyerProfile',compact('LawyerDetails','LawyerReviews','LawyerDetailsFromUser','UnreadMessagegs'));
    }
    public function ClientProfile($id){
        $ClientId = $id;
        $userId = Auth::id();
        $clientDetails = ClientDetails::where('id',$id)->get();
        $user = User::where('id',$id)->get(['email','name']);
        $countries = MetaInfo::where('meta_category','Country')->get(['meta_value']);
        $states=MetaInfo::where('meta_category','State')->where('meta_key','India')->get(['meta_value']);
        // --------- Common Data ---------
        $UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
        return view("Pages.Vidhikarya.Client.ClientProfile",compact('user','clientDetails','countries','states','ClientId','UnreadMessagegs'));
    }
}