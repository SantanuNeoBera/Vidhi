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
              <v-card-text class="UpdateCaseInfoContainer">

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
                        <p class="CheckboxDescription">Show attachements only to approved lawyers.Show attachements only to approved lawyers.Show attachements only to approved lawyers.</p>
                    </div>
                </div>

                <!-- Post As Anonymous Checkbox -->
                <div style="position: relative; margin-bottom: 25px;">
                    <div>
                        <v-checkbox label="Post as anonymous." v-model="temppostAsAnonymous" style="margin:0px;"/>
                    </div>
                    <div style="">
                        <p class="CheckboxDescription">Show attachements only to approved lawyers.Show attachements only to approved lawyers.Show attachements only to approved lawyers.</p>
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
                        <p class="CheckboxDescription">Show attachements only to approved lawyers.Show attachements only to approved lawyers.Show attachements only to approved lawyers.</p>
                    </div>
                </div>

              </v-card-text>
            </v-card-row>
          </v-card>
        </v-dialog>
      </v-layout>
    </template>
</div>