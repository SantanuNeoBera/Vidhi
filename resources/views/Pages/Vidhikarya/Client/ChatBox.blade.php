@extends('Layouts.Vidhikarya.Client.Master')
@section('title','Case Details')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/animate.css') }}">
<style type="text/css">
	.input-group--text-field input{
		padding-right: 20px !important;
	}
	#PageContent{
		margin:auto;
		width: 100%;
	}
	#ChatBox{
		display: flex;
		width: 100%;
	}
	#ChatList{
		height: 550px;
		flex:1;
		margin:10px;
		padding: 15px;
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
	  	border-radius: 5px;
	  	overflow-y: scroll;
	}
	#ChatContent{
		height: 550px;
		flex:4;
		margin:10px;
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
	  	border-radius: 5px;
	  	display: flex;
	  	flex-direction: column;
	}
	#ChatHeader{
		flex-basis: 10%;
		background: #dbdbdb;
		display: flex;
		align-items: center;
		justify-content: flex-start;
	}
	#ChatHeader span{
		font-size: 20px;
		padding-left: 20px;
	}
	#Messages{
		padding:20px;
		flex-basis: 80%;
		border-bottom: 1px solid #ddd;
		overflow-y: scroll;
	}
	#ChatForm{
		flex-basis: 10%;
		padding: 10px;
	}
	.SenderStyle{
		display: flex;
		width: 100%;
		justify-content: flex-end;
		align-items: center;
	}
	.SenderStyle div{
		width: 70%;
		padding:5px;
		color:#fff;
		background-color: #23d160;
		position: relative;
		margin-bottom: 10px;
		border-radius: 5px;
	}
	.SenderStyle div:after{
		position: absolute;
		bottom: -10px;
		right: 30px;
		content:'';
		border-top:5px solid #23d160;
		border-bottom:5px solid transparent;
		border-right:5px solid #23d160;
		border-left:5px solid transparent;
	}
	.ReceiverStyle{
		display: flex;
		width: 100%;
		justify-content: flex-start;
		align-items: center;
	}
	.ReceiverStyle div{
		width: 70%;
		padding:5px;
		color:#fff;
		background-color: #ff5252;
		position: relative;
		border-radius: 5px;
		margin-bottom: 10px;
	}
	.ReceiverStyle div:after{
		position: absolute;
		top: -10px;
		left: 30px;
		content:'';
		border-bottom:5px solid #ff5252;
		border-top:5px solid transparent;
		border-left:5px solid #ff5252;
		border-right:5px solid transparent;
	}
	input{
		height:30px;
		width: 95%;
		outline:none;
		padding: 5px;
	}
</style> 
<div id="PageContent">
	<div id="ChatBox">
		<div id="ChatList">
			<v-list subheader>
			  <v-subheader>Chat List</v-subheader>
			  <v-list-item v-for="(Lawyer, index) in LawyerList" :key='index'>
			    <v-list-tile>
			      <v-list-tile-content>
			        <v-list-tile-title v-html="Lawyer.LawyerName" v-on:click="GetMessages(Lawyer.LawyerName,Lawyer.LawyerID)"></v-list-tile-title>
			      </v-list-tile-content>
			      <v-list-tile-action>
			        <v-icon>chat_bubble</v-icon>
			      </v-list-tile-action>
			    </v-list-tile>
			  </v-list-item>
			</v-list>
		</div>
		<div id="ChatContent">
			<div id="ChatHeader">
				<span>@{{ CurrentOpenedLawyerName }}</span>
			</div>
			<div id="Messages">
				<message v-for="(Message, index) in Messages"
					:key = "index"
					:data-message="Message.Message"
					:who='Message.Who'
					:when='Message.When'>
				</message>
			</div>
			<div id="ChatForm">
				<form onsubmit="return false">
					<div style="display: flex;">
						<div style="flex-basis: auto; flex-grow: 1;">
							<input v-model="Message" v-on:keyup.enter="SendMessage" placeholder="Type Your Message Here !" type="text" name="message">
						</div>
						<div style="flex-basis: auto;">
							<a class="button is-light" style="height:inherit;" v-on:click="SendMessage">Send</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="Status"></div>
