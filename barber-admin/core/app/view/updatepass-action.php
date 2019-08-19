<?php

$dbhost = 'localhost';
$dbuser = 'c1531094_barber';
$dbpass = '51VOzupuru';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'c1531094_barber');


if(! $conn ) {
    die('No se pudo conectar a la bd: ' . mysqli_error());
}

$passw=md5($_POST["pass"]);
$emai=$_POST["email"];


$sql2 = "SELECT `id` FROM `usuarios` WHERE `usuarios`.`email` = '".$emai."';";

$conn->query($sql2);
$result=mysqli_query($conn,$sql2);
$row=mysqli_fetch_assoc($result);
$id=$row['id'];


$sql = "UPDATE `usuarios` SET `password` = '".$passw."' WHERE `usuarios`.`id` = '".$id."';";
$conn->query($sql);
$updatedRecords = mysqli_affected_rows($conn);


$emailerror='<html>
<body>
<div class="form-style-6 ">
    <h1> Error al modificar Contraseña! </h1>
<form method="get" action="http://danientraigasbarbers.com/barber-admin/core/app/view/updatepass-view.php">
<textarea hidden  name="emai" id="emai"   >'. $emai.'</textarea>
   
    <input type="submit" value="Intentar de Nuevo " />
</form>
</div>
</body>
</html>';
$passcorrect='<html>
<head>
<meta http-equiv="Refresh" content="5;url=http://danientraigasbarbers.com/barber-admin/">
</head>
<body>
<div class="form-style-6 ">
    <h1> Contraseña Modificada!!! </h1>
    <textarea >Redirigiendo al Login en cinco segundos...</textarea>
</div>
</body>
</html>';

if ($updatedRecords===0) {
    echo $emailerror;

} else{
    echo $passcorrect;
}

mysqli_close($conn);
?>
















<style type="text/css">



    .form-style-6{
        font: 95% Arial, Helvetica, sans-serif;
        max-width: 400px;
        margin: 10px auto;
        margin-top: 250px!important;
        padding: 16px;
        background: #F7F7F7;
    }
    .form-style-6 h1{
        background: #43D1AF;
        padding: 20px 0;
        font-size: 140%;
        font-weight: 300;
        text-align: center;
        color: #fff;
        margin: -16px -16px 16px -16px;
    }
    .form-style-6 input[type="password"],
    .form-style-6 input[type="date"],
    .form-style-6 input[type="datetime"],
    .form-style-6 input[type="email"],
    .form-style-6 input[type="number"],
    .form-style-6 input[type="search"],
    .form-style-6 input[type="time"],
    .form-style-6 input[type="url"],
    .form-style-6 textarea,
    .form-style-6 select
    {
        -webkit-transition: all 0.30s ease-in-out;
        -moz-transition: all 0.30s ease-in-out;
        -ms-transition: all 0.30s ease-in-out;
        -o-transition: all 0.30s ease-in-out;
        outline: none;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        width: 100%;
        background: #fff;
        margin-bottom: 4%;
        border: 1px solid #ccc;
        padding: 3%;
        color: #555;
        font: 95% Arial, Helvetica, sans-serif;
    }
    .form-style-6 input[type="password"]:focus,
    .form-style-6 input[type="date"]:focus,
    .form-style-6 input[type="datetime"]:focus,
    .form-style-6 input[type="email"]:focus,
    .form-style-6 input[type="number"]:focus,
    .form-style-6 input[type="search"]:focus,
    .form-style-6 input[type="time"]:focus,
    .form-style-6 input[type="url"]:focus,
    .form-style-6 textarea:focus,
    .form-style-6 select:focus
    {
        box-shadow: 0 0 5px #43D1AF;
        padding: 3%;
        border: 1px solid #43D1AF;
    }

    .form-style-6 input[type="submit"],
    .form-style-6 input[type="button"]{
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        width: 100%;
        padding: 3%;
        background: #43D1AF;
        border-bottom: 2px solid #30C29E;
        border-top-style: none;
        border-right-style: none;
        border-left-style: none;
        color: #fff;
    }
    .form-style-6 input[type="submit"]:hover,
    .form-style-6 input[type="button"]:hover{
        background: #2EBC99;
    }
</style>







