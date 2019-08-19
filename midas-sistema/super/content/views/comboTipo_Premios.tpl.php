<?php 
 require_once("content/models/comboTipo_Premios.mod.php");
?>
<select id="selectTipo" name="selectTipo[]"  multiple class="form-control">
  <?php
   $selected='';

   while($fila=mysqli_fetch_assoc($categorias)) {
      $item=$db->queryCount("select * from em_precat where categoria='$fila[idcatPremios]' and premio='$_POST[selectPremio]'");
      if($item==1)  
       $selected='selected';  
            
              ?>
                 
                  <option <?php echo $selected;?>   value="<?php echo $fila['idcatPremios'];?>"><?php echo $fila['nombreCat']?>
                  </option>
                 
                <?php
                $selected=''; 
                  
} 
  ?> 
</select>