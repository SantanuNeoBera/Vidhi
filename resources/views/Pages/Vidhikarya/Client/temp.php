@extends('Layouts.Vidhikarya.Client.Master')
@section('title','Case Details')
@section('content')


<div id="PageContent">
        

<!-- Update Case Info Dialog -->
<div style="float:right;">
<template>
  <v-layout style="margin:0px; border-radius: 0;">
    <v-dialog v-model="UpdateCaseInfoDialog" persistant fullscreen transition="v-dialog-bottom-transition" scrollable :overlay=false>
      <v-btn slot="activator" class="updateButton"><v-icon class="caseButtonIconStyle">mode_edit</v-icon><span>Edit Case</span></v-btn>
      <v-card>
        <v-card-row>
              <v-toolbar>
                <v-btn icon="icon" @click.native="UpdateCaseInfoDialogClosed" light>
                  <v-icon>close</v-icon>
                </v-btn>
                <v-toolbar-title>Update Case Details</v-toolbar-title>
                <v-btn light flat @click.native="UpdateCaseInfo">Update</v-btn>
              </v-toolbar>
        </v-card-row>
        <v-card-row style="padding-top: 20px;">
          <v-card-text>
            <!-- Status -->
            <div v-if="hasUpdated" class="notification is-success" style="padding:10px;margin-bottom:10px;">
              <strong style="color: #fff;"> Success ! </strong> Your Profile Has Been Updated !
            </div>

            <!-- Advice Only Checkboxes -->
            <div style="position: relative; margin-bottom: 25px;">
                <div>
                    <v-checkbox label="I want advice only." primary v-model="tempisOnlyAdvisable" hint="Mark this checkbox if you only want advice." style="margin:0;" />
                </div>
                <div style="">
                    <p style="font-size: 13px;">Show attachements only to approved lawyers.Show attachements only to approved lawyers.Show attachements only to approved lawyers.</p>
                </div>
            </div>

            <!-- Post As Anonymous Checkbox -->
            <div style="position: relative; margin-bottom: 25px;">
                <div>
                    <v-checkbox label="Post as anonymous." v-model="temppostAsAnonymous" style="margin:0px;"/>
                </div>
                <div style="">
                    <p style="font-size: 13px;">Show attachements only to approved lawyers.Show attachements only to approved lawyers.Show attachements only to approved lawyers.</p>
                </div>
            </div>

            <!-- Close By -->
            <div>
                <v-dialog style="width:100%"
                    v-model="modal"
                    lazy>
                    <v-text-field 
                      slot="activator"
                      label="Picker in dialog"
                      v-model="tempcaseDueDate"
                      prepend-icon="event"
                      readonly
                    ></v-text-field>
                    <v-date-picker v-model="tempcaseDueDate" scrollable></v-date-picker>
                  </v-dialog>
            </div>

            <!-- Show Attachment Checkbox -->
            <div style="position: relative; margin-bottom: 25px;">
                <div>
                    <v-checkbox label="Show attachements only to approved lawyers." v-model="tempattachmentPrivacy" style="margin:0;" />
                </div>
                <div style="">
                    <p style="font-size: 13px;">Show attachements only to approved lawyers.Show attachements only to approved lawyers.Show attachements only to approved lawyers.</p>
                </div>
            </div>

          </v-card-text>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
</div>

<!-- AddNote Dialog -->
<div style="float:right;">
<template>
  <v-layout style="margin:0px; border-radius: 0;">
    <v-dialog v-model="AddNoteDialog" fullscreen transition="v-dialog-bottom-transition" scrollable :overlay=false>
      <v-btn slot="activator" class="updateButton"><v-icon class="caseButtonIconStyle">note_add</v-icon><span>Add Note</span></v-btn>
      <v-card>
        <v-card-row>
              <v-toolbar>
                <v-btn icon="icon" @click.native="AddNoteDialogClosed" light>
                  <v-icon>close</v-icon>
                </v-btn>
                <v-toolbar-title>Update Case Details</v-toolbar-title>
              </v-toolbar>
        </v-card-row>
        <v-card-row>
          <v-card-text>
          
          </v-card-text>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