</div>
<script type="text/javascript">
var tmpLawyerList = [];
@php($Lawyers = [])
@php($hasAnyLawyerInChat = false)
var hasAnyLawyerInChat = false;
@foreach($LawyerList as $lawyer)
	hasAnyLawyerInChat = true;
	@php($hasAnyLawyerInChat = true)
	// Getting Lawyer List -- Lawyer To Client
	@if($lawyer->senderId == session('userId'))	
		@if(in_array($lawyer->receiverId,$Lawyers))
			// Lawyer Already Exist
		@else
			tmpLawyerList.push({
				'LawyerID' : {!! $lawyer->receiverId !!},
				'LawyerName' : "{!! $lawyer->receiverName !!}"
			});
			@php(array_push($Lawyers,$lawyer->receiverId))
		@endif
	// Getting Lawyer List -- Client To Lawyer
	@else
		@if(in_array($lawyer->senderId,$Lawyers))
			// Client Already Exist
		@else
			tmpLawyerList.push({
				'LawyerID' : {!! $lawyer->senderId !!},
				'LawyerName' : "{!! $lawyer->senderName !!}"
			});
			@php(array_push($Lawyers,$lawyer->senderId))
		@endif
	@endif
@endforeach

var hasTargetLawyer = false;
// If Target Id is set
@if(isset($TargetLawyerId))
	var hasTargetLawyer = true;
	var TargetLawyerId = {!! $TargetLawyerId !!};
@else
	// If Target Id is not set -- Getting the First Client.
	// Getting Lawyer List -- Client To Lawyer
	@if($hasAnyLawyerInChat == true)
		@if($LawyerList[0]->senderId == session('userId'))	
			var tmpFirstLawyerId = {!! $LawyerList[0]->receiverId !!};
			var tmpFirstLawyerName = "{!! $LawyerList[0]->receiverName !!}";
		// Getting Cleint List -- Lawyer To Client
		@else
			var tmpFirstLawyerId = {!! $LawyerList[0]->senderId !!};
			var tmpFirstLawyerName = "{!! $LawyerList[0]->senderName !!}";
		@endif
	@endif
@endif

