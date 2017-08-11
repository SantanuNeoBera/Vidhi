@extends('Layouts.Vidhikarya.Client.Master')
@section('title','Home')
@section('content')
<script type="text/javascript" src="js/dropzone.js"></script>
<link rel="stylesheet" type="text/css" href="css/dropzone.min.css">
<style type="text/css">
/*Overwritting. Making the Date Time Picker Label to White -----------------------*/
.picker__title{
    color:#fff !important;
}
.input-group__selections span{
	margin-left: 15px;
}
.input-group{
	margin-top: 0;
	margin-bottom: 10px;
	margin-left: 0;
	margin-right: 0;
}
.input-group.input-group--select{
	margin-bottom:4px;
	margin-top: 0;
}
#caseFormRow{
	margin:auto;
}
</style>
<div id="caseFormRow" style="width: 100%;">
<v-app>
	<div class="card" style="width: 95%; margin:auto; margin-top:5px;">
		<div class="card-header" style="margin-bottom: 5px; background-color: #009688;">
			<p class="card-header-title" style="margin-bottom: 0; color:#fff;">Hello World</p>
		</div>
		<div class="card-content">
		<form post="method">
			<!-- Case Title -->
			<div>
		          <v-text-field
		          	v-model = "caseTitle"
		          	id="caseTitle"
		            name="caseTitle"
		            :rules="caseTitleError"
		            label="Case Title"
		            prepend-icon="mode_edit"
		            hint="Type Case Title"
		          ></v-text-field>
	      	</div>

	      	<!-- Case Category -->
  			<div>
  				<v-select
	              v-bind:items="caseCategories"
	              prepend-icon='menu'
	              v-model="caseCategory"
	              label="Select"
	              dark
	              single-line
	              auto
	              :rules="caseCategoryError"
	            ></v-select>
  			</div>

  			<!-- Case Close By -->
  			<div>
  				<v-dialog style="width:100%"
			        persistent
			        v-model="modal"
			        lazy>
			        <v-text-field 
			          slot="activator"
			          label="Picker in dialog"
			          v-model="caseDueDate"
			          prepend-icon="event"
			          readonly
			          :rules="caseDueDateError"
			        ></v-text-field>
			        <v-date-picker v-model="caseDueDate" scrollable></v-date-picker>
			      </v-dialog>
  			</div>

  			<!-- Advice Only Checkboxes -->
  			<div style="position: relative; margin-bottom: 25px;">
		      	<div>
		      		<v-checkbox label="I want advice only." primary v-model="isOnlyAdvisable" hint="Mark this checkbox if you only want advice." style="margin:0;" />
		      	</div>
		      	<div style="position: absolute; top:30px; left:50px;">
		      		<p style="font-size: 13px;">Show attachements only to approved lawyers.Show attachements only to approved lawyers.Show attachements only to approved lawyers.</p>
		      	</div>
	      	</div>

	      	<!-- Post As Anonymous Checkbox -->
	      	<div style="position: relative; margin-bottom: 25px;">
		      	<div>
		      		<v-checkbox label="Post as anonymous." v-model="postAsAnonymous" style="margin:0px;"/>
		      	</div>
		      	<div style="position: absolute; top:30px; left:50px;">
		      		<p style="font-size: 13px;">Show attachements only to approved lawyers.Show attachements only to approved lawyers.Show attachements only to approved lawyers.</p>
		      	</div>
	      	</div>

	      	<!-- Show Attachment Checkbox -->
	      	<div style="position: relative; margin-bottom: 25px;">
		      	<div>
		      		<v-checkbox label="Show attachements only to approved lawyers." v-model="attachmentPrivacy" style="margin:0;" />
		      	</div>
		      	<div style="position: absolute; top:30px; left:50px;">
		      		<p style="font-size: 13px;">Show attachements only to approved lawyers.Show attachements only to approved lawyers.Show attachements only to approved lawyers.</p>
		      	</div>
	      	</div>

	      	<!-- Case Description -->
  			<div>
      			<v-text-field
		          	v-model = "caseDescription"
		            name="caseDescription"
		            id="caseDescription"
		            label="Case Description"
		            prepend-icon="mode_edit"
		            hint="Type Case Description"
		            multi-line
		            :rules="caseDescriptionError"
		          ></v-text-field>
	        </div>

	        <!-- File Uploader -->
	        <div style="margin-bottom: 10px;">
  				<p>Click on the below box to upload files - </p>
      			<form action="/file-upload"
      				class="dropzone"
      				id="my-awesome-dropzone">
				</form>
			</div>

			<!-- Button -->
	      	<div class="row end-md">
                <v-btn v-on:click.native='RegisterTheCase' primary light class = "btn--light-flat-focused green darken-3">Next</v-btn>
            </div>
        </form>
        <div id="Status"></div>
	    </div>
	</div>
