<style type="text/css">
  .links{
    font-size: 17px;
    padding:10px;
  }
  .links:hover{
    color:#fff;
  }
  #Sidebar{
    transform: translateX(-100%);
    -webkit-transform: translateX(-100%);
  }
  .card a{
    color:rgba(0,0,0,.87) !important;
  }
  .list__tile .list__tile__title{
    color:rgba(0,0,0,.87) !important;
    font-weight: 400 !important;
  }
</style>
<nav id="Navigation" class="nav" style="background-color: #424242; height:50px; position: fixed; width: 100%; box-shadow: 0 2px 4px -1px rgba(0,0,0,.2), 0 4px 5px rgba(0,0,0,.14), 0 1px 10px rgba(0,0,0,.12); z-index: 4;">
  <div class="nav-left">
    <div style="height:50px;width:50px;padding:15px; cursor: pointer;" v-on:click="toggleSidebar">
      <i class="material-icons icon" style="color:#fff;">menu</i>
    </div>
  </div>
  <div class="nav-right" style="margin-right: 50px;">
  
    <!-- Notification Menu -->
    <div style="position: relative; cursor: pointer; display: inline-block; margin-right: 20px;">
      <div @click="toggleNotificationSidebar" style="height: 50px; width: 60px; display: flex; justify-content: center; align-items: center;">
          <v-icon light>notifications</v-icon>
      </div>
      <div style="position: absolute; top: 3px; right: 3px; height: 20px; width: 20px; border-radius: 50%; display: flex; justify-content: center; align-items: center; background: rgba(255,255,255,.12);">
          <span style="color: #fff;">@{{ NotificationNumber }}</span>
      </div>
    </div>
    <div v-if ='NotificationShow' style="width:300px; height: 300px; position: absolute; top: 50px; right: 100px; z-index: 5000; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); background-color: #fff;">
      Notification Window
    </div>

    <!-- Message Menu -->
    <div style="position: relative; cursor: pointer; display: inline-block; margin-right: 20px;">
      <div @click="toggleMessageSidebar" style="height: 50px; width: 60px; display: flex; justify-content: center; align-items: center;">
          <v-icon light>message</v-icon>
      </div>
      <div style="position: absolute; top: 3px; right: 3px; height: 20px; width: 20px; border-radius: 50%; display: flex; justify-content: center; align-items: center; background: rgba(255,255,255,.12);">
          <span style="color: #fff;">@{{ MessageNumber }}</span>
      </div>
    </div>

    <v-btn light flat style="margin:0px;padding:0px; height: 50px;padding-right:10px;padding-left:10px; background-color:#585858 !important;" v-on:click.native="HomeLink">
        <v-icon style="color:#fff;padding-right: 15px;">home</v-icon><span style="padding-left: 10px;">Home</span>
    </v-btn>

  </div>
