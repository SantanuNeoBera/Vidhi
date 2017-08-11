// Request Payment Modal ---------------------------------------------------
Vue.component('requestPaymentModal',{
  props : ['elementData'],
  template:`
    <div>
    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialog">
          <v-btn primary light slot="activator" id="PaymentRequestDialogTrigger" style="display: none;">Open Dialog</v-btn>
          <v-card>
            <v-card-row>
              <v-card-title>Request Payment</v-card-title>
            </v-card-row>
            <v-divider style="margin:0;"></v-divider>
            <v-card-row>
                <div style="padding: 30px; width: 100%;">
                    <form>
                      <div style="width: 100%;">
                          <v-text-field
                              name="amount"
                              style="width: 100%;"
                              v-model = "amount"
                              label="Amount">
                          </v-text-field>
                      </div>
                      <div style="width: 100%;">
                          <v-text-field
                              name="comment"
                              style="width: 100%;"
                              v-model = "comment"
                              label="Comment"
                              multi-line>
                          </v-text-field>
                      </div>

                    </form>
                </div>
            </v-card-row>
            <v-card-row actions>
              <v-btn class="green--text darken-1" flat="flat" @click.native="CloseModal">Close</v-btn>
              <v-btn class="green--text darken-1" flat="flat" @click.native="RequestPayment">Request</v-btn>
            </v-card-row>
          </v-card>
        </v-dialog>
      </v-layout>
    </template>
    </div>
  `,
  data:function(){
    return {
      dialog : false,
      comment : '',
      amount : '',
    };
  },
  methods:{
    CloseModal:function(){
      this.dialog = false;
    },
    RequestPayment:function(){
      let formData={
        "caseId" : this.elementData[0].caseId,
        'clientId' : this.elementData[0].clientId,
        'comment' : this.comment,
        'amount' : this.amount,
        '_token': this.elementData[0].Token,
      };
      $.ajax({
          type: "post",
          url: "/RequestPayment",
          data: formData,
          dataType: 'json',
          success: function (data) {
              var ReturnedData=JSON.parse(JSON.stringify(data));
              if (ReturnedData.Status == "PaymentRequested") {
                var data = {'caseId' : this.elementData[0].caseId, 'clientId' : this.elementData[0].clientId, 'comment': this.comment, 'amount' : this.amount};
                this.$emit('paymentrequested',data);
              }
          }.bind(this),
          error: function (data) {
              $("#Status").append(JSON.stringify(data));
          }.bind(this)
      });
    },
  }
});

// Timeline  ----------------------------------------------------
Vue.component('timeline',{
  props :['elementData'],
  template : `
      <div>
          <div v-if="PaymentRequest">
              <div class="card">
                <div class="card-content">
                  <div class="media">
                    <div class="media-content">
                      <p class="title is-4">John Smith</p>
                      <p class="subtitle is-6">@johnsmith</p>
                    </div>
                  </div>
                  <div class="content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Phasellus nec iaculis mauris. <a>@bulmaio</a>.
                    <a>#css</a> <a>#responsive</a>
                    <br>
                    <small>11:09 PM - 1 Jan 2016</small>
                  </div>
                </div>
              </div>
          </div>
      </div>
  `,
  data:function(){
    return {
        // Switches ---------------
        PaymentRequest : false,
    };
  },
  mounted:function(){
    alert(this.elementData.ComponentType);
    if (this.elementData.ComponentType == "PaymentRequest") {
      this.PaymentRequest = true;
    }
  },
  methods:{

  }
});
