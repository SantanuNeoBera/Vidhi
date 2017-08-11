@extends('Layouts.Vidhikarya.Lawyer.Master')
@section('title','Dashboard')
@section('content')
<style type="text/css">
	.CaseViewDetails{
		transition: 300ms;
	}
	.CaseViewDetails:hover{
		background-color: #f5f5f5;
	}
</style>
<link rel="stylesheet" type="text/css" href="{{ url('css/Vidhikarya/Lawyer/Dashboard.css') }}">
<div id="PageContent">
	<!-- Tabs -->
	<div class="DashboardNav">
		<nav class="DashboardNavBar">
			<div class="Tabs">
				<neo-tab v-for="tab in Tabs" :data="tab" :tab-name="tab.TabName" @changed="ChangeTab"></neo-tab>
			</div>
	  		<div class="SearchBox">
	  			<input type="text" class="DashboardSearchBox" placeholder="Search">
	  		</div>
	    </nav>
	</div>

	<!-- Open Cases Tab -->
	<div v-show="OpenCasesTab" id="OpenCases" style="display: flex; flex-wrap: wrap; justify-content: flex-start;">
		<bulma-case-card v-for="(Case, index) in OpenCases" :key="index" :data="Case"></bulma-case-card>
	</div>

	<!-- Applied Cases Tab -->	
	<div v-show="AppliedCasesTab">
		<div v-if="hasAnyAppliedCases" style="display: flex; flex-wrap: wrap;">
			<card-for-applied v-for="(Case, index) in AppliedCases" :key="index" :data="Case"></card-for-applied>
		</div>
		<div v-else style="width: 100%; height: 100px; display: flex; justify-content: center;align-items: center;">
			<span style="font-size: 22px;">Empty ! Try Applying to a Case !</span>
		</div>
		<h4 class="ui horizontal divider header">
		  Cases No More Available
		</h4>
		<div style="display: flex; flex-wrap: wrap;">
			<card-for-applied-but-missed v-for="(Case, index) in AppliedButMissedCases" :key="index" :data="Case">
			</card-for-applied-but-missed>
		</div>
	</div>

	<!-- Approved Cases Tab -->
	<div v-show="ApprovedCasesTab" style="display: flex; flex-wrap: wrap;">
		<card-for-approved v-for="(Case, index) in ApprovedCases" :key="index" :data="Case"></card-for-approved>
	</div>

	<!-- Active Cases -->
	<div v-show="ActiveCasesTab" style="display: flex; flex-wrap: wrap;">
		<card-for-active v-for="(Case, index) in ActiveCases" :key="index" :data="Case"></card-for-active>
	</div>

	<!-- Closed Cases -->
	<div v-show="ClosedCasesTab" style="display: flex; flex-wrap: wrap;">
		<case-card v-for="(Case, index) in ClosedCases" :key="index" :data="Case"></case-card>
	</div>

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
          <v-btn class="green--text darken-1" flat="flat" @click.native="PickUpTheCaseSuccessGoToCase">Go To Case</v-btn>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
<div id="Status"></div>

