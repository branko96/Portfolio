
<?php
$mail=$_GET["emai"];

//if($_GET['key'] && $_GET['reset'])
//{
//    $email=$_GET['key'];
//    $pass=$_GET['reset'];
//    mysqli_connect('localhost','root','');
//    mysqli_select_db('barberia_db');
//    $select=mysqli_query("select email,password from usuarios where md5(mail)='$email' and md5(password)='$pass'");
//    if(mysqli_num_rows($select)==1)
//    {
//
//
//    }
//}
?>
<!--        <form method="post" action="submit_new.php">-->
<!--            <input type="hidden" name="email" value="-->
<!--            <p>Ingresa nueva contraseña</p>-->
<!--            <input type="password" name='password'>-->
<!--            <input type="password" name='password'>-->
<!--            <input type="submit" name="submit_password">-->
<!--        </form>-->
<HTML>
<BODY  style="background-image: url(&quot;https://sadpatagones.000webhostapp.com/wp-content/uploads/2019/05/darkness.png&quot;);">


<div class="form-style-6 ">
    <h1>Nuevo Acceso   </h1>
    <form  action="http://danientraigasbarbers.com/barber-admin/core/app/view/updatepass-action.php" method="post" >
        <textarea readonly="readonly" type="email" name="email" id="email"   ><?php echo $mail;?></textarea>
        <input type="password" name="pass" id="pass" placeholder="Nueva Contraseña" >
        <input type="password" name="field2" placeholder="Repita Contraseña" >

        <input type="submit" value="Actualizar" >
    </form>

</div>
</BODY>
</HTML>









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
