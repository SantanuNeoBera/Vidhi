@extends('Layouts.Vidhikarya.Client.Master')
@section('title','Case Details')
@section('content')
<style type="text/css">
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
.InfoRow{
	display: flex; 
	justify-content: flex-start; 
	padding-top: 8px; 
	padding-bottom: 8px;
}
.RowLabel{
	color: #90949c;
}
.RowValue{

}
</style>
<link rel="stylesheet" type="text/css" href=" {{ URL::asset('css/Rating/css-stars.css') }} ">
<script type="text/javascript" src="{{ URL::asset('js/Rating/jquery.barrating.min.js') }}"></script>
<div id="PageContent">
<div class="ProfileContainer">
	<!-- Cover Image -->
	<div class="ImageContainer">
		<div style="height: 100px; width: 100px;">
			<img src="{{ URL::asset('images/John_Doe.png') }}" style="width: 100%; height: 100%; border: 6px solid rgba(0, 0, 0, 0.38);">
		</div>
		<span style="font-size: 30px; color: #fff;"> {{ $LawyerDetails->firstName." ".$LawyerDetails->middleName." ".$LawyerDetails->lastName }}</span>
	</div>
	<!-- Tabs -->
	<div class="DashboardNav">        
		<nav class="DashboardNavBar">
			<div class="Tabs">
				<neo-tab v-for="tab in Tabs" :data="tab" :tab-name="tab.TabName" @changed="ChangeTab"></neo-tab>
			</div>
	    </nav>
	</div>
	<!-- About Lawyer -->
	<div v-show="AboutTab">

<div id="AboutSection" style=" padding: 20px;">
	<!-- Professional Information -->
	<div id="ProfessionalInformation">
		<span class="Heading">
			Professional Information
		</span>
		<v-divider style="margin:0;"></v-divider>

		<!-- Experience -->
		<div class="InfoRow">
			<div style="flex:1;">
				<span class="RowLabel">Years Of Experience</span>
			</div>
			<div style="flex:3;">
				<span class="RowValue"> {{ $LawyerDetails->experience }} </span>
			</div>
		</div>
		<v-divider style="margin:0;"></v-divider>

		<!-- Designation -->
		<div class="InfoRow">
			<div style="flex:1;">
				<span class="RowLabel">Designation</span>
			</div>
			<div style="flex:3;">
				<span class="RowValue"> {{ $LawyerDetails->designation }} </span>
			</div>
		</div>
		<v-divider style="margin:0;"></v-divider>

		<!-- Education -->
		<div class="InfoRow">
			<div style="flex:1;">
				<span class="RowLabel">Education</span>
			</div>
			<div style="flex:3;">
				<span class="RowValue"> {{ $LawyerDetails->education }} </span>
			</div>
		</div>
		<v-divider style="margin:0;"></v-divider>

		<!-- Professional Summary -->
		<div class="InfoRow">
			<div style="flex:1;">
				<span class="RowLabel">Professional Summary</span>
			</div>
			<div style="flex:3;">
				<span class="RowValue"> {{ $LawyerDetails->professionalSummary }} </span>
			</div>
		</div>
		<v-divider style="margin:0;"></v-divider>
	</div>

	<!-- Address Information -->
	<div id="AddressInformation">
		<span class="Heading">
			Address Information
		</span>
		<v-divider style="margin:0;"></v-divider>

		<!-- Country -->
		<div class="InfoRow">
			<div style="flex:1;">
				<span class="RowLabel">Country</span>
			</div>
			<div style="flex:3;">
				<span class="RowValue">{{ $LawyerDetails->country }}</span>
			</div>
		</div>
		<v-divider style="margin:0;"></v-divider>

		<!-- State -->
		<div class="InfoRow">
			<div style="flex:1;">
				<span class="RowLabel">State</span>
			</div>
			<div style="flex:3;">
				<span class="RowValue">{{ $LawyerDetails->state }}</span>
			</div>
		</div>
		<v-divider style="margin:0;"></v-divider>

		<!-- City -->
		<div class="InfoRow">
			<div style="flex:1;">
				<span class="RowLabel">City</span>
			</div>
			<div style="flex:3;">
				<span class="RowValue">{{ $LawyerDetails->city }}</span>
			</div>
		</div>
		<v-divider style="margin:0;"></v-divider>
	</div>

	<!-- General Information -->
	<div id="GeneralInformation">
		<span class="Heading">
			General Information
		</span>
		<v-divider style="margin:0;"></v-divider>

		<!-- Name -->
		<div class="InfoRow">
			<div style="flex:1;">
				<span class="RowLabel">Name</span>
			</div>
			<div style="flex:3;">
				<span class="RowValue">{{ $LawyerDetails->firstName." ".$LawyerDetails->middleName." ".$LawyerDetails->lastName }}</span>
			</div>
		</div>
		<v-divider style="margin:0;"></v-divider>
		<!-- Gender -->
		<div class="InfoRow">
			<div style="flex:1;">
				<span class="RowLabel">Gender</span>
			</div>
			<div style="flex:3;">
				<span class="RowValue">{{ $LawyerDetails->gender }}</span>
			</div>
		</div>
		<v-divider style="margin:0;"></v-divider>
	</div>

	<!-- Contact Information -->
	<div id="ContactInformation">
		<span class="Heading">
			Contact Information
		</span>
		<v-divider style="margin:0;"></v-divider>

		<!-- Mobile Number -->
		<div class="InfoRow">
			<div style="flex:1;">
				<span class="RowLabel">Mobile Number</span>
			</div>
			<div style="flex:3;">
				<span class="RowValue"> {{ $LawyerDetails->mobileNo }} </span>
			</div>
		</div>
		<v-divider style="margin:0;"></v-divider>

		<!-- Email -->
		<div class="InfoRow">
			<div style="flex:1;">
				<span class="RowLabel">Email</span>
			</div>
			<div style="flex:3;">
				<span class="RowValue"> {{ $LawyerDetailsFromUser->email }} </span>
			</div>
		</div>
		<v-divider style="margin:0;"></v-divider>
	</div>
