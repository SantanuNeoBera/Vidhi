@extends('Layouts.Vidhikarya.Global.Master')
@section('content')
<style type="text/css">
/* Change the white to any color ;) */
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 30px white inset;
}
#PageContent{
    margin:auto;
    margin-top: 10px;
    width: 100%;
}
#RegisterFormContainer{
    margin:auto;
    padding: 0;
    margin: 50px;
    margin-top: 10px;
}
#RegisterContent{
    margin:20px;
}
.TheForm{
    position: relative; 
    padding:50px; 
    padding-top: 0px;
}
/* Overritting CSS -----------*/
.icon-override{
    font-size: 13px !important;
}
p{
    margin-bottom: 0px;
}
</style>
<div id="PageContent">
<div id="RegisterFormContainer">
        <template>
        <v-stepper v-model="step">
            <v-stepper-header>
              <v-stepper-step step="1" :complete="step > 1">First Step Registration</v-stepper-step>
              <v-divider></v-divider>
              <v-stepper-step step="2" :complete="step > 2">Second Step Registration</v-stepper-step>
            </v-stepper-header>
            <v-stepper-content step="1">

            <!-- First Registration Step -->

            <form class="TheForm">

                <!-- First Name -->
                <div style='margin-bottom: 30px;'>
                    <bulma-textbox
                        id='firstName'
                        label='First Name'
                        v-model='firstName'
                        is-required="Yes"
                        placeholder='Type Name'
                        first-icon='fa-user'
                        :has-error='firstNameHasError'
                        :error-message ="firstNameErrorMessage"
                    ></bulma-textbox>
                </div>

                <!-- Middle Name -->
                <div style='margin-bottom: 30px;'>
                    <bulma-textbox
                        id='middleName'
                        label='Middle Name'
                        v-model='middleName'
                        is-required="No"
                        placeholder='Type Middle Name'
                        first-icon='fa-user'
                    ></bulma-textbox>
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
                <semantic-gender 
                    v-model="gender"
                    is-required="Yes"
                ></semantic-gender>

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
                        :rules="retypePasswordError"
                        @input="MatchPasswordAsType"
                      >
                    </v-text-field>
                </div>

                <!-- Term & Servieces -->
                <div>
                    <div style="position: relative; margin-bottom: 35px; width: 100%;">
                        <div>
                            <v-checkbox label="Terms or Service" primary v-model="termsOfService" hint="Hello" style="margin:0;" />
                        </div>
                        <div style="position: absolute; top:30px; left:50px;">
                            <p>Yes, I understand and agree to the Vidhikarya <a href="#">Terms of Service</a>, including the <a href="#">User Agreement</a> and <a href="#">Privecy Policy</a>.</p>
                        </div>
                    </div>
                </div>

                <div id="Status" v-if="termsofServiceIsSelected" :class="termsOfServiceSelected">
                    <div class="notification is-danger">
                      <button type="button" class="delete" @click="closeAlert"></button>
                      Please select Terms of Service.
                    </div>
                </div>

                <div class="row end-md">
                    <v-btn v-on:click.native='FirstStepRegistration' primary light class = "btn--light-flat-focused green darken-3">Next</v-btn>
                </div>

                <div id="FirstStepStatus"></div>
            </form>

            <!-- End of First Step Registration -->

            </v-stepper-content>
            <v-stepper-content step="2">
            
            <!-- Second Registration Step -->

            <form class="TheForm">
                <!-- Address -->
                <div>
                    <v-text-field
                        v-model = "address"
                        name="address"
                        label="Address"
                        prepend-icon="mode_edit"
                        hint="Type Case Title"
                        id="address"
                        multi-line
                      >
                    </v-text-field>
                </div>

                <!-- Country -->
                <div>
                    <v-select
                      v-bind:items="countries"
                      prepend-icon='menu'
                      v-model="country"
                      label="Country"
                      dark
                      auto
                      @input="LoadStates"
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
                    ></v-select>
                </div>                

                <!-- City -->
                <div>
                    <v-select
                      v-bind:items="['Male','Female']"
                      prepend-icon='menu'
                      v-model="city"
                      label="City"
                      dark
                      auto
                    ></v-select>
                </div>

                <!-- Age -->
                <div>
                    <v-select
                      v-bind:items="['1','2','3','4','5','6']"
                      prepend-icon='menu'
                      v-model="age"
                      label="Age"
                      dark
                      auto
                    ></v-select>
                </div>

                <!-- Occupation -->
                <div>
                    <v-select
                      v-bind:items="['Occupation 1','Occupation 2','Occupation 3']"
                      prepend-icon='menu'
                      v-model="occupation"
                      label="Occupation"
                      dark
                      auto
                    ></v-select>
                </div>

                <!-- Education Level -->
                <div>
                    <v-select
                      v-bind:items="['Male','Female']"
                      prepend-icon='menu'
                      v-model="educationLavel"
                      label="Education Level"
                      dark
                      auto
                    ></v-select>
                </div>

                <div class="row end-md">
                    <v-btn v-on:click.native='SecondStepRegistration' primary light class = "btn--light-flat-focused blue-grey darken-1">Skip This Step</v-btn>
                    <v-btn v-on:click.native='GoBack' primary light class = "btn--light-flat-focused">Previous</v-btn>
                    <v-btn v-on:click.native='SecondStepRegistration' primary light class = "btn--light-flat-focused green darken-3">Register</v-btn>
                </div>

                <div id="SecondStepStatus"></div>
            </form>

            <!-- End of Second Registration Step -->

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
<script type="text/javascript" src="{{ url('js/VidhiComponent/Vidhikarya.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    
});
var ParsedCountries = [];
@foreach($countries as $country)
    ParsedCountries.push("{{ $country->meta_value }}");
