@extends('Layouts.Vidhikarya.Lawyer.Master')
@section('title','Case Details')
@section('content')
<link rel="stylesheet" type="text/css" href=" {{ URL::asset('css/Rating/css-stars.css') }} ">
<script type="text/javascript" src="{{ URL::asset('js/Rating/jquery.barrating.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.inview.min.js') }}"></script>
<style type="text/css">
.progress{
	height:5px;
}
.ProfileContainer{
  margin:auto;
  width: 50%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  border-radius: 5px;
  margin-top: 5px;
}
.ImageContainer{
  width: 100%;
  height: 300px;
  display: flex;
  align-items:center; 
  justify-content: center;
  background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), 
        url( '{{ URL::asset('images/isThatHand.jpg') }}' );
  background-size: cover;
  flex-direction: column;
}
.CoverImage{
  width: 100%;
  height: 300px; 
}
/*Tabs ------------------------*/
.OpenCaseCardStyle{
  margin-bottom: 20px;
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
    color: #586069;
    background-color: rgba(27,31,35,0.08);
    border-radius: 20px;
}
/* Card Style*/
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
  flex-basis: 400px;
  flex-grow: 1;
    border-color: #e5e6e9 #dfe0e4 #d0d1d5;
    border-radius: 0 0 4px 4px;
    /*pointer-events: none;*/
    background-color: #fff;
    margin:5px;
    margin-bottom: 10px;
}
/* End Of Card Style*/
#OpenCases{
  display: flex;
  margin:auto;
  padding-top: 5px;
  flex-wrap: wrap;
  justify-content: space-around;
}
.DashboardNav{
  padding: 10px;
  padding-bottom: 0px;
  /*border-bottom: 1px solid #e1e4e8 ;*/
    width: 100%;
    background-color: #dbdbdb;
}
.DashboardNavBar{
    display: flex;
    flex-wrap: wrap;
}
.Tabs{
  align-content: flex-start;
  flex: 3;
}
.reponav-item{
  float: left;
    padding: 7px 15px 8px;
    color: #586069;
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
#ContactInformation, #GeneralInformation, #ProfessionalInformation, #AddressInformation, #EducationInformation{
  margin-bottom: 30px;
}
#ContactInformation .Heading, #GeneralInformation .Heading, #ProfessionalInformation .Heading, #AddressInformation .Heading, #EducationInformation .Heading{
  font-size: 17px; 
  font-weight: bold; 
  color: #90949c; 
  text-transform: uppercase;
}
.EditIcon{
  color: #90949c;
  font-size: 16px;
  cursor: pointer;
}
.InfoRow{
  display: flex; 
  justify-content: flex-start; 
  padding-top: 8px; 
  padding-bottom: 8px;
}
.RowLabel{
  color: #90949c;
}
.RowValue{
}
</style>
<div id="PageContent">
	<div class="ProfileContainer">
		<!-- Image Container -->
		<div class="ImageContainer">
			<div style="height: 100px; width: 100px;">
		    	<img src="{{ URL::asset('images/John_Doe.png') }}" style="width: 100%; height: 100%; border: 6px solid rgba(0, 0, 0, 0.38);">
		    </div>
		    <span style="font-size: 30px; color: #fff;"> @{{ name }} </span>
		</div>

		<!-- Tabs -->
		<div class="DashboardNav">
			<nav class="DashboardNavBar">
		    	<div class="Tabs">
		        	<neo-tab v-for="tab in Tabs" :data="tab" :tab-name="tab.TabName" @changed="ChangeTab"></neo-tab>
		    	</div>
			</nav>
		</div>

		<!-- About Tab -->
		<div v-if="AboutTab">
			<div id="AboutSection" style=" padding: 20px;">

		    <!-- General Information -->
		    <div id="GeneralInformation">
		        <div style="position: relative;">
		          <span class="Heading">
		            General Information
		          </span>
		          <div style="position: absolute; right: 20px; top: 0;">
		              <i class="material-icons EditIcon" v-on:click="EnableGeneralInformationEdit">mode_edit</i>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Name -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Name</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ name }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Gender -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Gender</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ gender }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>
		    </div>

		    <!-- Address Information -->
		    <div id="AddressInformation">
		        <div style="position: relative;">
		          <span class="Heading">
		            Address Information
		          </span>
		          <div style="position: absolute; right: 20px; top: 0;">
		              <i class="material-icons EditIcon" v-on:click="EnableAddressInformationEdit">mode_edit</i>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Country -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Country</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ country }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- State -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">State</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ state }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- City -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">City</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ city }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>
		    </div>

		    <!-- Contact Information -->
		    <div id="ContactInformation">
		        <div style="position: relative;">
		          <span class="Heading">
		            Contact Information
		          </span>
		          <div style="position: absolute; right: 20px; top: 0;">
		              <i class="material-icons EditIcon" v-on:click="EnableContactInformationEdit">mode_edit</i>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Email -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Email</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ email }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Mobile Number -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Mobile Number</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ mobileNo }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>
		    </div>

		    <!-- Education Information -->
		    <div id="EducationInformation">
		        <div style="position: relative;">
		          <span class="Heading">
		            Educational Information
		          </span>
		          <div style="position: absolute; right: 20px; top: 0;">
		              <i class="material-icons EditIcon" v-on:click="EnableEducationalInformationEdit">mode_edit</i>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Experience -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Experience</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ experience }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Designation -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Designation</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ designation }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Education -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Education</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ education }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Professional Summary -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Professional Summary</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ professionalSummary }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- State Bar Council -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">State Bar Council</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ stateBarCouncil }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Bar Council Registration No -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Bar Council Registration No</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ barCouncilRegNo }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Upload Bar Council -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Upload Bar Council</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ uploadBarCouncil }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Name of Bar Association -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Name of Bar Association</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ nameOfBarAssociation }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>

		        <!-- Court Name -->
		        <div class="InfoRow">
		          <div style="flex:1;">
		            <span class="RowLabel">Court Name</span>
		          </div>
		          <div style="flex:3;">
		            <span class="RowValue"> @{{ courtName }} </span>
		          </div>
		        </div>
		        <v-divider style="margin:0;"></v-divider>
		    </div>
		    </div>
		</div>

		<!-- Reviews Tab -->
		<div v-show="ReviewsTab" id="ReviewsTab">
