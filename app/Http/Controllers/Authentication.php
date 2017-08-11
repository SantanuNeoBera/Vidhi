<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Hash;
use Auth;
use DB;
use Response;
use Session;
// Model
use App\User;
use App\ClientDetails;
use App\OrganizationDetails;
use App\LawyerDetails;
use App\MetaInfo;
use App\LawyerAccountDetails;
use App\UserMetaInfo;
use App\UserMaster;

class Authentication extends Controller
{
	//Log In ---------------------------------------------------------------------------------
	public function getLogIn(){
		if (Auth::check()) {
			return view("Pages.Vidhikarya.Client.Dashboard");
		}
		return view('Pages.Vidhikarya.Global.login');
	}

    public function LogIn(Request $request){
    	$inputData = $request->all();
    	$email = $inputData['email'];
    	$password = $inputData['password'];
    	if (Auth::attempt(['email'=>$email,'password'=>$password])) {
    		$userId = Auth::id();
    		$userMaster = UserMaster::find($userId);
    		session(['userId' => $userId, 'userType' => $userMaster->userType]); //Creating The Session
	      	return Response::json(array(
	          		'success' => true
	        ));
        }
        else{
        	return Response::json(array(
	          		'success' => false
	        ));
        }
    }

    //Log Out -------------------------------------------------------------------------------
    public function LogOut(){
    	Auth::logout(); //Logging Out The User
    	Session::flush(); //Clearing The Session
    	return view('Pages.Vidhikarya.Global.Home');
    }

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

	//Organization -----------------------------------------------------------------------
	public function orgRegisterGetForm(){
		return view('auth.organizationRegister');
	}
	public function OrgRegisterCheckValidation(Request $request){
    	$inputData = $request->all(); //Getting All Form Input Data

    	//Creating data for validation
    	$validationData = array(
    		'orgName' => $inputData['orgName'],
		    'orgType' => $inputData['orgType'],
		    'country' => $inputData['country'],
		    'mobileNo' => $inputData['mobileNo'],
		    'email' => $inputData['email'],
		    'password' => $inputData['password'],
		    'password_confirmation' => $inputData['password_confirmation']
    	);

    	//Defining Rules For Validation
    	$rules = array(
	    	'orgName' => 'required',
	    	'orgType' => 'required',
	    	'mobileNo' => 'numeric',
	    	'country' => 'required',
	        'email'     =>  'required|email|unique:users',
	        'password'  =>  'required|min:6|confirmed',
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
	    	return Response::json(array(
	            'fail' => false
	        ));
	    }
    }
    public function RegisterOrg(Request $request){
    	$inputData = $request->all();

    	//Creating data for users table
	    $userData = array(
	      'name'      =>  $inputData['orgName'],
	      'email'     =>  $inputData['email'],
	      'password'  =>  $inputData['password'],
	      'created_at' => \Carbon\Carbon::now(),
	      'updated_at' => \Carbon\Carbon::now(),
	    );
        $userData['password'] = Hash::make($userData['password']);
	    $userId = User::insertGetId($userData);

		//Creating data for OrganizationDetails table
	    $org = new OrganizationDetails;
	    $org->orgName = $inputData['orgName'];
	    $org->orgType = $inputData['orgType'];
	    $org->country = $inputData['country'];
	    $org->isBlocked = 0;
	    $org->mobileNo = $inputData['mobileNo'];
	    $org->address = '';
	    $org->state = '';
	    $org->city = '';
	    $org->age = '';
	    $org->areaBusiness = '';
	    $org->id = $userId;
	    $org->save();

      	//After saving the user details we should log in the user automatically
      	$em = $inputData['email'];
      	$pa = $inputData['password'];
      	if (Auth::attempt(['email'=>$em,'password'=>$pa])) {
        	return Response::json(array(
          		'success' => true
        	));
   		}
    }