</nav>
<div style="height: 50px;width: 100%;background-color: crimson;"></div>
<div id="Sidebar" style="display:block; height:100%;position:fixed;width: 300px; top:50px; left: 0px; z-index: 1000; background-color: #009688;">
    <div id="SidebarContent" style="width: 100%; height: 100%;">

        <v-card style="border-radius:0; background-color: #00d1b2;">
          <v-list>

            <v-list-group>
              <v-list-tile slot="item">
                <v-list-tile-action>
                  <v-icon>dashboard</v-icon>
                </v-list-tile-action>
                <v-list-tile-content v-on:click="DashboardLink">
                  <v-list-tile-title>Dashboard</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list-group>

            <v-list-group>
              <v-list-tile slot="item">
                <v-list-tile-action>
                  <v-icon>assignment</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                  <v-list-tile-title v-on:click="CaseList">Cases</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list-group>

            <v-list-group>
              <v-list-tile slot="item">
                <v-list-tile-action>
                  <v-icon>perm_identity</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                  <v-list-tile-title>Profile</v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>
                  <v-icon>keyboard_arrow_down</v-icon>
                </v-list-tile-action>
              </v-list-tile>
              <v-list-item>
                <v-list-tile>
                  <v-list-tile-content v-on:click="myProfile">
                    <v-list-tile-title>My Profile</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list-item>
            </v-list-group>

            <v-list-group>
              <v-list-tile slot="item">
                <v-list-tile-action>
                  <v-icon>message</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                  <v-list-tile-title v-on:click="Messages">Messages</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list-group>

            <v-list-group v-for="item in items" :value="item.active" v-bind:key="item.title">
              <v-list-tile slot="item">
                <v-list-tile-action>
                  <v-icon>@{{ item.action }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                  <v-list-tile-title>@{{ item.title }}</v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>
                  <v-icon>keyboard_arrow_down</v-icon>
                </v-list-tile-action>
              </v-list-tile>
              <v-list-item v-for="subItem in item.items" v-bind:key="subItem.title">
                <v-list-tile>
                  <v-list-tile-content>
                    <v-list-tile-title>@{{ subItem.title }}</v-list-tile-title>
                  </v-list-tile-content>
                  <v-list-tile-action>
                    <v-icon>@{{ subItem.action }}</v-icon>
                  </v-list-tile-action>
                </v-list-tile>
              </v-list-item>
            </v-list-group>

          </v-list>
        </v-card>
    </div>
</div>

<!-- ------------------------------ Notification Container ----------------------------- -->
<div id="NotificationSidebar" style="display:block; height:100%;position:fixed; width: 300px; top:50px; right: 0px; z-index: 1000; background-color: #009688;">
    <div id="NotificationSidebarContent" style="width: 100%; height: 100%;">

        <v-card style="border-radius:0; background-color: #00d1b2;">
          
        </v-card>
    </div>
</div>

<!-- ------------------------------ Message Container ----------------------------- -->
<div id="MessageSidebar" style="display:block; height:100%;position:fixed; width: 300px; top:50px; right: 0px; z-index: 1000; background-color: #009688;">
    <div id="MessageSidebarContent" style="width: 100%; height: 100%;">

        <v-card style="border-radius:0; background-color: #00d1b2;">
          <message-notify v-for='Message in Messages' :message='Message'></message-notify>
        </v-card>
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('js/VidhiComponent/Vidhikarya.js') }}"></script>
<script type="text/javascript">
// Getting Unread Messages -----------------
var tempUnreadMessages = [];
var NumberOfUnreadMessages = 0;
@foreach($UnreadMessagegs as $Message)
    temp = {};
    temp['MessageId'] = "{{ $Message->id }}";
    temp['SenderId'] = "{{ $Message->senderId }}";
    temp['SenderName'] = "{{ $Message->senderName }}";
    temp['Message'] = "{{ $Message->message }}";
    temp['SentTime'] = "{{ $Message->created_at }}";    
    temp['Location'] = "{{ url('ChatBox') }}/{{ $Message->senderId }}";
    tempUnreadMessages.push(temp);
    NumberOfUnreadMessages++;
@endforeach

// Socket Io Script
var socket = io('http://vidhikarya.dev:3000');
var userId = {{ Auth::id() }};
socket.on('connect',function(){
  console.log("User Connected. Socket Id = " + socket.id);
  socket.emit('userConnected',  {'socketId' : socket.id, 'userId' : userId });
});
// End

