<?php  
  date_default_timezone_set('UTC');
  include 'libreria/engine.php';

  $mostrarErrorCedula = "magia";
  $datosUsuario = usuario::obtenerTodosUsuarios();
  $mostrarErrorEmail = "magia";
  $cedulaCorrecta = true;
  $emailCorrecto = true;

    if($_POST){
        /*$usuario = new usuario($_POST['txtUsuario'],$_POST['txtClave']);
             if ($usuario->confirmar) {
               session_start();
               $_SESSION['id'] = $usuario->id;
               $_SESSION['nombre'] = $usuario->nombre;
               alert("Hola!!!! de nuevo :D ".$_SESSION['nombre']);

             }else{
               alert("Lo sentimos los datos no coinciden");
              004-9222333-3
             }*/

     

      foreach ($datosUsuario as $datos) {
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
           $usuario = new genclas('usuario');
           $usuario->nombreusuario = (isset($_POST['txtUsuario']))?$_POST['txtUsuario']:$usuario->nombreusuario;
           $usuario->nombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:$usuario->nombre;
           $usuario->apellido = (isset($_POST['txtApellido']))?$_POST['txtApellido']:$usuario->apellido;
           $usuario->email = (isset($_POST['txtEmail']))?$_POST['txtEmail']:$usuario->email;
           $usuario->cedula = (isset($_POST['txtCedula']))?$_POST['txtCedula']:$usuario->cedula;
           $usuario->telefono = (isset($_POST['txtTelefono']))?$_POST['txtTelefono']:$usuario->telefono;
           $usuario->clave = (isset($_POST['txtClave']))?$_POST['txtClave']:$usuario->clave;
           //$usuario->guardar();
        
        }        
    }

?>
<html>
<head>
	<title>Anuncios PHP !!!!!</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/otroestilo.css">
  <link rel="stylesheet" type="text/css" href="css/tooltips.css">
</head>
<body onLoad="setearMascara()">

<!-- Barra superior-->

  <header class="encabezado"><p>Anuncios PHP</p></header>
  <div class="navbar navbar-inverse" id="overview">
       <div class='navbar-inner'>
          <div id="container">
            <div class="nav-collapse">
              <form method="GET" action="" class="form-search" > 
                <div class="input-append">
                  <input type="text" class="span2 search-query" name="txtBuscar" />
                  <button  type="submit" class="btn">Buscar</button>
                </div>
              </form>

               <ul class="nav pull-right">
                  <li class="divider-vertical"></li>
                  <li>
                     <a href="#iniciarsesion" data-toggle="modal"><i class="icon-user icon-white"></i> Iniciar Sesi&oacute;n</a>
                  </li>
               </ul>
           </div>
          </div>
      </div>
  </div>

<!-- .___ . mira a ver que haras con esto >:/ JUM!!!!!! -->
    <div id="confirmar" class="modal hide fade" tabindex="-1" rol="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
             <h3 id="myModalLabel">Confirmar</h3>

          </div>

          <div class="modal-body">
             Seguro que desea salir de aplicacion ?

          </div>

          <div class="modal-footer">
             <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
             <a class="btn btn-primary" href="index.html" target="_self">Aceptar</a>
             
          </div>
    </div>

<!--Login-->

    <div id="iniciarsesion" class="modal hide fade" tabindex="-1" rol="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
             <h3 id="myModalLabel">Iniciar Sesi&oacute;n</h3>
        
          </div>

          <div class="modal-body">        	
            	<form method="POST" action="" class="form-horizontal">

                <div class="control-group">
                  <label class="control-label" for="txtUsuario">Nombre de usuario</label>
                  <div class="controls">
                    <input type="text" name="txtUsuario" placeholder="Usuario">
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="txtClave">Contrase&ntilde;a</label>
                  <div class="controls">
                    <input type="password" name="txtClave" placeholder="Contrase&ntilde;a">
                  </div>
                </div>

                <div class="control-group">
                  <div class="controls">
                    <label class="checkbox">
                      <input type="checkbox"> Recuerdame
                    </label>
                      <input type="submit" class="btn btn-primary" id="btnLogin" value="Aceptar" />
                  </div>
                </div>

              </form>
          </div>

          <div class="modal-footer">
            <a href="#registrarse" class="registro" data-toggle="modal" data-dismiss="modal"> &iquest;Eres nuevo? Que esperas para registrarte :D </a>

          </div>
      </div>

