<?php 
 $premio= require_once("content/models/combo_premio.mod.php");
?>
<select id="selectPremio" name="selectPremio" class="form-control" required="">
  <?php
   while($fila=mysqli_fetch_assoc($premio)) {?>
   	<option value="<?php echo $fila['idpremios'];?>">
   		<?php echo $fila['titulo'];?>
   	</option>
  <?php }
  ?> 
</select>