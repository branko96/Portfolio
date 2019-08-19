
	<form method="GET" action="index.php">
		<select id="club" name="club" class="col-xs-4">
		  <option value="todos">todos</option>
		  <?php
		   while($fila=mysqli_fetch_assoc($clubes)) {?>
		   	 <option value="<?php echo $fila['idclub']?>"><?php echo $fila['nombreClub']?></option>
		  <?php }
		  ?> 
		</select>
    	<button class="btn btn-primary">Consultar</button>
	</form>