<div id="PaymentOptions">
		<nav class="DashboardNavBar" style="background-color: #00d1b2; cursor: pointer;">
			<div class="Tabs">
				<neo-tab v-for="tab in PaymentTabs" :data="tab" :tab-name="tab.TabName" @changed="ChangePaymentTab"></neo-tab>
			</div>
	    </nav>

	    <!-- Fixed Payment -->
	    

	    <!-- Hourly Payment -->
	    
	  </div>