<!--Formulario para registrarse -->

     <div id="registrarse" class="modal" tabindex="-1" rol="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
             <h3 id="myModalLabel">Registro</h3>
        
          </div>

          <div class="modal-body">
            <form method="POST" action="" class="form-horizontal frmRegistrar" onsubmit="verificar()"> 
              <table class="tblAgregar">
                <tbody>
                  <tr>
                    <th>Nombre</th>
                    <td><input type="text" name="txtNombre" value="<?php echo $_POST['txtNombre'] ?>" required/> </td>
                  </tr>

                  <tr>
                    <th>Apellido</th>
                    <td><input type="text" name="txtApellido" value="<?php echo $_POST['txtApellido'] ?>" required /> </td>
                  </tr>

                  <tr>
                    <th>Nombre de usuario</th>
                    <td><input type="text" name="txtUsuario"value="<?php echo $_POST['txtUsuario'] ?>" required /> </td>
                  </tr>

                  <tr class="contraseña">
                    <th>Contrase&ntilde;a</th>
                    <td><input type="password" id="txtPrimeraClave" name="txtPrimeraClave"></td>
                  </tr>
                  <tr>

                  <tr class="contraseña">
                    <th>Repita su Contrase&ntilde;a, Por Favor</th>
                    <td><input type="password" id="txtSegundaClave" name="txtSegundaClave"></td>
                    <td ><span class="help-inline"> La contrase&ntilde;a debe tener 6 caracteres Max.</span></td>
                  </tr>

                  <tr class="magia">
                    <td colspan="2">  
                        <div class="alert alert-error">
                          <button type="button" class="close" data-dismiss="alert">x</button>
                          <span>Las contrase&ntilde;as no coinciden</span>
                        </div> 
                    </td> 
                  </tr>

                  <tr>
                    <th>Email</th>
                    <td><input type="email" name="txtEmail" placeholder="Prueba@hotmail.com" value="<?php echo $_POST['txtEmail'] ?>"required /> </td>
                  </tr>

                  <tr class="<?php  echo $mostrarErrorEmail;?>">
                    <td colspan="2">  
                        <div class="alert alert-error">
                          <button type="button" class="close" data-dismiss="alert">x</button>
                          <span>Este correo electronico esta en uso</span>
                        </div> 
                    </td> 
                  </tr>


                  <tr>
                    <th>Cedula</th>
                    <td><input type="text" id="txtCedula" name="txtCedula" id="inputError" placeholder="000-0000000-0" required/> </td>
                  </tr>

                  <tr class="<?php  echo $mostrarErrorCedula;?>">
                    <td colspan="2">  
                        <div class="alert alert-error">
                          <button type="button" class="close" data-dismiss="alert">x</button>
                          <span>Existe un usuario con esa Cedula</span>
                        </div> 
                    </td> 
                  </tr>

                  <tr>
                    <th>Telefono</th>
                    <td><input type="text" name="txtTelefono" placeholder="(000) 000-0000" value="<?php echo $_POST['txtTelefono'] ?>"required/> </td>
                  </tr>
                 
                </tbody>
              </table>

              <div class="control-group">
                <div class="controls">
                   <label class="checkbox">
                    <input type="checkbox" required> Acepto los T&eacute;rminos de uso
                    
                   </label>

                  <input type="submit" value="Aceptar" class="btn btn-success" id="btnRegistro"/></td>
                </div>
              </div>

            </form>
          </div>

          <div class="modal-footer"></div>
      </div>

<!--Barra de navegación-->

  <div class="contenido">
      <div class="span2" data-spy="affix">
          <ul class="nav nav-tabs nav-stacked barracategoria">
            <li><h3 class="lblCategoria">Categorias</h3></li>
            <li><a href="">Electronica</a></li>
            <li><a href="">Computadoras</a></li>
            <li><a href="">Zona Gamers</a></li>
            <li><a href="">Artic&uacute;los Gamers</a></li>
            <li><a href="">Otros</a></li>
          </ul>
  
      </div>

        <?php 
            $fecha =  date('l jS \of F Y h:i:s A');
            $categoria = "No se :/"; 
            $fotos = rand(0,3);

            for ($i=0; $i < 2; $i++) { 
              echo "
                <section>
                  <h1>Poster De Cartoon Network</h1>
                  <img src='imagenes/1.jpg' class='imagenArticulo img-polaroid'>
                  <article class='articulo'>
                    <p class='nombre'><strong>Nombre:</strong> ---Nombre del usuario---</p>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. In auctor ornare neque eu ultrices. 
                      Aenean viverra scelerisque velit, quis laoreet nisl mollis at. Nullam condimentum luctus lorem, 
                      ac rutrum est tempor in. 
                    </p>

                    <aside><strong>Fecha de publicacion:</strong> $fecha | <strong>Categoria:</strong> $categoria | <strong>Fotos:</strong> $fotos </aside>
                  </article>
                </section> <br>";


            }

         ?>

    </div>

<!-- Final de pagina -->
    <footer>
      <p>Categorias</p>
      <ul>
        <li><a href="index.php?cat=electronica">Electronica</a></li>
        <li><a href="">Computadoras</a></li>
        <li><a href="">Zona Gamers</a></li>
        <li><a href="">Artic&uacute;los Gamers</a></li>
        <li><a href="">Otros</a></li>

      </ul>


    </footer>

<!-- Scripts -->
      <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>
      <script type="text/javascript" src="js/funciones.js"></script>
      <script type="text/javascript" src="js/bootstrap-affix.js"></script>
      <script type="text/javascript" src="js/jquery.inputmask.js"></script>
      <script type="text/javascript" src="js/tooltips.js"></script>
      <script>
        $(function() {
          $("a[title]").tooltips();

        });


     </script>

</body>
</html>