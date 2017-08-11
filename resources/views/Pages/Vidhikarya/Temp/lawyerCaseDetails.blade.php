		<div>
			<!-- Header -->
			<div class="row RowStyle between-md" style="padding:0px;  border-right: 0;">
				<!-- Column -1 -->
				<div v-if="postAsAnonymous">
					<v-icon>perm_identity</v-icon><span style="padding-left: 5px; margin-top: 10px;">Anonymous</span>
				</div>
				<div v-else class="col-md-3 LabelColStyle" style="padding: 0px; border-right:0px !important; background-color: rgb(250, 251, 252);">
					<div style="float:left; height:36px;">
						<img src="{{ URL::asset('images/4.jpg') }}" style="height: inherit; width:36px; padding: 0px; margin:0px;">
					</div>
					<div style="float: left; background:linear-gradient(-180deg, #fafbfc 30%, #eff3f6 60%); padding-right: 10px; border-right:1px solid rgba(34,36,38,.15); height:36px; line-height: 35px;">
						<a href="profile/{{ $userDetails->id }}" style="font-size: 16px; padding-left:15px; color: #23d160;">{{ $userDetails->firstName.' '.$userDetails->middleName.' '.$userDetails->lastName }}</a>
					</div>
				</div>
				<div class="col-sm-9 LabelColStyle" style="padding: 0px; background-color: #fafbfc;">

<!-- See Attachments Dialog-->
<div style="float:right;">
<template>
  <v-layout style="margin:0px; border-radius: 0;">
    <v-dialog v-model="SeeAttachmentsDialog" fullscreen transition="v-dialog-bottom-transition" scrollable :overlay=false>
    
      <v-btn slot="activator" class="updateButton"><v-icon class="caseButtonIconStyle">attach_file</v-icon><span>See Attached Files</span></v-btn>

      <v-card>
        <v-card-row>
              <v-toolbar>
	            <v-btn icon="icon" @click.native="SeeAttachmentsModalClosed" light>
	              <v-icon>close</v-icon>
	            </v-btn>
	            <v-toolbar-title>All Attachments</v-toolbar-title>
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
				</div>
			</div>

			<!-- Case Id | Case Status  -->
			<div class="row RowStyle" style="padding:0px; border-top: 0;">
				<!-- Column -1 -->
				<div class="col-md-2 LabelColStyle">
					<span>Case ID</span>
				</div>
				<!-- Column -2 -->
				<div class="col-md-4 LabelValueStyle">
					<span><code>{{ $TheCase->displayId }}</code></span>
				</div>
				<!-- Column -3 -->
				<div class="col-md-2 LabelColStyle" style="border-left:1px solid rgba(34,36,38,.15);">
					<span>Case Status</span>
				</div>
				<!-- Column -4 -->
				<div class="col-md-4 LabelValueStyle">
					<span><code style="color:#43a047; font-size:13px;">Open</code></span>
				</div>
			</div>

			<!-- Name | Case Due Date  -->
			<div class="row RowStyle" style="padding:0px; border-top: 0;">
				<!-- Column -1 -->
				<div class="col-md-2 LabelColStyle">
					<span>Posted By</span>
				</div>
				<!-- Column -2 -->
				<div class="col-md-4 LabelValueStyle">
					<a href="profile/{{ $userDetails->id }}">{{ $userDetails->firstName.' '.$userDetails->middleName.' '.$userDetails->lastName }}</a>
				</div>
				<!-- Column -3 -->
				<div class="col-md-2 LabelColStyle" style="border-left:1px solid rgba(34,36,38,.15);">
					<span>Case Due Date</span>
				</div>
				<!-- Column -4 -->
				<div class="col-md-4 LabelValueStyle">
					<span>@{{ caseDueDate }}</span>
				</div>
			</div>

			<!-- Case Category |  Advice Only Checkbox -->
			<div class="row RowStyle" style="padding:0px; border-top: 0;">
				<!-- Column -1 -->
				<div class="col-md-2 LabelColStyle">
					<span>Case Category</span>
				</div>
				<!-- Column -2 -->
				<div class="col-md-4 LabelValueStyle">
					<span>{{ $TheCase->caseCategory }}</span>
				</div>
				<!-- Column -3 -->
				<div class="col-md-2 LabelColStyle" style="border-left:1px solid rgba(34,36,38,.15)">
					<span>Case Type</span>
				</div>
				<!-- Column -2 -->
				<div class="col-md-4 LabelValueStyle">
					<span v-if="isOnlyAdvisable">Advice Only</span>
					<span v-else>Full Leagal Service</span>
				</div>
			</div>

			<!-- Attachment Privacy |  Post As Anonymous -->
			<div class="row RowStyle" style="padding:0px; border-top: 0;">
				<!-- Column -3 -->
				<div class="col-md-2 LabelColStyle" style="border-left:1px solid rgba(34,36,38,.15)">
					<span>Post As Anonymous</span>
				</div>
				<!-- Column -2 -->
				<div class="col-md-4 LabelValueStyle">
					<span v-if="postAsAnonymous">Personal Details is Shown Only to Approved Lawyers.</span>
					<span v-else>Personal Details is Visible to All Lawyers.</span>
				</div>
			</div>

			<!-- Case Title -->
			<div class="row RowStyle" style="padding:0px; border-top: 0;">
				<!-- Column -1 -->
				<div class="col-md-2 LabelColStyle">
					<span>Case Title</span>
				</div>
				<!-- Column -2 -->
				<div class="col-md-2 LabelValueStyle">
					<span>{{ $TheCase->caseTitle }}</span>
				</div>
			</div>

			<!-- Case Description -->
			<div class="row RowStyle" style="padding:0px; border-top: 0;">
				<!-- Column -1 -->
				<div class="col-md-2 LabelColStyle">
					<span>Case Description</span>
				</div>
				<!-- Column -2 -->
				<div class="col-md-2 LabelValueStyle">
					<span>{{ $TheCase->caseDescription }}</span>
				</div>
			</div>

			<!-- Notes -->
            <div class="row RowStyle" style="padding:0px; border-top: 0;">
                <!-- Column -1 -->
                <div class="col-md-2 LabelColStyle">
                    <span>Notes</span>
                </div>
                <!-- Column -2 -->
                <div class="col-md-10 LabelValueStyle">
                    <v-card v-for="Note in CaseNotes">
                      <v-card-text>
                        <div>
                            <div>
                                <p>
                                  <span v-html="Note.Note"></span><br><span style="font-size:13px;">@{{ Note.Date }}</span>
                                </p>
                            </div>
                        </div>
                      </v-card-text>
                    </v-card>
                </div>
            </div>
			<div id='Status'></div>
		</div>
<template>
  <v-layout row justify-center>
    <v-dialog v-model="ApplyToCaseStatusDialog">
      <v-btn primary light slot="activator" id='ApplyToCaseStatusDialogTriggerButton' style="display:none;">Open Dialog</v-btn>
      <v-card>
        <v-card-row>
          <v-card-title>You have successfully applied to this case.</v-card-title>
        </v-card-row>
        <v-card-row>
          <v-card-text>Thank you for applying to this case. Please wait for the client to approve your submission to work with the case.</v-card-text>
        </v-card-row>
        <v-card-row actions>
          <v-btn class="green--text darken-1" flat="flat" @click.native="ApplyToCaseStatusDialogButton">Okay</v-btn>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>


