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
.loginContent{
    padding: 25px;
}
#loginFormContainer{
    margin:auto;
    padding: 0;
}
.card{
    margin:auto;
    margin-top: 50px;
    width: 50%;
}
</style>
<div class="row" id="PageContent">
<div class="card">
<div class="card-header">
    <p class="card-header-title" style="margin:0px;">Hello World</p>
</div>
<div class="card-content">

    <div v-if="hasError" class="notification is-danger" style="padding: 10px;">
      <button class="delete" @click="closeAlert"></button>
      <strong>Log In Failed ! </strong> Wrong email or password
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
            class="input-group--focused"
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
            type="password"
            class="input-group--focused"
          >
        </v-text-field>
    </div>

    <div class="row end-md">
        <v-btn v-on:click.native='ForgetPasswordButton' primary light class = "btn--light-flat-focused blue-grey darken-1">Forget Your Password ?</v-btn>
        <v-btn v-on:click.native='LogIn' primary light class = "btn--light-flat-focused green darken-3">Log In</v-btn>
    </div>

    <div id="Status"></div>
</div>
</div>
</div>
<script type="text/javascript">
let data={
    email : '',
    password : '',
    hasError : false,
};
LoginApp = new Vue({
    el : '#PageContent',
    data : data,
    methods:{
        closeAlert : function(){
            this.hasError = false;
        },
        LogIn:function(){
            let formData={
                'email' : this.email,
                'password' : this.password,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/login",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                    this.hasError = false;
                    var ReturnedData = JSON.parse(JSON.stringify(data));
                    if (ReturnedData.success == false) {
                        this.hasError = true;
                    }
                    if (ReturnedData.success == true) {
                        window.location = "{{ url('/Dashboard') }}";
                    }
                    }.bind(this),
                    error: function (data) {
                        $("#Status").append(JSON.stringify(data));
                    }.bind(this)
                });
        }
    }
});
</script>
@endsection
