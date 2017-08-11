@extends('Layouts.Vidhikarya.Lawyer.Master')
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
		border-top-right-radius: 0;
	}
	.SenderStyle div:after{
		position: absolute;
		top: 0;
		right: -10px;
		content:'';
		border-top:5px solid #23d160;
		border-bottom:5px solid transparent;
		border-right:5px solid transparent;
		border-left:5px solid #23d160;
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
		border-top-left-radius: 0;
		margin-bottom: 10px;
	}
	.ReceiverStyle div:after{
		position: absolute;
		top: 0;
		left: -10px;
		content:'';
		border-bottom:5px solid transparent;
		border-top:5px solid #ff5252;
		border-left:5px solid transparent;
		border-right:5px solid #ff5252;
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
			<chat-list :people='ClientList' v-on:personchanged='GetMessages'></chat-list>
		</div>
		<div id="ChatContent">
			<div id="ChatHeader">
				<span>@{{ CurrentOpenedClientName }}</span>
			</div>
			<div id="Messages">
				<message v-for="Message in Messages"
					:data-message="Message.Message"
					:who='Message.Who'
					:when='Message.When'>
				</message>
			</div>
			<div id="ChatForm">
				
			</div>
		</div>
	</div>
	<div id="Status"></div>
</div>
<script type="text/javascript">
var tmpClientList = [];
@php($Clients = [])
@php($hasAnyClientInChat = false)
var hasAnyClientInChat = false;
@foreach($ClientList as $client)
	hasAnyClientInChat = true;
	@php($hasAnyClientInChat = true)
	// Getting Client List -- Lawyer To Client
	@if($client->senderId == session('userId'))	
		@if(in_array($client->receiverId,$Clients))
			// Client Already Exist
		@else
			tmpClientList.push({
				'ID' : {!! $client->receiverId !!},
				'Name' : "{!! $client->receiverName !!}"
			});
			@php(array_push($Clients,$client->receiverId))
		@endif
	// Getting Cleint List -- Client To Lawyer
	@else
		@if(in_array($client->senderId,$Clients))
			// Client Already Exist
		@else
			tmpClientList.push({
				'ClientID' : {!! $client->senderId !!},
				'ClientName' : "{!! $client->senderName !!}"
			});
			@php(array_push($Clients,$client->senderId))
		@endif
	@endif
@endforeach

var hasTargetClient = false;
// If Target Id is set
@if(isset($TargetClientId))
	var hasTargetClient = true;
	var TargetClientId = {!! $TargetClientId !!};
@else
	// If Target Id is not set -- Getting the First Client.
	// Getting Client List -- Lawyer To Client
	@if($hasAnyClientInChat == true)
		@if($ClientList[0]->senderId == session('userId'))	
			var tmpFirstClientId = {!! $ClientList[0]->receiverId !!};
			var tmpFirstClientName = "{!! $ClientList[0]->receiverName !!}";
		// Getting Cleint List -- Client To Lawyer
		@else
			var tmpFirstClientId = {!! $ClientList[0]->senderId !!};
			var tmpFirstClientName = "{!! $ClientList[0]->senderName !!}";
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
});
var ChatBox = new Vue({
	el:"#PageContent",
	data:{
		CurrentOpenedClientId : "",
		CurrentOpenedClientName : "",
		Message : "",
		ClientList : tmpClientList,
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
		if (hasTargetClient == false) {
			this.CurrentOpenedClientName = this.ClientList[0].ClientName;
			this.CurrentOpenedClientId = this.ClientList[0].ClientID;	
		}
	},
	methods:{
		showUpdatedPerson:function(value){
			alert(value);
		},
		SendMessage:function(){
			let formData={
                'ClientID': this.CurrentOpenedClientId,
                'ClientName' : this.CurrentOpenedClientName,
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
		GetMessages:function(ClientID,ClientName){
			// Changing the data of currently opened chat box ----------------
			this.CurrentOpenedClientName = ClientName;
			this.CurrentOpenedClientId = ClientID;
			let formData={
                'ClientID':ClientID,
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
                        				'Who' : 'Sender',
                        				'When' : Messages[count].created_at
                        			});
                        		}
                        		else{
                        			this.Messages.push({
                        				'Message' : Messages[count].message,
                        				'Who' : 'Receiver',
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
	if (hasTargetClient == true) {
		ChatBox.CurrentOpenedClientId = TargetClientId;
		let formData={
            'ClientID':TargetClientId,
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
	                    	ChatBox.CurrentOpenedClientName = ReturnedData.ClientName;
	                    	ChatBox.Messages = [];
	                    	while(count<TotalMessages){
	                    		if (ReturnedData.LawyerId == Messages[count].senderId) {
	                    			ChatBox.Messages.push({
	                    				'Message' : Messages[count].message,
	                    				'Who' : 'Sender',
	                    				'When' : Messages[count].created_at
	                    			});
	                    		}
	                    		else{
	                    			ChatBox.Messages.push({
	                    				'Message' : Messages[count].message,
	                    				'Who' : 'Receiver',
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
		if (hasAnyClientInChat == true) {
			ChatBox.CurrentOpenedClientId = tmpFirstClientId;
			ChatBox.CurrentOpenedClientName = tmpFirstClientName;
			let formData={
	            'ClientID':tmpFirstClientId,
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
		                    				'Who' : 'Sender',
		                    				'When' : Messages[count].created_at
		                    			});
		                    		}
		                    		else{
		                    			ChatBox.Messages.push({
		                    				'Message' : Messages[count].message,
		                    				'Who' : 'Receiver',
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