</div>
<script type="text/javascript" src="{{ url('js/VidhiComponent/Vidhikarya.js') }}"></script>
<script type="text/javascript">
  Vue.component('caseCard',{
	props:['data'],
	template:`
  <div class="ui"  ">
  <div class="column">
    <div class="ui raised segment" style="border-radius:0; padding-bottom:0">
      <a class="ui teal ribbon label">@{{ data.caseCategory }}</a>
      <span style="float:right;">@{{ data.caseCreatedOn }}</span>
      <p style="margin-bottom: 4px;"><span style="padding-right: 10px;">Case ID : </span><span>@{{ data.caseId }}</span></p>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
      <div style="display: flex;">
      	<div style="flex-basis: 50%">
      		<p><span style="padding-right: 10px;">Due Date : </span><span>@{{ data.caseDueDate }}</span></p>
      	</div>
      	<div style="flex-basis: 50%;">
      		<div class="CardFooter" style="display: flex; justify-content: flex-end;">
				  <a class="button is-link" :href=" '{{ url('CaseDetails') }}/' + data.caseId">View Details</a>
			</div>
      	</div>
      </div>
      <div style="width:inherit; height:35px; display:flex;">
      	<div style='flex:1;'>

      	</div>
      	<div style='flex:1;'>

      	</div>
      </div>
    </div>
  </div>
  </div>`,
});
Vue.component('bulmaCaseCard',{
	props:['data'],
	template:`
	<div class="card" style='margin: 10px; flex-basis: 400px;'>
	  <header class="card-header">
	    <p class="card-header-title" style='margin-bottom:0;'>
	      @{{ data.caseCategory }}
	    </p>
	  </header>
	  <div class="card-content">
	    <div class="content">
	    	<p style='margin-bottom:10px;'>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<small style='margin-left:20px;'>@{{ data.caseCreatedOn }}</small></p>
	      <div class="control" style='margin-bottom:4px;'>
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case Registered On</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseCreatedOn }}</a>
		    </div>
		  </div>
	      <div class="control" style='margin-bottom:4px;'>
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case Due Date</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseDueDate }}</a>
		    </div>
		  </div>
	      <div class="control">
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case ID</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseId }}</a>
		    </div>
		  </div>
	    </div>
	  </div>
	  <footer class="card-footer">
	    <a class="card-footer-item">Save</a>
	    <a class="card-footer-item">Edit</a>
	    <a class="card-footer-item CaseViewDetails" :href=" '{{ url('CaseDetails') }}/' + data.caseId">View Details</a>
	  </footer>
	</div>
	`,
});
Vue.component('cardForApplied',{
	props:['data'],
	template:`
	<div class="card" style='margin: 10px; flex-basis: 400px;'>
	  <header class="card-header">
	    <p class="card-header-title" style='margin-bottom:0;'>
	      @{{ data.caseCategory }}
	    </p>
	  </header>
	  <div class="card-content">
	    <div class="content">
	    	<p style='margin-bottom:10px;'>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<small style='margin-left:20px;'>@{{ data.caseCreatedOn }}</small></p>
	      <div class="control" style='margin-bottom:4px;'>
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case Registered On</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseCreatedOn }}</a>
		    </div>
		  </div>
	      <div class="control" style='margin-bottom:4px;'>
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case Due Date</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseDueDate }}</a>
		    </div>
		  </div>
	      <div class="control">
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case ID</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseId }}</a>
		    </div>
		  </div>
	    </div>
	  </div>
	  <footer class="card-footer">
	    <a class="card-footer-item">Save</a>
	    <a class="card-footer-item">Edit</a>
	    <a class="card-footer-item CaseViewDetails" :href=" '{{ url('CaseDetails') }}/' + data.caseId">View Details</a>
	  </footer>
	</div>
	`,
});
Vue.component('cardForApproved',{
	props:['data'],
	template:`
	<div class="card" style='margin: 10px; flex-basis: 400px;'>
	  <header class="card-header">
	    <p class="card-header-title" style='margin-bottom:0;'>
	      @{{ data.caseCategory }}
	    </p>
	  </header>
	  <div class="card-content">
	    <div class="content">
	    	<p style='margin-bottom:10px;'>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<small style='margin-left:20px;'>@{{ data.caseCreatedOn }}</small></p>
	      <div class="control" style='margin-bottom:4px;'>
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case Registered On</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseCreatedOn }}</a>
		    </div>
		  </div>
	      <div class="control" style='margin-bottom:4px;'>
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case Due Date</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseDueDate }}</a>
		    </div>
		  </div>
	      <div class="control">
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case ID</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseId }}</a>
		    </div>
		  </div>
	    </div>
	  </div>
	  <footer class="card-footer">
	    <a class="card-footer-item CaseViewDetails" v-on:click="PickUpTheCase(data.caseId)">Pick Up</a>
	  </footer>
	</div>
	`,
	methods:{
		PickUpTheCase:function(caseId){
			let formData={
				"caseId" : caseId,
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
                        	Dashboard.PickUpTheCaseSuccess = true;
                        	Dashboard.CurrentCaseId = ReturnedData.caseId;
                        }
                    }
                }.bind(this),
                error: function (data) {
                    $("#Status").append(JSON.stringify(data));
                }.bind(this)
            });
		}
	}
});
Vue.component('cardForAppliedButMissed',{
	props:['data'],
	template:`
	<div class="card" style='margin: 10px; flex-basis: 400px; position:relative;'>
	  <header class="card-header">
	    <p class="card-header-title" style='margin-bottom:0;'>
	      @{{ data.caseCategory }}
	    </p>
	  </header>
	  <div class="card-content">
	    <div class="content">
	    	<p style='margin-bottom:10px;'>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<small style='margin-left:20px;'>@{{ data.caseCreatedOn }}</small></p>
	      <div class="control" style='margin-bottom:4px;'>
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case Registered On</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseCreatedOn }}</a>
		    </div>
		  </div>
	      <div class="control" style='margin-bottom:4px;'>
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case Due Date</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseDueDate }}</a>
		    </div>
		  </div>
	      <div class="control">
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case ID</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseId }}</a>
		    </div>
		  </div>
	    </div>
	  </div>
	  <footer class="card-footer">
	    <a class="card-footer-item">Save</a>
	    <a class="card-footer-item">Edit</a>
	    <a class="card-footer-item CaseViewDetails" :href=" '{{ url('CaseDetails') }}/' + data.caseId">View Details</a>
	  </footer>
	  <div style='position:absolute; top:0; left:0; background-color:rgba(0,0,0,0.7); height:100%; width:100%; display: flex; justify-content:center; align-items: center;'>
	  	<span style='color:#fff;'>This case has been approved to other lawyer</span>
	  </div>
	</div>
	`,
});
Vue.component('cardForActive',{
	props:['data'],
	template:`
	<div class="card" style='margin: 10px; flex-basis: 400px;'>
	  <header class="card-header">
	    <p class="card-header-title" style='margin-bottom:0;'>
	      @{{ data.caseCategory }}
	    </p>
	  </header>
	  <div class="card-content">
	    <div class="content">
	    	<p style='margin-bottom:10px;'>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<small style='margin-left:20px;'>@{{ data.caseCreatedOn }}</small></p>
	      <div class="control" style='margin-bottom:4px;'>
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case Registered On</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseCreatedOn }}</a>
		    </div>
		  </div>
	      <div class="control" style='margin-bottom:4px;'>
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case Due Date</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseDueDate }}</a>
		    </div>
		  </div>
	      <div class="control">
		    <div class="tags has-addons">
		      <span class="tag" style='font-size:12px; background-color:#dbdbdb !important;'>Case ID</span>
		        <a class="tag is-success" style='font-size:12px; color:#fff !important; text-decoration:none;'>@{{ data.caseId }}</a>
		    </div>
		  </div>
	    </div>
	  </div>
	  <footer class="card-footer">
	    <a class="card-footer-item CaseViewDetails" :href=" '{{ url('CaseDetails') }}/' + data.caseId">Work</a>
	  </footer>
	</div>
	`,
});
var temp = {};
var tempOpenCases = [];
var tempAppliedCases = [];
var tempApprovedCases = [];
var tempActiveCases = [];
var tempClosedCases = [];
var tempAppliedButMissedCases = [];
@foreach($OpenCases as $Case)
	@if($Case->lawyerId != Auth::id())
	    temp = {};
	    temp['caseId'] = "{{ $Case->id }}";
	    temp['caseTitle'] = "{{ $Case->caseTitle }}";
	    temp['caseCategory'] = "{{ $Case->caseCategory }}";
	    temp['caseDueDate'] = "{{ $Case->caseDueDate }}";
	    temp['caseStatus'] = "{{ $Case->caseStatus }}";
	    temp['caseCreatedOn'] = moment("{{ $Case->created_at }}").format('MMMM Do YYYY');
	    tempOpenCases.push(temp);
    @endif
