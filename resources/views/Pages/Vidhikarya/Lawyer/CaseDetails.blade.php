@extends('Layouts.Vidhikarya.Lawyer.Master')
@section('title','Case Details')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<script type="text/javascript" src="{{ URL::asset('js/Vidhikarya/Lawyer/CaseDetails.js') }}"></script>
<style type="text/css">
	/*-----------------------------------*/
	@-webkit-keyframes scaleAnimation {
	  0% {
	    opacity: 0;
	    -webkit-transform: scale(1.5);
	            transform: scale(1.5);
	  }
	  100% {
	    opacity: 1;
	    -webkit-transform: scale(1);
	            transform: scale(1);
	  }
	}
	@keyframes scaleAnimation {
	  0% {
	    opacity: 0;
	    -webkit-transform: scale(1.5);
	            transform: scale(1.5);
	  }
	  100% {
	    opacity: 1;
	    -webkit-transform: scale(1);
	            transform: scale(1);
	  }
	}
	@-webkit-keyframes drawCircle {
	  0% {
	    stroke-dashoffset: 151px;
	  }
	  100% {
	    stroke-dashoffset: 0;
	  }
	}
	@keyframes drawCircle {
	  0% {
	    stroke-dashoffset: 151px;
	  }
	  100% {
	    stroke-dashoffset: 0;
	  }
	}
	@-webkit-keyframes drawCheck {
	  0% {
	    stroke-dashoffset: 36px;
	  }
	  100% {
	    stroke-dashoffset: 0;
	  }
	}
	@keyframes drawCheck {
	  0% {
	    stroke-dashoffset: 36px;
	  }
	  100% {
	    stroke-dashoffset: 0;
	  }
	}
	@-webkit-keyframes fadeOut {
	  0% {
	    opacity: 1;
	  }
	  100% {
	    opacity: 0;
	  }
	}
	@keyframes fadeOut {
	  0% {
	    opacity: 1;
	  }
	  100% {
	    opacity: 0;
	  }
	}
	@-webkit-keyframes fadeIn {
	  0% {
	    opacity: 0;
	  }
	  100% {
	    opacity: 1;
	  }
	}
	@keyframes fadeIn {
	  0% {
	    opacity: 0;
	  }
	  100% {
	    opacity: 1;
	  }
	}
	#successAnimationCircle {
	  stroke-dasharray: 151px 151px;
	  stroke: #FFF;
	}
	#successAnimationCheck {
	  stroke-dasharray: 36px 36px;
	  stroke: #FFF;
	}
	#successAnimationResult {
	  fill: #FFF;
	  opacity: 0;
	}
	#successAnimation.animated {
	  -webkit-animation: 1s ease-out 0s 1 both scaleAnimation;
	          animation: 1s ease-out 0s 1 both scaleAnimation;
	}
	#successAnimation.animated #successAnimationCircle {
	  -webkit-animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCircle, 0.3s linear 0.9s 1 both fadeOut;
	          animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCircle, 0.3s linear 0.9s 1 both fadeOut;
	}
	#successAnimation.animated #successAnimationCheck {
	  -webkit-animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCheck, 0.3s linear 0.9s 1 both fadeOut;
	          animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCheck, 0.3s linear 0.9s 1 both fadeOut;
	}
	#successAnimation.animated #successAnimationResult {
	  -webkit-animation: 0.3s linear 0.9s both fadeIn;
	          animation: 0.3s linear 0.9s both fadeIn;
	}
	#replay {
	  background: rgba(255, 255, 255, 0.2);
	  border: 0;
	  border-radius: 3px;
	  bottom: 100px;
	  color: #FFF;
	  left: 50%;
	  outline: 0;
	  padding: 10px 30px;
	  position: absolute;
	  -webkit-transform: translateX(-50%);
	          transform: translateX(-50%);
	}
	#replay:active {
	  background: rgba(255, 255, 255, 0.1);
	}
	/*---------------------------------*/
	.Button-1{
		color: #f24f66;
	    font-size: 13px;
	    text-transform: uppercase;
	    border: 1px #f24f66 solid;
	    border-radius: 3px;
	    display: inline-block;
	    padding: 9px 0 9px 0;
	    width: 200px;
	    margin-top: 19px;
	    transition: all 400ms ease-in-out;
	    text-align: center;
	}
	.Button-1:hover{
		background: #f24f66;
	    color: #fff;
	    -webkit-transform: scale(1.05);
	    -ms-transform: scale(1.05);
	    transform: scale(1.05);
	}
	#PageContent{
		background-color: #fff;
	}
	/*Nav Bar*/
	.Counter{
		color:#444d56;
	    display: inline-block; 
	    padding: 2px 5px;
	    margin-left: 5px;
	    font-size: 12px;
	    font-weight: 600;
	    line-height: 1;
	    color: #fff;
	    background-color: rgba(0,0,0,.38);
	    border-radius: 20px;
	}
	.CaseCardHeading{
		padding:5px;
		padding-left: 10px;
		width:100%;
		border-bottom: 1px solid #d0d1d5;
		font-size: 13px;
		line-height: 13px;
		text-transform: none;
		-webkit-font-smoothing:antialiased;
		font-weight: bold;
		color:#90949c;
	}
	.CaseCardContent{
		padding:10px;
	}
	.CaseCard{
		border: 1px solid;
		flex-basis: 300px;
		flex-grow: 1;
	    border-color: #e5e6e9 #dfe0e4 #d0d1d5;
	    border-radius: 0 0 4px 4px;
	    pointer-events: none;
	    background-color: #fff;
	    margin:5px;
	    margin-bottom: 10px;
	}
	.DashboardNavBar{
	    display: flex;
	    flex-wrap: wrap;
	    box-shadow: rgba(0, 0, 0, 0.5) 0px 2px 5px 0px;
	}
	.Tabs{
		align-content: flex-start;
		flex: 3;
	}
	.reponav-item{
		float: left;
	    padding: 7px 15px 8px;
	    color: #fff;
	    white-space: nowrap;
	    border: solid transparent;
	    border-width: 3px 1px 1px;
	    border-radius: 3px 3px 0 0;
	}
	.selected{
		color: #24292e;
	    background-color: #fff !important;
	    border-color: #e36209 #e1e4e8 transparent;
	}
	/* --------------------------------------------------CaseDetailsPage---------------------------------------------------------*/
	/*Overwritting -----------------------*/
	/*Making the Date Time Picker Label to White.*/
	.picker__title{
		color:#fff !important;
	}
	/*Removing the default box shadow for Case Update Button*/
	.btn--raised{
		box-shadow: none;
	}
	/*End Overwritting -------------------------*/
	#PageContent{
		padding:15px;
		width: 100%;
	}
	.CaseDetails{
		margin-bottom: 10px;
		background-color: #fff;
	}
	.TheLabel{
		 background-color:rgba(0,0,0,.03);
		 border:1px solid rgba(34,36,38,.15) !important;
	}
	.RowStyle{
		border:1px solid rgba(34,36,38,.15);
		padding:10px;
	}
	.LabelColStyle{
		background-color:rgba(0,0,0,.03);
		border-right:1px solid rgba(34,36,38,.15) !important;
		padding:5px;
	}
	.LabelValueStyle{
		padding: 5px;	
	}
	code{
		box-shadow: 1px 1px 3px rgba(0,0,0,.2), 1px 1px 1px rgba(0,0,0,.14), 1px 2px 1px -1px rgba(0,0,0,.12);
		background-color: #f5f5f5;
		border-radius: 0;
	}
	.updateButton{
		background:linear-gradient(-180deg, #fafbfc 30%, #eff3f6 60%);
		border-left:1px solid rgba(34,36,38,.15);
		margin: 0px; 
		border-radius: 0;
		height:36px;
		padding-left:10px;
		padding-right:10px;
		font-size: 12px;
	}
	.updateButton:hover{
		background:linear-gradient(-180deg, #fafbfc 30%, #eff3f6 60%) !important;
		box-shadow:inset 0 0.15em 0.3em rgba(27,31,35,0.15);
	}
	.caseButtonIconStyle{
		font-size:20px;
		padding-right: 5px;
	}
	.DashboardNavBar{
	    display: flex;
	    flex-wrap: wrap;
	}
	.Tabs{
		align-content: flex-start;
		flex: 3;
	}
	.newLabelStyle{
		flex:1; 
		border:1px solid rgba(34,36,38,.15); 
		padding:3px; 
		background-color: rgba(0,0,0,.07);
	}
	.newValueStyle{
		flex:3; 
		border:1px solid rgba(34,36,38,.15); 
		border-left: 0; 
		padding:3px;
	}
	.newRowStyle{
		display: flex; 
		flex-wrap: wrap; 
	}
	.Tabs:first-child a{
		border-left-color:transparent !important;
	}
	#Notes{
		background-color: #fff !important; 
		padding:10px; 
		box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5);
	}
	.TabContainer{
		background-color: #fff !important; 
		padding:10px; 
		box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5);
	}
