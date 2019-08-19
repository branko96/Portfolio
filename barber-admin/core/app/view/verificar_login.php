<?php 
@session_start();
if(!isset($_COOKIE['user_id'])){
	?>
	<script type="text/javascript">
	$(document).ready(function(){
		$.alert("No estas logueado!");
	  	setTimeout(function(){ 
	  	window.location="?view=login";
	  	 }, 1000);
	 	
	});
	</script>
<?php 
exit(0);

}
?>