<div style="display : flex; border-bottom: 1px solid #ddd;">
	<!-- Overview -->
	<div style="flex : 1; padding-left: 30px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
		<p style="margin-bottom: 5px; display: inline-block;"><span style="font-size: 30px; text-align: center; margin-bottom: 5px;">{{ $averageRating }}</span> <i class="material-icons" style="padding-left: 10px;">stars</i></p>
		<p style="font-size: 14px; color: #878787; font-weight: 500; margin-bottom: 5px;">{{ $totalRating }} Ratings</p>
		<p style="font-size: 14px; color: #878787; font-weight: 500; margin-bottom: 5px;">{{ $totalReview }} Reviews</p>
	</div>
	<!-- Ratings -->
	<div style="flex : 1; padding-top: 20px; padding-right: 20px;">

		<!-- 5 Stars -->
		<span style="display: flex; flex-wrap: wrap;">
			<span style="flex-basis: 50px; font-size: 13px; display: inline-block; display: flex; align-items: flex-start;">
				<span style="position: relative; bottom: 3px;">5</span> <i class="fa fa-star" style="font-size: 13px; padding-left: 4px;" aria-hidden="true"></i>
			</span>
			<div style="flex-basis: 120px; padding-top: 5px; flex-grow: 1;">
				<progress class="progress is-success" :value="ratingFiveProgressBar" max="100">95%</progress>
			</div>
			<div style="flex-basis: 30px;">
				<span style="position: relative; bottom: 3px;">&nbsp;{{ $fiveStar }}</span>
			</div>
		</span>

		<!-- 4 Stars -->
		<span style="display: flex; flex-wrap: wrap;">
			<span style="flex-basis: 50px; font-size: 13px; display: inline-block; display: flex; align-items: flex-start;">
				<span style="position: relative; bottom: 3px;">4</span> <i class="fa fa-star" style="font-size: 13px; padding-left: 4px;" aria-hidden="true"></i>
			</span>
			<div style="flex-basis: 120px; padding-top: 5px; flex-grow: 1;">
				<progress class="progress is-primary" :value="ratingFourProgressBar" max="100">75%</progress>
			</div>
			<div style="flex-basis: 30px;">
				<span style="position: relative; bottom: 3px;">&nbsp;{{ $fourStar }}</span>
			</div>
		</span>

		<!-- 3 Stars -->
		<span style="display: flex; flex-wrap: wrap;">
			<span style="flex-basis: 50px; font-size: 13px; display: inline-block; display: flex; align-items: flex-start;">
				<span style="position: relative; bottom: 3px;">3</span> <i class="fa fa-star" style="font-size: 13px; padding-left: 4px;" aria-hidden="true"></i>
			</span>
			<div style="flex-basis: 120px; padding-top: 5px; flex-grow: 1;">
				<progress class="progress is-info" :value="ratingThreeProgressBar" max="100">55%</progress>
			</div>
			<div style="flex-basis: 30px;">
				<span style="position: relative; bottom: 3px;">&nbsp;{{ $threeStar }}</span>
			</div>
		</span>

		<!-- 2 Stars -->
		<span style="display: flex; flex-wrap: wrap;">
			<span style="flex-basis: 50px; font-size: 13px; display: inline-block; display: flex; align-items: flex-start;">
				<span style="position: relative; bottom: 3px;">2</span> <i class="fa fa-star" style="font-size: 13px; padding-left: 4px;" aria-hidden="true"></i>
			</span>
			<div style="flex-basis: 120px; padding-top: 5px; flex-grow: 1;">
				<progress class="progress is-warning" :value="ratingTwoProgressBar" max="100">35%</progress>
			</div>
			<div style="flex-basis: 30px;">
				<span style="position: relative; bottom: 3px;">&nbsp;{{ $twoStar }}</span>
			</div>
		</span>
		
		<!-- 1 Stars -->
		<span style="display: flex; flex-wrap: wrap;">
			<span style="flex-basis: 50px; font-size: 13px; display: inline-block; display: flex; align-items: flex-start;">
				<span style="position: relative; bottom: 3px;">1</span> <i class="fa fa-star" style="font-size: 13px; padding-left: 4px;" aria-hidden="true"></i>
			</span>
			<div style="flex-basis: 120px; padding-top: 5px; flex-grow: 1;">
				<progress class="progress is-danger" :value="ratingOneProgressBar" max="100">15%</progress>
			</div>
			<div style="flex-basis: 30px;">
				<span style="position: relative; bottom: 3px;">&nbsp;{{ $oneStar }}</span>
			</div>
		</span>
	</div>