	//Client ------------------------------------------------------------------------------
	public function clientRegisterGetForm(){
		if (Auth::check()) {
			return view("Pages.Vidhikarya.Global.Home");
		}
		$countries = MetaInfo::where('meta_category','Country')->get(['meta_value']);
		return view('Pages.Vidhikarya.Client.Register',compact('countries'));
	}
	public function clientRegisterCheckValidation(Request $request){
    	$inputData = $request->all(); //Getting All Form Input Data
    	// $fullName = $inputData['firstName'].' '.$inputData['middleName'].' '.$inputData['lastName'];

    	//Creating data for validation
    	$validationData = array(
    		'firstName' => $inputData['firstName'],
		    'lastName' => $inputData['lastName'],
		    'gender' => $inputData['gender'],
		    'mobileNo' => $inputData['mobileNo'],
		    'email' => $inputData['email'],
		    'password' => $inputData['password'],
		    'password_confirmation' => $inputData['password_confirmation']
    	);

    	//Defining Rules For Validation
    	$rules = array(
	    	'firstName' => 'required',
	    	'lastName' => 'required',
	    	'mobileNo' => 'numeric',
	    	'gender' => 'required',
	        'email'     =>  'required|email|unique:users',
	        'password'  =>  'required|min:6|confirmed',
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
	    else{
	    	return Response::json(array(
	            'fail' => false,
	        ));
	    }
	  //   else
	  //   {
	  //   	
	    // }
    }
    public function RegisterClient(Request $request){
    	$inputData = $request->all();
    	$fullName = $inputData['firstName'].' '.$inputData['middleName'].' '.$inputData['lastName'];

    	//Creating data for Users table
	    $userData = array(
	      'name'      => $fullName,
	      'email'     =>  $inputData['email'],
	      'password'  =>  $inputData['password'],
	      'created_at' => \Carbon\Carbon::now(),
	      'updated_at' => \Carbon\Carbon::now(),
	    );
        $userData['password'] = Hash::make($userData['password']);
    	$userId = User::insertGetId($userData);

		//Creating data for ClientDetails table
		$age = $inputData['age'];
		if ($age == null || $age == "") {
			$age = 0;
		}
		else{
			$age = (int)$age;
		}
	    $client = new ClientDetails;
	    $client->id = $userId;
	    $client->firstName = $inputData['firstName'];
	    $client->middleName = $inputData['middleName'];
	    $client->lastName = $inputData['lastName'];
	    $client->Gender = $inputData['gender'];
	    $client->country = $inputData['country'];
	    $client->mobileNo = $inputData['mobileNo'];
	    $client->address = $inputData['address'];
	    $client->state = $inputData['state'];
	    $client->city = $inputData['city'];
	    $client->age = $age;
	    $client->occupation = $inputData['occupation'];
	    $client->educationLavel = $inputData['educationLavel'];
	    $client->save();

	    //Creating Data for userMaster table
	    $um = new UserMaster;
	    $um->id = $userId;
	    $um->userType = 'Client';
	    $um->isBlocked = 0;
	    $um->save();

      	//After saving the user details we should log in the user automatically
      	$em = $inputData['email'];
      	$pa = $inputData['password'];
      	if (Auth::attempt(['email'=>$em,'password'=>$pa])) {
      		session(['userId' => $userId, 'userType' => "Client"]);
        	return Response::json(array(
          		'success' => true
        	));
        }
    }
    
    //Lawyer -----------------------------------------------------------------------------
    public function lawyerRegisterGetForm(){
    	if (Auth::check()) {
    		return view("Pages.Vidhikarya.Lawyer.Dashboard");
    	}
    	$workingLanguages =MetaInfo::where('meta_category','LawyerWorkingLanguage')->get(['meta_value']);
		$categories = MetaInfo::where('meta_category','LawCategory')->get(['meta_value']);
		$countries = MetaInfo::where('meta_category','Country')->get(['meta_value']);
    	return view('Pages.Vidhikarya.Lawyer.Register',compact('workingLanguages','categories','countries'));
    }
    public function LawyerRegisterFirstStepCheckValidation(Request $request){
    	$inputData = $request->all();
	    $validationData = array(
    		'firstName' => $inputData['firstName'],
		    'lastName' => $inputData['lastName'],
		    'gender' => $inputData['gender'],
		    'mobileNo' => $inputData['mobileNo'],
		    'email' => $inputData['email'],
		    'password' => $inputData['password'],
		    'password_confirmation' => $inputData['password_confirmation']
    	);
    	//Defining Rules For Validation
    	$rules = array(
	    	'firstName' => 'required',
	    	'lastName' => 'required',
	    	'mobileNo' => 'numeric',
	    	'gender' => 'required',
	        'email'     =>  'required|email|unique:users',
	        'password'  =>  'required|min:6|confirmed',
	    );
	    $validator = Validator::make($validationData,$rules); //Validating
	    if($validator->fails()) //Checking if the validation is success
	        return Response::json(array(
	            'Status' => 'Failed',
	            'errors' => $validator->getMessageBag()->toArray()
	        ));
	    else {
	    	return Response::json(array(
	            'Status' => 'Success'
	        ));
	    // //hash it now
	    //     $userData['password'] = Hash::make($userData['password']);
	    //     unset($userData['password_confirmation']);
	    // //save to DB user details
	    //   if(User::create($userData)) {
	    //   	//After saving the user details we should log in the user automatically
	    //   	$em = $inputData['email'];
	    //   	$pa = $inputData['password'];
	    //   	if (Auth::attempt(['email'=>$em,'password'=>$pa])) {
	    //   		//return success  message
     //        	return Response::json(array(
	    //       		'success' => true
	    //     	));
     //    	}
	    // }
	  }
    }
    public function LawyerRegisterSecStepCheckValidation(Request $request){
    	$inputData = $request->all();
	    $validationData = array(
    		'country' => $inputData['country'],
		    'state' => $inputData['state'],
		    'city' => $inputData['city'],
		    'experience' => $inputData['experience'],
		    'designation' => $inputData['designation'],
		    'education' => $inputData['education'],
    	);
    	//Defining Rules For Validation
    	$rules = array(
	    	'country' => 'required',
	    	'state' => 'required',
	    	'city' => 'required',
	    	'experience' => 'required',
	        'designation'     =>  'required',
	        'education'  =>  'required',
	    );
	    $validator = Validator::make($validationData,$rules); //Validating
	    if($validator->fails()) //Checking if the validation is success
	        return Response::json(array(
	            'Status' => 'Failed',
	            'errors' => $validator->getMessageBag()->toArray()
	        ));
	    else {
	    	return Response::json(array(
	            'Status' => 'Success'
	        ));
	    }
    }
	public function LawyerRegisterThirdStepCheckValidation(Request $request){
		$inputData = $request->all();
		if (!array_key_exists('workingLanguages', $inputData)) {
			return Response::json(array(
	            'Status' => 'Failed',
	            'errors' => ['workingLanguages' => 'Language Must Be Selected !']
	        ));
		}
		else if (!array_key_exists('categories', $inputData)) {
			return Response::json(array(
	            'Status' => 'Failed',
	            'errors' => ['categories' => 'Category Must Be Selected !']
	        ));
		}
		else{
			return Response::json(array(
	            'Status' => 'Success'
	        ));
		}
	}
	public function LastStepRegistrationofLawyer(Request $request){
    	$inputData = $request->all(); //Getting All Form Input Data
    	$fullName = $inputData['firstName'].' '.$inputData['middleName'].' '.$inputData['lastName'];

    	//Creating data for Users table
	    $userData = array(
	      'name'      => $fullName,
	      'email'     =>  $inputData['email'],
	      'password'  =>  $inputData['password'],
	      'created_at' => \Carbon\Carbon::now(),
	      'updated_at' => \Carbon\Carbon::now(),
	    );
        $userData['password'] = Hash::make($userData['password']);
    	$userId = User::insertGetId($userData);

    	//Creating Data for userMaster table
	    $um = new UserMaster;
	    $um->id = $userId;
	    $um->userType = 'Lawyer';
	    $um->isBlocked = 0;
	    $um->save();

    	//Creating data for Lawyer Details Table
    	$ld = new LawyerDetails;
    	$ld->id = $userId;
    	$ld->firstName = $inputData['firstName'];
    	$ld->middleName = $inputData['middleName'];
    	$ld->lastName = $inputData['lastName'];
    	$ld->country = $inputData['country'];
    	$ld->Gender = $inputData['gender'];
    	$ld->mobileNo = $inputData['mobileNo'];
    	$ld->state = $inputData['state'];
    	$ld->city = $inputData['city'];
    	$ld->experience = $inputData['experience'];
    	$ld->designation = $inputData['designation'];
    	$ld->education = $inputData['education'];
    	$ld->photo = ""; //NeedModification
    	$ld->professionalSummary = $inputData['professionalSummary'];
    	$ld->stateBarCouncil = $inputData['stateBarCouncil'];
    	$ld->barCouncilRegNo = $inputData['barCouncilRegNo'];
    	$ld->uploadBarCouncil = ""; //NeedModification
    	$ld->nameOfBarAssociation = $inputData['nameOfBarAssociation'];
    	$ld->courtName = $inputData['courtName'];
    	$ld->save();

    	//Creating Data for Lawyer Account Details Table
    	$lad = new LawyerAccountDetails;
    	$lad->id = $userId;
    	$lad->bankName = $inputData['bankName'];
    	$lad->branchName = $inputData['branchName'];
    	$lad->accountHolderName = $inputData['accountHolderName'];
    	$lad->IFSCCode = $inputData['IFSCCode'];
    	$lad->accountNumber = $inputData['accountNumber'];
    	$lad->save();

    	//Creating Data For UserMetaInfo table
    	$WorkingLanguages = $inputData['workingLanguages'];
    	$Categories = $inputData['categories'];
    	foreach ($WorkingLanguages as $Language) {
    		$umi = new UserMetaInfo;
    		$umi->id=$userId;
	    	$umi->userType="Lawyer";
	    	$umi->meta_category="WorkingLanguage";
	    	$umi->meta_key="";
	    	$umi->meta_value=$Language;
	    	$umi->save();
    	}
    	foreach ($Categories as $Category) {
    		$umi = new UserMetaInfo;
    		$umi->id=$userId;
	    	$umi->userType="Lawyer";
	    	$umi->meta_category="Category";
	    	$umi->meta_key="";
	    	$umi->meta_value=$Category;
	    	$umi->save();
    	}

    	//After saving the user details we should log in the user automatically
      	$em = $inputData['email'];
      	$pa = $inputData['password'];
      	if (Auth::attempt(['email'=>$em,'password'=>$pa])) {
    		session(['userId' => $userId, 'userType' => "Lawyer"]);
	      	return Response::json(array(
	          		'Status' => "Registered"
	        	));
        }
    }
}