</div>

	</div>
	
	<!-- Applied  -->
	<div v-show="AppliedCasesTab">
		<h1>Neo</h1>
	</div>
	<div v-show="ReviewsTab">

<div style="display : flex; border-bottom: 1px solid #ddd;">

	<!-- Overview -->
	<div style="flex : 1; padding-left: 30px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
		<p style="margin-bottom: 5px; display: inline-block;"><span style="font-size: 30px; text-align: center; margin-bottom: 5px;">@{{ averageRating }}</span> <i class="material-icons" style="padding-left: 10px;">stars</i></p>
		<p style="font-size: 14px; color: #878787; font-weight: 500; margin-bottom: 5px;">@{{ totalRating }} Ratings</p>
		<p style="font-size: 14px; color: #878787; font-weight: 500; margin-bottom: 5px;">@{{ totalReview }} Reviews</p>
	</div>

	<!-- Ratings -->
	<div style="flex : 1; padding-top: 20px; padding-right: 20px;">

		<!-- 5 Stars -->
		<span style="display: flex; flex-wrap: wrap;">
			<span style="flex-basis: 50px; font-size: 13px; display: inline-block; display: flex; align-items: flex-start;">
				<span style="position: relative; bottom: 3px;">5</span> <i class="fa fa-star" style="font-size: 13px; padding-left: 4px;" aria-hidden="true"></i>
			</span>
			<div style="flex-basis: 120px; padding-top: 5px; flex-grow: 1;">
				<progress class="progress is-success" :value="ratingFiveProgressBar" max="100">95%</progress>
			</div>
			<div style="flex-basis: 30px;">
				<span style="position: relative; bottom: 3px;">&nbsp;@{{ fiveStar }}</span>
			</div>
		</span>

		<!-- 4 Stars -->
		<span style="display: flex; flex-wrap: wrap;">
			<span style="flex-basis: 50px; font-size: 13px; display: inline-block; display: flex; align-items: flex-start;">
				<span style="position: relative; bottom: 3px;">4</span> <i class="fa fa-star" style="font-size: 13px; padding-left: 4px;" aria-hidden="true"></i>
			</span>
			<div style="flex-basis: 120px; padding-top: 5px; flex-grow: 1;">
				<progress class="progress is-primary" :value="ratingFourProgressBar" max="100">75%</progress>
			</div>
			<div style="flex-basis: 30px;">
				<span style="position: relative; bottom: 3px;">&nbsp;@{{ fourStar }}</span>
			</div>
		</span>

		<!-- 3 Stars -->
		<span style="display: flex; flex-wrap: wrap;">
			<span style="flex-basis: 50px; font-size: 13px; display: inline-block; display: flex; align-items: flex-start;">
				<span style="position: relative; bottom: 3px;">3</span> <i class="fa fa-star" style="font-size: 13px; padding-left: 4px;" aria-hidden="true"></i>
			</span>
			<div style="flex-basis: 120px; padding-top: 5px; flex-grow: 1;">
				<progress class="progress is-info" :value="ratingThreeProgressBar" max="100">55%</progress>
			</div>
			<div style="flex-basis: 30px;">
				<span style="position: relative; bottom: 3px;">&nbsp;@{{ threeStar }}</span>
			</div>
		</span>

		<!-- 2 Stars -->
		<span style="display: flex; flex-wrap: wrap;">
			<span style="flex-basis: 50px; font-size: 13px; display: inline-block; display: flex; align-items: flex-start;">
				<span style="position: relative; bottom: 3px;">2</span> <i class="fa fa-star" style="font-size: 13px; padding-left: 4px;" aria-hidden="true"></i>
			</span>
			<div style="flex-basis: 120px; padding-top: 5px; flex-grow: 1;">
				<progress class="progress is-warning" :value="ratingTwoProgressBar" max="100">35%</progress>
			</div>
			<div style="flex-basis: 30px;">
				<span style="position: relative; bottom: 3px;">&nbsp;@{{ twoStar }}</span>
			</div>
		</span>
		
		<!-- 1 Stars -->
		<span style="display: flex; flex-wrap: wrap;">
			<span style="flex-basis: 50px; font-size: 13px; display: inline-block; display: flex; align-items: flex-start;">
				<span style="position: relative; bottom: 3px;">1</span> <i class="fa fa-star" style="font-size: 13px; padding-left: 4px;" aria-hidden="true"></i>
			</span>
			<div style="flex-basis: 120px; padding-top: 5px; flex-grow: 1;">
				<progress class="progress is-danger" :value="ratingOneProgressBar" max="100">15%</progress>
			</div>
			<div style="flex-basis: 30px;">
				<span style="position: relative; bottom: 3px;">&nbsp;@{{ oneStar }}</span>
			</div>
		</span>
	</div>
