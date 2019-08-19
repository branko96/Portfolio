<?php 
class FormulariosController{
	function tabla_usuarios($usuarios,$tipo){
  		if (count($usuarios)>0) {
        $ult_columna="";
        if ($tipo != "alta") {
          $ult_columna='<th style="width: 20%">Acción</th>';
        }
  			echo '<table id="tabla_usuarios2" class="table table-striped projects">
                        <thead>
                          <tr>
                            <th style="width: 20%">Nombre</th>
                            <th>Apellido</th>
                            <th>Dni</th>
                            <th>Email</th>
                            <th>Teléfono</th>'.
                            $ult_columna.'
                          </tr>
                        </thead>
                        <tbody>';
                         
                       foreach ($usuarios as $key => $usuario) { 
                         	echo' <tr>';
                            echo '<td><a>'.$usuario->getNombre().'</a></td>';
                            echo '<td>'.$usuario->getApellido().'</td>';
                            echo '<td>'.$usuario->getDni().'</td>';
                            echo '<td>'.$usuario->getEmail().'</td>';
                            echo '<td>'.$usuario->getTelefono().'</td>';
                              switch ($tipo) {
                                case 'editar':
                                   $boton='<td>
                                      <a href="#" data-pkUser="'.$usuario->getId().'" class="btn btn-success editar_user2 btn-xs"><i class="fa fa-pencil"></i> Editar </a></td>';
                                  break;
                                
                                case 'borrar':
                                  $boton= '<td><a href="#" data-pkUser="'.$usuario->getId().'" class="btn btn-danger btn-xs borrar_user2"><i class="fa fa-trash-o"></i> Borrar </a></td>';
                                  break;
                                default:
                                  $boton="";
                                break;
                              }
                            echo $boton;
                          echo '</tr>';
                         } 
                          
                        echo '</tbody>
                      </table>';
  			
  		}

	}
  function form_editar_usuario($id_user,$modulos,$permisos_usuario,$permisos_todos,$permisos_padre){
   // if (is_object($permisos)) { 
        //var_dump($permisos_usuario);
          echo '<form id="form_editar_usuario">
                    <input type="hidden" name="op" value="editar_permisos" required>
                    <input type="hidden" name="id_user" value="'.$id_user.'" required>
                    <div class="div_permisos_contenedor">';

                    if (count($modulos)>0) {
                      foreach ($modulos as $key => $modulo) {
                        $id_mod=$modulo["id_modulo"];
                        $nombre=$modulo["descripcion"];
                        $this->mostrar_permisos_modulo($key,$id_mod,$nombre,$permisos_usuario,$permisos_todos,$permisos_padre);
                      }
                    
                    }
                  echo '</div>';
          echo '  <div style="margin-top: 2rem;" class="form-group col-sm-12 text-center"><button type="submit" class="btn btn-success">Guardar</button></div>
                  </form>';

  }
  function mostrar_respuesta($codigo,$mensaje){
    if ( $codigo === 1) {
      echo '<div class="alert alert-success text-center col-sm-6 col-sm-offset-3">

        '.$mensaje.'</div>';
    }else{
      echo '<div class="alert alert-danger text-center col-sm-6 col-sm-offset-3">

      '.$mensaje.'</div>';
    }
  }

  function mostrar_permisos_modulo($key2,$id_modulo,$nombre,$permisos_usuario,$permisos_todos,$permisos_padre){
   //var_dump($permisos_usuario);
    if (count($permisos_todos)>0) {
      if($key2%2==0){
        echo '<div class="col-sm-12 permiso_fila">';
      }
      echo '<div class="col-sm-6 row">
                <div class="col-sm-6">
                  <a class="btn btn-app" id="btn_users_app">
                      <i class="fa fa-users"></i> '.$nombre.'
                  </a>
                </div>';
      echo '<div class="col-sm-6">';
      echo '<div class=" form-group">
                <div class="">
                  <label>
                    <input type="checkbox" checked class="js-switch2 habilitar_modulo" value="1" name="modulo" /> '.$nombre.'</label>
                </div>
              </div>';
       echo '<div class=" form-group">
                <div class="">
                  <label>
                    <input type="checkbox" class="js-switch2 habilitar_todo" value="1" name="modulo" /> Habilitar Todo</label>
                </div>
              </div>';
      echo '<div class="permisos">';
      foreach ($permisos_todos as $key => $permiso) {
          $id_perm=$permiso["pk_permiso"];
          $nombre_perm=$permiso["descripcion"];
          $modulo_perm=$permiso["modulo"];
          $checked="";
          if($modulo_perm == $id_modulo){
                    //
                     $tiene_permiso_padre=$this->validar_permisos($id_perm,$permisos_padre);
                    if ($tiene_permiso_padre) {
                    	$tiene_permiso=$this->validar_permisos($id_perm,$permisos_usuario);
                    	if ($tiene_permiso) {
		                      echo '<div class=" form-group">
		                            <div class="">
		                              <label>
		                                <input type="checkbox" checked  class="js-switch2" value="'.$id_perm.'" name="usuarios_permisos[]" /> '.$nombre_perm.' </label>
		                            </div>
		                          </div>';
                        }else{
                        	echo '<div class=" form-group">
		                            <div class="">
		                              <label>
		                                <input type="checkbox" class="js-switch2" value="'.$id_perm.'" name="usuarios_permisos[]" /> '.$nombre_perm.' </label>
		                            </div>
		                          </div>';
                        }
                    }else{
                      echo '<div class=" form-group">
                            <div class="">
                              <label class="sw-disabled">
                                <input type="checkbox" disabled class="js-switch2 disabled" value="'.$id_perm.'" name="usuarios_permisos[]" /> '.$nombre_perm.' </label>
                            </div>
                          </div>';
                    }
          }
      }
      echo '</div>';
      echo '</div>';// nuevo div permisos
      echo '</div>';
    }

    if($key2%2!=0){
      echo '</div>';
    }
  }

