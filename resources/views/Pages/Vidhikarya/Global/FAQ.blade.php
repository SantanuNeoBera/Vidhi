@extends('Layouts.Vidhikarya.Lawyer.Master')
@section('title','Case Details')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/animate.css') }}">
<style type="text/css">
#PageContent{
	width: 70%;
	margin:auto;
	margin-top: 50px;
	margin-bottom: 50px;
}
#Question{
	width:100%;
	display: flex;
	justify-content: flex-start;
	align-items: center;
	padding: 10px;
	background: #333;
	cursor: pointer;
	position: relative;
}
.Answer{
	background: #eee;
	box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  	border-bottom-right-radius: 5px;
  	border-bottom-left-radius: 5px;
}
.QuestionBlock{
	margin-bottom: 20px;
}
.animated{
	animation-duration: 500ms;
}
</style>
<div id="PageContent">
<div id="Accordion">
<neo-accordion id="Question2">
	<div slot="Title">
		My Title
	</div>
	<div slot="Content">
		My Content
	</div>
</neo-accordion>

<neo-accordion id="Question3">
	<div slot="Title">
		My Title 1
	</div>
	<div slot="Content">
		My Content 1
	</div>
</neo-accordion>

</div>
</div>
<script type="text/javascript">
Vue.component('neoAccordion',{
	props:['id'],
	template:`
<div :id="id" class="QuestionBlock">
	<div id="Question" v-on:click="ExpandContent">
		<span style="color: #fff; font-size: 18px; flex-basis: 80%;">
			<slot name="Title"></slot>
		</span>
		<div style="flex-basis: 20%; display: flex; justify-content: flex-end; flex-grow: 1;">
			<i style="color:#fff;" class="material-icons" :id="id+'Icon'">keyboard_arrow_down</i>
		</div>
	</div>
	<div :id="id+'Answer'" class="Answer animated" v-show="AnswerVisible">
		<p style="padding: 20px; color:black;">
			<slot name="Content"></slot>
		</p>
	</div>
</div>
`,
data:function(){
	return {
		AnswerVisible : false
	};
},
methods:{
ExpandContent:function(){
	if (this.AnswerVisible == true) {
		$("#"+this.id+"Answer").removeClass('slideInUp');
		$("#"+this.id+"Icon").html('keyboard_arrow_down');
		this.AnswerVisible = false;
	}
	else{
		this.AnswerVisible = true;
		$("#"+this.id+"Answer").addClass('slideInUp');
		$("#"+this.id + "Icon").html('keyboard_arrow_up');
	}
}
}
});
new Vue({
	el:'#PageContent',
	data:{
		Question1Visible : false,
		Question2Visible : false,
	},
	methods:{
	}
})
</script>
@stop