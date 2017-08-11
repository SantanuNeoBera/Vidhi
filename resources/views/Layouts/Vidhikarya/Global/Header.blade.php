<style type="text/css">
.Header{
	width: 100%;
	height: 40px;
	background-color: #546e7a!important;
	position: fixed;
}
.RightNavigation{
	float:right;
  margin-right: 100px;
}
.Links{
	list-style: none;
	margin:0;
	padding: 0;
}
.Links li{
  display: inline-block;
}
</style>
<header class="Header">
	<nav class="RightNavigation">
      @if(!Auth::check())
          <v-menu
            origin="center center"
            transition="v-scale-transition"
            bottom>
            <v-btn light flat slot="activator" style="margin:0px;padding:0px;height:40px;">Register</v-btn>
            <v-list>
              <v-list-item>
                <v-list-tile>
                  <v-list-tile-title v-on:click="clientRegister">
                    Sign Up As a Client
                  </v-list-tile-title>
                </v-list-tile>
              </v-list-item>

              <v-list-item>
                <v-list-tile>
                  <v-list-tile-title v-on:click="OrgRegister">
                    Sign Up As a Organization
                  </v-list-tile-title>
                </v-list-tile>
              </v-list-item>

              <v-list-item>
                <v-list-tile>
                  <v-list-tile-title v-on:click="lawyerRegister">
                    Sign Up As a Lawyer
                  </v-list-tile-title>
                </v-list-tile>
              </v-list-item>

            </v-list>
          </v-menu>
      @endif  
      @if(Auth::check())
        <v-btn light flat style="margin:0px;padding:0px; height: 40px;" v-on:click.native="Dashboard">Dashboard</v-btn>
        <v-btn light flat style="margin:0px;padding:0px; height: 40px;" v-on:click.native="LogOut">Log Out</v-btn>
      @else
          <div style="display: inline-block; position: relative;">
            <v-btn id="logInButton" light flat style="margin:0px;padding:0px; height: 40px;" v-on:click.native="LogIn">Log In</v-btn>
            <div v-show="logInShow" style="background-color: #fff; width:300px; position: absolute; top: 40px; right: 0px; z-index: 5000; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                <form class="ui form" style="padding-left: 30px; padding-right: 30px; padding-top: 30px;">
                  <div v-show='hasError' class="notification is-danger">
                    <button class="delete"></button>
                    Wrong Email or Password !
                  </div>
                  <!-- Email -->
                  <div class="field">
                    <div class="fields">
                      <div class="field "  style="width: 100%;">
                        <input v-model='email' @input='StartedTyping' type="text" name="email" placeholder="Email">
                      </div>
                    </div>
                  </div>

                  <!-- Password -->
                  <div class="field">
                    <div class="fields">
                      <div class="field"  style="width: 100%;">
                        <input v-model='password' @input='StartedTyping'  type="password" name="password" placeholder="Password">
                      </div>
                    </div>
                  </div>

                  <!-- Button -->
                  <div style="display: flex; justify-content: flex-end; padding-bottom: 30px;">
                      <v-btn v-on:click.native='CreateLogIn' primary light style='margin:0;'>Log In</v-btn>
                  </div>
                </form>
            </div>
          </div>
      @endif
	</nav>
</header>
<div style="height: 40px;width: 100%;"></div>
<script type="text/javascript">
new Vue({
  el:'.Header',
  data:{
      logInShow : false,
      email : '',
      password : '',
      hasError : false
  },
  methods:{
      StartedTyping:function(){
        this.hasError = false;
      },
      clientRegister:function(){
        window.location="clientRegister";
      },
      OrgRegister:function(){
        window.location="organizationRegister";
      },
      lawyerRegister:function(){
        window.location='lawyerRegister';
      },
      LogIn:function(){
        if (this.logInShow == true) {
          this.logInShow = false;
        }
        else{
          this.logInShow = true;
        }
      },
      LogOut:function(){
        window.location="logout";
      },
      Dashboard:function(){
        window.location="Dashboard";
      },
      CreateLogIn:function(){
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
})
</script>