// Ready Function -------------------
$(document).ready(function(){
    $('#NotificationSidebar').velocity({ translateX: '100%' });
    $('#MessageSidebar').velocity({ translateX: '100%' });
});
$(document).click(function(event) {
    if( event.target.closest("#Sidebar") == null && event.target.closest("#Navigation") == null) {
        if(NavBar.sidebarVisible == true) {
            $('#Sidebar').velocity({ translateX: '-100%' });
            $('#Main').velocity(
                    {
                        opacity: 1
                    }, 500, 'easeInOutQuart'
            );
            NavBar.sidebarVisible = false;
        }
    }
    if( event.target.closest("#NotificationSidebar") == null && event.target.closest("#Navigation") == null) {
        if(NavBar.NotificationSidebarVisible == true) {
            $('#NotificationSidebar').velocity({ translateX: '100%' });
            $('#Main').velocity(
                    {
                        opacity: 1
                    }, 500, 'easeInOutQuart'
            );
            NavBar.NotificationSidebarVisible = false;
        }
    }
    if( event.target.closest("#MessageSidebar") == null && event.target.closest("#Navigation") == null) {
        if(NavBar.MessageSidebarVisible == true) {
            $('#MessageSidebar').velocity({ translateX: '100%' });
            $('#Main').velocity(
                    {
                        opacity: 1
                    }, 500, 'easeInOutQuart'
            );
            NavBar.MessageSidebarVisible = false;
        }
    }
});
var NavBar = new Vue({
  el : '#Navigation',
  data:{
    sidebarVisible : false,
    NotificationSidebarVisible : false,
    MessageSidebarVisible : false,

    NotificationNumber : 0,
    MessageNumber : 0,

    NotificationShow : false,

    // Messages ----------------------
    MessageShow : false,
    MessageNumber : NumberOfUnreadMessages,
    Messages : tempUnreadMessages,
  },
  mounted(){
    socket.on('GetAMessage',function(message){
      this.MessageNumber = this.MessageNumber + 1;
      var temp = {};
      temp['MessageId'] = message.messageId;
      temp['Message'] = message.message;
      temp['SenderId'] = message.senderId;
      temp['SenderName'] = message.senderName;
      temp['SentTime'] = message.sentTime;
      temp['Location'] = "{{ url('ChatBox') }}/"+message.senderId;
      this.Messages.unshift(temp);
    }.bind(this));
  },
  methods:{
    NotificationClicked:function(){
      if (this.NotificationShow == true) {
        this.NotificationShow = false;
      }
      else{
        this.NotificationShow = true;
      }
    },
    MessageClicked:function(){
      if (this.MessageShow == true) {
        this.MessageShow = false;
      }
      else{
        this.MessageShow = true;
      }
    },
    HomeLink:function(){
      window.location="/";
    },
    toggleSidebar:function(){
      if (this.sidebarVisible) {
        $('#Sidebar').velocity({ translateX: '-100%' });
        $('#Main').velocity(
                {
                    opacity: 1
                }, 500, 'easeInOutQuart'
        );
        this.sidebarVisible = false;
      }
      else{
        $('#Sidebar').velocity({ translateX: ['0%', '-100%'] });
        $('#Main')
          .velocity(
                {
                    opacity: .7
                }, 500, '[200, 20]'
          );        
        this.sidebarVisible = true;
      }
    },
    toggleNotificationSidebar(){
      if (this.MessageSidebarVisible) {
        $('#MessageSidebar').velocity({ translateX: '100%' });
        $('#Main').velocity(
                {
                    opacity: 1
                }, 500, 'easeInOutQuart'
        );
        this.MessageSidebarVisible = false;
      }
      if (this.NotificationSidebarVisible) {
        $('#NotificationSidebar').velocity({ translateX: '100%' });
        $('#Main').velocity(
                {
                    opacity: 1
                }, 500, 'easeInOutQuart'
        );
        this.NotificationSidebarVisible = false;
      }
      else{
        $('#NotificationSidebar').velocity({ translateX: ['0%', '100%'] });
        $('#Main')
          .velocity(
                {
                    opacity: .7
                }, 500, '[200, 20]'
          );        
        this.NotificationSidebarVisible = true;
      }
    },
    toggleMessageSidebar(){
      if (this.NotificationSidebarVisible) {
        $('#NotificationSidebar').velocity({ translateX: '100%' });
        $('#Main').velocity(
                {
                    opacity: 1
                }, 500, 'easeInOutQuart'
        );
        this.NotificationSidebarVisible = false;
      }
      if (this.MessageSidebarVisible) {
        $('#MessageSidebar').velocity({ translateX: '100%' });
        $('#Main').velocity(
                {
                    opacity: 1
                }, 500, 'easeInOutQuart'
        );
        this.MessageSidebarVisible = false;
      }
      else{
        $('#MessageSidebar').velocity({ translateX: ['0%', '100%'] });
        $('#Main')
          .velocity(
                {
                    opacity: .7
                }, 500, '[200, 20]'
          );        
        this.MessageSidebarVisible = true;
      }
    }
  }
});
var Sidebar = new Vue({
  el : '#Sidebar',
  data:{
    items: [
          {
            action: 'restaurant',
            title: 'Dining',
            active: true,
            items: [
              { title: 'Breakfast & brunch' },
              { title: 'New American' },
              { title: 'Sushi' }
            ]
          },
          {
            action: 'school',
            title: 'Education',
            items: [
              { title: 'List Item' }
            ]
          },
          {
            action: 'directions_run',
            title: 'Family',
            items: [
              { title: 'List Item' }
            ]
          },
          {
            action: 'healing',
            title: 'Health',
            items: [
              { title: 'List Item' }
            ]
          },
          {
            action: 'content_cut',
            title: 'Office',
            items: [
              { title: 'List Item' }
            ]
          },
          {
            action: 'local_offer',
            title: 'Promotions',
            items: [
              { title: 'List Item' }
            ]
          }
        ]
  },
  methods:{
    DashboardLink:function(){
      window.location="{{ url('Dashboard') }}";
    },
    CaseList:function(){
      window.location="{{ url('CaseList') }}";
    },
    myProfile:function(){
      window.location = "{{ url('myProfile') }}";
    },
    Messages:function(){
      window.location = "{{ url('ChatBox') }}";
    }
  }
});
var NotificationSidebar = new Vue({
  el : '#NotificationSidebar',
  data:{}
});
var MessageSidebar = new Vue({
  el : '#MessageSidebar',
  data:{}
});
</script>