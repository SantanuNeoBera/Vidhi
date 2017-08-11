@extends('Layouts.Vidhikarya.Client.Master')
@section('content')
<style type="text/css">
  table{
      width: 100%;
      background: #fff;
      border: 1px solid rgba(34,36,38,.15);
      box-shadow: none;
      outline: none;
      text-align: left;
      color: rgba(0,0,0,.87);
      border-collapse: separate;
      border-spacing: 0;
      font-size: 1em;
  }
  tr{
  	padding-left:10px;
  }
  .TheLabel{
  	 background-color:rgba(0,0,0,.03);
  	 width:20%;
  	 border-right:1px solid rgba(34,36,38,.15) !important;
  	 padding:10px;
  }
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
  #ContactInformation, #GeneralInformation, #ProfessionalInformation, #AddressInformation{
    margin-bottom: 30px;
  }
  #ContactInformation .Heading, #GeneralInformation .Heading, #ProfessionalInformation .Heading, #AddressInformation .Heading{
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
</style>
<div id="PageContent">
<div class="ProfileContainer">

  <!-- Image Container -->
  <div class="ImageContainer">
    <div style="height: 100px; width: 100px;">
      <img src="{{ URL::asset('images/John_Doe.png') }}" style="width: 100%; height: 100%; border: 6px solid rgba(0, 0, 0, 0.38);">
    </div>
    <span style="font-size: 30px; color: #fff;"> @{{ fullName }} </span>
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
  <div id="AboutTab" v-if="AboutTab">
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

        <!-- Age -->
        <div class="InfoRow">
          <div style="flex:1;">
            <span class="RowLabel">Age</span>
          </div>
          <div style="flex:3;">
            <span class="RowValue"> @{{ age }} </span>
          </div>
        </div>
        <v-divider style="margin:0;"></v-divider>

        <!-- Occupation -->
        <div class="InfoRow">
          <div style="flex:1;">
            <span class="RowLabel">Occupation</span>
          </div>
          <div style="flex:3;">
            <span class="RowValue"> @{{ occupation }} </span>
          </div>
        </div>
        <v-divider style="margin:0;"></v-divider>

        <!-- Education Level -->
        <div class="InfoRow">
          <div style="flex:1;">
            <span class="RowLabel">Education Level</span>
          </div>
          <div style="flex:3;">
            <span class="RowValue"> @{{ educationLavel }} </span>
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

        <!-- Address -->
        <div class="InfoRow">
          <div style="flex:1;">
            <span class="RowLabel">Address</span>
          </div>
          <div style="flex:3;">
            <span class="RowValue"> @{{ address }} </span>
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
          <div style="padding-left: 20px; padding-right: 20px;">
            <div class="notification is-success" v-show="isGeneralInfoUpdateSuccess" style="padding:10px;">
              <button class="delete"></button>Saved
            </div>
          </div>
          <v-card-row height="300px">
            <v-card-text>
              <!-- First Name -->
              	<v-text-field 
              		v-model="tmpfirstName"
              		label="First Name"
              		>
              	</v-text-field>
              <!-- Middle Name -->
              	<v-text-field 
              		v-model="tmpmiddleName"
              		label="Middle Name"
              		>
              	</v-text-field>
              <!-- Last Name -->
              	<v-text-field 
              		v-model="tmplastName"
              		label="Last Name"
              		>
              	</v-text-field>
              <!-- Gender -->
              	<v-select
                        v-bind:items="['Male','Female']"
                        v-model="tmpgender"
                        label="Gender"
                        dark
                        auto
                  ></v-select>
              <!-- Occupation -->
              	<v-select
                        v-bind:items="['Occupation 1','Occupation 2']"
                        v-model="tmpoccupation"
                        label="Occupation"
                        dark
                        auto
                  ></v-select>
              <!-- Age -->
              	<v-select
                        v-bind:items="['1','2']"
                        v-model="tmpage"
                        label="Age"
                        dark
                        auto
                  ></v-select>
              <!-- Education Level -->
              	<v-select
                        v-bind:items="['HS','Graduation']"
                        v-model="tmpeducationLavel"
                        label="Education Level"
                        dark
                        auto
                  ></v-select>            
              <!-- <small>*indicates required field</small> -->
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

  <!-- Update Address Information -->
  <template>
    <v-layout row justify-center>
      <v-dialog v-model="AddressInfoDialog" width="500px">
        <v-btn primary light slot="activator" id="AddressInformationDialogActivator" style="display: none;">Edit</v-btn>
        <v-card>
          <v-card-row>
            <v-card-title style="padding-top:10px; padding-bottom: 10px;">Address Details</v-card-title>
          </v-card-row>
          <v-divider style="margin-top:0; margin-bottom: 10px;"></v-divider>
          <div style="padding-left: 20px; padding-right: 20px;">
            <div class="notification is-success" v-show="isAddressInfoUpdateSuccess" style="padding:10px;">
              <button class="delete"></button>Saved
            </div>
          </div>
          <v-card-row>
            <v-card-text>
              <!-- Country -->
              	<v-select
                        v-bind:items="countries"
                        v-model="tmpcountry"
                        label="Country"
                        dark
                        auto
                        @input="LoadState"
                  ></v-select>
              <!-- State -->
              	<v-select
                        v-bind:items="states"
                        v-model="tmpstate"
                        label="State"
                        dark
                        auto
                  ></v-select>
              <!-- City -->
              	<v-text-field 
              		v-model="tmpcity"
              		label="City"
              		>
              	</v-text-field>
              <!-- Address -->
              	<v-text-field 
              		v-model="tmpaddress"
              		label="Address"
              		multi-line
              		>
              	</v-text-field>
              <!-- <small>*indicates required field</small> -->
            </v-card-text>
          </v-card-row>
          <v-card-row actions>
            <v-btn class="blue--text darken-1" flat @click.native="AddressInfoDialogClose">Close</v-btn>
            <v-btn class="blue--text darken-1" flat @click.native="UpdateAddressInformation">Save</v-btn>
          </v-card-row>
        </v-card>
      </v-dialog>
    </v-layout>
  </template>

  <!-- Update Contact Information -->
  <template>
    <v-layout row justify-center>
      <v-dialog v-model="ContactInfoDialog">
        <v-btn primary light slot="activator" id="ContactInformationDialogActivator" style="display:none;">Edit</v-btn>
        <v-card>
          <v-card-row>
            <v-card-title style="padding-top:10px; padding-bottom: 10px;">Contact Information</v-card-title>
          </v-card-row>
          <v-divider style="margin-top:0; margin-bottom: 10px;"></v-divider>
          <div style="padding-left: 20px; padding-right: 20px;">
            <div class="notification is-success" v-show="isContactInfoUpdateSuccess" style="padding:10px;">
  				    <button class="delete"></button>Saved
  			    </div>
          </div>
          <v-card-row>
            <v-card-text>
              <!-- Email -->
              	<v-text-field 
              		v-model="tmpemail"
              		label="Email"
              		>
              	</v-text-field>
              <!-- Mobile No -->
  	            <v-text-field 
              		v-model="tmpmobileNo"
              		label="Mobile Number"
              		>
  	            </v-text-field>
              <!-- <small>*indicates required field</small> -->
            </v-card-text>
          </v-card-row>
          <v-card-row actions>
            <v-btn class="blue--text darken-1" flat @click.native="ContactInfoDialogClose">Close</v-btn>
            <v-btn class="blue--text darken-1" flat @click.native="UpdateContactInformation">Save</v-btn>
          </v-card-row>
        </v-card>
      </v-dialog>
    </v-layout>
  </template>

  <div id="Status"></div>