</div>
<div id="Reviews" style="width: 100%;">
	<div v-for="Review in Reviews">
		<div class="card" style="margin-left: 20px; margin-right: 20px; margin-bottom: 5px; margin-top: 5px;">
			<div style="display: flex; justify-content: flex-start; padding-left: 20px; padding-top: 5px;">
				<span style="font-size: 16px; font-weight: 500;">@{{ Review.Name }}</span>
				<small style="padding-left: 20px; position: relative; top: 5px;">@{{ Review.Date }} </small>
			</div>
			<div style="padding-left: 20px;">
				@{{ Review.Review}}
			</div>
			<div style="padding-left: 20px; padding-bottom: 20px;">
				<neo-rating :rating-value="Review.Rating" :id="Review.UserID"></neo-rating>
			</div>
		</div>
	</div>
</div>


	</div>
</div>
</div>
<script type="text/javascript" src="{{ url('js/neoComponent.js') }}"></script>
<script type="text/javascript">
Vue.component('neoRating',{
	props:['ratingValue','id'],
	template:`
<div>
	<select :id="id">
	  <option value="1">1</option>
	  <option value="2">2</option>
	  <option value="3">3</option>
	  <option value="4">4</option>
	  <option value="5">5</option>
	</select>
</div>
`,
mounted(){
		$('#'+this.id).barrating({
	        theme: 'css-stars',
	        initialRating : this.ratingValue,
	        readonly : true
	    });
	}
});
var tempReviews = [];
@php($fiveStar = 0)
@php($fourStar = 0)
@php($threeStar = 0)
@php($twoStar = 0)
@php($oneStar = 0)
@php($totalReview = 0)
@php($totalRating = 0)
@foreach($LawyerReviews as $Review)
	@if($Review->rating == 1)
		@php($oneStar = $oneStar +1)
	@elseif($Review->rating == 2)
		@php($twoStar = $twoStar +1)
	@elseif($Review->rating == 3)
		@php($threeStar = $threeStar +1)
	@elseif($Review->rating == 4)
		@php($fourStar = $fourStar +1)
	@else
		@php($fiveStar = $fiveStar +1)
	@endif
	@php($totalRating = $totalRating +1)
	@if($Review->review != "")
		@php($totalReview = $totalReview + 1)
	@endif
    temp = {};
    temp['Review'] = "{{ $Review->review }}";
    temp['Rating'] = "{{ $Review->rating }}";
    temp['Name'] = "{{ $Review->userName }}";
    temp['UserID'] = "{{ $Review->userId }}";
    temp['Date'] = "{{ $Review->created_at }}";
    tempReviews.push(temp);