</div>
<div id="Reviews" style="width: 100%; padding-bottom: 40px;">
	<div v-for="Review in Reviews">
		<div class="card" style="margin-left: 20px; margin-right: 20px; margin-bottom: 5px; margin-top: 5px;">
			<div style="display: flex; justify-content: flex-start; padding-left: 20px; padding-top: 5px;">
				<span style="font-size: 16px; font-weight: 500;">@{{ Review.Name }}</span>
				<small style="padding-left: 20px; position: relative; top: 5px;">@{{ Review.Date }} </small>
			</div>
			<div style="padding-left: 20px;">
				@{{ Review.Review}}
			</div>
			<div style="padding-left: 20px; padding-bottom: 20px;">
				<neo-rating :rating-value="Review.Rating" :id="Review.UserID"></neo-rating>
			</div>
		</div>
	</div>
</div>
<div id="LoadMoreReviews" style="width:100%; display: flex; justify-content: center; align-items: center;">
	<a id="LoadingButton" class="button" style="border:0;">Loading</a>
</div>
		</div>
	</div>
  <!-- Update General Information -->
  <template>
	    <v-layout row justify-center>
	      <v-dialog v-model="GeneralInfoDialog" scrollable width="70%">
	        <v-btn primary light slot="activator" id="GeneralInformationDialogActivator" style="display: none;">Edit</v-btn>
	        <v-card>
	          <v-card-title>General Information</v-card-title>
	          <v-divider style="margin:0;"></v-divider>
	          <div style="margin:20px;">
	            <div class="notification is-success" v-show="isGeneralInfoUpdateSuccess" style="padding:10px;">
	              <button class="delete"></button>Saved
	            </div>
	          </div>
	          <v-card-row height="300px">
	            <v-card-text>
	              <!-- First Name -->
	              	<v-text-field 
	              		v-model="tmpFirstName"
	              		label="First Name"
	              		>
	              	</v-text-field>
	              <!-- Middle Name -->
	              	<v-text-field 
	              		v-model="tmpMiddleName"
	              		label="Middle Name"
	              		>
	              	</v-text-field>
	              <!-- Last Name -->
	              	<v-text-field 
	              		v-model="tmpLastName"
	              		label="Last Name"
	              		>
	              	</v-text-field>
	              <!-- Gender -->
	              	<v-select
	                        v-bind:items="['Male','Female']"
	                        v-model="tmpGender"
	                        label="Gender"
	                        dark
	                        auto
	                  ></v-select>
	            </v-card-text>
	          </v-card-row>
	          <v-divider></v-divider>
	          <v-card-row actions>
	            <v-btn class="blue--text darken-1" flat @click.native="GeneralInfoDialogClose">Close</v-btn>
	            <v-btn class="blue--text darken-1" flat @click.native="UpdateGeneralInformation">Save</v-btn>
	          </v-card-row>
	        </v-card>
	      </v-dialog>
	    </v-layout>
  </template>

  <!-- Update Contact Information -->
  <template>
	    <v-layout row justify-center>
	      <v-dialog v-model="ContactInfoDialog" scrollable width="70%">
	        <v-btn primary light slot="activator" id="ContactInformationDialogActivator" style="display: none;">Edit</v-btn>
	        <v-card>
	          <v-card-title>Contact Information</v-card-title>
	          <v-divider style="margin:0;"></v-divider>
	          <div style="margin:20px;">
	            <div class="notification is-success" v-show="isContactInfoUpdateSuccess" style="padding:10px;">
	              <button class="delete"></button>Saved
	            </div>
	          </div>
	          <v-card-row height="300px">
	            <v-card-text>
	              <!-- Email -->
	              	<v-text-field 
	              		v-model="tmpEmail"
	              		label="Email"
	              		>
	              	</v-text-field>

	              <!-- Mobile No. -->
	              	<v-text-field 
	              		v-model="tmpMobileNo"
	              		label="Mobile No."
	              		>
	              	</v-text-field>
	            </v-card-text>
	          </v-card-row>
	          <v-divider></v-divider>
	          <v-card-row actions>
	            <v-btn class="blue--text darken-1" flat @click.native="ContactInfoDialogClose">Close</v-btn>
	            <v-btn class="blue--text darken-1" flat @click.native="UpdateContactInformation">Save</v-btn>
	          </v-card-row>
	        </v-card>
	      </v-dialog>
	    </v-layout>
  </template>

  <!-- Update Address Information -->
  <template>
	    <v-layout row justify-center>
	      <v-dialog v-model="AddressInfoDialog" scrollable width="70%">
	        <v-btn primary light slot="activator" id="AddressInformationDialogActivator" style="display: none;">Edit</v-btn>
	        <v-card>
	          <v-card-title>Address Information</v-card-title>
	          <v-divider style="margin:0;"></v-divider>
	          <div style="margin:20px;">
	            <div class="notification is-success" v-show="isAddressInfoUpdateSuccess" style="padding:10px;">
	              <button class="delete"></button>Saved
	            </div>
	          </div>
	          <v-card-row height="300px">
	            <v-card-text>
	              <!-- Country -->
	              	<v-select
	                        v-bind:items="countries"
	                        v-model="tmpCountry"
	                        label="Country"
	                        dark
	                        auto
	                        @input="LoadState"
	                  ></v-select>
	              <!-- State -->
	              	<v-select
	                        v-bind:items="states"
	                        v-model="tmpState"
	                        label="State"
	                        dark
	                        auto
	                  ></v-select>
	              <!-- City -->
	              	<v-text-field 
	              		v-model="tmpCity"
	              		label="City"
	              		>
	              	</v-text-field>
	            </v-card-text>
	          </v-card-row>
	          <v-divider></v-divider>
	          <v-card-row actions>
	            <v-btn class="blue--text darken-1" flat @click.native="AddressInfoDialogClose">Close</v-btn>
	            <v-btn class="blue--text darken-1" flat @click.native="UpdateAddressInformation">Save</v-btn>
	          </v-card-row>
	        </v-card>
	      </v-dialog>
	    </v-layout>
  </template>

  <!-- Update Educational Information -->
  <template>
	    <v-layout row justify-center>
	      <v-dialog v-model="EducationalInfoDialog" scrollable width="70%">
	        <v-btn primary light slot="activator" id="EducationalInformationDialogActivator" style="display: none;">Edit</v-btn>
	        <v-card>
	          <v-card-title>Educational Information</v-card-title>
	          <v-divider style="margin:0;"></v-divider>
	          <div style="margin:20px;">
	            <div class="notification is-success" v-show="isEducationalInfoUpdateSuccess" style="padding:10px;">
	              <button class="delete"></button>Saved
	            </div>
	          </div>
	          <v-card-row height="300px">
	            <v-card-text>
	            	<!-- Experience -->
	                <div>
	                    <v-select
	                      v-bind:items="['1','2','3','4','5','6']"
	                      prepend-icon='menu'
	                      v-model="tmpExperience"
	                      label="Experience"
	                      dark
	                      auto
	                      :rules="experienceError"
	                      @input="ExperienceSelected"
	                    ></v-select>
	                </div>

	                <!-- Designation -->
	                <div>
	                    <v-select
	                      v-bind:items="['areaBusiness 1','areaBusiness 2','areaBusiness 3']"
	                      prepend-icon='menu'
	                      v-model="tmpDesignation"
	                      label="Designation"
	                      dark
	                      auto
	                      :rules="designationError"
	                      @input="DesignationSelected"
	                    ></v-select>
	                </div>
	              	
	              	<!-- Education -->
	                <div>
	                    <v-select
	                      v-bind:items="['education 1','education 2','education 3']"
	                      prepend-icon='menu'
	                      v-model="tmpEducation"
	                      label="Education"
	                      dark
	                      auto
	                      :rules="educationError"
	                      @input="EducationSelected"
	                    ></v-select>
	                </div>                

	                <!-- Professional Summary -->
	                <div>
	                    <v-text-field
	                        v-model = "tmpProfessionalSummary"
	                        name="professionalSummary"
	                        label="Professional Summary"
	                        prepend-icon="mode_edit"
	                        hint="Type Case Title"
	                        id="professionalSummary"
	                        multi-line
	                      >
	                    </v-text-field>
	                </div>

	                <!-- State Bar Council -->
	                <div>
	                    <v-select
	                      v-bind:items="['State Bar Council 1','State Bar Council 2','State Bar Council 3']"
	                      prepend-icon='menu'
	                      v-model="tmpStateBarCouncil"
	                      label="State Bar Council Where you are registered"
	                      dark
	                      auto
	                    ></v-select>
	                </div>   

	                <!-- Bar Council Registration No -->
	                <div>
	                    <v-text-field
	                        v-model = "tmpBarCouncilRegNo"
	                        name="barCouncilRegNo"
	                        label="Bar Council Registration No"
	                        prepend-icon="mode_edit"
	                        hint="Type Case Title"
	                        id="professionalSummary"
	                      >
	                    </v-text-field>
	                </div>

	                <!-- Name of Bar Association -->
	                <div>
	                    <v-select
	                      v-bind:items="['bar 1','bar 2','bar 3']"
	                      prepend-icon='menu'
	                      v-model="tmpNameOfBarAssociation"
	                      label="Name of Bar Association of which you are a member"
	                      dark
	                      auto
	                    ></v-select>
	                </div>                
	                
	                <!-- Name Of The Court -->
	                <div>
	                    <v-text-field
	                        v-model = "tmpCourtName"
	                        name="courtName"
	                        label="Name of the Courts where you practice"
	                        prepend-icon="mode_edit"
	                        hint="Type Case Title"
	                        id="courtName"
	                      >
	                    </v-text-field>
	                </div>

	            </v-card-text>
	          </v-card-row>
	          <v-divider></v-divider>
	          <v-card-row actions>
	            <v-btn class="blue--text darken-1" flat @click.native="EducationalInfoDialogClose">Close</v-btn>
	            <v-btn class="blue--text darken-1" flat @click.native="UpdateEducationalInformation">Save</v-btn>
	          </v-card-row>
	        </v-card>
	      </v-dialog>
	    </v-layout>
  </template>  
 <div id="Status"></div>
