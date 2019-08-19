<?php 
 $premio= require_once("content/models/comboTipo_mov.mod.php");
?>
<select id="selectTipoMov" name="selectTipoMov" class="form-control">
  <?php
   while($fila=mysqli_fetch_assoc($premio)) {?>
   	<option value="<?php echo $fila['idtipoMovimiento'];?>">
   		<?php echo $fila['tipo'];?>
   	</option>
  <?php }
  ?> 
</select>