</div>

<!-- Add Attachments -->
<div style="float:right;">
<template>
  <v-layout style="margin:0px; border-radius: 0;">
    <v-dialog v-model="AddAttachmentDialog" fullscreen transition="v-dialog-bottom-transition" scrollable :overlay=false>
      <v-btn slot="activator" class="updateButton"><v-icon class="caseButtonIconStyle">attach_file</v-icon><span>Attach File</span></v-btn>
      <v-card>
        <v-card-row>
              <v-toolbar>
                <v-btn icon="icon" @click.native="ModalClosed" light>
                  <v-icon>close</v-icon>
                </v-btn>
                <v-toolbar-title>Update Case Details</v-toolbar-title>
                <v-btn light flat @click.native="UpdateCaseInfo">Update</v-btn>
              </v-toolbar>
        </v-card-row>
        <v-card-row>
          <v-card-text>

            <div> Hello World</div>

          </v-card-text>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
</div>

<script>
let cId = {{ $TheCase->id }};
let Advisable = false;
let Anonymous = false;
let Attachment = false;
let DueDate = "{{ $TheCase->caseDueDate }}";
@if($TheCase->isOnlyAdvisable == 1)
    Advisable = true;
@endif
@if($TheCase->postAsAnonymous == 1)
    Anonymous = true;
@endif
@if($TheCase->attachmentPrivacy == 'ApprovedLawyer')
    Attachment = true;
@endif
$(document).ready(function(){
    $(".input-group__details").remove();
})
var CaseInfo =new Vue({
    el : '#PageContent',
    data:{
        //Add Note ------------------
        newNote : '',
        newNoteHasError : true,
        newNoteErrorMessage : '',

        //-------
        caseId : cId,
        isOnlyAdvisable : Advisable,
        postAsAnonymous : Anonymous,
        attachmentPrivacy : Attachment,
        caseDueDate : DueDate,

        tempisOnlyAdvisable : Advisable,
        temppostAsAnonymous : Anonymous,
        tempattachmentPrivacy : Attachment,
        tempcaseDueDate : DueDate,
        UpdateCaseInfoDialog : false,
        dialog1 : false,
        hasUpdated : false,
        modal : false,

        AddAttachmentDialog : false,
        AddNoteDialog : false
    },
    computed:{
        newNoteError:function(){
            if (this.newNoteHasError == true) {
                var tmp = [];
                tmp.push(this.newNoteErrorMessage);
                return tmp;
            }
            else{
                return [];
            }
        }
    },
    methods:{
        newNoteHasValue:function(){
            this.newNoteHasError = false;
        },
        AddNoteDialogClosed:function(){
            this.AddNoteDialog = false;
        },
        AddNote:function(){

        },
        UpdateCaseInfoDialogClosed:function(){
            this.tempattachmentPrivacy = this.attachmentPrivacy;
            this.tempisOnlyAdvisable = this.isOnlyAdvisable;
            this.temppostAsAnonymous = this.postAsAnonymous;
            this.tempcaseDueDate = this.caseDueDate;
            this.hasUpdated = false;
            this.UpdateCaseInfoDialog = false;
        },
        UpdateCaseInfo:function(){
            let formData={
                'caseId' : this.caseId,
                'isOnlyAdvisable' : this.tempisOnlyAdvisable,
                'postAsAnonymous' : this.temppostAsAnonymous,
                'attachmentPrivacy' : this.tempattachmentPrivacy,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                type: "post",
                url: "/UpdateCaseInfo",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var ReturnedData=JSON.parse(JSON.stringify(data));
                    if ('Status' in ReturnedData) {
                        if (ReturnedData.Status == "Updated") {
                            this.hasUpdated = true;
                            this.isOnlyAdvisable = this.tempisOnlyAdvisable;
                            this.postAsAnonymous = this.temppostAsAnonymous;
                            this.attachmentPrivacy = this.tempattachmentPrivacy;
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
new Vue({
    el:'#temp',
    data:{
        
    }
})
</script>
@stop