</style>
<div id="PageContent">
	<div class="CaseDetails">
		<nav class="DashboardNavBar" style="background-color: #00d1b2; cursor: pointer;">
			<div class="Tabs">
				<neo-tab v-for="tab in Tabs" :data="tab" :tab-name="tab.TabName" @changed="ChangeTab"></neo-tab>
			</div>
	    </nav>

	    <!-- Details -->
	    <div id="Details" v-show="DetailsTab" class="TabContainer">

	    	<!-- ID -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle">
					<span>Case ID</span>
				</div>
				<div class="newValueStyle">
					<span>{{ $TheCase->displayId }}</span>
				</div>
	    	</div>

	    	<!-- Status -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Case Status</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span>Open</span>
				</div>
	    	</div>

	    	<!-- Name -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Posted By</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span><a href="{{ URL::to('ClientProfile/' . $userDetails->id) }}">{{ $userDetails->firstName.' '.$userDetails->middleName.' '.$userDetails->lastName }}</a></span>
				</div>
	    	</div>

	    	<!-- Case Due Date -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Case Due Date</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span>@{{ caseDueDate }}</span>
				</div>
	    	</div>

	    	<!-- Case Category -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Case Category</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span>{{ $TheCase->caseCategory }}</span>
				</div>
	    	</div>

	    	<!-- Advice Preference -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Case Type</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span v-if="isOnlyAdvisable">Advice Only</span>
					<span v-else>Full Leagal Service</span>
				</div>
	    	</div>

	    	<!-- Personal Details Visibility -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Personal Details Visibility</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span v-if="postAsAnonymous">Personal Details is Shown Only to Approved Lawyers.</span>
					<span v-else>Personal Details is Visible to All Lawyers.</span>
				</div>
	    	</div>

	    	<!-- Case Title -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Case Title</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span>{{ $TheCase->caseTitle }}</span>
				</div>
	    	</div>

	    	<!-- Case Description -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Case Description</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span>{{ $TheCase->caseDescription }}</span>
				</div>
	    	</div>
	    </div>

	    <!-- Notes -->
	    <div id="Notes" v-show="NotesTab" class="TabContainer">
	    	<div v-if="hasAnyNotes">
	            <v-card v-for="Note in CaseNotes">
	              <v-card-text>
	                <div>
	                    <p>
	                      <span v-html="Note.Note"></span><br><span style="font-size:13px;">@{{ Note.Date }}</span>
	                    </p>
	                </div>
	              </v-card-text>
	            </v-card>
            </div>
            <div v-else style="display: flex; justify-content: center; align-items: center; height: 250px; width: 100%;">
            	<span style="font-size: 24px;">No Notes Yet !</span>
            </div>
	    </div>

	    <!-- Files -->
	    <div id="Files" v-show="FilesTab" class="TabContainer">
	    	<div v-if="hasAnyFiles">
	    		<span style="font-size: 24px;">Notes !</span>
	    	</div>
	    	<div v-else style="display: flex; justify-content: center; align-items: center; height: 250px; width: 100%;">
            	<span style="font-size: 24px;">No Files Yet !</span>
            </div>
	    </div>

	    <!-- Timeline -->
	    <div id="Timeline" class="TabContainer" v-show="TimelineTab" style="padding: 20px;">
	    	<div style="height: 300px; width: 100%;" id="TimelineBody">
	    		<timeline v-for="(timeline, index) in TimelineData" :key="index" :element-data="timeline"></timeline>
	    	</div>
	    	<div style="display: flex; justify-content: flex-end; border-top:1px solid #eee; padding-top: 20px;">
	    		<a class="button is-primary" v-on:click="RequestPayment">Request Payment</a>
	    	</div>
	    </div>
	</div>
		@if($lawyerEngaged == true)
	    	@if($hasApplied == true)
	    		<div style="display: flex; justify-content: flex-end;">
		    		<v-btn dark default disabled>Applied</v-btn>
		    	</div>
		    	<div style="display: flex; justify-content: flex-end; align-items: center; margin-top: 10px; margin-bottom: 20px;">
		    		<a class="button is-danger" v-on:click='BeforeWithdrawApplied'>Withdraw</a>
		    	</div>
	    	@elseif($hasApproved == true)
		    	<div style="display: flex; justify-content: flex-end; align-items: center; margin-top: 10px; margin-bottom: 20px;">
		    		<a class="button is-danger" v-on:click="PickUpTheCase">Pick Up The Case</a>
		    	</div>
		    @elseif($isActive == true)
		    	<div style="display: flex; justify-content: flex-end; align-items: center; margin-top: 10px; margin-bottom: 20px;">
		    		<a class="button is-danger" v-on:click='BeforeMarkCompleteACase'>Mark Complete</a>
		    	</div>
		    @elseif($approvalPending == true)
		    	<div style="display: flex; justify-content: flex-end; align-items: center; margin-top: 10px; margin-bottom: 20px;">
		    		<h1>Waiting For Client To Approve This Case As Completed !</h1>
		    	</div>
	    	@endif

			@if((int)$AppliedData->isFixedRate == 1)
	    	<!-- Fixed Payment Details -->
	    	<div id="FixedPaymentDetails">
	    		<!-- Applied Status -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle">
						<span>Applied Status</span>
					</div>
					<div class="newValueStyle">
						@if($AppliedData->status == "Applied")
							<span style="color: #00d1b2; font-weight: bold;">{{ $AppliedData->status }}</span>
						@elseif($AppliedData->status == "Approved")
							<span style="color: #21ba45; font-weight: bold;">{{ $AppliedData->status }}</span>
						@endif
					</div>
		    	</div>

	    		<!-- Applied Date -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle">
						<span>Applied Date</span>
					</div>
					<div class="newValueStyle">
						<span>{{ $AppliedData->appliedDate }}</span>
					</div>
		    	</div>

		    	<!-- Payment Preference -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle" style="border-top: 0;">
						<span>Payment Preference</span>
					</div>
					<div class="newValueStyle" style="border-top: 0;">
						<span>Fixed Rate</span>
					</div>
		    	</div>

		    	<!-- Total Amount -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle" style="border-top: 0;">
						<span>Total Amount</span>
					</div>
					<div class="newValueStyle" style="border-top: 0;">
						<span>{{ $AppliedData->totalAmount }}</span>
					</div>
		    	</div>

		    	<!-- Comment -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle" style="border-top: 0;">
						<span>Comment</span>
					</div>
					<div class="newValueStyle" style="border-top: 0;">
						<span>{{ $AppliedData->comment }}</span>
					</div>
		    	</div>

		    	<!-- Client Can Contact -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle" style="border-top: 0;">
						<span>Client Can Contact</span>
					</div>
					<div class="newValueStyle" style="border-top: 0;">
						@if($AppliedData->clientCanContact == 0)
							<span>No</span>
						@else
							<span>Yes</span>
						@endif
					</div>
		    	</div>

		    	<!-- Advance Payment -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle" style="border-top: 0;">
						<span>Advance Payment</span>
					</div>
					<div class="newValueStyle" style="border-top: 0;">
						@if($AppliedData->wantAdvancePayment == 0)
							<span>No</span>
						@else
							<span>Yes</span>
						@endif
					</div>
		    	</div>

		    	<!-- Advance Payment Percentage -->
		    	@if($AppliedData->wantAdvancePayment == 1)
					<!-- Advance Payment -->
			    	<div class="newRowStyle">
			    		<div class="newLabelStyle" style="border-top: 0;">
							<span>Advance Percentage</span>
						</div>
						<div class="newValueStyle" style="border-top: 0;">
							<span>{{ $AppliedData->advancePercentage }}%</span>
						</div>
			    	</div>	    		
		    	@endif
	    	</div>
	    	@else
	    	<!-- Hourly Payment Detials -->
	    	<div id="HourlyPaymentDetails">

				<!-- Applied Date -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle">
						<span>Applied Date</span>
					</div>
					<div class="newValueStyle">
						<span>{{ $AppliedData->appliedDate }}</span>
					</div>
		    	</div>

		    	<!-- Payment Preference -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle" style="border-top: 0;">
						<span>Payment Preference</span>
					</div>
					<div class="newValueStyle" style="border-top: 0;">
						<span>Hourly Rate</span>
					</div>
		    	</div>

		    	<!-- Amount Per Hour -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle" style="border-top: 0;">
						<span>Amount Per Hour</span>
					</div>
					<div class="newValueStyle" style="border-top: 0;">
						<span>{{ $AppliedData->amountPerHour }}</span>
					</div>
		    	</div>

		    	<!-- Estimated Hour -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle" style="border-top: 0;">
						<span>Estimated Hour</span>
					</div>
					<div class="newValueStyle" style="border-top: 0;">
						<span>{{ $AppliedData->estimatedHour }}</span>
					</div>
		    	</div>

		    	<!-- Comment -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle" style="border-top: 0;">
						<span>Comment</span>
					</div>
					<div class="newValueStyle" style="border-top: 0;">
						<span>{{ $AppliedData->comment }}</span>
					</div>
		    	</div>

		    	<!-- Client Can Contact -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle" style="border-top: 0;">
						<span>Client Can Contact</span>
					</div>
					<div class="newValueStyle" style="border-top: 0;">
						@if($AppliedData->clientCanContact == 0)
							<span>No</span>
						@else
							<span>Yes</span>
						@endif
					</div>
		    	</div>

		    	<!-- Advance Payment -->
		    	<div class="newRowStyle">
		    		<div class="newLabelStyle" style="border-top: 0;">
						<span>Advance Payment</span>
					</div>
					<div class="newValueStyle" style="border-top: 0;">
						@if($AppliedData->wantAdvancePayment == 0)
							<span>No</span>
						@else
							<span>Yes</span>
						@endif
					</div>
		    	</div>

		    	<!-- Advance Payment Percentage -->
		    	@if($AppliedData->wantAdvancePayment == 1)
					<!-- Advance Payment -->
			    	<div class="newRowStyle">
			    		<div class="newLabelStyle" style="border-top: 0;">
							<span>Advance Percentage</span>
						</div>
						<div class="newValueStyle" style="border-top: 0;">
							<span>{{ $AppliedData->advancePercentage }}%</span>
						</div>
			    	</div>	    		
		    	@endif
	    	</div>
	    	@endif
	    @elseif($isRunning == true)
	    	<h1>Case Is Running By Other Lawyer Information</h1>
	    @else
	    	<div style="display: flex; justify-content: flex-end;">
	    		<a class="button is-primary" v-on:click='ApplyToThisCase'>Show Interest</a>	
	    	</div>
    	@endif
