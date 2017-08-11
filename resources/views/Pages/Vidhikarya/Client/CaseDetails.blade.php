@extends('Layouts.Vidhikarya.Client.Master')
@section('title','Case Details')
@section('content')
<style type="text/css">
  /* Chat Style -----------------*/

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
    /* Profile Card --------- */
    .ProfileCard{
        width: 100%;
        margin-bottom: 30px;
        border:1px solid #ddd;
    }
    .ProfileCard .CardHeader{
        display: flex; 
        padding:5px; 
        border-bottom: 1px solid #ddd;
    }
    .ProfileCard .Image{
        flex-basis: 70px;
        height: 70px;
        padding:5px
    }
    .ProfileCard .HeaderContent{
        flex-basis:300px;
        flex-grow: 1;
    }
    .ProfileCard .Icons{
        font-size: 15px; 
        position: relative; 
        top: 3px;
    }
    .ProfileCard .CardContent{
        padding: 15px; 
        position: relative;
    }
    /* End of Profile Card -------------*/
    /*Overwritting. Making the Date Time Picker Label to White -----------------------*/
    .picker__title{
        color:#fff !important;
    }
    /*Removing the default box shadow for Case Update Button*/
    .btn--raised{
        box-shadow: none;
    }
    /*Overwritting Style for FullScreen Modal Box*/
    .card__row{
    min-height: 0;
    }
    /*End Overwritting -------------------------*/
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
    #PageContent{
        padding:20px;
        width: 100%;
        display: flex;
    }
    .TheLabel{
         background-color:rgba(0,0,0,.03);
         border:1px solid rgba(34,36,38,.15) !important;
    }
    .RowStyle{
        border:1px solid rgba(34,36,38,.15);
        padding:0;
        border-right: 0;
    }
    .NameDisplay{
        float:left;
        background:linear-gradient(-180deg, #fafbfc 30%, #eff3f6 60%); 
        padding-right: 10px; 
        border-right:1px solid rgba(34,36,38,.15); 
        height:36px; 
        line-height: 35px;
    }
    .UpdateCaseInfoContainer{
        width: 60%;
        margin:auto;
    }
    .NameDisplay a{
        font-size: 16px; 
        padding-left:15px; 
        color: #23d160;
    }
    .LabelColStyle{
        background-color:rgba(0,0,0,.03);
        border-right:1px solid rgba(34,36,38,.15) !important;
        padding:5px;
    }
    .NamePictureDisplay{
        padding: 0px;
        border-right:0px !important;
        background-color: rgb(250, 251, 252);
    }
    .LabelValueStyle{
        padding: 5px;   
        border-right:1px solid rgba(34,36,38,.15) !important;
    }
    .HeadingStyle{
        font-size: 25px; 
        background-color: #3273dc; 
        border-radius: 5px; 
        margin-top:20px; 
        color:#fff; 
        padding: 10px;"
    }
    img{
        height: inherit;
        width:36px;
        padding: 0px;
        margin:0px;
    }
    code{
        box-shadow: 1px 1px 3px rgba(0,0,0,.2), 1px 1px 1px rgba(0,0,0,.14), 1px 2px 1px -1px rgba(0,0,0,.12);
        background-color: #f5f5f5;
        border-radius: 0;
    }
    .updateButton{
        background:linear-gradient(-180deg, #fafbfc 30%, #eff3f6 60%);
        border-left:1px solid rgba(34,36,38,.15);
        margin: 0px; 
        border-radius: 0;
        height:36px;
        padding-left:10px;
        padding-right:10px;
        font-size: 12px;
    }
    .updateButton:hover{
        background:linear-gradient(-180deg, #fafbfc 30%, #eff3f6 60%) !important;
        box-shadow:inset 0 0.15em 0.3em rgba(27,31,35,0.15);
    }
    .caseButtonIconStyle{
        font-size:20px;
        padding-right: 5px;
    }
    .CheckboxDescription{
        font-size: 13px;
    }
    small {
    display: block;
    line-height: 1.428571429;
    color: #999;
    }
</style>
<style type="text/css">
  #CaseContainer{
      margin-left: 10px;
      width: 50%;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      border-radius: 5px;
      flex-basis: 50%;
      margin-right: 30px;
  }
  #LawyersTab{
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      border-radius: 5px;
      margin-bottom: 50px;
  }
  /*Tab Style -----------------------------------------------------------------*/
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
  /* End of Tab Style -----------------------------------------------------------*/

  /* Information Template Style --------------------------------------*/
  .Section{
    margin-bottom: 30px;
  }
  .Section .Heading{
    font-size: 17px; 
    font-weight: bold; 
    color: #90949c; 
    text-transform: uppercase;
  }
  .EditIcon{
    color: #90949c;
    font-size: 16px;
    cursor: pointer;
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
  /* End of Information Template Style ------------------------------------------*/

  input{
        height:30px;
        width: 95%;
        outline:none;
        padding: 5px;
    }
</style>
<div id="PageContent">
    <div id="CaseContainer">

        <!-- Tabs -->
        <div class="DashboardNav">
            <nav class="DashboardNavBar">
                <div class="Tabs">
                    <neo-tab v-for="tab in Tabs" :data="tab" :tab-name="tab.TabName" @changed="ChangeTab"></neo-tab>
                </div>
            </nav>
        </div>

        <!-- Case Details Tab -->
        <div id="CaseDetailsTab"  v-show="CaseDetailsTab">
            <div id="CaseDetailsSection" style="padding: 20px;">

                <!-- Case Details Information -->
                <div class="Section">
                    <div style="position: relative;">
                      <span class="Heading">
                        Case Information
                      </span>
                    </div>
                    <v-divider style="margin:0;"></v-divider>

                    <!-- Case Id -->
                    <div class="InfoRow">
                      <div style="flex:1;">
                        <span class="RowLabel">Case ID</span>
                      </div>
                      <div style="flex:3;">
                        <span class="RowValue"> {{ $TheCase->displayId }} </span>
                      </div>
                    </div>
                    <v-divider style="margin:0;"></v-divider>

                    <!-- Case Status -->
                    <div class="InfoRow">
                      <div style="flex:1;">
                        <span class="RowLabel">Case Status</span>
                      </div>
                      <div style="flex:3;">
                        <span class="RowValue"> Open </span>
                      </div>
                    </div>
                    <v-divider style="margin:0;"></v-divider>

                    <!-- Posted By -->
                    <div class="InfoRow">
                      <div style="flex:1;">
                        <span class="RowLabel">Registered By</span>
                      </div>
                      <div style="flex:3;">
                        <span class="RowValue"> <a href="{{ url('myProfile') }}">{{ $userDetails->firstName.' '.$userDetails->middleName.' '.$userDetails->lastName }}</a> </span>
                      </div>
                    </div>
                    <v-divider style="margin:0;"></v-divider>

                    <!-- Case Due Date -->
                    <div class="InfoRow">
                      <div style="flex:1;">
                        <span class="RowLabel">Case Due Date</span>
                      </div>
                      <div style="flex:3;">
                        <span class="RowValue"> @{{ caseDueDate }} </span>
                      </div>
                    </div>
                    <v-divider style="margin:0;"></v-divider>

                    <!-- Case Category Level -->
                    <div class="InfoRow">
                      <div style="flex:1;">
                        <span class="RowLabel">Case Category</span>
                      </div>
                      <div style="flex:3;">
                        <span class="RowValue"> {{ $TheCase->caseCategory }} </span>
                      </div>
                    </div>
                    <v-divider style="margin:0;"></v-divider>

                    <!-- Case Type -->
                    <div class="InfoRow">
                      <div style="flex:1;">
                        <span class="RowLabel">Case Type</span>
                      </div>
                      <div style="flex:3;">
                        <span v-if="isOnlyAdvisable" class="RowValue">Advice Only</span>
                        <span v-else class="RowValue">Full Leagal Service</span>
                      </div>
                    </div>
                    <v-divider style="margin:0;"></v-divider>

                    <!-- Attachment Privacy -->
                    <div class="InfoRow">
                      <div style="flex:1;">
                        <span class="RowLabel">Attachment Privacy</span>
                      </div>
                      <div style="flex:3;">
                        <span v-if="attachmentPrivacy" class="RowValue">Only Approved Lawyers</span>
                        <span v-else class="RowValue">All Lawyers</span>
                      </div>
                    </div>
                    <v-divider style="margin:0;"></v-divider>

                    <!-- Post As Anonymous -->
                    <div class="InfoRow">
                      <div style="flex:1;">
                        <span class="RowLabel">Post As Anonymous</span>
                      </div>
                      <div style="flex:3;">
                            <span v-if="postAsAnonymous" class="RowValue">Personal Details is Shown Only to Approved Lawyers.</span>
                            <span v-else class="RowValue">Personal Details is Visible to All Lawyers.</span>
                      </div>
                    </div>
                    <v-divider style="margin:0;"></v-divider>

                    <!-- Case Title -->
                    <div class="InfoRow">
                      <div style="flex:1;">
                        <span class="RowLabel">Case Title</span>
                      </div>
                      <div style="flex:3;">
                            <span class="RowValue">{{ $TheCase->caseTitle }}</span>
                      </div>
                    </div>
                    <v-divider style="margin:0;"></v-divider>

                    
                    <!-- Case Description -->
                    <div class="InfoRow">
                      <div style="flex:1;">
                        <span class="RowLabel">Case Description</span>
                      </div>
                      <div style="flex:3;">
                            <span class="RowValue">{{ $TheCase->caseDescription }}</span>
                      </div>
                    </div>
                    <v-divider style="margin:0;"></v-divider>
                </div>
            </div>
        </div>

        <!-- Case Notes Tab -->
        <div id="CaseNotesTab" v-show="CaseNotesTab">
            <div id="NoteForm" style="padding: 10px;">
                <form onsubmit="return false">
                    <div style="display: flex;">
                        <div style="flex-basis: auto; flex-grow: 1;">
                            <input v-model="newNote" v-on:keyup.enter="addNewNote" placeholder="Type Your Notes Here !" type="text" name="newNote">
                        </div>
                        <div style="flex-basis: auto;">
                            <a class="button is-light" style="height:inherit;" v-on:click='addNewNote'>Add Note</a>
                        </div>
                    </div>
                </form>
            </div>
            <v-divider style="margin: 0;"></v-divider>
            <div id="Notes" v-if="hasAnyNote">
                <v-card v-for="Note in CaseNotes">
                  <v-card-text style="padding-top:5px; padding-bottom: 5px;">
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
            <div v-else style="height: 300px; width: 100%; display: flex; justify-content: center; align-items: center;">
                <span style="font-size: 30px;">No Notes</span>
            </div>
        </div>

        <!-- Case Files Tab -->
        <div id="CaseFilesTab" v-show="CaseFilesTab">
            <h1>Files Tab</h1>
        </div>

        <div id="ChatTab" v-show="ChatTab">
          <div id="ChatContent" v-if="hasApprovedLawyer">
            <div id="ChatHeader">
              <span>@{{ LawyerName }}</span>
            </div>
            <div id="Messages">
              <message v-for="(Message, index) in Messages"
                :key = 'index'
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
          <div v-else style="display: flex; justify-content: center; align-items: center; width: 100%; height: 200px;"> 
            <h1>You haven't Approved Any Lawyers Yet</h1>
          </div>
        </div>

        <div id="TimelineTab" v-show="TimelineTab" style="padding: 20px;">
            <div style="width: 100%; height: 500px;">
              
            </div>
            <div style="display:flex;justify-content:flex-end;">
                
            </div>
        </div>
    </div>

    <div id="LawyersRel" style="flex-basis: 45%;">
        <div id="LawyersTab">

            <!-- Tabs -->
            <div class="DashboardNav">
                <nav class="DashboardNavBar">
                    <div class="Tabs">
                        <neo-tab v-for="tab in ApplyTabs" :data="tab" :tab-name="tab.TabName" @changed="ChangeApplyTab"></neo-tab>
                    </div>
                </nav>
            </div>

            <!-- Applied Lawyers Tab -->
            <div id="AppliedLawyersTab" v-show="AppliedLawyersTab" style="padding:20px; height: 530px; overflow-y: scroll;">

                    <!-- Client Payments Aggrements -->
                    <div id="PaymentsContainer">
                      <!-- Case Id -->
                      @if($hasPayments == true)
                        <h1>Payments</h1>
                        <pay-aggrement-table :data="PaymentAggrement" v-on:clientpay="ClientPay"></pay-aggrement-table>
                      @endif
                    </div>
                <!-- Showing Applied Lawyers -->
                <div>
                    @php($totalNumberOfAppliedLawyers = 0)
                    @if($hasAnyAppliedLawyers)
                      @foreach($AppliedLawyers as $Lawyer)
                          @php($totalNumberOfAppliedLawyers++)
                          <div class="ProfileCard">
                              <div class="CardHeader">
                                  <img class="Image" src="{{ URL::asset('images/John_Doe.png') }}" alt=""/>
                                  <div class="HeaderContent">
                                      <h4 style="margin-bottom: 0;">{{ $Lawyer->firstName }}</h4>
                                      <small>
                                          <cite title="San Francisco, USA">
                                               <i class="material-icons Icons">location_on</i>
                                                  San Francisco, USA
                                               <i class="material-icons Icons">language</i>
                                                  <a href="http://google.com">www.google.com</a>
                                          </cite>
                                      </small>
                                  </div>
                              </div>
                              <div class="CardContent">
                                  <div>
                                          
                                  </div>
                                  <p> 
                                      <small style="font-size: 15px;">
                                          <i class="material-icons Icons">payment</i>
                                          Payment :
                                          <span style="color: #333; padding-left: 10px;">Fixed</span>
                                      </small>
                                      <i class="material-icons Icons">email</i>
                                          email@example.com
                                      <br />
                                      <i class="material-icons Icons">language</i>
                                          <a href="http://google.com">www.google.com</a>
                                      <br />
                                  </p>
                                  <div style="display: flex; justify-content: flex-end; position: absolute; bottom: 10px; right: 20px;">
                                      <a class="button is-info" href="{{ url('LawyerProfile') }}/{{ $Lawyer->id }}">View Details</a>
                                      @if($TheCase->caseStatus == "Open")
                                        <a class="button is-primary" style="margin-left: 20px;" v-on:click="ApproveThisLawyer(' {{ $Lawyer->id }} ')">Approve</a>
                                      @endif
                                  </div>
                                  <div style="height: 40px; width: 100%;"></div>
                              </div>
                              <!-- Split button -->
                          </div>
                      @endforeach
                    @endif
                    <div id="LawyerApproveStatus"></div>
                    @if($hasAnyAppliedLawyers)
                        <span style="color:red; font-size: 30px;">No lawyer has applied yet !</span>
                    @endif
                </div>
            </div>

            <!-- Approved Lawyers Tab -->
            <div id="ApprovedLawyersTab" v-show="ApprovedLawyersTab"  style="padding: 20px;">
                @if($lawyerEngaged)
                    <div class="ProfileCard">
                        <div class="CardHeader">
                            <img class="Image" src="{{ URL::asset('images/John_Doe.png') }}" alt=""/>
                            <div class="HeaderContent">
                                <h4 style="margin-bottom: 0;">{{ $ApprovedLawyer->firstName }}</h4>
                                <small>
                                    <cite title="San Francisco, USA">
                                         <i class="material-icons Icons">location_on</i>
                                            San Francisco, USA
                                         <i class="material-icons Icons">language</i>
                                            <a href="http://google.com">www.google.com</a>
                                    </cite>
                                </small>
                            </div>
                        </div>
                        <div class="CardContent">
                            <p> 
                                <small style="font-size: 15px;">
                                    <i class="material-icons Icons">payment</i>
                                    Payment :
                                    <span style="color: #333; padding-left: 10px;">Fixed</span>
                                </small>
                                <i class="material-icons Icons">email</i>
                                    email@example.com
                                <br />
                                <i class="material-icons Icons">language</i>
                                    <a href="http://google.com">www.google.com</a>
                                <br />
                            </p>
                            <div style="display: flex; justify-content: flex-end; position: absolute; bottom: 10px; right: 20px;">
                                <a class="button is-info" style="" href="{{ url('LawyerProfile') }}/{{ $ApprovedLawyer->id }}">View Details</a>    
                            </div>
                            <div style="height: 40px; width: 100%;"></div>
                        </div>
                        <!-- Split button -->
                    </div>
                @endif
                @if($lawyerEngaged == false)
                    <div style="width: 100%; height: 300px; display: flex; justify-content: center; align-items: center;">
                        <span style="font-size: 22px; padding:50px;">You haven't approved any lawyers to work on this case. Please go to the "Applied Lawyers" tab and select a lawyer of your choice.</span>
                    </div>
                @endif
            </div>
        </div>
        <div class="ui styled accordion">
          <div class="title">
            <i class="dropdown icon"></i>
            What is a dog?
          </div>
          <div class="content">
            <p class="transition hidden">A dog is a type of domesticated animal. Known for its loyalty and faithfulness, it can be found as a welcome guest in many households across the world.</p>
          </div>
          <div class="title">
            <i class="dropdown icon"></i>
            What kinds of dogs are there?
          </div>
          <div class="content">
            <p class="transition hidden">There are many breeds of dogs. Each breed varies in size and temperament. Owners often select a breed of dog that they find to be compatible with their own lifestyle and desires from a companion.</p>
          </div>
          <div class="title">
            <i class="dropdown icon"></i>
            How do you acquire a dog?
          </div>
          <div class="content">
            <p class="transition hidden">Three common ways for a prospective owner to acquire a dog is from pet shops, private owners, or shelters.</p>
            <p class="transition hidden">A pet shop may be the most convenient way to buy a dog. Buying a dog from a private owner allows you to assess the pedigree and upbringing of your dog before choosing to take it home. Lastly, finding your dog from a shelter, helps give a good home to a dog who may not find one so readily.</p>
          </div>
        </div>
    </div>
    <div id='Status'></div>

<!-- Confirmation Message for Approving Lawyer  -->
<template>
  <v-layout row justify-center>
    <v-dialog v-model="confirmApproveDialog">
      <v-btn primary light slot="activator" id="confirmApproveDialogTrigger" style="display: none;">
        Open Dialog
      </v-btn>
      <v-card>
        <v-card-row>
          <v-card-title>Confirm</v-card-title>
        </v-card-row>
        <v-card-row>
          <v-card-text>Are you sure you want to approve this lawye to work on this case ?</v-card-text>
        </v-card-row>
        <v-card-row actions>
          <v-btn class="green--text darken-1" flat="flat" @click.native="confirmApproveDialogDisagree">Disagree</v-btn>
          <v-btn class="green--text darken-1" flat="flat" @click.native="confirmApproveDialogAgree">Agree</v-btn>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<!-- Dialog For Successfully lawyer approved message -->
<template>
  <v-layout row justify-center>
    <v-dialog v-model="lawyerApprovedDialog">
      <v-btn primary light slot="activator" id="lawyerApprovedDialogTrigger" style="display: none;">Open Dialog</v-btn>
      <v-card>
        <v-card-row>
          <v-card-title>Successful</v-card-title>
        </v-card-row>
        <v-card-row>
          <v-card-text>Thank you for choosing lawyer. Any More Information  --- </v-card-text>
        </v-card-row>
        <v-card-row actions>
          <v-btn class="green--text darken-1" flat="flat" @click.native="lawyerApprovedDialogOkay">Okay</v-btn>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<!-- Modal for Client Payment -->
<template>
  <v-layout row justify-center>
    <v-dialog v-model="PaymentDialog">
      <v-btn primary light slot="activator" id="PaymentDialogTrigger" style="display: none;">Open Dialog</v-btn>
      <v-card>
        <v-card-row>
          <v-card-title>Pay</v-card-title>
        </v-card-row>
        <v-card-row>
            <div style="padding: 30px; width: 100%;">
                <form action="{{ url('ClientPay') }}" method="post" id="ClientPayForm">
                  {{ csrf_field() }}
                  <input type="hidden" name="clientId" v-model="PayClientId">
                  <input type="hidden" name="lawyerId" v-model="PayLawyerId">
                  <input type="hidden" name="caseId" v-model="PayCaseId">
                  <div style="width: 100%;">
                      <v-text-field
                          name="amount"
                          style="width: 100%;"
                          v-model = "PayAmount"
                          label="Pay Amount">
                      </v-text-field>
                  </div>
                </form>
            </div>
        </v-card-row>
        <v-card-row actions>
          <v-btn class="green--text darken-1" flat="flat" @click.native="PaymentDialogClose">Close</v-btn>
          <v-btn class="green--text darken-1" flat="flat" @click.native="PaymentDialogPay">Pay</v-btn>
        </v-card-row>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

</div>

<script type="text/javascript" src="{{ url('js/neoComponent.js') }}"></script>
<script>
Vue.component('requestPayment',{
  props:[],
  template:`
      <div>

      </div>
  `,
});
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
var tempPaymentRow = [];
var tempRow = {};
@foreach($Payments as $row)
  tempRow['Amount'] = {{ $row->amount }};
  tempRow['Name'] = "{{ $row->firstName }}" + " " + "{{ $row->lastName }}";
  tempRow['clientId'] = {{ $row->clientId }};
  tempRow['lawyerId'] = {{ $row->lawyerid }};
  tempRow['caseId'] = {{ $row->forCaseId }};
  tempPaymentRow.push(tempRow);
@endforeach
var LawyerId, LawyerName, hasApprovedLawyer = false;
@if($lawyerEngaged)
  LawyerId = {!! $ApprovedLawyer->lawyerid !!};
  hasApprovedLawyer = true;
@endif
var tempNotes = [];
var tmpHasAnyNotes = false;
var tmpNumberOfNotes = 0;
var tmpNumberOfFiles = 0;
var tmpNumberOfApprovedLawyers = 0;
var tmpNumberOfAppliedLawyers = 0;
@foreach($caseNotes as $note)
    temp = {};
    temp['Note'] = "{{ $note->notes }}";
    temp['Date'] = "{{ $note->created_at }}";
    tmpHasAnyNotes = true;
    tempNotes.push(temp);
    tmpNumberOfNotes++;
@endforeach
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
    $(".checkbox .input-group__details").remove();
    $('.ui.accordion').accordion();
})
Vue.component('payAggrementTable',{
  props:['data'],
  template:`
    <table class="table is-bordered">
        <tr>
            <th>Amount</th>
            <th>Lawyer Name</th>
            <th></th>
        </tr>
        <pay-aggrement v-for="Aggrements in data" v-on:paymoney="emitdata" :data="Aggrements"></pay-aggrement>
    </table>
  `,
  methods:{
    emitdata:function(clientId, lawyerId, caseId, Amount){
      this.$emit('clientpay',clientId, lawyerId, caseId, Amount);
    }
  }
});
Vue.component('payAggrement',{
  props:['data'],
  template:`
      <tr>
          <td style="text-align: center;">@{{ data.Amount }}</td>
          <td style="text-align: center;">@{{ data.Name }}</td>
          <td style="padding:15px;">
              <a class="button is-primary" v-on:click="emitdata">Pay Now</a>
          </td>
      </tr>
  `,
  methods:{
    emitdata:function(){
      this.$emit('paymoney', this.data.clientId, this.data.lawyerId, this.data.caseId, this.data.Amount);
    }
  }
});
var tempMessages = [];
var CaseInfo = new Vue({
    el : '#PageContent',
    data:{
        // Global Case Data -------
        currentChoosenLawyer : 0,
        caseId : cId,
        clientId : "",

        // Payment Details ----------
        PaymentAggrement : tempPaymentRow,
        PayAmount : 0,
        PayClientId : 0,
        PayLawyerId : 0,
        PayCaseId : 0,

        // Chat Data -----------------
        hasApprovedLawyer : hasApprovedLawyer,
        LawyerId : LawyerId,
        LawyerName : LawyerName,
        Messages : [],
        Message : "",

        // Tabs ---------------------
        CaseDetailsTab : false,
        CaseNotesTab : false,
        CaseFilesTab : false,
        ChatTab : true,
        TimelineTab : false,

        AppliedLawyersTab : true,
        ApprovedLawyersTab : false,
        Tabs : [
                    { 'TabName' : 'Case Details', 'isActive' : false },
                    { 'TabName' : 'Notes', 'Counter' : tmpNumberOfNotes, 'isActive' : false },
                    { 'TabName' : 'Files', 'Counter' : tmpNumberOfFiles, 'isActive' : false },
                    { 'TabName' : 'Chat', 'isActive' : true},
                    { 'TabName' : 'Timeline', 'isActive' : false},

               ],

        ApplyTabs : [
                    { 'TabName' : 'Applied Lawyers', 'Counter' : {!! $totalNumberOfAppliedLawyers !!}, 'isActive' : true },
                    { 'TabName' : 'Approved Lawyer', 'isActive' : false },
               ],

        // Notes
        hasAnyNote : tmpHasAnyNotes,
        NumberOfNotes : tmpNumberOfNotes,

        //Modals
        AddAttachmentDialog : false,
        AddNoteDialog : false,
        confirmApproveDialog : false,
        lawyerApprovedDialog : false,
        PaymentDialog : false,
        PaymentRequestDialog : false,

        //Add Note ------------------
        newNote : '',

        //Display Notes -------------
        CaseNotes : tempNotes,

        // -------------
        
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
    },
    methods:{
        PaymentDialogClose:function(){
            this.PaymentDialog = false;
        },
        ClientPay:function(clientId, lawyerId, caseId, Amount){
            this.PayAmount = Amount;
            this.PayClientId = clientId;
            this.PayLawyerId = lawyerId;
            this.PayCaseId = caseId;
            setTimeout(function(){
              $("#PaymentDialogTrigger").trigger('click');
            },200);
        },
        // Tabs ---
        PaymentDialogPay: function(){
            $("#ClientPayForm").submit();
        },
        ChangeTab:function(SelectedTab){
              this.Tabs.forEach(tab => {
                if (tab.TabName == SelectedTab) { tab.isActive = true; } else{ tab.isActive = false; }
              });
              if (SelectedTab == "Case Details") {
                this.CaseDetailsTab = true;
                this.CaseNotesTab = false;
                this.CaseFilesTab = false;
                this.ChatTab = false;
                this.TimelineTab = false;
              }
              else if (SelectedTab == "Notes") {
                this.CaseNotesTab = true;
                this.CaseDetailsTab = false;
                this.CaseFilesTab = false;
                this.ChatTab = false;
                this.TimelineTab = false;
              }
              else if(SelectedTab == "Chat"){
                this.ChatTab = true;
                this.CaseNotesTab = false;
                this.CaseDetailsTab = false;
                this.CaseFilesTab = false;
                this.TimelineTab = false;
              }
              else if(SelectedTab == "Timeline"){
                this.TimelineTab = true;
                this.ChatTab = false;
                this.CaseNotesTab = false;
                this.CaseDetailsTab = false;
                this.CaseFilesTab = false;
              }
              else{
                this.CaseFilesTab = true;
                this.CaseNotesTab = false;
                this.CaseDetailsTab = false;
                this.ChatTab = false;
                this.TimelineTab = false;
              }
        },
        ChangeApplyTab:function(SelectedTab){
              this.ApplyTabs.forEach(tab => {
                if (tab.TabName == SelectedTab) { tab.isActive = true; } else{ tab.isActive = false; }
              });
              if (SelectedTab == "Applied Lawyers") {
                this.AppliedLawyersTab = true;
                this.ApprovedLawyersTab = false;
              }
              else{
                this.ApprovedLawyersTab = true;
                this.AppliedLawyersTab = false;
              }
        },
        lawyerApprovedDialogOkay:function(){
            this.lawyerApprovedDialog = false;
            location.reload();
        },
        AddNoteDialogClosed:function(){
            this.AddNoteDialog = false;
        },
        ApproveThisLawyer:function(id){
            this.currentChoosenLawyer = id;
            setTimeout(function () {
                $("#confirmApproveDialogTrigger").trigger('click');
            }, 100);
        },
        confirmApproveDialogDisagree:function(){
            this.confirmApproveDialog = false;
        },
        confirmApproveDialogAgree:function(){
            this.confirmApproveDialog = false;
            let formData={
                'lawyerId' : this.currentChoosenLawyer,
                'caseId' : this.caseId,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                type: "post",
                url: "/ApproveLawyer",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var ReturnedData=JSON.parse(JSON.stringify(data));
                    if ('Status' in ReturnedData) {
                        if (ReturnedData.Status == "Approved") {
                            $("#lawyerApprovedDialogTrigger").trigger('click');
                        }
                    }
                }.bind(this),
                error: function (data) {
                    $("#LawyerApproveStatus").append(JSON.stringify(data));
                }.bind(this)
            });
        },
        UpdateCaseInfoDialogClosed:function(){
            this.tempattachmentPrivacy = this.attachmentPrivacy;
            this.tempisOnlyAdvisable = this.isOnlyAdvisable;
            this.temppostAsAnonymous = this.postAsAnonymous;
            this.tempcaseDueDate = this.caseDueDate;
            this.hasUpdated = false;
            this.UpdateCaseInfoDialog = false;
        },
        addNewNote:function(){
            
            if (this.newNote == "") {
                return;
            }
            let formData={
                'newNote' : this.newNote,
                'caseId' : this.caseId,
                '_token': "{{csrf_token()}}"
            };
            $.ajax({
                type: "post",
                url: "/addNewNote",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var ReturnedData=JSON.parse(JSON.stringify(data));
                    if ('Status' in ReturnedData) {
                        if (ReturnedData.Status == "Added") {
                            if (this.hasAnyNote == false) {
                                this.hasAnyNote = true;
                            }
                            this.CaseNotes.unshift({'Note':this.newNote,'Date': ReturnedData.Time });
                            this.newNote = "";
                            CaseInfo.Tabs[1].Counter = this.NumberOfNotes + 1;
                            this.NumberOfNotes = this.NumberOfNotes + 1;
                        }
                    }
                }.bind(this),
                error: function (data) {
                    $("#Status").append(JSON.stringify(data));
                }.bind(this)
            });
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
        },
        SendMessage:function(){
          let formData={
                  'LawyerID': this.LawyerId,
                  'LawyerName' : this.LawyerName,
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
    }
});
$(document).ready(function(){
      let formData={
          'LawyerID' : LawyerId,
          '_token': "{{csrf_token()}}"
      };
      if (hasApprovedLawyer == true) {
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
                          CaseInfo.LawyerName = ReturnedData.LawyerName;
                          CaseInfo.Messages = [];
                          while(count<TotalMessages){
                            if (ReturnedData.LawyerId == Messages[count].senderId) {
                              CaseInfo.Messages.push({
                                'Message' : Messages[count].message,
                                'Who' : 'Receiver',
                                'When' : Messages[count].created_at
                              });
                            }
                            else{
                              CaseInfo.Messages.push({
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
        },100);
      }
});
</script>
@stop