<!-- LOADING PAGE -->
	<script src="js/preload/jquery-2.2.1.min.js"></script>
	<style type="text/css">
	.preloader {
	  position: fixed;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  z-index: 9999;
	  background-color: #fff;
	}
	.preloader .loading {
	  position: absolute;
	  left: 50%;
	  top: 50%;
	  transform: translate(-50%,-50%);
	  font: 14px arial;
	}
	</style>

	<script>
	$(document).ready(function(){
	$(".preloader").fadeIn().delay(4000).fadeOut(); /* .fadeIn(1000).delay(1000).fadeOut() time 1000=1dtk*/
	})
	</script>
	<!-- END LOADING PAGE -->


	<div class="preloader">
  		<div class="loading">
    		<img src="img/loading.gif" width="80">
    		
  		</div>
	</div>
<meta http-equiv="refresh" content="0;url=panel/?page=home">