<div class="modal" :class="{'is-active' : ApplyToThisCaseModal}">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head" style="border-radius: 0; background-color: #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.16), 0 2px 3px rgba(0,0,0,0.23); border-bottom: 0;">
    	<div v-show="enablePaymentBackButton" style="display: flex; justify-content: center; align-items: center; width:30px; border-right: 1px solid #dbdbdb; cursor: pointer; margin-right:15px;" v-on:click="GoBackToPaymentOverview">
  			<i class="material-icons">arrow_back</i>
  		</div>
      <p class="modal-card-title" style="margin-bottom: 0px;">Payment Preference @{{ PaymentPrefereceLabel }}</p>
      <button class="delete" v-on:click="CloseApplyToThisModal"></button>
    </header>
    <section class="modal-card-body" style="padding:0px;">
      <div id="PaymentOverview" style="display: flex; justify-content: center; align-items: center;" v-show="PaymentOverview">
      	<div id="FixedOverview" style="flex:1; margin:30px;" class="box animated">
      		<img src="https://file.payumoney.com/images/front/home_seller/billing_app.png" alt="Collect payments online India" style="height:200px; width:100%;">
      		<div>
      			<p style="font-size: 15px;">Hello Lorem Ipsum is simply a dummy text ! Hello Hello Lorem Ipsum is simply a dummy text ! Hello Hello Lorem Ipsum is simply a dummy text !</p>
      		</div>
      		<div style="display: flex; justify-content: center;">
      			<a class="Button-1" v-on:click="enableFixedPayment">Apply</a>
      		</div>
      	</div>
      	<div id="HourlyOverview" style="flex:1; margin: 30px;" class="box animated">
      		<img src="https://file.payumoney.com/images/front/home_seller/billing_app.png" alt="Collect payments online India" style="height: 200px; width: 100%;">
      		<div>
      			<p style="font-size: 15px;">Hello Lorem Ipsum is simply a dummy text ! Hello Hello Lorem Ipsum is simply a dummy text ! Hello Hello Lorem Ipsum is simply a dummy text !</p>
      		</div>
      		<div style="display: flex; justify-content: center;">
      			<a class="Button-1" v-on:click="enableHourlyPayment">Apply</a>
      		</div>
      	</div>
      </div>
      <div id="FixedPaymentOption" v-show="FixedPaymentOption">
      	<div id="FixedPayment" style="display: flex; padding:20px;">
    		<form style="flex:1; padding:20px; padding-right: 40px;">
					<!-- Total Amount -->
	      			<v-text-field
	      				style="margin:0px; margin-top: 10px;"
	                    v-model = "totalAmount"
	                    name="totalAmount"
	                    label="Total Amount"
	                    id="totalAmount"
	                    :rules='totalAmountError'
	                    @input="totalAmountHasValue"
	                  >
	                </v-text-field>

	                <!-- Comment -->
	                <v-text-field
	                    v-model = "comment"
	                    name="comment"
	                    label="Comment"
	                    id="comment"
	                    rows="3"
	                    multi-line
	                  >
	                </v-text-field>	 

                	<!-- Client Contact Preference -->
	      			<div>
	      				<v-checkbox label="Client can contact me." primary v-model="canContact" style="margin:0;" />
	      			</div>

	      			<!-- Advanced Payment Checkbox -->
	      			<div>
	      				<v-checkbox label="I Want Advanced Payment." primary v-model="advancePayment" style="margin:0;" />
	      			</div>
			
					<!-- Advanced Percentage -->
		  			<div id="AdvancePaymentContainer" v-if="advancePayment">
		  				<v-select
		                  v-bind:items="['10%','15%','20%']"
		                  v-model="advancePercentage"
		                  label="Percentage"
		                  dark
		                  auto
		                  :rules="advancePercentageError"
		                  @input="advancePercentageSelected"
		                ></v-select>
		      		</div>

		      		<div style="display: flex; justify-content: flex-end;">
		      			<a class="button is-primary" v-on:click='BeforeFixedApply'>Save Payment Preference</a>
	      			</div>
    		</form>
	    </div>
      </div>
      <div id="FinalFixedPaymentOption" v-show="FinalFixedPaymentOption">
      	<div id="Details" class="TabContainer" style="padding:30px; padding-bottom: 50px;">

	    	<!-- Payment Preference -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle">
					<span>Payment Preference</span>
				</div>
				<div class="newValueStyle">
					<span>Fixed Payment</span>
				</div>
	    	</div>

	    	<!-- Total Amount -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Total Amount</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span> @{{ totalAmount }} </span>
				</div>
	    	</div>

	    	<!-- Advance Payment -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Advance Payment</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span v-if="advancePayment">Yes</span>
					<span v-else>No</span>
				</div>
	    	</div>

	    	<!-- Advance Payment Percentage -->
	    	<div class="newRowStyle" v-if="advancePayment">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Advance Payment Percentage</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span>@{{ advancePercentage }}</span>
				</div>
	    	</div>

	    	<!-- Client Contact Preference -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Can Client Contact</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span v-if="canContact">Yes</span>
					<span v-else>No</span>
				</div>
	    	</div>

	    	<!-- Vidhikarya Commission -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Vidhikarya Commission</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span> 10% </span>
				</div>
	    	</div>

	    	<!-- Comment -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Comment</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span> @{{ comment }} </span>
				</div>
	    	</div>

	    	<div style="display: flex; justify-content: center; align-items: center; margin-top: 30px;">
		    	<a class="button is-primary" v-on:click='ConfirmFixedApply'>Confirm Save Payment Preference</a>
		    </div>
		    <div id="FixedPaymentStatus"></div>
	    </div>
      </div>
      <div v-show="FixedApplySuccess" style="background-color: #35297B; overflow-y: hidden;">
      	<div style="display: flex; justify-content: center; align-items: center; overflow-y: hidden;">
      		
	      		<svg id="successAnimation" class="animated" xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="0 0 70 70">
				  <path id="successAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z"/>
				  <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent"/>
				  <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent"/>
				</svg>		
      	</div>
	  </div>
      <div id="HourlyPaymentOption" v-show="HourlyPaymentOption">
      	<div id="HourlyPayment" style="display: flex; padding:20px;">
	    	<form style="padding-left: 20px; padding-right:20px; flex:1;">
	    		<div style="display: flex; margin-bottom: 15px;">

	    			<!-- Amount Per Hour -->
	    			<div style="flex:1; padding-right:20px;">
	    				<v-text-field
	    					style="margin:0px; margin-top: 10px;"
		                    v-model = "amountPerHour"
		                    name="amountPerHour"
		                    label="Amount Per Hour"
		                    id="amountPerHour"
		                    :rules='amountPerHourError'
		                    @input="amountPerHourHasValue"
		                  >
		                </v-text-field>	
	    			</div>

	    			<!-- Estimated Hour -->
	    			<div style="flex:1; padding-left: 20px;">
	    				<v-text-field
	    					style="margin:0px; margin-top: 10px;"
		                    v-model = "estimatedHour"
		                    name="estimatedHour"
		                    label="Estimated Hour"
		                    id="estimatedHour"
		                    :rules='estimatedHourError'
		                    @input="estimatedHourHasValue"
		                  >
		                </v-text-field>
	    			</div>
	    		</div>
          		
      			<!-- Advanced Payment Checkbox -->
  				<div>
  					<v-checkbox label="I Want Advanced Payment." primary v-model="advancePaymentforHourly" style="margin:0; padding: 0; margin-bottom: 15px;" />
  				</div>
      		
      			<!-- Advanced Percentage -->
          		<div id="AdvancePaymentforHourlyContainer" v-show="advancePaymentforHourly">
      				<v-select
      					style="margin-top:20px; margin-bottom: 20px;"
                      v-bind:items="['10%','15%','20%']"
                      v-model="advancePercentageforHourly"
                      label="Percentage"
                      dark
                      auto
                      :rules="advancePercentageforHourlyError"
                      @input="advancePercentageforHourlySelected"
                    ></v-select>
          		</div>				          		

          		<!-- Comment -->
          		<div style="margin-bottom: 15px;">
          			<v-text-field
	      				style="margin:0;"
	                    v-model = "commentforHourly"
	                    name="commentforHourly"
	                    label="Comment"
	                    id="commentforHourly"
	                    multi-line
	                    auto-grow
	                    rows="3"
                  	>
                	</v-text-field>
          		</div>

	      		<!-- Client Contact Preference -->
	      		<div>
	      			<v-checkbox label="Client can contact me." primary v-model="canContactforHourly" style="margin:0;" />
	      		</div>
	      		<div style="display: flex; justify-content: flex-end;">
	      			<a class="button is-primary" 
	      				v-on:click='BeforeHourlyApply'>
	      					Save Payment Preference
	      			</a>
	      		</div>
	      		<!-- Status -->
	    	</form>
	    </div>
      </div>
      <div id="FinalHourlyPaymentOption" v-show="FinalHourlyPaymentOption" style="padding: 30px; padding-bottom: 50px;">
      		<!-- Payment Preference -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle">
					<span>Payment Preference</span>
				</div>
				<div class="newValueStyle">
					<span>Hourly Payment</span>
				</div>
	    	</div>

	    	<!-- Total Amount -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Amount Per Hour</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span> @{{ amountPerHour }} </span>
				</div>
	    	</div>

	    	<!-- Estimated Hour -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Estimated Hour</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span> @{{ estimatedHour }} </span>
				</div>
	    	</div>

	    	<!-- Advance Payment -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Advance Payment</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span v-if="advancePaymentforHourly">Yes</span>
					<span v-else>No</span>
				</div>
	    	</div>

	    	<!-- Advance Payment Percentage -->
	    	<div class="newRowStyle" v-if="advancePaymentforHourly">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Advance Payment Percentage</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span>@{{ advancePercentageforHourly }}</span>
				</div>
	    	</div>

	    	<!-- Client Contact Preference -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Can Client Contact</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span v-if="canContactforHourly">Yes</span>
					<span v-else>No</span>
				</div>
	    	</div>

	    	<!-- Vidhikarya Commission -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Vidhikarya Commission</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span> 10% </span>
				</div>
	    	</div>

	    	<!-- Comment -->
	    	<div class="newRowStyle">
	    		<div class="newLabelStyle" style="border-top: 0;">
					<span>Comment</span>
				</div>
				<div class="newValueStyle" style="border-top: 0;">
					<span> @{{ commentforHourly }} </span>
				</div>
	    	</div>

	    	<div style="display: flex; justify-content: center; align-items: center; margin-top: 30px;">
		    	<a class="button is-primary" v-on:click='ConfirmHourlyApply'>Confirm Save Payment Preference</a>
		    </div>
      		<div id="HourlyPaymentStatus"></div>
      </div>
    </section>
  </div>
