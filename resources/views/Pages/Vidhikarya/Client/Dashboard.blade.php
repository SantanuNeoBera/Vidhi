@extends('Layouts.Vidhikarya.Client.Master')
@section('title','Dashboard')
@section('content')
<style type="text/css">
#AllCases{
	width: 50%;
	margin:auto;
	padding-top: 20px;
}
.CaseCardStyle{
	margin-bottom: 20px;
}
</style>
<div id="PageContent">
	<!-- All Cases -->
	<div id="AllCases">
		<v-card v-for="Case in Cases" class="CaseCardStyle">
		    <v-card-row class="green darken-1">
		      <v-card-title>
		        <span class="white--text">@{{ Case.caseCategory }}</span>
		        <v-spacer></v-spacer>
		        <div>
		          <div>@{{ Case.caseStatus }}</div>
		        </div>
		      </v-card-title>
		    </v-card-row>
		    <v-card-text>
		        <div>
		        	<div>@{{ Case.caseId }}</div>
		          <div>@{{ Case.caseTitle }}</div>
		          <div>@{{ Case.caseDueDate }}</div>
		        </div>
		    </v-card-text>
		    <v-divider style="margin:0;"></v-divider>
		    <v-card-row actions>
		      <a flat class="green--text darken-1" :href="'{{ url('CaseDetails') }}/'+Case.caseId">View Details</a>
		    </v-card-row>
		  </v-card>
	</div>
</div>
<script type="text/javascript">
var tempCases = [];
@foreach($Cases as $Case)
    temp = {};
    temp['caseId'] = "{{ $Case->id }}";
    temp['caseTitle'] = "{{ $Case->caseTitle }}";
    temp['caseCategory'] = "{{ $Case->caseCategory }}";
    temp['caseDueDate'] = "{{ $Case->caseDueDate }}";
    temp['caseStatus'] = "{{ $Case->caseStatus }}";
    tempCases.push(temp);
@endforeach
let data={
	Cases : tempCases,
}
new Vue({
	el:'#PageContent',
	data:data,
	methods:{
	}
})
</script>
@stop