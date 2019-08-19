<?php 
include_once("../../BACKEND/model/Usuario.php");
session_start();
if (isset($_SESSION['user'])) {
  $id_user=$_SESSION['user']->getId();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Boxtracker Panel </title>

   <?php include("header.php");?>
  </head>

  <body class="nav-md">
        <?php require("menu.php");?>
        <input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user;?>" required>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Proyectos <small>Modulo</small></h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Ir</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel" id="contenedor_herramientas">
                  <div class="x_title">
                    <h2>Proyectos</h2>
                    <!-- <div style="">
                      <center>
                        <label>Filtro Grupo</label>
                        <select id="select_grupos">
                          <option value="0">Todos los Grupos</option>
                          <option value="1">Constructora</option>
                          <option value="2">Obras Centro</option>
                        </select> 
                      </center>
                    </div> -->
                   <!--  <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div > -->

                      <!-- start project list 
                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                            <th style="width: 20%">Nombre Proyecto</th>
                            <th>Miembros</th>
                            <th>Progreso del Proyecto</th>
                            <th>Estado</th>
                            <th style="width: 20%">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                            <td>
                              <a>Obra construccion</a>
                              <br />
                              <small>Creado 01.01.2018</small>
                            </td>
                            <td>
                              <ul class="list-inline">
                                <li>
                                  <img src="../images/user.png" class="avatar" alt="Avatar">
                                </li>
                                <li>
                                  <img src="../images/user.png" class="avatar" alt="Avatar">
                                </li>
                                <li>
                                  <img src="../images/user.png" class="avatar" alt="Avatar">
                                </li>
                              </ul>
                            </td>
                            <td class="project_progress">
                              <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="12"></div>
                              </div>
                              <small>12% Completado</small>
                            </td>
                            <td>
                              <button type="button" class="btn btn-danger btn-xs">Atrasado</button>
                            </td>
                            <td>
                              <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Ver </a>
                              <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                              <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Eliminar </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <a>Obra general 2</a>
                              <br />
                              <small>Creado 01.01.2018</small>
                            </td>
                            <td>
                              <ul class="list-inline">
                                <li>
                                  <img src="../images/user.png" class="avatar" alt="Avatar">
                                </li>
                                <li>
                                  <img src="../images/user.png" class="avatar" alt="Avatar">
                                </li>
                              </ul>
                            </td>
                            <td class="project_progress">
                              <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="35"></div>
                              </div>
                              <small>35% Completado</small>
                            </td>
                            <td>
                              <button type="button" class="btn btn-success btn-xs">En curso</button>
                            </td>
                            <td>
                              <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Ver </a>
                              <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                              <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Eliminar </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <a>Obra general</a>
                              <br />
                              <small>Creado 01.01.2018</small>
                            </td>
                            <td>
                              <ul class="list-inline">
                                <li>
                                  <img src="../images/user.png" class="avatar" alt="Avatar">
                                </li>
                                <li>
                                  <img src="../images/user.png" class="avatar" alt="Avatar">
                                </li>
                              </ul>
                            </td>
                            <td class="project_progress">
                              <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="87"></div>
                              </div>
                              <small>87% Completado</small>
                            </td>
                            <td>
                              <button type="button" class="btn btn-success btn-xs">En curso</button>
                            </td>
                            <td>
                              <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Ver </a>
                              <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                              <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Eliminar </a>
                            </td>
                          </tr>
                          
                        </tbody>
                      </table>
                      end project list -->
                    <!-- </div> -->
                    <!-- end div tabla -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <?php include("footer.php");?>
        <script src="js/index.js"></script>
    
  </body>
</html>
<?php



?>