$(".input-group__details").css('line-height','0');
Vue.component('message',{
props:['dataMessage','who','when'],
template:`
<div class="popUp1 animated zoomIn" :class="whichClass" :data-content="when">
	<div>
		@{{ dataMessage }} <span style="padding:20px; color:#fff; font-size:11px;">@{{ when }}</span>
	</div>
</div>
`,
computed:{
	whichClass:function(){
		if (this.who == "Sender") {
			return "SenderStyle";
		}
		else
		{
			return "ReceiverStyle";
		}
	}
},
mounted(){
	$('.popUp1').popup({position : 'top center'});
}
});
var ChatBox = new Vue({
	el:"#PageContent",
	data:{
		CurrentOpenedLawyerId : "",
		CurrentOpenedLawyerName : "",
		Message : "",
		LawyerList : tmpLawyerList,
		Messages:[]
	},
	mounted(){
		socket.on('GetAMessage',function(message){
		  	this.Messages.push({
				'Message' : message.message,
				'Who' : 'Receiver',
				'When' : message.sentTime
			});
		  	setTimeout(function(){
        		var elem = document.getElementById('Messages');
		  		elem.scrollTop = elem.scrollHeight;
        	},50);
		}.bind(this));
		// If Target client not set, view the messages of first client and set current client details.
		if (hasTargetLawyer == false) {
			this.CurrentOpenedLawyerName = this.LawyerList[0].LawyerName;
			this.CurrentOpenedLawyerId = this.LawyerList[0].LawyerID;	
		}
	},
	methods:{
		SendMessage:function(){
			let formData={
                'LawyerID': this.CurrentOpenedLawyerId,
                'LawyerName' : this.CurrentOpenedLawyerName,
                'Message' : this.Message,
                '_token': "{{csrf_token()}}"
            };
            if(this.Message != ""){
	            $.ajax({
	                type: "post",
	                url: "/SendMessage",
	                data: formData,
	                dataType: 'json',
	                success: function (data) {
	                    var ReturnedData=JSON.parse(JSON.stringify(data));
	                    if ('Status' in ReturnedData) {
	                        if (ReturnedData.Status == "Saved") {
	                        	// Do Stuff after successfully message sent.
	                        	this.Messages.push({
	                				'Message' : this.Message,
	                				'Who' : 'Sender',
	                				'When' : ReturnedData.Time
	                			});
	                			this.Message = "";
	                			setTimeout(function(){
	                        		var elem = document.getElementById('Messages');
							  		elem.scrollTop = elem.scrollHeight;
	                        	},50);
	                        }
	                    }
	                }.bind(this),
	                error: function (data) {
	                    $("#Status").append(JSON.stringify(data));
	                }.bind(this)
	            });
        	}
		},
		GetMessages:function(LawyerName,LawyerID){
			// Changing the data of currently opened chat box ----------------
			this.CurrentOpenedLawyerName = LawyerName;
			this.CurrentOpenedLawyerId = LawyerID;
			let formData={
                'LawyerID':LawyerID,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                type: "post",
                url: "/GetMessages",	
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var ReturnedData=JSON.parse(JSON.stringify(data));
                    if ('Status' in ReturnedData) {
                        if (ReturnedData.Status == "Loaded") {
                        	var Messages = ReturnedData.Messages;
                        	var TotalMessages = Messages.length;
                        	var count = 0;
                        	var LawyerId = ReturnedData.LawyerId;
                        	this.Messages = [];
                        	while(count<TotalMessages){
                        		if (ReturnedData.LawyerId == Messages[count].senderId) {
                        			this.Messages.push({
                        				'Message' : Messages[count].message,
                        				'Who' : 'Receiver',
                        				'When' : Messages[count].created_at
                        			});
                        		}
                        		else{
                        			this.Messages.push({
                        				'Message' : Messages[count].message,
                        				'Who' : 'Sender',
                        				'When' : Messages[count].created_at
                        			});
                        		}
                        		count++;
                        	}
                        	setTimeout(function(){
                        		var elem = document.getElementById('Messages');
						  		elem.scrollTop = elem.scrollHeight;
                        	},50);
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
$(document).ready(function(){
	if (hasTargetLawyer == true) {
		ChatBox.CurrentOpenedLawyerId = TargetLawyerId;
		let formData={
            'LawyerID' : TargetLawyerId,
            '_token': "{{csrf_token()}}"
        };
        setTimeout(function(){ 
        	$.ajax({
	            type: "post",
	            url: "/GetTargetMessages",
	            data: formData,
	            dataType: 'json',
	            success: function (data) {
	                var ReturnedData=JSON.parse(JSON.stringify(data));
	                if ('Status' in ReturnedData) {
	                    if (ReturnedData.Status == "Loaded") {
	                    	var Messages = ReturnedData.Messages;
	                    	var TotalMessages = Messages.length;
	                    	var count = 0;
	                    	var LawyerId = ReturnedData.LawyerId;
	                    	ChatBox.CurrentOpenedLawyerName = ReturnedData.LawyerName;
	                    	ChatBox.Messages = [];
	                    	while(count<TotalMessages){
	                    		if (ReturnedData.LawyerId == Messages[count].senderId) {
	                    			ChatBox.Messages.push({
	                    				'Message' : Messages[count].message,
	                    				'Who' : 'Receiver',
	                    				'When' : Messages[count].created_at
	                    			});
	                    		}
	                    		else{
	                    			ChatBox.Messages.push({
	                    				'Message' : Messages[count].message,
	                    				'Who' : 'Sender',
	                    				'When' : Messages[count].created_at
	                    			});
	                    		}
	                    		count++;
	                    	}
	                    	setTimeout(function(){
                        		var elem = document.getElementById('Messages');
						  		elem.scrollTop = elem.scrollHeight;
                        	},50);
	                    }
	                }
	            },
	            error: function (data) {
	                $("#Status").append(JSON.stringify(data));
	            }
	        });
        }, 100);
	}
	else{
		if (hasAnyLawyerInChat == true) {
			ChatBox.CurrentOpenedLawyerId = tmpFirstLawyerId;
			ChatBox.CurrentOpenedLawyerName = tmpFirstLawyerName;
			let formData={
	            'LawyerID':tmpFirstLawyerId,
	            '_token': "{{csrf_token()}}"
	        };
	        setTimeout(function(){ 
	        	$.ajax({
		            type: "post",
		            url: "/GetTargetMessages",
		            data: formData,
		            dataType: 'json',
		            success: function (data) {
		                var ReturnedData=JSON.parse(JSON.stringify(data));
		                if ('Status' in ReturnedData) {
		                    if (ReturnedData.Status == "Loaded") {
		                    	var Messages = ReturnedData.Messages;
		                    	var TotalMessages = Messages.length;
		                    	var count = 0;
		                    	var LawyerId = ReturnedData.LawyerId;
		                    	ChatBox.Messages = [];
		                    	while(count<TotalMessages){
		                    		if (ReturnedData.LawyerId == Messages[count].senderId) {
		                    			ChatBox.Messages.push({
		                    				'Message' : Messages[count].message,
		                    				'Who' : 'Receiver',
		                    				'When' : Messages[count].created_at
		                    			});
		                    		}
		                    		else{
		                    			ChatBox.Messages.push({
		                    				'Message' : Messages[count].message,
		                    				'Who' : 'Sender',
		                    				'When' : Messages[count].created_at
		                    			});
		                    		}
		                    		count++;
		                    	}
		                    	setTimeout(function(){
	                        		var elem = document.getElementById('Messages');
							  		elem.scrollTop = elem.scrollHeight;
	                        	},50);
		                    }
		                }
		            },
		            error: function (data) {
		                $("#Status").append(JSON.stringify(data));
		            }
		        });
	        }, 100);
		}
	}
});
</script>
@stop