</div>
<script type="text/javascript" src="{{ url('js/neoComponent.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#LoadMoreReviews').on('inview', function(event, isInView) {
	  	if (isInView) {
	  		if (LawyerAccount.totalRating == 0) {
	  			$("#LoadingButton").html("Not Rating and Reviews Yet !");
	  		}
	  		else if (LawyerAccount.currentReviewsLoaded < LawyerAccount.totalReview) {
	            let formData={
	                'currentReviewsLoaded' : LawyerAccount.currentReviewsLoaded,
	                '_token': "{{ csrf_token() }}"
	            };
	            $('#LoadingButton').addClass('is-loading').html("Loading...");
	            $.ajax({
	                    type: "post",
	                    url: "/LoadReviews",
	                    data: formData,
	                    dataType: 'json',
	                    success: function (data) {
	                        var ReturnedData=JSON.parse(JSON.stringify(data));
	                        if ('Status' in ReturnedData) {
	                            if (ReturnedData.Status == "Loaded") {
	                            	var Reviews = ReturnedData.Reviews;
	                            	var totalFetchedReview = Reviews.length;
	                            	var count = 0;
	                            	while(count<totalFetchedReview)
	                            	{
	                            		temp = {};
									    temp['Review'] = Reviews[count].review;
									    temp['Rating'] = Reviews[count].rating;
									    temp['Name'] = Reviews[count].userName;
									    temp['UserID'] = Reviews[count].userId;
									    temp['Date'] = Reviews[count].created_at;
									    LawyerAccount.Reviews.push(temp);
									    LawyerAccount.currentReviewsLoaded = LawyerAccount.currentReviewsLoaded + 1;
									    count++;
	                            	}
	                            	$('#LoadingButton').removeClass('is-loading').html("Load More");
	                            }
	                        }
	                    }.bind(this),
	                    error: function (data) {
	                        $("#Status").append(JSON.stringify(data));
	                    }.bind(this)
	            });
	  		}
	  		else{
	  			$("#LoadingButton").html("All Reviews Has Been Loaded !");
	  		}
	  	} 
	  	else {
	    	$('#LoadingButton').removeClass('is-loading');
	  	}
	}.bind(this));
});
// Rating and Reviews ---------------------------
var tempReviews = [];
var tmpCurrentReviewsLoaded = 0;
@foreach($LawyerReviews as $Review)
    temp = {};
    temp['Review'] = "{{ $Review->review }}";
    temp['Rating'] = "{{ $Review->rating }}";
    temp['Name'] = "{{ $Review->userName }}";
    temp['UserID'] = "{{ $Review->userId }}";
    temp['Date'] = "{{ $Review->created_at }}";
    tempReviews.push(temp);
    tmpCurrentReviewsLoaded++;