@endforeach
@foreach($AppliedCases as $Case)
	temp = {};
	temp['caseId'] = "{{ $Case->id }}";
	temp['caseTitle'] = "{{ $Case->caseTitle }}";
	temp['caseCategory'] = "{{ $Case->caseCategory }}";
	temp['caseDueDate'] = "{{ $Case->caseDueDate }}";
	temp['caseStatus'] = "{{ $Case->caseStatus }}";
	temp['appliedDate'] = "{{ $Case->appliedDate }}";
	@if ($Case->caseStatus == "Running") {
		tempAppliedButMissedCases.push(temp);
	}
	@else{
		tempAppliedCases.push(temp);
	}
	@endif	
@endforeach
@foreach($ApprovedCases as $Case)
	temp = {};
	temp['caseId'] = "{{ $Case->id }}";
	temp['caseTitle'] = "{{ $Case->caseTitle }}";
	temp['caseCategory'] = "{{ $Case->caseCategory }}";
	temp['caseDueDate'] = "{{ $Case->caseDueDate }}";
	temp['caseStatus'] = "{{ $Case->caseStatus }}";
	temp['appliedDate'] = "{{ $Case->appliedDate }}";
	tempApprovedCases.push(temp);
@endforeach
@foreach($ActiveCases as $Case)
	temp = {};
	temp['caseId'] = "{{ $Case->id }}";
	temp['caseTitle'] = "{{ $Case->caseTitle }}";
	temp['caseCategory'] = "{{ $Case->caseCategory }}";
	temp['caseDueDate'] = "{{ $Case->caseDueDate }}";
	temp['caseStatus'] = "{{ $Case->caseStatus }}";
	temp['appliedDate'] = "{{ $Case->appliedDate }}";
	tempActiveCases.push(temp);