@endforeach
new Vue({
	el:'#PageContent',
	data:{
		Reviews : tempReviews,
		oneStar : {{ $oneStar }}, 
		twoStar : {{ $twoStar }},
		threeStar : {{ $threeStar }}, 
		fourStar : {{ $fourStar }},
		fiveStar : {{ $fiveStar }},
		totalReview : {{ $totalReview }},
		totalRating : {{ $totalRating }},
		// Tabs
		AboutTab : true,
		AppliedCasesTab : false,
		ReviewsTab : false,
		Tabs : [
			{ 'TabName' : 'About', 'isActive' : true },
			{ 'TabName' : 'Applied', 'isActive' : false },
			{ 'TabName' : 'Reviews', 'Counter' : {{ $totalRating }}, 'isActive' : false }
		]
	},
	computed:{
		averageRating:function(){
			var temp = ((this.oneStar*1) + (this.twoStar*2) + (this.threeStar*3) + (this.fourStar*4) + (this.fiveStar*5))/this.totalRating;
			if (this.totalRating == 0) {
				return 0;
			}
			else{
				return Number(temp.toFixed(1));
			}
		},
		ratingOneProgressBar:function(){
			if (this.totalRating == 0) {
				return 0;
			}
			var temp = (this.oneStar * 100)/this.totalRating;
			temp = Math.round(temp);
			return temp;
		},
		ratingTwoProgressBar:function(){
			if (this.totalRating == 0) {
				return 0;
			}
			var temp = (this.twoStar * 100)/this.totalRating;
			temp = Math.round(temp);
			return temp;
		},
		ratingThreeProgressBar:function(){
			if (this.totalRating == 0) {
				return 0;
			}
			var temp = (this.threeStar * 100)/this.totalRating;
			temp = Math.round(temp);
			return temp;
		},
		ratingFourProgressBar:function(){
			if (this.totalRating == 0) {
				return 0;
			}
			var temp = (this.fourStar * 100)/this.totalRating;
			temp = Math.round(temp);
			return temp;
		},
		ratingFiveProgressBar:function(){
			if (this.totalRating == 0) {
				return 0;
			}
			var temp = (this.fiveStar * 100)/this.totalRating;
			temp = Math.round(temp);
			return temp;
		},
	},
	methods:{
		ChangeTab:function(SelectedTab){
			this.Tabs.forEach(tab => {
				if (tab.TabName == SelectedTab) { tab.isActive = true; } else{ tab.isActive = false; }
			});
			if (SelectedTab == "About") {
				this.AboutTab = true;
				this.AppliedCasesTab = false;
				this.ReviewsTab = false;
			}
			else if(SelectedTab == "Applied"){
				this.AppliedCasesTab = true;
				this.AboutTab = false;
				this.ReviewsTab = false;
			}
			else if(SelectedTab == "Reviews"){
				this.ReviewsTab = true;
				this.AboutTab = false;
				this.AppliedCasesTab = false;
			}
		},
	}
})
</script>
@stop