@endforeach
// End of Rating and Reviews ---------------------
  var ParsedCountries = [];
  @foreach($countries as $country)
      ParsedCountries.push("{{ $country->meta_value }}");
  @endforeach
  var ParsedStates = [];
  @foreach($states as $state)
      ParsedStates.push("{{ $state->meta_value }}");
  @endforeach
  @foreach($user as $theuser)
  	var TheName = "{{ $theuser->name }}";
  	var TheEmail = "{{ $theuser->email }}";
  @endforeach
  @foreach($lawyerDetails as $details)
  	var TheFirstName = "{{ $details->firstName }}";
  	var TheMiddleName = "{{ $details->middleName }}";
  	var TheLastName = "{{ $details->lastName }}";
  	var TheCountry = "{{ $details->country }}";
  	var TheGender = "{{ $details->gender }}";
  	var TheMobileNo = "{{ $details->mobileNo }}";
  	var TheState = "{{ $details->state }}";
  	var TheCity = "{{ $details->city }}";
  	var TheExperience = "{{ $details->experience }}";
  	var TheDesignation = "{{ $details->designation }}";
  	var TheEducation = "{{ $details->education }}";
  	var TheProfessionalSummary = "{{ $details->professionalSummary }}";
  	var TheStateBarCouncil = "{{ $details->stateBarCouncil }}";
  	var TheBarCouncilRegNo = "{{ $details->barCouncilRegNo }}";
  	var TheUploadBarCouncil = "{{ $details->uploadBarCouncil }}";
  	var TheNameOfBarAssociation = "{{ $details->nameOfBarAssociation }}";
  	var TheCourtName = "{{ $details->courtName }}";
  @endforeach
