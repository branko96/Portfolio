<?php 
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <title>Boxtracker Login</title>
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" href="css/notifIt.min.css">
    <link rel="stylesheet" href="css/loadingfy.css">
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="admin/js/JQueryConfirm-3.3.0/jquery-confirm.min.css">
    <script src="admin/js/JQueryConfirm-3.3.0/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="js/notifIt.min.js"></script>
    <script src="js/login.js"></script>
    
</head>
<body>
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> 
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />-->
            <img id="profile-img" class="profile-img-card" src="admin/images/logogris_fblanco.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" id="form_login">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>
                <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Contraseña" required>
                <!--<div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Recordarme
                    </label>
                </div>-->
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Acceder</button>
                 
            </form><!-- /form -->
            <div class="row">
                <div class="col-sm-12">
                    <a href="#" class="forgot-password">
                        Olvidaste tu contraseña?
                    </a>
                </div>
                <div class="col-sm-12">
                    <div id="cargando2" class="col-sm-6 col-sm-offset-3" style="display: none;margin-top: 2rem;">
                        <center>
                            <img src="img/loading.gif" style="width: 40px;">
                        </center>
                    </div>
                </div>
            </div>
        </div><!-- /card-container -->
        <div id="cargando" style="display: none;">
            <center>
                <img src="img/loading.gif" style="width: 50px;">
            </center>
        </div>
        <div class="col-sm-12">
            <div id="resultado"></div>
        </div>
        
        
    </div><!-- /container -->
    

    
</body>
</html>
