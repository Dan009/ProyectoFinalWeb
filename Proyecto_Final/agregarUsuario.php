<?php  
 
  include 'libreria/engine.php';
 
  $usuario = new usuario();
  $mostrarErrorCedula = "magia";
  $datosUsuarios = usuario::obtenerTodosUsuarios();
  $mostrarErrorEmail = "magia";
  $cedulaCorrecta = true;
  $emailCorrecto = true;

    if($_POST){
      if ($_POST['btnLogin']) {
        $usuario->logear($_POST['txtUsuario'],$_POST['txtClave']);
  
         if ($usuario->confirmar) {

          $_SESSION['userLogin'] = serialize($usuario);
          header("Location:perfilUsuario.php?id={$usuario->id}");

         }else{
           echo "<script>alert('Lo sentimos los datos no coinciden')</script>";
  
         }

      }else{
        foreach ($datosUsuarios as $datos) {
            if($datos['cedula'] == $_POST['txtCedula']){
              $cedulaCorrecta = false;
              $mostrarErrorCedula = "display:block";

            }

            if ($datos['email'] ==  $_POST['txtEmail']) {
                $emailCorrecto = false;
                $mostrarErrorEmail = "display:block";

            }
        }

          if ($cedulaCorrecta && $emailCorrecto) {
             $usuario->nombreusuario = (isset($_POST['txtUsuario']))?$_POST['txtUsuario']:$usuario->nombreusuario;
             $usuario->nombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:$usuario->nombre;
             $usuario->apellido = (isset($_POST['txtApellido']))?$_POST['txtApellido']:$usuario->apellido;
             $usuario->email = (isset($_POST['txtEmail']))?$_POST['txtEmail']:$usuario->email;
             $usuario->cedula = (isset($_POST['txtCedula']))?$_POST['txtCedula']:$usuario->cedula;
             $usuario->telefono = (isset($_POST['txtTelefono']))?$_POST['txtTelefono']:$usuario->telefono;
             $usuario->clave = (isset($_POST['txtPrimeraClave']))?$_POST['txtPrimeraClave']:$usuario->clave;
             $usuario->guardar();
             $_POST = "";
             header("Location:index.php");
          
          }
      }        
    }

    if (isset($_GET['buscar']) && isset($_GET['query'])){
      $anuncios = buscador::buscar($_GET['q']);

    }else if(isset($_GET['query'])){
      $anuncios = buscador::buscarCategoria($_GET['query']);
      

    }

/*
  echo "<pre>";
  var_dump(variableaqui);
  echo "</pre>";
  exit();

*/
    
?>

<html>

<head>
	<title>Anuncios PHP !!!!!</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/otroestilo.css">
</head>

<body onLoad="setearMascara()">

<!-- Barra superior-->
  <div class="navbar navbar-inverse" id="overview">
       <div class='navbar-inner'>
          <div id="container">
            <div class="nav-collapse">
              <a class="brand" href="index.php">Anuncios PHP </a>

          </div>
       </div>
    </div>
  </div>

<!--Formulario para registrarse -->
 <div id="registrarse" class="modal registrar" tabindex="-1" rol="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
         <button type="button" class="close"  aria-hidden="true">x</button>
         <h3 id="myModalLabel">Registro</h3>
    
      </div>

      <div class="modal-body">
        <form method="POST" action="" class="form-horizontal frmRegistrar" onsubmit="verificar()"> 
          <table class="tblAgregar">
            <tbody>
              <tr>
                <th>Nombre</th>
                <td><input type="text" name="txtNombre" value="<?php echo $_POST['txtNombre'] ?>" required/> </td>
         
                <th>Apellido</th>
                <td><input type="text" name="txtApellido" value="<?php echo $_POST['txtApellido'] ?>" required /> </td>
              </tr>

              <tr class="contraseña">
                <th>Contrase&ntilde;a</th>
                <td><input type="password" id="txtPrimeraClave" name="txtPrimeraClave"></td>

              <th>Repita su Contrase&ntilde;a, Por Favor</th>
                <td><input type="password" id="txtSegundaClave" name="txtSegundaClave"></td>
                <td class="achicar"><span > La contrase&ntilde;a debe tener 6 caracteres Max.</span></td>
              </tr>

              <tr id="error1" class="magia">
                <td colspan='4'>
                 <div class='alert alert-error'>
                    <button type='button' class='close' data-dismiss='alert'>x</button>
                     <span>La constrase&ntilde;a digitada es muy corta</span>
                  </div> 
                </td> 
              </tr>

              <tr id="error2" class="magia">
                <td colspan="4">  
                    <div class="alert alert-error">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <span>Las constrase&ntilde;as no coinciden</span>
                    </div> 
                </td> 
              </tr>

              <tr>
                <th>Nombre de usuario</th>
                <td><input type="text" name="txtUsuario"value="<?php echo $_POST['txtUsuario'] ?>" required /> </td>

                <th>Email</th>
                <td><input style="width:200px;"type="email" name="txtEmail" placeholder="Prueba@hotmail.com" value="<?php echo $_POST['txtEmail'] ?>" required /> </td>
              </tr>

              <tr class="<?php  echo $mostrarErrorEmail;?>">
                <td colspan="4">  
                    <div class="alert alert-error">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <span>Este correo electronico esta en uso</span>
                    </div> 
                </td> 
              </tr>


              <tr>
                <th>Cedula</th>
                <td><input type="text" id="txtCedula" name="txtCedula" id="inputError" placeholder="000-0000000-0" required/> </td>
               
                <th>Telefono</th>
                <td><input type="text" name="txtTelefono" placeholder="(000) 000-0000" value="<?php echo $_POST['txtTelefono'] ?>"required/> </td>
              </tr>

              <tr class="<?php  echo $mostrarErrorCedula;?>">
                <td colspan="4">  
                    <div class="alert alert-error">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <span>Existe un usuario con esa Cedula</span>
                    </div> 
                </td> 
              </tr>
            </tbody>
          </table>

          <div class="control-group derecha">
            <div class="controls">
               <label class="checkbox">
                <input type="checkbox" required> Acepto los T&eacute;rminos de uso
                
               </label>

              <input type="submit" value="Aceptar" class="btn btn-success" id="btnRegistro" name="btnRegistro" /></td>
            </div>
          </div>

        </form>
      </div>

      <div class="modal-footer"></div>
  </div>

<!-- Scripts -->
  <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/funciones.js"></script>
  <script type="text/javascript" src="js/bootstrap-affix.js"></script>
  <script type="text/javascript" src="js/jquery.inputmask.js"></script>
  <script type="text/javascript" src="js/tooltips.js"></script>

</body>
</html>