</div>
<template>
  <v-layout row justify-center>
    <v-dialog v-model="WithdrawDialog">
      <v-btn id="WithdrawDialogTrigger" primary light slot="activator" style='display: none;'>Open Dialog</v-btn>
      <v-card>
        <v-card-row>
          <v-card-title>Successful !</v-card-title>
        </v-card-row>
        <v-card-row>
          <v-card-text>You have successfully withdrawn this case !</v-card-text>
        </v-card-row>
        <v-card-row actions>
          <v-btn class="green--text darken-1" flat="flat" @click.native="WithdrawSuccessDialogOkay">Okay</v-btn>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
<template>
  <v-layout row justify-center>
    <v-dialog v-model="ConfirmWithdrawDialog" width="400">
      <v-btn id="ConfirmWithdrawDialogTrigger" primary light slot="activator" style='display: none;'>Open Dialog</v-btn>
      <v-card style='width: 500px; height: 500px;'>
        <v-card-row>
          <v-card-title>Confirmation !</v-card-title>
        </v-card-row>
        <v-card-row>
          <v-card-text>Are you sure you want to withdraw the Case?</v-card-text>
        </v-card-row>
        <v-card-row>
	        <div style="display: flex; padding-left:20px; padding-right: 20px; width:100%;">
	            <v-text-field
	                v-model = "WithdrawComment"
	                name="withdrawComment"
	                label="Give a Reason"
	                id="withdrawComment"
	                multi-line
	              >
	            </v-text-field>
	        </div>
        </v-card-row>
        <v-card-row actions>
          <v-btn class="green--text darken-1" flat="flat" @click.native="CancelWithdraw">Cancel</v-btn>
          <v-btn class="green--text darken-1" flat="flat" @click.native="WithdrawApplied">Withdraw</v-btn>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
