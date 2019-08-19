<?php 
//combo clubes ingresados
 $club= require_once("content/models/combo_club.mod.php");
?>
<select id="selectClub" name="selectClub" class="form-control">
  <?php
   while($fila=mysqli_fetch_assoc($club)) {?>
   	 <option <?php if($socio[0]['nTarjeta']==$fila['idclub']){;?> selected <?php };?> value="<?php echo $fila['idclub']?>"><?php echo $fila['nombreClub']?></option>
  <?php }
  ?> 
</select>
