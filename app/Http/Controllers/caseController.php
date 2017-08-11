<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Auth;
//Model
use App\Cases;
use App\UserMaster;
use App\ClientDetails;
use App\LawyerDetails;
use App\OrganizationDetails;
use App\CaseNote;
use App\CaseApply;
use Carbon\Carbon;
use App\ChatBox;
use App\WithdrawCases;
use App\ActionLog;
use App\MarkComplete;
use App\ClientPaymentsAggrement;

class caseController extends Controller
{
	public function MarkCompleteACase(Request $request){
		$inputData = $request->all();
		$caseId = (int)$inputData['caseId'];
		$comment = $inputData['comment'];
		$lawyerId = Auth::id();
		// Changing The Status Of Case Apply To LawyerCompleted
		CaseApply::where('caseId', $caseId)->where('lawyerId',$lawyerId)->update(['status' => 'ApprovalPending']);
		// Creating The Log
		$al = new ActionLog;
		$al->userId = $lawyerId;
		$al->userType = 'Lawyer';
		$al->actionType = 'Lawyer Completed';
		$al->oldValue = '';
		$al->newValue = '';
		$al->caseId = $caseId;
		$al->save();
		// Adding The Mark Complete Comment if there's any
		if ($comment != "") {
			$mc = new MarkComplete;
			$mc->comment = $comment;
			$mc->caseId = $caseId;
			$mc->lawyerId = $lawyerId;
			$mc->save();
		}
		// Returning Success
		return Response::json(array(
            'Status' => "LawyerCompleted",
        ));
	}
	public function WidthdrawApplied(Request $request){
		$inputData = $request->all();
		$caseId = (int)$inputData['caseId'];
		$comment = $inputData['comment'];
		$lawyerId = Auth::id();
		$case = CaseApply::where('caseId',$caseId)->where('lawyerId',$lawyerId)->delete();

		// Storing The Reason
		$wc = new WithdrawCases;
		$wc->caseId = $caseId;
		$wc->userId = $lawyerId;
		$wc->comment = $comment;
		$wc->save();

		// Creating Log
		$al = new ActionLog;
		$al->userId = $lawyerId;
		$al->userType = 'Lawyer';
		$al->actionType = 'Case Withdrawed';
		$al->oldValue = '';
		$al->newValue = '';
		$al->caseId = $caseId;
		$al->save();

		return Response::json(array(
            'Status' => "Withdrew",
        ));
	}
	public function ApproveLawyer(Request $request){
		$inputData = $request->all();
		$lawyerId = (int)$inputData['lawyerId'];
		$caseId = (int)$inputData['caseId'];

		//Changing the status in Cases Table
		$case = Cases::find($caseId);
		$case->caseStatus = "Running";
		$case->save();

		// Creating Row to ClientPaymentsAggrements
    	$payinfo = CaseApply::where('caseId',$caseId)->where('lawyerId',$lawyerId)->first();
    	$amount = 0;
    	if ((int)$payinfo->isFixedRate == 1) {
    		$amount = (float)$payinfo->totalAmount;
    	}
    	else{
    		$amount = (float)$payinfo->amountPerHour * (int)$payinfo->estimatedHour;
    		$whole = floor($amount);
    		$frac = $amount - $whole;
    		if ($frac != 0 ) {
    			$whole = $whole + 1;
    		}
    		$amount = $whole;
    	}
    	$cpa = new ClientPaymentsAggrement;
    	$cpa->amount = $amount;
    	$cpa->forCaseId = $caseId;
    	$cpa->clientId = (int)$payinfo->userId;
    	$cpa->save();

		//Changing the status in CaseApply
		$ca = CaseApply::where('lawyerId',$lawyerId)->where('caseId',$caseId)->first();
		$ca->status = "Approved";
		$ca->save();

		return Response::json(array(
	            'Status' => "Approved",
	        ));
	}
	public function FixedApply(Request $request){
		$lawyerId = session('userId');
		$inputData = $request->all();
		$ca = new CaseApply;
		$ca->caseId = $inputData['caseId'];
		$ca->userId = (int)$inputData['userId'];
		$ca->lawyerId = $lawyerId;
		$ca->appliedDate = Carbon::now();
		$ca->status = "Applied";
		$ca->isFixedRate = 1;
		$ca->isHourlyRate = 0;
		$ca->totalAmount = $inputData['totalAmount'];
		$ca->comment = $inputData['comment'];
		$ca->clientCanContact = (int)$inputData['canContact'];
		$ca->wantAdvancePayment = (int)$inputData['advancePayment'];
		$ca->advancePercentage = (int)$inputData['advancePercentage'];

		$ca->amountPerHour = 0;
		$ca->estimatedHour = 0;
		
		$ca->save();

		return Response::json(array('Status' => 'Applied'));
	}
	public function HourlyApply(Request $request){
		$lawyerId = session('userId');
		$inputData = $request->all();
		$ca = new CaseApply;
		$ca->caseId = $inputData['caseId'];
		$ca->userId = (int)$inputData['userId'];
		$ca->lawyerId = $lawyerId;
		$ca->appliedDate = Carbon::now();
		$ca->status = "Applied";
		$ca->isFixedRate = 0;
		$ca->isHourlyRate = 1;
		$ca->amountPerHour = (int)$inputData['amountPerHour'];
		$ca->estimatedHour = (int)$inputData['estimatedHour'];
		$ca->comment = $inputData['commentforHourly'];
		$ca->clientCanContact = (int)$inputData['canContactforHourly'];
		$ca->wantAdvancePayment = (int)$inputData['advancePaymentforHourly'];
		$ca->advancePercentage = (int)$inputData['advancePercentageforHourly'];
		
		$ca->totalAmount = 0;

		$ca->save();

		return Response::json(array('Status' => 'Applied'));
	}
    public function getNewCaseForm(){
    	$userId = Auth::id();
    	// Common Data --------
    	$UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
    	return view('Pages.Vidhikarya.Client.CaseForm',compact('UnreadMessagegs'));
    }
    public function addNewNote(Request $request){
    	if (Auth::check()) {
    		if (session('userType') == 'Client') {
    			$inputData = $request->all();
		    	$note = new CaseNote;
		    	$note->userId = (int)session('userId');
		    	$note->caseId = (int)$inputData['caseId'];
		    	$note->notes= $inputData['newNote'];
		    	$note->save();
		    	$now = date('Y-m-d h:m:s');
		    	return Response::json(array(
		            'Status' => "Added",
		            'Time' => $now
		        ));
    		}
    		else{
    			return view("Pages.Vidhikarya.Global.FourOFour");
    		}
    	}
    	else{
    		return view("Pages.Vidhikarya.Global.login");
    	}    	
    }
    public function CaseDetails($id){
    	if (Auth::check()) {
    		if (session('userType') == "Client") {
    			// Applied Lawyer
    			$AppliedLawyers = CaseApply::where('caseId',$id)->where('status','Applied')
    								->join('LawyerDetails','CaseApply.lawyerId','=','LawyerDetails.id')
    								->get();
    			$hasAnyAppliedLawyers = false;
    			foreach($AppliedLawyers as $lawyer){
    				$hasAnyAppliedLawyers = true;
    			}

    			// Approved Lawyer
    			$ApprovedLawyer = CaseApply::where('caseId',$id)
    								->whereIn('status',['Approved','Active','ApprovalPending'])
    								->join('LawyerDetails','CaseApply.lawyerId','=','LawyerDetails.id')
    								->first();
    			$lawyerEngaged = false;
    			if ($ApprovedLawyer != null) {
    				$lawyerEngaged = true;
    			}

    			// Payments 
    			$Payments = "";
    			$hasPayments = false;
		    	if ($ApprovedLawyer != null) {
		    		if ($ApprovedLawyer->status == "ApprovalPending") {
			    		$Payments = ClientPaymentsAggrement::where('clientId',Auth::id())->get();
			    		$hasPayments = true;
			    		$Payments = ClientPaymentsAggrement::select(
			    							'ClientPaymentsAggrement.id', 
			    							'ClientPaymentsAggrement.amount', 
			    							'ClientPaymentsAggrement.forCaseId', 
			    							'ClientPaymentsAggrement.clientId', 
			    							'LawyerDetails.firstName', 
			    							'LawyerDetails.lastName',
			    							'CaseApply.lawyerid'
			    							)
				            ->join('CaseApply', 'CaseApply.caseId', '=', 'ClientPaymentsAggrement.forCaseId')
				            ->join('LawyerDetails', 'LawyerDetails.id', '=', 'CaseApply.lawyerid')
				            ->get();
			    	}
		    	}

		    	// Case Information
    			$TheCase = Cases::find($id);
		    	$userId = $TheCase->userId;
		    	$userType = UserMaster::find($userId)->userType;
		    	$userDetails = '';
		    	$userDetails = ClientDetails::find($userId);
		    	$caseNotes = CaseNote::where('userId',$userId)->where('caseId',$id)->latest()->get();

		    	// Common Data ------------
		    	$UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
		    	return view('Pages.Vidhikarya.Client.CaseDetails',compact(
		    		'AppliedLawyers', 'hasAnyAppliedLawyers',
		    		'ApprovedLawyer', 'lawyerEngaged', 
		    		'TheCase','userDetails','caseNotes','totalNumberOfAppliedLawyers','UnreadMessagegs',
		    		'Payments', 'hasPayments'));
    		}
    		elseif (session('userType') == "Lawyer") {
    			$lawyerId = session('userId');
		    	$TheCase = Cases::find($id);
		    	$userId = $TheCase->userId;
		    	$userType = UserMaster::find($userId)->userType;
		    	$userDetails = '';
		    	$caseNotes = CaseNote::where('userId',$userId)->where('caseId',$id)->latest()->get();
		    	$AppliedData = CaseApply::where('lawyerId',$lawyerId)->where('caseId',$id)->get();
		    	// Case Status ------------
		    	$isRunning = false;
		    	// Case Apply Status ---------
		    	$hasApplied = false;
		    	$hasApproved = false;
		    	$isActive = false;
		    	$approvalPending = false;
		    	$isClosed = false;
		    	$lawyerEngaged = false;
		    	// -----------------
		    	foreach ($AppliedData as $data) {
		    		if ($data->status == "Applied") {
		    			$hasApplied = true;
		    			$lawyerEngaged = true;
		    		}
		    		else if ($data->status == "Approved") {
		    			$hasApproved = true;
		    			$lawyerEngaged = true;
		    		}
		    		else if($data->status == "Active"){
		    			$isActive = true;
		    			$lawyerEngaged = true;
		    		}
		    		else if($data->status == "ApprovalPending"){
		    			$approvalPending = true;
		    			$lawyerEngaged = true;
		    		}
		    		else if($data->status == "Closed"){
		    			$isClosed = true;
		    			$lawyerEngaged = true;
		    		}
		    	}
		    	if ($TheCase->caseStatus == "Running") {
		    		$isRunning = true;
		    	}
		    	if ($userType == "Client") {
		    		$userDetails = ClientDetails::find($userId);
		    	}
		    	elseif ($userType == "Org") {
		    		$userDetails = OrganizationDetails::find($userId);
		    	}
		    	if ($lawyerEngaged == true) {
		    		$AppliedData = $AppliedData[0];
		    	}
		    	// --------- Common Data -------------
		    	$UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
		    	return view('Pages.Vidhikarya.Lawyer.CaseDetails',compact('TheCase','userDetails','caseNotes','AppliedData',
		    			'hasApplied', 'hasApproved', 'isActive', 'approvalPending', 'isClosed', 'lawyerEngaged', 'isRunning', 'UnreadMessagegs' ));
    		}
    		elseif (session('userType') == "Org") {
    			
    		}
    		elseif(session('userType') == "Admin"){

    		}
    	}
    }
    public function RegistertheCase(Request $request){
    	$inputData = $request->all();

    	//Creating data for validation
    	$validationData = array(
    		'caseTitle' => $inputData['caseTitle'],
		    'caseCategory' => $inputData['caseCategory'],
		    'caseDueDate' => $inputData['caseDueDate'],
		    'caseDescription' => $inputData['caseDescription'],
    	);

    	//Defining Rules For Validation
    	$rules = array(
	    	'caseTitle' => 'required',
	    	'caseCategory' => 'required',
	    	'caseDueDate' => 'required',
	    	'caseDescription' => 'required',
	    );

	    $validator = Validator::make($validationData,$rules); //Validating
	     //Checking if the validation is success
	    if($validator->fails())
	    {
	    	return Response::json(array(
	            'fail' => true,
	            'errors' => $validator->getMessageBag()->toArray()
	        ));
	    }
	    else
	    {
	    	//Registering The Case --------
	    	$userId = Auth::id();
	 	$isOnlyAdvisable = 0;
	    	$attachmentPrivacy = 'AllLawyer';
	    	$postAsAnonymous = 0;
	    	$displayId = '';
	    	if (array_key_exists('isOnlyAdvisable', $inputData)) {
	    		if ($inputData['isOnlyAdvisable'] == true) {
	    			$isOnlyAdvisable = 1;
	    		}
	    	}
	    	if (array_key_exists('attachmentPrivacy', $inputData)) {
	    		if ($inputData['attachmentPrivacy'] == true) {
	    			$attachmentPrivacy = 'ApprovedLawyer';
	    		}
	    	}
	    	if (array_key_exists('postAsAnonymous', $inputData)) {
	    		if ($inputData['postAsAnonymous'] == true) {
	    			$postAsAnonymous = 1;
	    		}
	    	}
	    	$userType = session('userType');
	    	if ($userType == 'Client') {
	    		$umdata = ClientDetails::find($userId);
	    		$displayId = "DID - Client";
	    	}
	    	if ($userType == 'Org') {
	    		$umdata = OrganizationDetails::find($userId);
	    		$displayId = "DID - Org";
	    	}
	    	$caseData = array(
		      'caseTitle'      =>  $inputData['caseTitle'],
		      'caseCategory'     =>  $inputData['caseCategory'],
		      'caseDescription'  =>  $inputData['caseDescription'],
		      'caseDueDate' => $inputData['caseDueDate'],
		      'isOnlyAdvisable' => $isOnlyAdvisable,
		      'attachmentPrivacy' => $attachmentPrivacy,
		      'postAsAnonymous' => $postAsAnonymous,
		      'userId' => $userId,
		      'displayId' => $displayId,
		      'caseStatus' => 'Open',
		    );
		    $caseId = Cases::insertGetId($caseData);
		    return Response::json(array(
	            'Status' => 'Registered',
	            'caseId' => $caseId
	        ));
	    }
    }
    public function UpdateCaseInfo(Request $request){
    	$inputData = $request->all();
    	$isOnlyAdvisable = 0;
    	$attachmentPrivacy = 'AllLawyer';
    	$postAsAnonymous = 0;
    	if (array_key_exists('isOnlyAdvisable', $inputData)) {
    		if ($inputData['isOnlyAdvisable'] == "true") {
    			$isOnlyAdvisable = 1;
    		}
    	}
    	if (array_key_exists('attachmentPrivacy', $inputData)) {
    		if ($inputData['attachmentPrivacy'] == "true") {
    			$attachmentPrivacy = 'ApprovedLawyer';
    		}
    	}
    	if (array_key_exists('postAsAnonymous', $inputData)) {
    		if ($inputData['postAsAnonymous'] == "true") {
    			$postAsAnonymous = 1;
    		}
    	}
    	$data = Cases::find((int)$inputData['caseId']);
    	$data->isOnlyAdvisable = $isOnlyAdvisable;
    	$data->attachmentPrivacy = $attachmentPrivacy;
    	$data->postAsAnonymous = $postAsAnonymous;
    	$data->save();
    	return Response::json(array(
            'Status' => 'Updated'
        ));
    }
    public function CaseList(){
    	if (Auth::check()) {
    		return view('Pages.Vidhikarya.Global.FourOFour');
    	}
    	return view('Pages.Vidhikarya.Lawyer.CaseList');
    }
    public function PickUpTheCase(Request $request){
    	$inputData = $request->all();
    	$caseId = (int)$inputData['caseId'];
    	$lawyerId = Auth::id();

    	// Changing The Case Status - Cases
    	$case = Cases::find($caseId);
    	$case->caseStatus = "Running";
    	$case->save();

    	// Changing The Lawyer Case Apply Status - CaseApply
    	CaseApply::where('caseId', $caseId)->where('lawyerId',$lawyerId)->update(['status' => 'Active']);

    	// Creating Log 
    	$al = new ActionLog;
		$al->userId = $lawyerId;
		$al->userType = 'Lawyer';
		$al->actionType = 'Case Picked Up';
		$al->oldValue = '';
		$al->newValue = '';
		$al->caseId = $caseId;
		$al->save();

    	return Response::json(array(
            'Status' => 'PickedUp',
            'caseId' => $caseId
        ));
    }
}