<template>
  <v-layout row justify-center>
    <v-dialog v-model="MarkCompleteDialog">
      <v-btn id="MarkCompleteDialogTrigger" primary light slot="activator" style='display: none;'>Open Dialog</v-btn>
      <v-card>
        <v-card-row>
          <v-card-title>Successful !</v-card-title>
        </v-card-row>
        <v-card-row>
          <v-card-text>You have successfully marked this case as completed. Please, wait for client to approve. Thank you !</v-card-text>
        </v-card-row>
        <v-card-row actions>
          <v-btn class="green--text darken-1" flat="flat" @click.native="MarkCompleteDialogOkay">Okay</v-btn>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
<template>
  <v-layout row justify-center>
    <v-dialog v-model="BeforeMarkCompleteDialog">
      <v-btn id="BeforeMarkCompleteDialogTrigger" primary light slot="activator" style='display: none;'>Open Dialog</v-btn>
      <v-card>
        <v-card-row>
          <v-card-title>Confirmation !</v-card-title>
        </v-card-row>
        <v-card-row>
          <v-card-text>Are You sure you want to mark this case as completed ? </v-card-text>
        </v-card-row>
        <v-card-row>
	        <div style="display: flex; padding-left:20px; padding-right: 20px; width:100%;">
	            <v-text-field
	                v-model = "MarkCompleteComment"
	                name="markCompleteComment"
	                label="Give a Reason"
	                id="markCompleteComment"
	                multi-line
	              >
	            </v-text-field>
	        </div>
        </v-card-row>
        <v-card-row actions>
        <v-btn class="green--text darken-1" flat="flat" @click.native="MarkCompleteACaseNo">No</v-btn>
          <v-btn class="green--text darken-1" flat="flat" @click.native="MarkCompleteACase">Yes</v-btn>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
