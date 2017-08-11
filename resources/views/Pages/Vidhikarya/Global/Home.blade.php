@extends('Layouts.Vidhikarya.Global.Master')
@section('title','Home')
@section('content')
<style type="text/css">
#PageContent{
	margin:auto;
	margin-top: 50px;
	width: 100%;
}

/* How It Works ---------------- Begin ---------------*/
#HowItWorksContainer{
	width:100%;
	margin:auto;
}
.HowItWorksWrapper{
	margin: auto;
	margin-left: 30px;
	width:1080px;
}
.HowItWorksCircles{
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: row;
	overflow-y: auto;
	width: 100%;
	padding-bottom: 30px;
}
.CircleUp{
	height: 180px;
	width: 180px;
	border-radius: 50%;
	border: 20px solid transparent;
	background-color: transparent;

	display: flex;
	justify-content: center;
	align-items: center;
	transform: rotate(45deg);
	/*background-image: -webkit-linear-gradient(red, yellow);*/
	/*transform: rotate(45deg);*/
}
.InnerCircle{
	height: 100%;
	width: 100%;
	border-radius: 50%;
	background-color: #fff;
	box-shadow: 4px 4px 8px 8px rgba(0,0,0,0.2);
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	transform: rotate(-45deg);
}
.InnerCircle span{
	text-align: center;
	font-size: 12px;
}
.InnerCircle i{
	display: block;
}
.CircleDown{
	height: 180px;
	width: 180px;
	border-radius: 50%;
	border: 20px solid transparent;
	background-color: transparent;
	display: flex;
	justify-content: center;
	align-items: center;
	transform: rotate(45deg);
}
.moveLeft{
	position: relative;
	left: -20px;
}
.Circle1{
	border-color: transparent tomato tomato transparent;
}
.Circle2{
		left: -20px;
		border-color: #673ab7 transparent transparent #673ab7;
	}
.Circle3{
	 left: -40px; 
	 border-color: transparent #4caf50 #4caf50 transparent;
}
.Circle4{
	 left: -60px; 
	 border-color: #795548 transparent transparent #795548;
}
.Circle5{
	 left: -80px; 
	 border-color: transparent #009688 #009688 transparent;
}
.Circle6{
	 left: -100px; 
	 border-color: #cddc39 transparent transparent #cddc39;
}
@media only screen and (max-width: 500px) {
	.HowItWorksWrapper{
		width: 400px;
		margin: auto;
	}
	.HowItWorksCircles{
		flex-direction: column;
	}
	.CircleUp, .CircleDown{
		width:300px;
		height:300px;
	}
	.Circle1{
		border-color: transparent transparent tomato tomato;
	}
	.Circle2{
		left: 0;
		top : -20px;
		border-color: #673ab7 #673ab7 transparent transparent;
	}
	.Circle3{
		left:0;
		top:-40px;
		border-color: transparent transparent tomato tomato;
	}
	.Circle4{
		left: 0;
		top:-60px;
		border-color: #673ab7 #673ab7 transparent transparent;
	}
	.Circle5{
		left: 0;
		top: -80px;
		border-color: transparent transparent tomato tomato; 
	}
	.Circle6{
		left: 0;
		top: -100px;
		border-color: #673ab7 #673ab7 transparent transparent;
	}
}
/* --------- How It Works ------------------- End -----------------------*/
</style>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/jquery.mCustomScrollbar.css') }}">
<script type="text/javascript" src="{{ URL::asset('js/jquery.mCustomScrollbar.min.js') }}"></script>
<div id="PageContent">

	<!-- How It Works -->
	<div id="HowItWorksContainer">
		<div style="display: flex; justify-content: center; align-items: center; margin-bottom: 30px;">
			<h3>How It Works</h3>
		</div>
		<div class="HowItWorksWrapper">
		<div class='HowItWorksCircles'>
			<div class="CircleUp Circle1">
				<div class="InnerCircle">
					<i class="material-icons">account_circle</i>
					<span>Register yourself !</span>
				</div>
			</div>
			<div class="CircleDown moveLeft Circle2">
				<div class="InnerCircle">
					<i class="material-icons" >search</i>
					<span>Explore and <br> select a course !</span>
				</div>
			</div>
			<div class="CircleUp moveLeft Circle3">
				<div class="InnerCircle">
					<i class="material-icons">account_balance_wallet</i>
					<span>Pay for <br> the course !</span>
				</div>
			</div>
			<div class="CircleDown moveLeft Circle4">
				<div class="InnerCircle">
					<i class="material-icons">chrome_reader_mode</i>
					<span>Learn and <br> take quiz !</span>
				</div>
			</div>
			<div class="CircleUp moveLeft Circle5">
				<div class="InnerCircle">
					<i class="material-icons">assignment_turned_in</i>
					<span>Get evaluation <br> scores and <br> feedback !</span>
				</div>
			</div>
			<div class="CircleDown moveLeft Circle6">
				<div class="InnerCircle">
					<i class="material-icons">book</i>
					<span>Receive <br> Certificate !</span>
				</div>
			</div>
		</div>
		</div>
	</div>
	<!-- How It Works - End -->
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#HowItWorksContainer").mCustomScrollbar({
		axis:"x",
		theme:"dark",
		autoHideScrollbar : true
	});
});
if (typeof Object.assign != 'function') {
  Object.assign = function(target) {
    'use strict';
    if (target == null) {
      throw new TypeError('Cannot convert undefined or null to object');
    }
    target = Object(target);
    for (var index = 1; index < arguments.length; index++) {
      var source = arguments[index];
      if ( source != null ) {
        for ( var key in source ) {
          if ( Object.prototype.hasOwnProperty.call(source, key) ) {
            target[key] = source[key];
          }
        }
      }
    }
    return target;
  };
}
</script>
@stop