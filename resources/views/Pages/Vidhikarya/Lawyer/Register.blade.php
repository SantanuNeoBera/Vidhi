@extends('Layouts.Vidhikarya.Global.Master')
@section('title','Registration')
@section('content')
<style type="text/css">
/* Change the white to any color ;) */
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 30px white inset;
}
#PageContent{
    margin:auto;
    width: 100%;
}
#RegisterFormContainer{
    margin:auto;
    padding: 0;
    margin: 50px;
    margin-top: 10px;
}
.TheForm{
    position: relative; 
    padding:50px; 
    padding-top: 0px;
}
</style>
<div id="PageContent">
<div id="RegisterFormContainer">
        <template>
        <v-stepper v-model="step">
            <v-stepper-header>
              <v-stepper-step step="1" :complete="step > 1">First Step</v-stepper-step>
              <v-divider></v-divider>
              <v-stepper-step step="2" :complete="step > 2">Second Step</v-stepper-step>
              <v-divider></v-divider>
              <v-stepper-step step="3" :complete="step > 3">Third Step</v-stepper-step>
              <v-divider></v-divider>
              <v-stepper-step step="4" :complete="step > 4">Fourth Step</v-stepper-step>
            </v-stepper-header>
            <v-stepper-content step="1">

            <!-- First Registration Step -->

            <form class="TheForm">
                <!-- Fist Name -->
                <div>
                    <v-text-field
                        v-model = "firstName"
                        name="firstName"
                        label="First Name"
                        prepend-icon="mode_edit"
                        hint="Type Case Title"
                        id="firstName"
                        :rules="firtNameError"
                        @blur="firstNameHasValue"
                      >
                    </v-text-field>
                </div>

                <!-- Middle Name -->
                <div>
                    <v-text-field
                        v-model = "middleName"
                        name="middleName"
                        label="Middle Name"
                        prepend-icon="mode_edit"
                        hint="Type Case Title"
                        id="middleName"
                      >
                    </v-text-field>
                </div>

                <!-- Last Name -->
                <div>
                    <v-text-field
                        v-model = "lastName"
                        name="lastName"
                        label="Last Name"
                        prepend-icon="mode_edit"
                        hint="Type Case Title"
                        id="lastName"
                        :rules='lastNameError'
                        @blur="lastNameHasValue"
                      >
                    </v-text-field>
                </div>

                <!-- Mobile Number -->
                <div>
                    <v-text-field
                        v-model = "mobileNo"
                        name="mobileNo"
                        label="Mobile No"
                        prepend-icon="perm_phone_msg"
                        hint="Type Case Title"
                        id="mobileNo"
                        :rules="mobileNoError"
                        @blur="mobileNoHasValue"
                      >
                    </v-text-field>
                </div>

                <!-- Gender -->
                <div>
                    <v-select
                      v-bind:items="['Male','Female']"
                      prepend-icon='menu'
                      v-model="gender"
                      label="Gender"
                      id="gender"
                      dark
                      auto
                      :rules="genderError"
                      @input="genderSelected"
                    ></v-select>
                </div>

                <!-- Email -->
                <div>
                    <v-text-field
                        v-model = "email"
                        name="email"
                        label="Email"
                        prepend-icon="email"
                        hint="Type Case Title"
                        id="email"
                        :rules="emailError"
                        @blur="emailHasValue"
                      >
                    </v-text-field>
                </div>

                <!-- Password -->
                <div>
                    <v-text-field
                        v-model = "password"
                        name="password"
                        label="Password"
                        prepend-icon="security"
                        hint="Type Case Title"
                        id="password"
                        :rules="passwordError"
                        type="password"
                        @input="MatchPasswordAsType"
                        @blur="passwordHasValue"
                      >
                    </v-text-field>
                </div>

                <!-- Confirm Password -->
                <div>
                    <v-text-field
                        v-model = "password_confirmation"
                        name="password_confirmation"
                        label="Confirm Password"
                        prepend-icon="security"
                        hint="Type Case Title"
                        id="password_confirmation"
                        type="password"
                        @blur="MatchPasswordWhenFocusLoses"
                        @input="MatchPasswordAsType"
                        :rules="retypePasswordError"
                      >
                    </v-text-field>
                </div>

                <!-- Term & Servieces -->
                <div>
                    <div style="position: relative; margin-bottom: 35px; width: 100%;">
                        <div>
                            <v-checkbox @change="TermsOfServiceHasSelected" label="Terms or Service" primary v-model="termsOfService" hint="Hello" style="margin:0;" />
                        </div>
                        <div style="position: absolute; top:30px; left:50px;">
                            <p>Yes, I understand and agree to the Vidhikarya <a href="#">Terms of Service</a>, including the <a href="#">User Agreement</a> and <a href="#">Privecy Policy</a>.</p>
                        </div>
                    </div>
                </div>

                <div v-if="TermsOfServiceHasError">
                    <div class="notification is-danger">
                      <button type="button" class="delete" @click="TermsOfServiceErrorMessageClose"></button>
                      Please select Terms of Service.
                    </div>
                </div>

                <div class="row end-md">
                    <v-btn v-on:click.native='FirstStepCheckValidation' primary light class = "btn--light-flat-focused">Next</v-btn>
                </div>

                <div id="FirstStepStatus"></div>
            </form>

            <!-- End of First Step Registration -->

            </v-stepper-content>
            <v-stepper-content step="2">
            
            <!-- Second Registration Step -->

            <form class="TheForm">

                <!-- Country -->
                <div>
                    <v-select
                      v-bind:items="countries"
                      prepend-icon='menu'
                      v-model="country"
                      label="Country"
                      dark
                      auto
                      @input="loadState"
                      :rules="countryError"
                    ></v-select>
                </div>
                
                <!-- State -->
                <div>
                    <v-select
                      v-bind:items="states"
                      prepend-icon='menu'
                      v-model="state"
                      label="State"
                      dark
                      auto
                      :rules="stateError"
                      @input="StateSelected"
                    ></v-select>
                </div>                

                <!-- City -->
                <div>
                    <v-text-field
                        v-model = "city"
                        name="city"
                        label="City"
                        prepend-icon="mode_edit"
                        hint="Type Case Title"
                        id="city"
                        :rules="cityError"
                        @blur="CityHasValue"
                      >
                    </v-text-field>
                </div>

                <!-- Experience -->
                <div>
                    <v-select
                      v-bind:items="['1','2','3','4','5','6']"
                      prepend-icon='menu'
                      v-model="experience"
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
                      v-model="designation"
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
                      v-model="education"
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
                        v-model = "professionalSummary"
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
                      v-model="stateBarCouncil"
                      label="State Bar Council Where you are registered"
                      dark
                      auto
                    ></v-select>
                </div>   

                <!-- Bar Council Registration No -->
                <div>
                    <v-text-field
                        v-model = "barCouncilRegNo"
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
                      v-model="nameOfBarAssociation"
                      label="Name of Bar Association of which you are a member"
                      dark
                      auto
                    ></v-select>
                </div>
                                
                <!-- Name Of The Court -->
                <div>
                    <v-text-field
                        v-model = "courtName"
                        name="courtName"
                        label="Name of the Courts where you practice"
                        prepend-icon="mode_edit"
                        hint="Type Case Title"
                        id="courtName"
                      >
                    </v-text-field>
                </div>

                <div id="Status" v-if='isSuccess'>
                    <div class="notification is-success">
                        <button class="delete"></button>
                        Saved ! Redirecting ..
                    </div>
                </div>

                <div class="row end-md">
                    <v-btn v-on:click.native='GoBack' primary light class = "btn--light-flat-focused">Previous</v-btn>
                    <v-btn v-on:click.native='SecondStepCheckValidation' primary light class = "btn--light-flat-focused green darken-3">Next</v-btn>
                </div>

                <div id="SecondStepStatus"></div>
            </form>

            <!-- End of Second Registration Step -->

            </v-stepper-content>
            <v-stepper-content step="3">

            <!-- Third Step Registration -->

            <form class="TheForm">
                <!-- Working Language -->
                <div>
                    <v-select
                      label="Working Language"
                      v-bind:items="LawyerWorkingLanguages"
                      v-model="workingLanguages"
                      multiple
                      chips
                      dark
                      hint="What are the target regions"
                      persistent-hint
                      :rules="workingLanguagesError"
                      @input="workinglanguagesSelected"
                    ></v-select>
                </div>

                <!-- Categories -->
                <div>
                    <v-select
                      label="Categories"
                      v-bind:items="lawCategories"
                      v-model="categories"
                      multiple
                      chips
                      dark
                      hint="What are the target regions"
                      persistent-hint
                      :rules="categoriesError"
                      @input="CategoriesSelected"
                    ></v-select>
                </div>

                <div class="row end-md">
                    <v-btn v-on:click.native='GoBack' primary light class = "btn--light-flat-focused">Previous</v-btn>
                    <v-btn v-on:click.native='ThirdStepCheckValidation' primary light class = "btn--light-flat-focused green darken-3">Next</v-btn>
                </div>

                <div id="ThirdStepStatus"></div>            
            </form>

            <!-- End Of Third Step Registration -->

            </v-stepper-content>
            <v-stepper-content step="4">

            <!-- Fourth Step Registration -->

            <form class="TheForm">
                <!-- Bank Name -->
                <div>
                    <v-text-field
                        v-model = "bankName"
                        name="bankName"
                        label="Bank Name"
                        prepend-icon="mode_edit"
                        hint="Type Case Title"
                        id="bankName"
                      >
                    </v-text-field>
                </div>      

                <!-- Branch Name -->
                <div>
                    <v-text-field
                        v-model = "branchName"
                        name="branchName"
                        label="Branch Name"
                        prepend-icon="mode_edit"
                        hint="Type Case Title"
                        id="branchName"
                      >
                    </v-text-field>
                </div>      

                <!-- Account Holder Name -->
                <div>
                    <v-text-field
                        v-model = "accountHolderName"
                        name="accountHolderName"
                        label="Account Holder Name"
                        prepend-icon="mode_edit"
                        hint="Type Case Title"
                        id="accountHolderName"
                      >
                    </v-text-field>
                </div>      

                <!-- IFSC Code -->
                <div>
                    <v-text-field
                        v-model = "IFSCCode"
                        name="IFSCCode"
                        label="IFSC Code"
                        prepend-icon="mode_edit"
                        hint="Type Case Title"
                        id="IFSCCode"
                      >
                    </v-text-field>
                </div>      

                <!-- Account Number -->
                <div>
                    <v-text-field
                        v-model = "accountNumber"
                        name="accountNumber"
                        label="Account Number"
                        prepend-icon="mode_edit"
                        hint="Type Case Title"
                        id="accountNumber"
                      >
                    </v-text-field>
                </div>                

                <div id="AccountDetailsStatus" v-if='isSuccess'>
                    <div class="notification is-success">
                        <button class="delete"></button>
                        Saved ! Redirecting ..
                    </div>
                </div>

                <div class="row end-md">
                    <v-btn v-on:click.native='GoBack' primary light class = "btn--light-flat-focused">Previous</v-btn>
                    <v-btn v-on:click.native='LastStepRegistration' primary light class = "btn--light-flat-focused green darken-3">Next</v-btn>
                </div>

                <div id="LastStepStatus"></div>
            </form> 

            <!-- End Of Fourth Step Registration -->

            </v-stepper-content>
        </v-steper>
        </template>
        <div id="Status"></div>
    </div>