@endforeach
let data={
    // Test 
    fullName : '',
    fullNameError : "",
    // Global
    step : 1,
    RegistrationSuccessModal : false,

    // First Step Registration
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
    termsofServiceIsSelected : false,
    retypePasswordHasError : false,

    firstNameErrorMessage: '',
    middleNameErrorMessage:'',
    lastNameErrorMessage:'',
    emailErrorMessage : '',
    genderErrorMessage:'',
    mobileNoErrorMessage :'',
    passwordErrorMessage: '',
    retypePasswordErrorMessage : 'Password Do Not Match !',

    //Second Step Registration
    address : '',
    country : '',
    state:'',
    city : '',
    age : '',
    occupation : '',
    educationLavel : '',

    countries : ParsedCountries,
    states : [],
};
var ClientRegistration = new Vue({
    el : '#PageContent',
    data : data,
    computed:{
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
        termsOfServiceSelected:function(){
            if (this.termsOfService == true) {
                this.termsofServiceIsSelected = false;
                return true;
            }
        }
    },
    methods:{
        ProceedButton:function(){
            window.location="{{ url('Dashboard') }}";
        },
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
            }
        },
        GenderSelected:function(){
            this.genderHasError = false;
        },
        firstNameHasValue:function(){
            this.firstNameHasError = false;
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
        closeAlert:function(){
            this.termsofServiceIsSelected = false;
        },
        GoBack:function(){
            this.step = 1;
        },
        FirstStepRegistration:function(){
            if (this.termsOfService == false) {
                this.termsofServiceIsSelected = true;
                return;
            }
            else{
                this.termsofServiceIsSelected=false;
            }
            if (this.password == this.password_confirmation) {
                this.retypePasswordHasError = false;
            }
            else{
                this.retypePasswordHasError = true;
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
                    url: "/clientRegisterCheckValidation",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        this.fullNameHasError = false;
                        this.emailHasError = false;
                        this.passwordHasError = false;
                        var ReturnedData=JSON.parse(JSON.stringify(data));
                        if ('fail' in ReturnedData) {
                            if (ReturnedData.fail == true) {
                                var Errors = ReturnedData.errors;
                                this.firstNameHasError = false;
                                this.middleNameHasError = false;
                                this.lastNameHasError = false;
                                this.emailHasError = false;
                                this.genderHasError = false;
                                this.mobileNoHasError = false;
                                this.passwordHasError = false;
                                //Setting Focus
                                var firstErrorElement = Object.keys(Errors)[0];
                                $("#"+firstErrorElement).focus();
                                //-------------
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
        SecondStepRegistration:function(){
            let formData={
                'firstName' : this.firstName,
                'middleName' : this.middleName,
                'lastName' : this.lastName,
                'mobileNo' : this.mobileNo,
                'gender' : this.gender,
                'email' : this.email,
                'password' : this.password,
                'address' : this.address,
                'country' : this.country,
                'state' : this.state,
                'city' : this.city,
                'age' : this.age,
                'occupation' : this.occupation,
                'educationLavel' : this.educationLavel,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/RegisterClient",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var ReturnedData=JSON.parse(JSON.stringify(data));
                        if ('success' in ReturnedData) {
                            this.RegistrationSuccessModal = true;
                        }
                    }.bind(this),
                    error: function (data) {
                        $("#SecondStepStatus").append(JSON.stringify(data));
                    }.bind(this)
                });
        },
        LoadStates:function(){
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
                            var event = this.states.length;
                            while(i<event){
                                this.states.pop();
                                i++;
                            }
                            i=0;
                            while(i<len){
                                this.states.push(ParsedStates[i]);
                                i++;
                            }
                        }
                    }.bind(this),
                    error: function (data) {
                        alert("Cannot Load States !");
                        // $("#Error").append(JSON.stringify(data));
                    }.bind(this)
                });
        },
    }
});
</script>
@endsection