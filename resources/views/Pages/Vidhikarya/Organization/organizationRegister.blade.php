@extends('Layouts.Vidhikarya.Master')

@section('content')
<style type="text/css">
#PageContent{
    margin:auto;
    margin-top: 50px;
    width: 100%;
}
#RegisterFormContainer{
    margin:auto;
    padding: 0;
}
#RegisterContent{
    margin:20px;
}
</style>
<div id="PageContent">
    <div id="RegisterFormContainer" style="margin: 50px;">

        <template>
        <v-stepper v-model="step">
            <v-stepper-header>
              <v-stepper-step step="1" :complete="step > 1">First Step Registration</v-stepper-step>
              <v-divider></v-divider>
              <v-stepper-step step="2" :complete="step > 2">Second Step Registration</v-stepper-step>
            </v-stepper-header>
            <v-stepper-content step="1">

            <!-- First Registration Step -->

            <form style="position: relative; padding: 50px;">
                <!-- Organization Name -->
                <div>
                    <v-text-field
                        v-model = "orgName"
                        name="orgName"
                        label="Organization Name"
                        prepend-icon="mode_edit"
                        hint="Type Case Title"
                        id="orgName"
                        :rules="orgNameError"
                      >
                    </v-text-field>
                </div>

                <!-- Organization Type -->
                <div>
                    <v-select
                      v-bind:items="['India','Bangladesh','Nepal', 'Bhutan', 'Srilanka', 'Pakistan']"
                      prepend-icon='menu'
                      v-model="orgType"
                      label="Organization Type"
                      dark
                      auto
                      :rules="orgTypeError"
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
                      >
                    </v-text-field>
                </div>

                <!-- Country -->
                <div>
                    <v-select
                      v-bind:items="['India','Bangladesh','Nepal', 'Bhutan', 'Srilanka', 'Pakistan']"
                      prepend-icon='menu'
                      v-model="country"
                      label="Country"
                      dark
                      auto
                      :rules="countryError"
                    ></v-select>
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

                <div v-if="termsofServiceIsSelected">
                    <div class="notification is-danger">
                      <button type="button" class="delete" @click="closeAlert"></button>
                      Please select Terms of Service.
                    </div>
                </div>
                <div id="Status">
                    
                </div>

                <div class="row end-md">
                    <v-btn v-on:click.native='OrgRegisterCheckValidation' primary light class = "btn--light-flat-focused green darken-3">Next</v-btn>
                </div>
            </form>

            <!-- End of First Step Registration -->

            </v-stepper-content>
            <v-stepper-content step="2">
            
            <!-- Second Registration Step -->

            <form style="position: relative; padding: 50px;">
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

                <!-- State -->
                <div>
                    <v-select
                      v-bind:items="['Male','Female']"
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
                      label="How old the Organization is"
                      dark
                      auto
                    ></v-select>
                </div>

                <!-- Area Business -->
                <div>
                    <v-select
                      v-bind:items="['areaBusiness 1','areaBusiness 2','areaBusiness 3']"
                      prepend-icon='menu'
                      v-model="areaBusiness"
                      label="Area Business"
                      dark
                      auto
                    ></v-select>
                </div>

                <div id="Error">
                    
                </div>

                <div class="row end-md">
                    <v-btn v-on:click.native='RegisterOrg' primary light class = "btn--light-flat-focused blue-grey darken-1">Skip This Step</v-btn>
                    <v-btn v-on:click.native='GoBack' primary light class = "btn--light-flat-focused">Previous</v-btn>
                    <v-btn v-on:click.native='RegisterOrg' primary light class = "btn--light-flat-focused green darken-3">Register</v-btn>
                </div>
            </form>              

            <!-- End of Second Registration Step -->

            </v-stepper-content>
        </v-steper>
        </template>

        <div id="Status"></div>
    </div>
</div>
<script type="text/javascript">
let data={
    // Global --
    step : 1,

    // First Step of Registration
    orgName : '',
    orgType : '',
    email : '',
    country : '',
    mobileNo : '',
    password : '',
    password_confirmation : '',
    termsOfService : false,

    orgNameHasError: false,
    orgTypeHasError : false,
    emailHasError : false,
    countryHasError :false,
    genderHasError : false,
    mobileNoHasError : false,
    passwordHasError : false,
    termsofServiceIsSelected : false,

    orgNameErrorMessage : '',
    orgTypeErrorMessage : '',
    emailErrorMessage : '',
    countryErrorMessage:'',
    genderErrorMessage:'',
    mobileNoErrorMessage :'',
    passwordErrorMessage: '',

    //Second Step of Registration
    address : '',
    state:'',
    city : '',
    age : '',
    areaBusiness : '',

    isSuccess : false,
};
new Vue({
    el : '#PageContent',
    data : data,
    computed:{
        orgNameError : function(){
            if (this.orgNameHasError == true) {
                var tmp = [];
                tmp.push(this.orgNameErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        orgTypeError : function(){
            if (this.orgTypeHasError == true){
                var tmp = [];
                tmp.push(this.orgTypeErrorMessage);
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
    },
    methods:{
        GoBack:function(){
            this.step = 1;
        },
        closeAlert:function(){
            this.termsofServiceIsSelected = false;
        },
        OrgRegisterCheckValidation:function(){
            if (this.termsOfService == false) {
                this.termsofServiceIsSelected = true;
                return;
            }
            else{
                this.termsofServiceIsSelected=false;
            }
            let formData={
                'orgName' : this.orgName,
                'orgType' : this.orgType,
                'mobileNo' : this.mobileNo,
                'country' : this.country,
                'email' : this.email,
                'password' : this.password,
                'password_confirmation' : this.password_confirmation,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/OrgRegisterCheckValidation",
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
                                this.orgNameHasError = false;
                                this.orgTypeHasError = false;
                                this.emailHasError = false;
                                this.countryHasError = false;
                                this.mobileNoHasError = false;
                                this.passwordHasError = false;
                                if ('orgName' in Errors) {
                                    this.orgNameHasError = true;
                                    this.orgNameErrorMessage=Errors.orgName[0];
                                }
                                if ('orgType' in Errors) {
                                    this.orgTypeHasError = true;
                                    this.orgTypeErrorMessage=Errors.orgType[0];
                                }
                                if ('mobileNo' in Errors) {
                                    this.mobileNoHasError = true;
                                    this.mobileNoErrorMessage=Errors.mobileNo[0];
                                }
                                if ('country' in Errors) {
                                    this.countryHasError = true;
                                    this.countryErrorMessage=Errors.country[0];
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
                        }
                        else{
                            this.step = 2;
                            // window.location = "{{ url('/organizationRegisterFinal') }}";
                        }
                    }.bind(this),
                    error: function (data) {
                        $("#Status").append(JSON.stringify(data));
                    }.bind(this)
                });
        },
        Register:function(){
            let formData={
                'orgName' : this.orgName,
                'orgType' : this.orgType,
                'mobileNo' : this.mobileNo,
                'country' : this.country,
                'email' : this.email,
                'password' : this.password,
                'address' : this.address,
                'state' : this.state,
                'city' : this.city,
                'age' : this.age,
                'areaBusiness' : this.areaBusiness,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/RegisterOrg",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var ReturnedData=JSON.parse(JSON.stringify(data));
                        if ('success' in ReturnedData) {
                            this.isSuccess = false;
                            window.location="{{ url('/') }}";
                        }
                    }.bind(this),
                    error: function (data) {
                        this.isSuccess = true;
                        $("#Error").append(JSON.stringify(data));
                    }.bind(this)
                });
        }
    }
});
</script>
@endsection
