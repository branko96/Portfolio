<?php 
@session_start();
if(!isset($_SESSION['user'])){ 
	?>
	<script type="text/javascript">
	$(document).ready(function(){
		$.alert("No estas logueado!");
	  	setTimeout(function(){ 
	  	window.location="../index.php";
	  	 }, 1000);
	 	
	});
	</script>
<?php 
exit(0);

}
?>