var LawyerAccount = new Vue({
	el:'#PageContent',
	data:{
		// Ratings ----------------
		Reviews : tempReviews,
		oneStar : {{ $oneStar }}, 
		twoStar : {{ $twoStar }},
		threeStar : {{ $threeStar }}, 
		fourStar : {{ $fourStar }},
		fiveStar : {{ $fiveStar }},
		totalReview : {{ $totalReview }},
		totalRating : {{ $totalRating }},
		currentReviewsLoaded : tmpCurrentReviewsLoaded,

		// Data ---------
		countries : ParsedCountries,
		states : ParsedStates,

		// Modals --------
		GeneralInfoDialog : false,
		ContactInfoDialog : false,
		AddressInfoDialog : false,
		EducationalInfoDialog : false,

		// Status ---------------
		isGeneralInfoUpdateSuccess : false,
		isContactInfoUpdateSuccess : false,
		isAddressInfoUpdateSuccess : false,
		isEducationalInfoUpdateSuccess : false,

		//General ----------------
		firstName : TheFirstName,
		middleName : TheMiddleName,
		lastName : TheLastName,
		gender : TheGender,
		name : TheName,

		tmpFirstName : TheFirstName,
		tmpMiddleName : TheMiddleName,
		tmpLastName : TheLastName,
		tmpGender : TheGender,
		tmpName : TheName,

		// Address ----------------
		country : TheCountry,		
		state : TheState,
		city : TheCity,

		tmpCountry : TheCountry,
		tmpState : TheState,
		tmpCity : TheCity,

		// Contact -----------------
		mobileNo : TheMobileNo,
		email : TheEmail,

		tmpMobileNo : TheMobileNo,
		tmpEmail : TheEmail,

		// Educational ---------------
		experience : TheExperience,
		designation : TheDesignation,
		education : TheEducation,
		professionalSummary : TheProfessionalSummary,
		stateBarCouncil : TheStateBarCouncil,
		barCouncilRegNo : TheBarCouncilRegNo,
		uploadBarCouncil : TheUploadBarCouncil,
		nameOfBarAssociation : TheNameOfBarAssociation,
		courtName : TheCourtName,

		tmpExperience : TheExperience,
		tmpDesignation : TheDesignation,
		tmpEducation : TheEducation,
		tmpProfessionalSummary : TheProfessionalSummary,
		tmpStateBarCouncil : TheStateBarCouncil,
		tmpBarCouncilRegNo : TheBarCouncilRegNo,
		tmpUploadBarCouncil : TheUploadBarCouncil,
		tmpNameOfBarAssociation : TheNameOfBarAssociation,
		tmpCourtName : TheCourtName,
		// Tabs
      AboutTab : true,
      ReviewsTab : false,
      Tabs : [
        { 'TabName' : 'About', 'isActive' : true },
        { 'TabName' : 'Reviews', 'Counter' : {{ $totalRating }}, 'isActive' : false }
      ],
	},
	mounted(){
		$('#'+this.id).barrating({
	        theme: 'css-stars',
	        initialRating : this.ratingValue,
	        readonly : true
	    });
	},
	computed:{
		ratingOneProgressBar:function(){
			if (this.totalRating == 0) {
				return 0;
			}
			var temp = (this.oneStar * 100)/this.totalRating;
			temp = Math.round(temp);
			return temp;
		},
		ratingTwoProgressBar:function(){
			if (this.totalRating == 0) {
				return 0;
			}
			var temp = (this.twoStar * 100)/this.totalRating;
			temp = Math.round(temp);
			return temp;
		},
		ratingThreeProgressBar:function(){
			if (this.totalRating == 0) {
				return 0;
			}
			var temp = (this.threeStar * 100)/this.totalRating;
			temp = Math.round(temp);
			return temp;
		},
		ratingFourProgressBar:function(){
			if (this.totalRating == 0) {
				return 0;
			}
			var temp = (this.fourStar * 100)/this.totalRating;
			temp = Math.round(temp);
			return temp;
		},
		ratingFiveProgressBar:function(){
			if (this.totalRating == 0) {
				return 0;
			}
			var temp = (this.fiveStar * 100)/this.totalRating;
			temp = Math.round(temp);
			return temp;
		},
	},
	methods:{
		LoadState:function(){
              	this.tmpState = "";
	            let formData={
	                'country' : this.tmpCountry,
	                '_token': "{{csrf_token()}}"
	            };
	            $.ajax({
	                    type: "post",
	                    url: "/LoadState",
	                    data: formData,
	                    dataType: 'json',
	                    success: function (data) {
	                        var ReturnedData=JSON.parse(JSON.stringify(data));
	                        if ('success' in ReturnedData) {
	                            var states = ReturnedData['states'];
	                            var ParsedStates2 = JSON.parse(states);
	                            var len = ParsedStates2.length;
	                            var i=0;
                              	this.states = [];
	                            while(i<len){
	                                this.states.push(ParsedStates2[i]);
	                                i++;
	                            }
	                        }
	                    }.bind(this),
	                    error: function (data) {
	                        $("#Status").append(JSON.stringify(data));
	                    }.bind(this)
	            });
      	},
		// Enableing Modal
		EnableGeneralInformationEdit:function(){
			setTimeout(function () {
                $("#GeneralInformationDialogActivator").trigger('click');
            }, 100);
		},
		EnableContactInformationEdit:function(){
			setTimeout(function () {
                $("#ContactInformationDialogActivator").trigger('click');
            }, 100);
		},
		EnableAddressInformationEdit:function(){
			setTimeout(function () {
                $("#AddressInformationDialogActivator").trigger('click');
            }, 100);	
		},
		EnableEducationalInformationEdit:function(){
			setTimeout(function () {
                $("#EducationalInformationDialogActivator").trigger('click');
            }, 100);	
		},
		// Close Dialog ---------------------------------
		GeneralInfoDialogClose:function(){
			this.GeneralInfoDialog = false;
			this.isGeneralInfoUpdateSuccess = false;
		},
		ContactInfoDialogClose:function(){
			this.ContactInfoDialog = false;
			this.isContactInfoUpdateSuccess = false;
		},
		AddressInfoDialogClose:function(){
			this.AddressInfoDialog = false;
			this.isAddressInfoUpdateSuccess = false;
		},
		EducationalInfoDialogClose:function(){
			this.EducationalInfoDialog = false;
			this.isEducationalInfoUpdateSuccess = false;
		},
		// Dialog Update --------------------------------
		UpdateGeneralInformation:function(){
			let formData={
              'firstName' : this.tmpFirstName,
              'middleName' : this.tmpMiddleName,
              'lastName' : this.tmpLastName,
              'gender' : this.tmpGender,
              '_token': "{{csrf_token()}}"
          	};
        	$.ajax({
                type: "post",
                url: "/UpdateGeneralInformationforLawyer",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var ReturnedData=JSON.parse(JSON.stringify(data));
                    if ("Status" in ReturnedData) {
                      if (ReturnedData.Status == "Updated") {
                        this.isGeneralInfoUpdateSuccess = true;
                        this.name = this.tmpFirstName + " " + this.tmpMiddleName + " " + this.tmpLastName;
                        this.gender = this.tmpGender;
                      }
                    }
                }.bind(this),
                error: function (data) {
                    $("#Status").append(JSON.stringify(data));
                }.bind(this)
            });
		},
		UpdateContactInformation:function(){
			let formData={
              'email' : this.tmpEmail,
              'mobileNo' : this.tmpMobileNo,
              '_token': "{{csrf_token()}}"
          	};
        	$.ajax({
                type: "post",
                url: "/UpdateContactInformationforLawyer",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var ReturnedData=JSON.parse(JSON.stringify(data));
                    if ("Status" in ReturnedData) {
                      if (ReturnedData.Status == "Updated") {
                        this.isContactInfoUpdateSuccess = true;
                        this.email = this.tmpEmail;
                        this.mobileNo = this.tmpMobileNo;
                      }
                    }
                }.bind(this),
                error: function (data) {
                    $("#Status").append(JSON.stringify(data));
                }.bind(this)
            });
		},
		UpdateAddressInformation:function(){
			let formData={
              'country' : this.tmpCountry,
              'state' : this.tmpState,
              'city' : this.tmpCity,
              '_token': "{{csrf_token()}}"
          	};
        	$.ajax({
                type: "post",
                url: "/UpdateAddressInformationforLawyer",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var ReturnedData=JSON.parse(JSON.stringify(data));
                    if ("Status" in ReturnedData) {
                      if (ReturnedData.Status == "Updated") {
                        this.isAddressInfoUpdateSuccess = true;
                        this.country = this.tmpCountry;
                        this.state = this.tmpState;
                        this.city = this.tmpCity;
                      }
                    }
                }.bind(this),
                error: function (data) {
                    $("#Status").append(JSON.stringify(data));
                }.bind(this)
            });
		},
		UpdateEducationalInformation:function(){
			let formData={
              'experience' : this.tmpExperience,
              'designation' : this.tmpDesignation,
              'education' : this.tmpEducation,
              'professionalSummary' : this.tmpProfessionalSummary,
              'stateBarCouncil' : this.tmpStateBarCouncil,
              'barCouncilRegNo' : this.tmpBarCouncilRegNo,
              'uploadBarCouncil' : this.tmpUploadBarCouncil,
              'nameOfBarAssociation' : this.tmpNameOfBarAssociation,
              'courtName' : this.tmpCourtName,
              '_token': "{{csrf_token()}}"
          	};
        	$.ajax({
                type: "post",
                url: "/UpdateEducationalInformationforLawyer",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var ReturnedData=JSON.parse(JSON.stringify(data));
                    if ("Status" in ReturnedData) {
                      if (ReturnedData.Status == "Updated") {
                          this.isEducationalInfoUpdateSuccess = true;
                          this.experience = this.tmpExperience;
			              this.designation = this.tmpDesignation;
			              this.education = this.tmpEducation;
			              this.professionalSummary = this.tmpProfessionalSummary;
			              this.stateBarCouncil = this.tmpStateBarCouncil;
			              this.barCouncilRegNo = this.tmpBarCouncilRegNo;
			              this.uploadBarCouncil = this.tmpUploadBarCouncil;
			              this.nameOfBarAssociation = this.tmpNameOfBarAssociation;
			              this.courtName = this.tmpCourtName;
                      }
                    }
                }.bind(this),
                error: function (data) {
                    $("#Status").append(JSON.stringify(data));
                }.bind(this)
            });
		},
		ChangeTab:function(SelectedTab){
          this.Tabs.forEach(tab => {
            if (tab.TabName == SelectedTab) { tab.isActive = true; } else{ tab.isActive = false; }
          });
          if (SelectedTab == "About") {
            this.AboutTab = true;
            this.ReviewsTab = false;
          }
          else if(SelectedTab == "Reviews"){
            this.ReviewsTab = true;
            this.AboutTab = false;
          }
      },
	}
});
</script>
@stop