</v-app>
<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" persistent width="400px">
    	<v-btn primary light slot="activator" style="display:none;" id="DialogTrigger">Open Dialog</v-btn>
      <v-card>
        <v-card-row>
          <v-card-title> Case Id : <code>@{{ caseId }}</code></v-card-title>
        </v-card-row>
        <v-card-row>
          <v-card-text> Your case has been successfully submitted. Our lawyers will respond soon.</v-card-text>
        </v-card-row>
        <v-card-row actions>
          <v-btn class="green--text darken-1" flat="flat" @click.native="GoToDashboard">Go to Dashboard</v-btn>
          <v-btn class="green--text darken-1" flat="flat" @click.native="ViewCaseDetails">View Case Details</v-btn>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
</div>
<script type="text/javascript">
let data={
	caseCategories : ['Hello','World'],
	
	caseTitle : '',
	caseCategory : '',
	caseDescription : '',
	caseDueDate : '',
	isOnlyAdvisable : '',
	attachmentPrivacy : '',
	postAsAnonymous : '',

	caseTitleHasError : false,
	caseCategoryHasError : false,
	caseDescriptionHasError : false,
	caseDueDateHasError : false,	

	caseTitleErrorMessage : '',
	caseCategoryErrorMessage : '',
	caseDescriptionErrorMessage: '',
	caseDueDateErrorMessage : '',

	modal : false,
	dialog : false,
	caseId : '',
};
var caseForm = new Vue({
	el : '#caseFormRow',
	data : data,
	computed:{
		caseTitleError : function(){
            if (this.caseTitleHasError == true) {
                var tmp = [];
                tmp.push(this.caseTitleErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        caseCategoryError : function(){
            if (this.caseCategoryHasError == true) {
                var tmp = [];
                tmp.push(this.caseCategoryErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        caseDueDateError : function(){
            if (this.caseDueDateHasError == true) {
                var tmp = [];
                tmp.push(this.caseDueDateErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
        caseDescriptionError : function(){
            if (this.caseDescriptionHasError == true) {
                var tmp = [];
                tmp.push(this.caseDescriptionErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        },
	},
	methods:{
        GoToDashboard:function(){
            window.location="Dashboard";
        },
        ViewCaseDetails:function(){
            window.location="CaseDetails/"+this.caseId;
        },
		RegisterTheCase:function(){
            let formData={
                'caseTitle' : this.caseTitle,
                'caseDescription' : this.caseDescription,
                'caseCategory' : this.caseCategory,
                'caseDueDate' : this.caseDueDate,
                'isOnlyAdvisable' : this.isOnlyAdvisable,
                'attachmentPrivacy' : this.attachmentPrivacy,
                'postAsAnonymous' : this.postAsAnonymous,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                    type: "post",
                    url: "/RegisterTheCase",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var ReturnedData=JSON.parse(JSON.stringify(data));
                        this.caseTitleHasError = false;
						this.caseCategoryHasError = false;
						this.caseDescriptionHasError = false;
						this.caseDueDateHasError = false;
                        if ('fail' in ReturnedData) {
                            if (ReturnedData.fail == true) {
                                var Errors = ReturnedData.errors;
                                //Setting Focus
                                var firstErrorElement = Object.keys(Errors)[0];
                                $("#"+firstErrorElement).focus();
                                //-------------
                                if ('caseTitle' in Errors) {
                                    this.caseTitleHasError = true;
                                    this.caseTitleErrorMessage=Errors.caseTitle[0];
                                }
                                if ('caseCategory' in Errors) {
                                    this.caseCategoryHasError = true;
                                    this.caseCategoryErrorMessage=Errors.caseCategory[0];
                                }
                                if ('caseDueDate' in Errors) {
                                    this.caseDueDateHasError = true;
                                    this.caseDueDateErrorMessage=Errors.caseDueDate[0];
                                }
                                if ('caseDescription' in Errors) {
                                    this.caseDescriptionHasError = true;
                                    this.caseDescriptionErrorMessage=Errors.caseDescription[0];
                                }
                            }
                        }
                        else{
                            if (ReturnedData.Status == 'Registered') {
                            	$("#DialogTrigger").trigger("click");
                            	this.caseId = ReturnedData.caseId;
                            }
                        }
                    }.bind(this),
                    error: function (data) {
                        $("#Status").append(JSON.stringify(data));
                    }.bind(this)
                });
        },
	}
});
</script>
@stop