<template>
  <v-layout row justify-center>
    <v-dialog v-model="PickUpTheCaseSuccess">
      <v-btn id="PickUpTheCaseSuccessTrigger" primary light slot="activator" style='display: none;'>Open Dialog</v-btn>
      <v-card>
        <v-card-row>
          <v-card-title>Successful !</v-card-title>
        </v-card-row>
        <v-card-row>
          <v-card-text>You have successfully Picked Up The Case.</v-card-text>
        </v-card-row>
        <v-card-row actions>
          <v-btn class="green--text darken-1" flat="flat" @click.native="PickUpTheCaseSuccessOkay">Okay</v-btn>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<!-- Modal for Payment Request -->
<request-payment-modal :element-data='RequestPaymentData' v-on:paymentrequested="addPaymentRequestCardToTimeline"></request-payment-modal>

<div id="Status"></div>
</div>
<script>
$(document).ready(function(){
	$(".checkbox .input-group__details").remove();	
	$(".input-group__details").css('min-height','0px');
});
Vue.component('neoTab',{
  props:['data','tabName'],
  template:`
  <span style="cursor:pointer;">
    <a style="background-color:#00d1b2;" class="reponav-item" v-on:click="TabClicked" :class="{selected : data.isActive}">
      <span>@{{ data.TabName }}</span><span v-if="hasCounter" class="Counter">@{{ data.Counter}}</span>
    </a>
  </span>
  `,
  data:function(){
    return {

    };
  },
  computed:{
    hasCounter:function(){
      if ('Counter' in this.data) {
        return true;
      }
      else{
        return false;
      }
    }
  },
  methods:{
    TabClicked:function(){
      this.$emit('changed',this.tabName);
    },
  }
});
@if($hasApplied == true)
let hasApplied = true;
@else
let hasApplied = false;
@endif
var tempNotes = [];
var NumberOfNotes = 0;
var NumberOfFiles  = 0;
@foreach($caseNotes as $note)
    temp = {};
    temp['Note'] = "{{ $note->notes }}";
    temp['Date'] = "{{ $note->created_at }}";
    tempNotes.push(temp);
    NumberOfNotes++;
@endforeach
let uId = {{ $TheCase->userId }}; 
let cId = {{ $TheCase->id }};
let Advisable = false;
let Anonymous = false;
let Attachment = false;
let DueDate = "{{ $TheCase->caseDueDate }}";
@if($TheCase->isOnlyAdvisable == 1)
	Advisable = true;
@endif
@if($TheCase->postAsAnonymous == 1)
	Anonymous = true;
@endif
@if($TheCase->attachmentPrivacy == 'ApprovedLawyer')
	Attachment = true;