</div>
<script type="text/javascript" src="{{ url('js/neoComponent.js') }}"></script>
<script type="text/javascript">
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
  @foreach($clientDetails as $details)
  	var TheFirstName = "{{ $details->firstName }}";
  	var TheMiddleName = "{{ $details->middleName }}";
  	var TheLastName = "{{ $details->lastName }}";
  	var TheGender = "{{ $details->gender }}";
  	var TheAge = "{{ $details->age }}";
  	var TheOccupation = "{{ $details->occupation }}";
  	var TheEducationLavel = "{{ $details->educationLavel }}";
  	var TheCountry = "{{ $details->country }}";
  	var TheAddress = "{{ $details->address }}";
  	var TheState = "{{ $details->state }}";
  	var TheCity = "{{ $details->city }}";
  	var TheMobileNo = "{{ $details->MobileNo }}";
  @endforeach
	new Vue({
		el:'#PageContent',
		data:{
      // Tabs
      AboutTab : true,
      Tabs : [
        { 'TabName' : 'About', 'isActive' : true },
      ],

      // General
			name : TheName,
			firstName : TheFirstName,
			middleName : TheMiddleName,
			lastName : TheLastName,
			gender : TheGender,
			age : TheAge,
			occupation : TheOccupation,
			educationLavel : TheEducationLavel,

      // Address
			country: TheCountry,
			address : TheAddress,
			state : TheState,
			city : TheCity,

      // Contact
			email: TheEmail,
			mobileNo : TheMobileNo,

      // General Edit
			tmpname : TheName,
			tmpfirstName : TheFirstName,
			tmpmiddleName : TheMiddleName,
			tmplastName : TheLastName,
			tmpgender : TheGender,
			tmpage : TheAge,
			tmpoccupation : TheOccupation,
			tmpeducationLavel : TheEducationLavel,

      // Address Edit
			tmpcountry: TheCountry,
			tmpaddress : TheAddress,
			tmpstate : TheState,
			tmpcity : TheCity,

      // Contact Edit
			tmpemail: TheEmail,
			tmpmobileNo : TheMobileNo,

      // Dialogs
			GeneralInfoDialog : false,
			AddressInfoDialog : false,
			ContactInfoDialog : false,

			isContactInfoUpdateSuccess : false,
      isAddressInfoUpdateSuccess : false,
      isGeneralInfoUpdateSuccess : false,

			countries : ParsedCountries,
			states : ParsedStates,
		},
    computed:{
      fullName:function(){
        return (this.firstName + " " + this.middleName + " " + this.lastName);
      }
    },
		methods:{
      EnableGeneralInformationEdit:function(){
          setTimeout(function () {
                $("#GeneralInformationDialogActivator").trigger('click');
            }, 100);
      },
      EnableAddressInformationEdit:function(){
          setTimeout(function () {
                $("#AddressInformationDialogActivator").trigger('click');
            }, 100);
      },
      EnableContactInformationEdit:function(){
          setTimeout(function () {
                $("#ContactInformationDialogActivator").trigger('click');
            }, 100);
      },
      ChangeTab:function(SelectedTab){
          this.Tabs.forEach(tab => {
            if (tab.TabName == SelectedTab) { tab.isActive = true; } else{ tab.isActive = false; }
          });
          if (SelectedTab == "About") {
            this.AboutTab = true;
          }
      },
			LoadState:function(){
              this.tmpstate = "";
	            let formData={
	                'country' : this.tmpcountry,
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
	                            var ParsedStates = JSON.parse(states);
	                            var len = ParsedStates.length;
	                            var i=0;
                              this.states = [];
	                            while(i<len){
	                                this.states.push(ParsedStates[i]);
	                                i++;
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
              'mobileNo' : this.tmpmobileNo,
              'email' : this.tmpemail,
              '_token': "{{csrf_token()}}"
        	};
    		$.ajax({
                type: "post",
                url: "/UpdateContactInformationforClient",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var ReturnedData=JSON.parse(JSON.stringify(data));
                    this.isContactInfoUpdateSuccess = true;
                    this.email = this.tmpemail;
                    this.mobileNo = this.tmpmobileNo;
                }.bind(this),
                error: function (data) {
                    $("#Status").append(JSON.stringify(data));
                }.bind(this)
            });
    	},
    	UpdateAddressInformation:function(){
        let formData={
              'country' : this.tmpcountry,
              'address' : this.tmpaddress,
              'state' : this.tmpstate,
              'city' : this.tmpcity,
              '_token': "{{csrf_token()}}"
          };
        $.ajax({
                type: "post",
                url: "/UpdateAddressInformationforClient",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var ReturnedData=JSON.parse(JSON.stringify(data));
                    if ("Status" in ReturnedData) {
                      if (ReturnedData.Status == "Updated") {
                        this.isAddressInfoUpdateSuccess = true;
                        this.country = this.tmpcountry;
                        this.address = this.tmpaddress;
                        this.state = this.tmpstate;
                        this.city = this.tmpcity;
                      }
                    }
                }.bind(this),
                error: function (data) {
                    $("#Status").append(JSON.stringify(data));
                }.bind(this)
            });
    	},
    	UpdateGeneralInformation:function(){
        let formData={
              'firstName' : this.tmpfirstName,
              'middleName' : this.tmpmiddleName,
              'lastName' : this.tmplastName,
              'gender' : this.tmpgender,
              'occupation' : this.occupation,
              'age' : this.tmpage,
              'educationLavel' : this.tmpeducationLavel,
              '_token': "{{csrf_token()}}"
          };
        $.ajax({
                type: "post",
                url: "/UpdateGeneralInformationforClient",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var ReturnedData=JSON.parse(JSON.stringify(data));
                    if ("Status" in ReturnedData) {
                      if (ReturnedData.Status == "Updated") {
                        this.isGeneralInfoUpdateSuccess = true;
                        this.name = this.tmpfirstName + " " + this.tmpmiddleName + " " + this.tmplastName;
                        this.gender = this.tmpgender;
                        this.age = this.tmpage;
                        this.occupation = this.tmpoccupation;
                        this.educationLavel = this.tmpeducationLavel;
                      }
                    }
                }.bind(this),
                error: function (data) {
                    $("#Status").append(JSON.stringify(data));
                }.bind(this)
            });
    	},
      ContactInfoDialogClose:function(){
        this.isContactInfoUpdateSuccess = false;
        this.ContactInfoDialog = false;
      },
      AddressInfoDialogClose:function(){
        this.isAddressInfoUpdateSuccess = false;
        this.AddressInfoDialog = false;
      },
      GeneralInfoDialogClose:function(){
        this.GeneralInfoDialog = false;
        this.isGeneralInfoUpdateSuccess = false;
      }
		}
	})
</script>
@stop