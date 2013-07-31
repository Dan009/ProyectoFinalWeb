<?php 
	include("libreria/engine.php");

	$magia = "magia";

	if ($_POST) {
		$nombreusuario = (isset($_POST['txtNombre']))?$_POST['txtNombre']:$administrador->nombre;
		$clave = (isset($_POST['txtClave']))?$_POST['txtClave']:$administrador->clave;
		$usuario = new admin($nombreusuario,$clave);
		
		if ($usuario->confirmar) {
			session_start();
			$_SESSION['usuario'] = $nombreusuario;
			header("Location:manteAdministrativo.php");

		}else{
			$magia = "";

		}
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<!--------------------
	LOGIN FORM
	by: Amit Jakhu
	www.amitjakhu.com
	--------------------->

	<!--META-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login Form</title>

	<!--STYLESHEETS-->
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />

</head>

<body>

	<div id="error1">
	     <div class='alert alert-error <?php echo $magia; ?>'>
	      <button type='button' class='close' data-dismiss='alert'>x</button>
	      <span>La constrase&ntilde;a o el nombre de usuario es incorrecto</span>

	    </div> 
	</div> 

	<h1 class="encabezadoLogin">Bienvenido al Login Secreto <img src="css/imagenes/eye-blocked.png"></h1>
	<!--WRAPPER-->
	<div id="wrapper">
		<!--SLIDE-IN ICONS-->
	    <div class="user-icon"></div>
	    <div class="pass-icon"></div>
	    <!--END SLIDE-IN ICONS-->

	<!--LOGIN FORM-->

    <form name="login-form" class="login-form" action="" method="post">
		<!--HEADER-->
	    <div class="header">
	    <!--TITLE--><h1 style="text-align:center;">Login Administrativo</h1><!--END TITLE-->
	    </div>
	    <!--END HEADER-->
		
		<!--CONTENT-->
	    <div class="content">
		<!--USERNAME--><input name="txtNombre" type="text" class="input username" placeholder="Nombre de usuario" /><!--END USERNAME-->
	    <!--PASSWORD--><input name="txtClave" type="password" class="input password" placeholder="Contrase&ntilde;a" /><!--END PASSWORD-->
	    </div>
	    <!--END CONTENT-->
	    
	    <!--FOOTER-->
	    <div class="footer">
	    <!--LOGIN BUTTON--><input type="submit" name="submit" value="Aceptar" class="button" /><!--END LOGIN BUTTON-->

	    </div>
	    <!--END FOOTER-->

	</form>
	<!--END LOGIN FORM-->

	</div>
	<!--END WRAPPER-->

	<!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->
	<!--SCRIPTS-->
	<!--Slider-in icons-->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$(".username").focus(function() {
					$(".user-icon").css("left","-48px");
				});
				$(".username").blur(function() {
					$(".user-icon").css("left","0px");
				});
				
				$(".password").focus(function() {
					$(".pass-icon").css("left","-48px");
				});
				$(".password").blur(function() {
					$(".pass-icon").css("left","0px");
				});
			});
		</script>

</body>

</html>