@endif
var CaseInfo =new Vue({
	el : '#PageContent',
	data:{
		// Global Data ---------------
		caseId : cId,
		clientId : uId,

		// Component Data --------------- 
				RequestPaymentData : [],
				TimelineData : [],
				PaymentRequestCardData : [],			

		//Tabs
		Tabs : [
			{ 'TabName' : 'Details', 'isActive' : false },
			{ 'TabName' : 'Notes', 'Counter' : NumberOfNotes, 'isActive' : false },
			{ 'TabName' : 'Files', 'Counter' : '5', 'isActive' : false },
			{ 'TabName' : 'Timeline', 'isActive' : true },
		],
		PaymentTabs : [
			{ 'TabName' : 'Fixed Rate', 'isActive' : true },
			{ 'TabName' : 'Hourly Rate', 'isActive' : false },
		],
		DetailsTab : false,
		NotesTab : false,
		FilesTab : false,
		TimelineTab : true,
		FixedTab : true,
		HourlyTab : false,

		// Payment Request --------------
		PaymentRequestDialog : false,
		PayRequestAmount : 0,
		PayRequestComment : "",



		// Notes ---
		CaseNotes : tempNotes,

		// Fixed Rate --
		totalAmount : '',
		advancePayment : false,
		advancePercentage : '',
		comment : '',
		canContact : false,

		totalAmountHasError : false,
		advancePercentageHasError : false,

		totalAmountErrorMessage : "Total Amount is Required !",
		advancePercentageErrorMessage : "Percentage is Required !",

		FixedSelected : true,

		// Hourly --
		amountPerHour : '',
		estimatedHour : '',
		advancePaymentforHourly : false,
		advancePercentageforHourly : '',
		commentforHourly : '',
		canContactforHourly : false,

		amountPerHourHasError : false,
		estimatedHourHasError : false,
		advancePercentageforHourlyHasError : false,
		amountPerHourErrorMessage:'Amount Per Hour is Required !',
		estimatedHourErrorMessage : 'Estimated Hour is Required !',
		advancePercentageforHourlyErrorMessage:'Percentage is Required !',

		ApplyToCaseDialog : false,
		SeeAttachmentsDialog : false,

		userId : uId,
		isOnlyAdvisable : Advisable,
		postAsAnonymous : Anonymous,
		attachmentPrivacy : Attachment,
		caseDueDate : DueDate,

		tempisOnlyAdvisable : Advisable,
		temppostAsAnonymous : Anonymous,
		tempattachmentPrivacy : Attachment,
		tempcaseDueDate : DueDate,
		
		hasUpdated : false,
		// PaymentSuccessDialog : false,

		// Dialogs
		ApplyToCaseStatusDialog : false,
		WithdrawDialog : false,
		MarkCompleteDialog : false,
		ConfirmWithdrawDialog : false,
		ApplyToThisCaseModal : false,
		BeforeMarkCompleteDialog : false,
		PickUpTheCaseSuccess : false,

		HourlyPaymentOption : false,
		FixedPaymentOption : false,
		PaymentOverview : true,
		enablePaymentBackButton : false,
		enablePaymentPreferenceLabel : false,
		PaymentPrefereceLabel : "",
		FinalFixedPaymentOption : false,
		FinalHourlyPaymentOption : false,
		FixedApplySuccess : false,
		HourlyApplySuccess : false,

		WithdrawComment : "",
		hasApplied : hasApplied,
		MarkCompleteComment : '',
	},
	computed:{
		hasAnyNotes:function(){
			if (NumberOfNotes == 0) {
				return false;
			}
			else
			{
				return true;
			}
		},
		hasAnyFiles:function(){
			if (NumberOfFiles == 0) {
				return false;
			}
			else{
				return true;
			}
		},
		totalAmountError : function(){
            if (this.totalAmountHasError == true) {
                var tmp = [];
                tmp.push(this.totalAmountErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        amountPerHourError : function(){
            if (this.amountPerHourHasError == true) {
                var tmp = [];
                tmp.push(this.amountPerHourErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        estimatedHourError : function(){
            if (this.estimatedHourHasError == true) {
                var tmp = [];
                tmp.push(this.estimatedHourErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        advancePercentageError : function(){
            if (this.advancePercentageHasError == true) {
                var tmp = [];
                tmp.push(this.advancePercentageErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        advancePercentageforHourlyError : function(){
            if (this.advancePercentageforHourlyHasError == true) {
                var tmp = [];
                tmp.push(this.advancePercentageforHourlyErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
	},
	methods:{
		RequestPayment:function(){
			setTimeout(function(){
				this.RequestPaymentData = [];
				this.RequestPaymentData.push({'clientId':this.clientId, 'caseId':this.caseId, 'Token':"{{csrf_token()}}"});
				$("#PaymentRequestDialogTrigger").trigger("click");
			}.bind(this),300);
        },
        addPaymentRequestCardToTimeline:function(data){
        	this.TimelineData.push({'ComponentType' : 'PaymentRequest', 'ComponentData' : data});
        },
		PickUpTheCase:function(){
			let formData={
				"caseId" : this.caseId,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                type: "post",
                url: "/PickUpTheCase",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var ReturnedData=JSON.parse(JSON.stringify(data));
                    if ('Status' in ReturnedData) {
                        if (ReturnedData.Status == "PickedUp") {
                        	$("#PickUpTheCaseSuccessTrigger").trigger('click');
                        	this.PickUpTheCaseSuccess = true;
                        }
                    }
                }.bind(this),
                error: function (data) {
                    $("#Status").append(JSON.stringify(data));
                }.bind(this)
            });
		},
		PickUpTheCaseSuccessOkay:function(){
			window.location.reload(true);
		},
		BeforeMarkCompleteACase:function(){
			setTimeout(function(){
				$("#BeforeMarkCompleteDialogTrigger").trigger('click');
			},300);
		},
		MarkCompleteACaseNo:function(){
			this.BeforeMarkCompleteDialog = false;
		},
		MarkCompleteACase:function(){
			let formData={
				"caseId" : this.caseId,
				"comment" : this.MarkCompleteComment,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/MarkCompleteACase",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var ReturnedData=JSON.parse(JSON.stringify(data));
                        if ('Status' in ReturnedData) {
                            if (ReturnedData.Status == "LawyerCompleted") {
                            	this.BeforeMarkCompleteDialog = false;
                            	setTimeout(function(){
                            		$("#MarkCompleteDialogTrigger").trigger('click');
                            	},500);
                            }
                        }
                    }.bind(this),
                    error: function (data) {
                        $("#FixedPaymentStatus").append(JSON.stringify(data));
                    }.bind(this)
            });
		},
		CancelWithdraw:function(){
			this.ConfirmWithdrawDialog = false;
		},
		BeforeWithdrawApplied:function(){
			
			setTimeout(function(){
				$("#ConfirmWithdrawDialogTrigger").trigger('click');
				this.ConfirmWithdrawDialog = true;
			},100);
		},
		WithdrawApplied:function(){
			this.ConfirmWithdrawDialog = false;
			let formData={
				"caseId" : this.caseId,
				"comment" : this.WithdrawComment,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/WidthdrawApplied",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var ReturnedData=JSON.parse(JSON.stringify(data));
                        if ('Status' in ReturnedData) {
                            if (ReturnedData.Status == "Withdrew") {
                            	setTimeout(function(){
                            		$("#WithdrawDialogTrigger").trigger('click');
                            	}, 500);
                            }
                            else{
                            	
                            }
                        }
                    }.bind(this),
                    error: function (data) {
                        $("#FixedPaymentStatus").append(JSON.stringify(data));
                    }.bind(this)
            });
		},
		WithdrawSuccessDialogOkay:function(){
			this.WithdrawDialog = false;
			location.reload();
		},
		MarkCompleteDialogOkay:function(){
			this.MarkCompleteDialog = false;
			location.reload();
		},
		advancePercentageforHourlySelected:function(){
			this.advancePercentageforHourlyHasError = false;
		},
		advancePercentageSelected:function(){
			this.advancePercentageHasError = false;
		},
		totalAmountHasValue:function(){
			this.totalAmountHasError = false;
		},
		amountPerHourHasValue:function(){
			this.amountPerHourHasError = false;
		},
		estimatedHourHasValue:function(){
			this.estimatedHourHasError = false;
		},
		ApplyToCaseDialogClose:function(){
			this.ApplyToCaseDialog = false;
		},
		SeeAttachmentsModalClosed:function(){
			this.SeeAttachmentsDialog = false;
		},
		ChangeTab:function(SelectedTab){
			this.Tabs.forEach(tab => {
				if (tab.TabName == SelectedTab) { tab.isActive = true; } else{ tab.isActive = false; }
			});
			if (SelectedTab == "Details") {
				this.DetailsTab = true;
				this.NotesTab = false;
				this.FilesTab = false;
				this.TimelineTab = false;
			}
			else if(SelectedTab == "Notes"){
				this.NotesTab = true;
				this.DetailsTab = false;
				this.FilesTab = false;
				this.TimelineTab = false;
			}
			else if(SelectedTab == "Files"){
				this.FilesTab = true;
				this.NotesTab = false;
				this.DetailsTab = false;
				this.TimelineTab = false;
			}
			else if(SelectedTab == "Timeline"){
				this.TimelineTab = true;
				this.FilesTab = false;
				this.NotesTab = false;
				this.DetailsTab = false;
			}
		},
		ChangePaymentTab:function(SelectedTab){
			this.PaymentTabs.forEach(tab => {
				if (tab.TabName == SelectedTab) { tab.isActive = true; } else{ tab.isActive = false; }
			});
			if (SelectedTab == "Fixed Rate") {
				this.FixedTab = true;
				this.HourlyTab = false;
			}
			else if(SelectedTab == "Hourly Rate"){
				this.HourlyTab = true;
				$(".checkbox .input-group__details").remove();
				this.FixedTab = false;
			}
		},
		ApplyToThisCase:function(){
			if (this.ApplyToThisCaseModal == false){
				this.ApplyToThisCaseModal = true;
				$("#FixedOverview").removeClass("zoomIn").addClass("zoomIn");
				$("#HourlyOverview").removeClass("zoomIn").addClass("zoomIn");
			}
			else{
				this.ApplyToThisCaseModal = false;
			}
		},
		CloseApplyToThisModal:function(){
			this.ApplyToThisCaseModal = false;
		},
		enableHourlyPayment:function(){
			this.enablePaymentBackButton = true;
			this.PaymentOverview = false;
			this.HourlyPaymentOption = true;
			this.FixedPaymentOption = false;
			this.enablePaymentPreferenceLabel = true;
			this.PaymentPrefereceLabel = ": Hourly";
		},
		enableFixedPayment:function(){
			this.enablePaymentBackButton = true;
			this.PaymentOverview = false;
			this.HourlyPaymentOption = false;
			this.FixedPaymentOption = true;
			this.enablePaymentPreferenceLabel = true;
			this.PaymentPrefereceLabel = ": Fixed";
		},
		GoBackToPaymentOverview:function(){
			if (this.FinalFixedPaymentOption == true) {
				this.FinalFixedPaymentOption = false;
				this.FixedPaymentOption = true;
			}
			else if (this.FinalHourlyPaymentOption == true) {
				this.FinalHourlyPaymentOption = false;
				this.HourlyPaymentOption = true;
			}
			else{
				$("#FixedOverview").removeClass("zoomIn").addClass("zoomIn");
				$("#HourlyOverview").removeClass("zoomIn").addClass("zoomIn");
				this.PaymentOverview = true;
				this.HourlyPaymentOption = false;
				this.FixedPaymentOption = false;
				this.enablePaymentBackButton = false;
				this.enablePaymentPreferenceLabel = false;
				this.PaymentPrefereceLabel = "";
			}
		},
		BeforeFixedApply:function(){
			//Validation
			if (this.totalAmount == "") {
				this.totalAmountHasError = true;
				return;
			}
			if (this.advancePayment == true) {
				if (this.advancePercentage == "") {
					this.advancePercentageHasError = true;
					return;
				}
			}
			var clientCanContact = 0;
			var advPayment = 0;
			if (this.canContact == true) {
				clientCanContact = 1;
			}
			if (this.advancePayment == true) {
				advPayment = 1;
			}
            this.FixedPaymentOption = false;
			this.FinalFixedPaymentOption = true;
		},
		ConfirmFixedApply:function(){
			var clientCanContact = 0;
			var advPayment = 0;
			if (this.canContact == true) {
				clientCanContact = 1;
			}
			if (this.advancePayment == true) {
				advPayment = 1;
			}
			let formData={
				"caseId" : this.caseId,
				"userId" : this.userId,
                "totalAmount" : this.totalAmount,
				"advancePayment" : advPayment,
				"advancePercentage" : this.advancePercentage,
				"comment" : this.comment,
				"canContact" : clientCanContact,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/FixedApply",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var ReturnedData=JSON.parse(JSON.stringify(data));
                        if ('Status' in ReturnedData) {
                            if (ReturnedData.Status == "Applied") {
                            	// $("#PaymentSuccessDialogTrigger").trigger('click');
                            	this.FinalFixedPaymentOption = false;
								this.FixedApplySuccess = true;
								setTimeout(function(){
									window.location.reload(true);
								},2000);
                            }
                            else{
                            	// Error Task
                            }
                        }
                    }.bind(this),
                    error: function (data) {
                        $("#FixedPaymentStatus").append(JSON.stringify(data));
                    }.bind(this)
            });
		},
		BeforeHourlyApply:function(){
			//Validation
			if (this.amountPerHour == "") {
				this.amountPerHourHasError = true;
				return;
			}
			if (this.estimatedHour == "") {
				this.estimatedHourHasError = true;
				return;
			}
			if (this.advancePaymentforHourly == true) {
				if (this.advancePercentageforHourly == null || this.advancePercentageforHourly == "") {
					this.advancePercentageforHourlyHasError = true;
					return;
				}
			}
			var clientCanContact = 0;
			var advPayment = 0;
			if (this.canContactforHourly == true) {
				clientCanContact = 1;
			}
			if (this.advancePaymentforHourly == true) {
				advPayment = 1;
			}
			this.HourlyPaymentOption = false;
			this.FinalHourlyPaymentOption = true;
		},
		ConfirmHourlyApply:function(){
			//Validation
			if (this.amountPerHour == "") {
				this.amountPerHourHasError = true;
				return;
			}
			if (this.estimatedHour == "") {
				this.estimatedHourHasError = true;
				return;
			}
			if (this.advancePaymentforHourly == true) {
				if (this.advancePercentageforHourly == null || this.advancePercentageforHourly == "") {
					this.advancePercentageforHourlyHasError = true;
					return;
				}
			}
			var clientCanContact = 0;
			var advPayment = 0;
			if (this.canContactforHourly == true) {
				clientCanContact = 1;
			}
			if (this.advancePaymentforHourly == true) {
				advPayment = 1;
			}
			let formData={
				"userId" : this.userId,
				"caseId" : this.caseId,
                "amountPerHour" : this.amountPerHour,
				"estimatedHour" : this.estimatedHour,
				"advancePaymentforHourly" : advPayment,
				"advancePercentageforHourly" : this.advancePercentageforHourly,
				"canContactforHourly": clientCanContact,
				"commentforHourly" : this.commentforHourly,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/HourlyApply",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var ReturnedData=JSON.parse(JSON.stringify(data));
                        if ('Status' in ReturnedData) {
                        	if (ReturnedData.Status == "Applied") {
                        		// $("#PaymentSuccessDialogTrigger").trigger('click');
                        		this.FixedApplySuccess = true;
                        		this.FinalHourlyPaymentOption = false;
                        		setTimeout(function(){
									window.location.reload(true);
								},2000);
                        	}
                        	else{
                        		//Error Task
                        	}
                        }
                    }.bind(this),
                    error: function (data) {
                        $("#HourlyPaymentStatus").append(JSON.stringify(data));
                    }.bind(this)
            });
		}
	}
});
</script>
@stop