@endforeach
@foreach($ClosedCases as $Case)
	temp = {};
	temp['caseId'] = "{{ $Case->id }}";
	temp['caseTitle'] = "{{ $Case->caseTitle }}";
	temp['caseCategory'] = "{{ $Case->caseCategory }}";
	temp['caseDueDate'] = "{{ $Case->caseDueDate }}";
	temp['caseStatus'] = "{{ $Case->caseStatus }}";
	temp['appliedDate'] = "{{ $Case->appliedDate }}";
	tempClosedCases.push(temp);
@endforeach
var numberofOpenCases = tempOpenCases.length;
var numberOfAppliedCases = tempAppliedCases.length;
var numberOfApprovedCases = tempApprovedCases.length;
var numberOfActiveCases = tempActiveCases.length;
var numberOfClosedCases = tempClosedCases.length;
let Dashboard = new Vue({
	el:"#PageContent",
	data:{
		// Dashboard Current Card Id -
		CurrentCaseId : 0,

		OpenCases : tempOpenCases,
		AppliedCases : tempAppliedCases,
		ApprovedCases : tempApprovedCases,
		ActiveCases : tempActiveCases,
		ClosedCases : tempClosedCases,
		AppliedButMissedCases : tempAppliedButMissedCases,

		// --------------------
		PickUpTheCaseSuccess : false,

		// Tabs ---------------
		OpenCasesTab : true,
		AppliedCasesTab : false,
		ApprovedCasesTab : false,
		ActiveCasesTab : false,
		ClosedCasesTab : false,
		Tabs : [
			{ 'TabName' : 'New', 'Counter' : numberofOpenCases, 'isActive' : true },
			{ 'TabName' : 'Applied', 'Counter' : numberOfAppliedCases, 'isActive' : false },
			{ 'TabName' : 'Approved', 'Counter' : numberOfApprovedCases, 'isActive' : false },
			{ 'TabName' : 'Active', 'Counter' : numberOfActiveCases, 'isActive' : false },
			{ 'TabName' : 'Closed', 'Counter' : numberOfClosedCases, 'isActive' : false }
		]
	},	
	computed:{
		hasAnyAppliedCases:function(){
			if (numberOfAppliedCases == 0) {
				return false;
			}
			else{
				return true;
			}
		}
	},
	methods:{
		ChangeTab:function(SelectedTab){
			this.Tabs.forEach(tab => {
				if (tab.TabName == SelectedTab) { tab.isActive = true; } else{ tab.isActive = false; }
			});
			if (SelectedTab == "New") {
				this.OpenCasesTab = true;
				this.AppliedCasesTab = false;
				this.ApprovedCasesTab = false;
				this.ActiveCasesTab = false;
				this.ClosedCasesTab = false;
			}
			else if(SelectedTab == "Applied"){
				this.AppliedCasesTab = true;
				this.OpenCasesTab = false;
				this.ApprovedCasesTab = false;
				this.ActiveCasesTab = false;
				this.ClosedCasesTab = false;
			}
			else if(SelectedTab == "Approved"){
				this.ApprovedCasesTab = true;
				this.OpenCasesTab = false;
				this.AppliedCasesTab = false;
				this.ActiveCasesTab = false;
				this.ClosedCasesTab = false;
			}
			else if(SelectedTab == "Active"){
				this.ActiveCasesTab = true;
				this.ApprovedCasesTab = false;
				this.OpenCasesTab = false;
				this.AppliedCasesTab = false;				
				this.ClosedCasesTab = false;
			}
			else if(SelectedTab == "Closed"){
				this.ClosedCasesTab = true;
				this.ActiveCasesTab = false;
				this.ApprovedCasesTab = false;
				this.OpenCasesTab = false;
				this.AppliedCasesTab = false;
			}
		},
		PickUpTheCaseSuccessOkay:function(){
			location.reload();
		},
		PickUpTheCaseSuccessGoToCase:function(){
			window.location = "{{ url('CaseDetails') }}"+"/"+this.CurrentCaseId;
		}
	}
})
</script>
@stop