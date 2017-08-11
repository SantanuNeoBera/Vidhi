<?php
use Illuminate\Support\Facades\Redis;

Route::get('/',function(){
	return view('Pages.Vidhikarya.Global.Home');
});
Route::get('/Home',function(){
	return view('Home');
});
Route::get('Dashboard','Dashboard@getDashboard');
Route::post('LoadState','Authentication@LoadState');
//Authentication ----------
Route::get('clientRegister','Authentication@clientRegisterGetForm');
Route::post('clientRegisterCheckValidation','Authentication@clientRegisterCheckValidation');
Route::post('RegisterClient','Authentication@RegisterClient');
Route::get('lawyerRegister','Authentication@lawyerRegisterGetForm');
Route::post('LawyerRegisterFirstStepCheckValidation','Authentication@LawyerRegisterFirstStepCheckValidation');
Route::post('LawyerRegisterSecStepCheckValidation','Authentication@LawyerRegisterSecStepCheckValidation');
Route::post('LawyerRegisterThirdStepCheckValidation','Authentication@LawyerRegisterThirdStepCheckValidation');
Route::post('LastStepRegistrationofLawyer','Authentication@LastStepRegistrationofLawyer');
Route::get('login','Authentication@getLogIn');
Route::post('login','Authentication@LogIn');
Route::get('logout','Authentication@LogOut');

//Case Handler ----------
Route::get('postCase','caseController@getNewCaseForm');
Route::post('RegisterTheCase','caseController@RegisterTheCase');
Route::get('CaseDetails/{id}','caseController@CaseDetails');
Route::post('UpdateCaseInfo','caseController@UpdateCaseInfo');
Route::get('CaseList','caseController@CaseList');
Route::post('addNewNote','caseController@addNewNote');
Route::post('ApproveLawyer','caseController@ApproveLawyer');
Route::post('WidthdrawApplied','caseController@WidthdrawApplied');
Route::post('MarkCompleteACase','caseController@MarkCompleteACase');
Route::post('PickUpTheCase','caseController@PickUpTheCase');

//Lawyer Payment --------------
Route::post('FixedApply','CaseController@FixedApply');
Route::post('HourlyApply','CaseController@HourlyApply');

// Client Payment --------------
Route::post('ClientPay','PaymentController@ClientPay');
Route::post('PaymentSuccess','PaymentController@PaymentSuccess');
Route::post('PaymentFailed','PaymentController@PaymentFailed');

Route::post('RequestPayment','PaymentController@RequestPayment');

//Profile ----------------
Route::get('LawyerProfile/{id}','Account@LawyerProfile'); //Client See Lawyer's Account
Route::get('ClientProfile/{id}','Account@ClientProfile'); //lawyer See Client's Account
Route::get('myProfile','Account@getProfileInformation'); //Client,Lawyer and Org can See his Own Account

//Account ----------------
	// Client
	Route::post('UpdateContactInformationforClient','Account@UpdateContactInformationforClient');
	Route::post('UpdateAddressInformationforClient','Account@UpdateAddressInformationforClient');
	Route::post('UpdateGeneralInformationforClient','Account@UpdateGeneralInformationforClient');
	// Lawyer
	Route::post('UpdateGeneralInformationforLawyer','Account@UpdateGeneralInformationforLawyer');
	Route::post('UpdateContactInformationforLawyer','Account@UpdateContactInformationforLawyer');
	Route::post('UpdateAddressInformationforLawyer','Account@UpdateAddressInformationforLawyer');
	Route::post('UpdateEducationalInformationforLawyer','Account@UpdateEducationalInformationforLawyer');
	Route::post('LoadReviews','Account@LoadReview');
		
// Chatting------------------
Route::get('ChatBox/{id?}','ChatController@getChat');
Route::post('GetMessages','ChatController@GetMessages');
Route::post('GetTargetMessages','ChatController@GetTargetMessages');	
Route::post('SendMessage','ChatController@SaveMessage');

// ---------------------- Authentication -----------------
// --Organization-----
Route::get('orgRegister','Authentication@orgRegisterGetForm');
Route::post('OrgRegisterCheckValidation','Authentication@OrgRegisterCheckValidation');
Route::post('RegisterOrg','Authentication@RegisterOrg');			
// --Lawyer--------
//---------------------- Account Information---------------------------
// --Client------
			
			Route::post('UpdateProfileInformation','Account@UpdateProfileInformation');

// -------------------- Case Handler ------------------------------------------------------
			
			Route::get('lawyerCaseView/{id}','caseController@getLawyerCaseView');
			
Route::get('organizationRegister',function(){
	return view('auth.organizationRegister');
});
// ----------------------- POST ---------------------------
Route::get('FAQ',function(){
	return view('Pages.Vidhikarya.Global.FAQ');
});
Route::get('getSocket',function(){
	$id = Auth::id();
	$var = Redis::get($id);
	return $var;
});
Route::get('/{FourOFour}',function(){
	return view('Pages.Vidhikarya.Global.FourOFour');
});