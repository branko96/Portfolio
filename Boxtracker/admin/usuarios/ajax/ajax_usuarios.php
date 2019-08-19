<?php

include_once("../../../BACKEND/datos/conexion.php");

include_once("../../../BACKEND/controller/UsuariosController.php");

include_once("../../FormulariosController.php");
session_start();
$usuariosCont=new UsuariosController($basedatos,$servidor,$usuario,$paswd);

$ctrl_form=new FormulariosController();

$operacion=$_POST['op'];

if (isset($operacion)) {

	switch ($operacion) {

		case 'alta':
			$id_padre=$_POST['user_padre'];

			$nombre=$_POST['nombre_u'];

			$apellido=$_POST['apellido_u'];

			$dni=$_POST['dni_u'];

			$telefono=$_POST['tel_u'];

			$email=$_POST['email_u'];

			$usuarios_permisos=$_POST['usuarios_permisos'];
			//var_dump($usuarios_permisos);
			//$tablero_permisos=$_POST['tablero_permisos'];
			$rta=$usuariosCont->NuevoUsuario($nombre,$apellido,$dni,$telefono,$email,$usuarios_permisos,$id_padre);
				//var_dump($rta);
			$id_rta=$rta->getId_respuesta();
			$mensaje=$rta->getMensaje();
			
			//$id_rta=1;
			if($id_rta == 1){

				$codigo=1;
				$ctrl_form->mostrar_respuesta($codigo,$mensaje);

			}else{

				$codigo=0;

				$ctrl_form->mostrar_respuesta($codigo,$mensaje);

			}

			break;

		case 'borrar':

			$id_user=$_POST['id_user'];
			$tiene_hijos=$usuariosCont->SaberPadre($id_user);
			if ($tiene_hijos) {
				$codigo=2;	
				$cant_hijos=$usuariosCont->traer_cant_hijos($id_user);
			}else{
				$rta=$usuariosCont->EliminarUsuario($id_user);
				$codigo=1;
			}
			$respuesta= array("codigo" => $codigo,"tiene" => $cant_hijos);
			echo json_encode($respuesta);

			break;

		case 'editar_perfil':

			$id_user=$_POST['id_user'];

			$nombre=$_POST['nombre_u'];

			$apellido=$_POST['apellido_u'];

			$dni=$_POST['dni_u'];

			$telefono=$_POST['tel_u'];
			$img=$_FILES['foto_u'];	
			$rta=$usuariosCont->EditarPerfil($id_user,$nombre,$apellido,$dni,$telefono,$img);
			//var_dump($_POST);

			if(is_object($rta)){

				$_SESSION['user']=$rta;
				$codigo=1;

				$mensaje="Usuario actualizado correctamente";

				$ctrl_form->mostrar_respuesta($codigo,$mensaje);

			}else{

				$codigo=0;

				$mensaje="No se ha podido actualizar el Usuario";

				$ctrl_form->mostrar_respuesta($codigo,$mensaje);

			}

			break;

		case 'listar':

			$id_user=$_SESSION['user']->getId();
			$tipo=$_POST['tipo'];

			$usuarios=$usuariosCont->DevolverUsuarios($id_user);
			
			
			if (count($usuarios)>0) {

				$ctrl_form->tabla_usuarios($usuarios,$tipo);

			}else{

				echo "No existen Usuarios";

			}

			break;



		case 'ver_usuario':

			$id_user=$_POST['id_user'];

			

			if (isset($id_user)) {

				$usuario=$usuariosCont->VerUsuario($id_user);

				//var_dump($usuario);

			}else{

				echo "No existe el Usuario";

			}

			break;

		case 'form_editar_usuario':

			$id_user=$_POST['id_user'];

			$id_padre=$_SESSION['user']->getId();

			if (isset($id_user)) {
				
				$permisos=$usuariosCont->DevolverPermisos_activos($id_user);
				$permisos_padre=$usuariosCont->DevolverPermisos_activos($id_padre);
				$permisos_todos=$usuariosCont->DevolverPermisos_vigentes();
				$modulos_todos=$usuariosCont->DevolverModulos();
				$ctrl_form->form_editar_usuario($id_user,$modulos_todos,$permisos,$permisos_todos,$permisos_padre);
				
				
				//var_dump($usuario);

			}else{

				echo "No existe el Usuario";

			}

			break;
		case 'editar_permisos':
			$usuarios_permisos=$_POST['usuarios_permisos'];
			$id_user=$_POST['id_user'];
			$rta=$usuariosCont->editar_permisos($usuarios_permisos,$id_user);
			//var_dump($usuarios_permisos);
			//var_dump($rta);
			if ($rta != 0) {
				$codigo=0;

				$mensaje="Permisos no actualizados";

				$ctrl_form->mostrar_respuesta($codigo,$mensaje);
			}else{
				$codigo=1;

				$mensaje="Permisos actualizados correctamente";

				$ctrl_form->mostrar_respuesta($codigo,$mensaje);
			}

			break;

		case 'ver_hijos':
			$id_user=$_POST['id_user'];
			$rta=$usuariosCont->traer_hijos($id_user);
			
			if (count($rta > 0)) {
				$arr_hijos=[];
				foreach ($rta as $key => $hijo) {
					
					$id_hijo=$hijo['id_usuario'];
					$usuario=$usuariosCont->VerUsuario($id_hijo);
					$arr_hijos[$key]= $usuario->getJson();
				}
				//var_dump($arr_hijos);
				echo json_encode($arr_hijos, JSON_PRETTY_PRINT);
			}
			
			break;
		case 'enganchar_hijos':
			$id_padre_actual=$_POST['id_padre_actual'];
			$id_padre_enganche=$_POST['id_padre_enganche'];
			$rta=$usuariosCont->enganchar_user_padre($id_padre_enganche,$id_padre_actual);
			
			var_dump($rta);
			break;
		case 'eliminar_hijos':
			$id_usuario=$_POST['id_user'];
			$rta=$usuariosCont->Eliminar_hijos_recursiva($id_usuario);
			$rta2=$usuariosCont->EliminarUsuario($id_usuario);
			break;

		case 'cbm_hermanos_padre': 
			$id_user=$_POST['id_user'];
			//$id_padre=$usuariosCont->traer_padre_id($id_user);
			//$padre=$usuariosCont->VerUsuario($id_padre);
			$id_padre=$_SESSION['user']->getId();
			$hermanos=$usuariosCont->traer_hermanos($id_padre,$id_user);
			//echo $id_user." ".$id_padre."<br>";
			//var_dump($padre);
			if (count($hermanos)>0) {
				$clasecol='col-sm-6';
			}else{
				$clasecol='col-sm-12';
			}

		?>	<div class="text-center" style="margin-bottom: 2rem;"><h2>¿A quién Asignarás sus hijos?</h2></div>
		 <input type="hidden" name="asignar_a" id="asignar_a" value="<?php if(count($hermanos)>0){echo '2';}else{echo '1';}?>" required>
		 <input type="hidden" name="padre_actual" id="padre_actual" value="<?php echo $id_user; ?>" required>
				<div class="<?php echo $clasecol;?>">
                      <div class="radio radio_asignar text-center">
                        <label>
                          <div class="">
                              <input type="radio" name="iCheck" id="padre_radio" class="flat radiobtn_asignar" <?php if (count($hermanos)> 0) {echo "";}else{echo "checked";}?> value="1">
                          </div>
                          <div>
                              <span class="label label-primary labels_radio">A mi mismo(usuario actual)</span>
                          </div>
                        </label>
                      </div>       
                    </div>
                    <?php if (count($hermanos)>0) { ?>
                    <div class="col-sm-6"> 
                    <div class="radio radio_asignar text-center">  
                        <label>  
                          <div class="">
                            <input type="radio" checked name="iCheck" id="hermanos_radio" class="flat radiobtn_asignar" value="2">
                          </div>
                          <div>
                            <span class="label label-primary labels_radio">Hermanos del usuario</span>
                          </div>  
                        </label>
                      </div>
                      <!--<label for="hermanos_radio" class="label label-primary">Hermanos del usuario a eliminar</label>-->
                      <center>
                        <select id="hermanos" class="form-control">
                          <option value="0">Hermanos</option>
                         	<?php 
	                         		//arriba ya pregunto si es mayor a 0 el array de hnos
	                         		foreach ($hermanos as $hermano) { 
	                        			echo '<option value="'.$hermano->getId().'">'.$hermano->getNombre().'</option>';
	                        		}
                        	?>
                        </select>
                      </center>  
                    </div>
                <?php } ?>
                </div>

			<?php
			break;

		case 'enganchar_padre':
			$id_padre_actual=$_POST['id_padre_actual'];
			$id_padre_asignado=$_POST['id_padre_asignado'];
			if ($id_padre_actual != "" && $id_padre_asignado != "") {
				$rta=$usuariosCont->enganchar_user_padre($id_padre_asignado,$id_padre_actual);
				if ($rta != false) {
					$rta='Los hijos del usuario eliminado fueron asignados al nuevo padre';
				}else{
					$rta='No se han enganchado los hijos, intente nuevamente';
				}
			}else{
				$rta="No se han enganchado los hijos, intente nuevamente";
			}
			echo $rta;
			

		break;

	}

}else{

	echo "no hay operacion";

}











?>