  function mostrar_menu($permisos_usuario,$permisos_todos){
    if (count($permisos_todos)>0) {
    	//var_dump($permisos_todos);
      $menu="";
      foreach ($permisos_todos as $key => $permiso) {
          $id_perm=$permiso->getId_permiso();
          $nombre_perm=$permiso->getNombre();
          $ruta=$permiso->getRuta();
          $disabled="";
            foreach ($permisos_usuario as $key => $user_permiso) {
                $id_permiso_user=$user_permiso->getPermiso();
                $valor=$user_permiso->getValor();
                if ($id_permiso_user == $id_perm) {
                  if($valor == 1){
                    $disabled="";
                    $ruta=$permiso->getRuta();
                  }
                  $menu.= '<li class="menu_herramientas" ><a data-ruta="'.$ruta.'" style="color:white;"><div style="display: inline-flex;"> <i class="'.$permiso->getIcono().'"></i> <div class="nombre_menu">'.$permiso->getNombre().'</div> </div></a></li>';
                }
            }
            
            
      }

    }
    return $menu;
  }

  function mostrar_permisos_modulo2($key2,$id_modulo,$nombre,$permisos_todos,$permisos_activos){
    if (count($permisos_todos)>0) {
        if($key2%2==0){
          echo '<div class="col-sm-12 permiso_fila">';
        }

      echo '<div class="col-sm-6 row">
                <div class="col-sm-6">
                  <a class="btn btn-app" id="btn_users_app">
                      <i class="fa fa-users"></i> '.$nombre.'
                  </a>
                </div>';
        echo '<div class="col-sm-6">';
          echo '<div class=" form-group">
                    <div class="">
                      <label>
                        <input type="checkbox" checked class="js-switch1 habilitar_modulo" value="1" name="modulo" /> '.$nombre.'</label>
                    </div>
                  </div>';
           echo '<div class=" form-group">
                    <div class="">
                      <label>
                        <input type="checkbox" class="js-switch1 habilitar_todo" checked value="1" name="modulo" /> Habilitar Todo</label>
                    </div>
                  </div>';
          echo '<div class="permisos" hidden>';
      foreach ($permisos_todos as $key => $permiso) {
          
          $id_perm=$permiso["pk_permiso"];
          $nombre_perm=$permiso["descripcion"];
          $modulo_perm=$permiso["modulo"];
         
          if($modulo_perm == $id_modulo){
            $tiene_permiso=$this->validar_permisos($id_perm,$permisos_activos);
            if ($tiene_permiso) {
              echo '<div class=" form-group">
                    <div class="">
                      <label>
                        <input type="checkbox" checked class="js-switch1" value="'.$id_perm.'" name="usuarios_permisos[]" /> '.$nombre_perm.' </label>
                    </div>
                  </div>';
            }else{
              echo '<div class=" form-group">
                    <div class="">
                      <label class="sw-disabled">
                        <input type="checkbox" disabled class="js-switch1 disabled " value="'.$id_perm.'" name="usuarios_permisos[]" /> '.$nombre_perm.' </label>
                    </div>
                  </div>';
            }
            
          }
          
      }
      echo ' </div>';
      echo ' </div>';
     /* echo '<div class="form-group">
                    <div class="">
                      <label>
                        <input type="checkbox" class="js-switch" id="js-switch" value="'.$id_perm.'" name="usuarios_permisos[]" /> '.$nombre_perm.' </label>
                    </div>
                  </div>';*/
      echo '</div>';
      if($key2%2!=0){
          echo '</div>';
        }
    }
  }

  function validar_permisos($id_perm,$permisos_activos){
    $rta=false;
    //var_dump($permisos_activos);
    if (count($permisos_activos)>0) {
      foreach ($permisos_activos as $permiso) {
        if ($permiso->getPermiso() == $id_perm) {
          $rta= true;
        }
      }
    }
    return $rta;
  }

}
?>