<!-- Modal For Showing Success Message after Registration -->
<template>
  <v-layout row justify-center>
    <v-dialog v-model="RegistrationSuccessModal" width="500px">
      <v-btn id="RegistrationSuccessModal" primary light slot="activator" style="display: none;">Open Dialog</v-btn>
      <v-card>
        <v-card-row>
          <v-card-title>Registration is Successful !</v-card-title>
        </v-card-row>
        <v-card-row>
          <v-card-text>Thank you for registering on Vidhikarya.</v-card-text>
        </v-card-row>
        <v-card-row actions>
          <v-btn class="green--text darken-1" flat="flat" @click.native="ProceedButton">Proceed</v-btn>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
</div>
<!-- End of Modal -->
<script type="text/javascript">
var ParsedLawyerWorkingLanguages = [];
@foreach($workingLanguages as $language)
    ParsedLawyerWorkingLanguages.push("{{ $language->meta_value}}");
@endforeach
//Law Category
var ParsedLawCategories = [];
@foreach($categories as $category)
    ParsedLawCategories.push("{{ $category->meta_value }}");
@endforeach
//Country
var ParsedCountries = [];
@foreach($countries as $country)
    ParsedCountries.push("{{ $country->meta_value }}");
@endforeach
let data = {
    //Global Data ----------------------
    step : 1,
    RegistrationSuccessModal : false,

    //Step - 1 Data ------------------------------------------------------
    firstName : '',
    middleName : '',
    lastName : '',
    email : '',
    gender : '',
    mobileNo : '',
    password : '',
    password_confirmation : '',
    termsOfService : false,

    firstNameHasError: false,
    middleNameHasError : false,
    lastNameHasError : false,
    emailHasError : false,
    genderHasError : false,
    mobileNoHasError : false,
    passwordHasError : false,
    retypePasswordHasError : false,
    TermsOfServiceHasError : false,

    firstNameErrorMessage: '',
    middleNameErrorMessage:'',
    lastNameErrorMessage:'',
    emailErrorMessage : '',
    genderErrorMessage:'',
    mobileNoErrorMessage :'',
    passwordErrorMessage: '',
    retypePasswordErrorMessage : 'Password Do Not Match !',

    //Step - 2 Data -------------------------------------------------------
    countries : ParsedCountries,
    states : [],

    country:'',
    state:'',
    city:'',
    experience : '',
    designation : '',
    education : '',
    professionalSummary : '',
    stateBarCouncil : '',
    barCouncilRegNo : '',
    nameOfBarAssociation : '',
    courtName : '',

    countryHasError : false,
    stateHasError : false,
    cityHasError : false,
    experienceHasError : false,
    designationHasError : false,
    educationHasError : false,

    countryErrorMessage : '',
    stateErrorMessage : '',
    cityErrorMessage : '',
    experienceErrorMessage : '',
    designationErrorMessage : '',
    educationErrorMessage : '',

    isSuccess : false,

    //Step - 3 Data -----------------------------------------------------
    LawyerWorkingLanguages : ParsedLawyerWorkingLanguages,
    lawCategories : ParsedLawCategories,

    workingLanguages : [],
    categories : [],

    workingLanguagesHasError:false,
    categoriesHasError:false,

    workingLanguagesErrorMessage:'',
    categoriesErrorMessage:'',

    //Step - 4 Data ------------------------------------------------------
    bankName : '',
    branchName : '',
    IFSCCode : '',
    accountNumber : '',
    accountHolderName : '',
}
var app = new Vue({
    el:'#PageContent',
    data:data,
    computed:{
        categoriesError : function(){
            if (this.categoriesHasError == true) {
                var tmp = [];
                tmp.push(this.categoriesErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        workingLanguagesError : function(){
            if (this.workingLanguagesHasError == true) {
                var tmp = [];
                tmp.push(this.workingLanguagesErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        firtNameError : function(){
            if (this.firstNameHasError == true) {
                var tmp = [];
                tmp.push(this.firstNameErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        retypePasswordError:function(){
          if (this.retypePasswordHasError == true) {
                var tmp = [];
                tmp.push(this.retypePasswordErrorMessage);
                return tmp;
            }
            else{
                return [];
            }  
        },
        lastNameError : function(){
            if (this.lastNameHasError == true) {
                var tmp = [];
                tmp.push(this.lastNameErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        genderError : function(){
            if (this.genderHasError == true) {
                var tmp = [];
                tmp.push(this.genderErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        mobileNoError : function(){
            if (this.mobileNoHasError == true) {
                var tmp = [];
                tmp.push(this.mobileNoErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        emailError : function(){
            if (this.emailHasError == true) {
                var tmp = [];
                tmp.push(this.emailErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        passwordError : function(){
            if (this.passwordHasError == true) {
                var tmp = [];
                tmp.push(this.passwordErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        countryError : function(){
            if (this.countryHasError == true) {
                var tmp = [];
                tmp.push(this.countryErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        stateError : function(){
            if (this.stateHasError == true) {
                var tmp = [];
                tmp.push(this.stateErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        cityError : function(){
            if (this.cityHasError == true) {
                var tmp = [];
                tmp.push(this.cityErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        experienceError : function(){
            if (this.experienceHasError == true) {
                var tmp = [];
                tmp.push(this.experienceErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        designationError : function(){
            if (this.designationHasError == true) {
                var tmp = [];
                tmp.push(this.designationErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        educationError : function(){
            if (this.educationHasError == true) {
                var tmp = [];
                tmp.push(this.educationErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
    },
    methods:{
        MatchPasswordWhenFocusLoses:function(){
            if (this.password == this.password_confirmation) {
                this.retypePasswordHasError = false;
            }
            else{
                this.retypePasswordHasError = true;
            }
        },
        MatchPasswordAsType:function(){
            if (this.password == this.password_confirmation) {
                this.retypePasswordHasError = false;
                this.passwordHasError = false;
            }
        },
        GoBack:function(){
            this.step = this.step - 1;
        },
        TermsOfServiceHasSelected:function(){
            this.TermsOfServiceHasError = false;
        },
        previous:function(){
            this.step = this.step-1;
        },
        loadState:function(){
            this.countryHasError = false;
            let formData={
                'country' : this.country,
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
                            this.state = [];
                            while(i<len){
                                this.states.push(ParsedStates[i]);
                                i++;
                            }
                        }
                    }.bind(this),
                    error: function (data) {
                        $("#Error").append(JSON.stringify(data));
                    }.bind(this)
                });
        },
        ProceedButton:function(){
            window.location = "Dashboard";
        },                
        genderSelected:function(){
            this.genderHasError = false;
        },
        StateSelected:function(){
            this.stateHasError = false;
        },
        CityHasValue:function(){
            this.cityHasError = false;
        },
        ExperienceSelected:function(){
            this.experienceHasError = false;
        },
        DesignationSelected:function(){
            this.designationHasError = false;
        },
        EducationSelected:function(){
            this.educationHasError = false;
        },
        workinglanguagesSelected:function(){
            this.workingLanguagesHasError = false;
        },
        CategoriesSelected:function(){
            this.categoriesHasError = false;
        },
        firstNameHasValue:function(){
          this.firstNameHasError =false;
        },
        lastNameHasValue:function(){
          this.lastNameHasError = false;
        },
        mobileNoHasValue:function(){
          this.mobileNoHasError = false;
        },
        emailHasValue:function(){
          this.emailHasError = false;
        },
        passwordHasValue:function(){
          this.passwordHasError = false;
        },
        TermsOfServiceErrorMessageClose:function(){
            this.TermsOfServiceHasError = false;
        },
        FirstStepCheckValidation:function(){
            if (this.termsOfService == false) {
                this.TermsOfServiceHasError = true;
                return;
            }
            else{
                this.TermsOfServiceHasError=false;
            }
            if (this.password == this.password_confirmation) {
                this.retypePasswordHasError = false;
            }
            else{
                this.retypePasswordHasError = true;
                this.passwordHasError = false;
                return;
            }
            let formData={
                'firstName' : this.firstName,
                'middleName' : this.middleName,
                'lastName' : this.lastName,
                'mobileNo' : this.mobileNo,
                'gender' : this.gender,
                'email' : this.email,
                'password' : this.password,
                'password_confirmation' : this.password_confirmation,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/LawyerRegisterFirstStepCheckValidation",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var ReturnedData=JSON.parse(JSON.stringify(data));
                        this.firstNameHasError = false;
                        this.middleNameHasError = false;
                        this.lastNameHasError = false;
                        this.emailHasError = false;
                        this.genderHasError = false;
                        this.mobileNoHasError = false;
                        this.passwordHasError = false;
                        if ('Status' in ReturnedData) {
                            if (ReturnedData.Status == 'Failed') {
                                var Errors = ReturnedData.errors;
                                //Setting Focus
                                var firstErrorElement = Object.keys(Errors)[0];
                                $("#"+firstErrorElement).focus();
                                //End of Setting Focus                                
                                if ('firstName' in Errors) {
                                    this.firstNameHasError = true;
                                    this.firstNameErrorMessage=Errors.firstName[0];
                                }
                                if ('lastName' in Errors) {
                                    this.lastNameHasError = true;
                                    this.lastNameErrorMessage=Errors.lastName[0];
                                }
                                if ('mobileNo' in Errors) {
                                    this.mobileNoHasError = true;
                                    this.mobileNoErrorMessage=Errors.mobileNo[0];
                                }
                                if ('gender' in Errors) {
                                    this.genderHasError = true;
                                    this.genderErrorMessage=Errors.gender[0];
                                }
                                if ('email' in Errors) {
                                    this.emailHasError = true;
                                    this.emailErrorMessage = Errors.email[0];
                                }
                                if ('password' in Errors) {
                                    this.passwordHasError = true;
                                    this.passwordErrorMessage = Errors.password[0];
                                }
                            }
                            else{
                                this.step = 2;
                            }
                        }
                    }.bind(this),
                    error: function (data) {
                        $("#FirstStepStatus").append(JSON.stringify(data));
                    }.bind(this)
                });
        },
        SecondStepCheckValidation:function(){
            let formData={
                'country' : this.country,
                'state' : this.state,
                'city' : this.city,
                'experience' : this.experience,
                'designation' : this.designation,
                'education' : this.education,
                'professionalSummary' : this.professionalSummary,
                'stateBarCouncil' : this.stateBarCouncil,
                'barCouncilRegNo' : this.barCouncilRegNo,
                'nameOfBarAssociation' : this.nameOfBarAssociation,
                'courtName' : this.courtName,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/LawyerRegisterSecStepCheckValidation",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var ReturnedData=JSON.parse(JSON.stringify(data));
                        if ('Status' in ReturnedData) {
                            var Errors = ReturnedData.errors;
                            this.countryHasError = false;
                            this.stateHasError = false;
                            this.cityHasError = false;
                            this.experienceHasError = false;
                            this.designationHasError = false;
                            this.educationHasError = false;
                            if (ReturnedData.Status == "Failed") {
                                if ('country' in Errors) {
                                    this.countryHasError = true;
                                    this.countryErrorMessage=Errors.country[0];
                                }
                                if ('state' in Errors) {
                                    this.stateHasError = true;
                                    this.stateErrorMessage=Errors.state[0];
                                }
                                if ('city' in Errors) {
                                    this.cityHasError = true;
                                    this.cityErrorMessage=Errors.city[0];
                                }
                                if ('experience' in Errors) {
                                    this.experienceHasError = true;
                                    this.experienceErrorMessage=Errors.experience[0];
                                }
                                if ('designation' in Errors) {
                                    this.designationHasError = true;
                                    this.designationErrorMessage=Errors.designation[0];
                                }
                                if ('education' in Errors) {
                                    this.educationHasError = true;
                                    this.educationErrorMessage=Errors.education[0];
                                }
                            }
                            else{
                                this.step = 3;
                            }
                        }
                    }.bind(this),
                    error: function (data) {
                        $("#SecondStepStatus").append(JSON.stringify(data));
                    }.bind(this)
                });
        },
        ThirdStepCheckValidation:function(){
            let formData={
                'workingLanguages' : this.workingLanguages,
                'categories' : this.categories,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/LawyerRegisterThirdStepCheckValidation",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var ReturnedData=JSON.parse(JSON.stringify(data));
                        if ('Status' in ReturnedData) {
                            this.categoriesHasError = false;
                            this.workingLanguagesHasError = false;
                            if (ReturnedData.Status == 'Failed') {
                                var Errors = ReturnedData.errors;
                                if ('categories' in Errors) {
                                    this.categoriesHasError = true;
                                    this.categoriesErrorMessage=Errors['categories'];
                                }
                                if ('workingLanguages' in Errors) {
                                    this.workingLanguagesHasError = true;
                                    this.workingLanguagesErrorMessage=Errors['workingLanguages'];
                                }
                            }
                            else{
                                this.step = this.step+1;     
                            }
                        }
                    }.bind(this),
                    error: function (data) {
                        $("#ThirdStepStatus").append(JSON.stringify(data));
                    }.bind(this)
                });
        },
        LastStepRegistration:function(){
            let formData={
                'firstName' : this.firstName,
                'middleName' : this.middleName,
                'lastName' : this.lastName,
                'mobileNo' : this.mobileNo,
                'gender' : this.gender,
                'email' : this.email,
                'password' : this.password,

                'country' : this.country,
                'state' : this.state,
                'city' : this.city,
                'experience' : this.experience,
                'designation' : this.designation,
                'education' : this.education,
                'professionalSummary' : this.professionalSummary,
                'stateBarCouncil' : this.stateBarCouncil,
                'barCouncilRegNo' : this.barCouncilRegNo,
                'nameOfBarAssociation' : this.nameOfBarAssociation,
                'courtName' : this.courtName,

                'workingLanguages' : this.workingLanguages,
                'categories' : this.categories,

                'bankName' : this.bankName,
                'branchName' : this.branchName,
                'accountHolderName' : this.accountHolderName,
                'IFSCCode' : this.IFSCCode,
                'accountNumber' : this.accountNumber,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/LastStepRegistrationofLawyer",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var ReturnedData=JSON.parse(JSON.stringify(data));
                        if ('Status' in ReturnedData) {
                            if (ReturnedData.Status == "Registered") {
                                //Show Modal
                                $("#RegistrationSuccessModal").trigger('click');
                            }
                        }
                    }.bind(this),
                    error: function (data) {
                        $("#LastStepStatus").append(JSON.stringify(data));
                    }.bind(this)
                });
        },
    }
});
</script>
@stop