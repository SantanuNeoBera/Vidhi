<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.0/css/bulma.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/buefy"></script>

	<title>Vidhikarya | Home</title>
<style type="text/css">
	.Header{
		height: 40px;
		width: 100%;
		background-color: #333;
	}
	.NavBar{

	}
</style>
</head>
<body>
<div id="PageContent">
	<header class="Header">
		<nav class="NavBar">
			<div style="position: relative; left: 500px;">
				<a class="button is-primary" v-on:click="OpenDiv">Primary</a>
				<div style="position: absolute; height: 400px; width:400px; background-color: pink;" v-show="showDiv">
					
				</div>
			</div>
		</nav>
	</header>
</div>
<script type="text/javascript">
	new Vue({
		el:"#PageContent",
		data:{
			showDiv : false,
		},
		methods:{
			OpenDiv:function(){
				if (this.showDiv == false) {
					this.showDiv = true;
				}
				else{
					this.showDiv = false;
				}
			}
		}
	});
</script>
</body>
</html>