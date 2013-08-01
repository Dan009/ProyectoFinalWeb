<?php  
session_start();

   $inactividad = 1800;

  if ($_SESSION['tiempo_sesion']) {
    $vida_sesion = time() - $_SESSION['tiempo_sesion'];
      if ($vida_sesion > $inactividad) {
          echo "<script>alert('Tu sesion sera cerrada')</script>";

      }
   }

  $_SESSION['tiempo_sesion'] = time();

?>
<html>
<head>
  <title>Perfil</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/otroestilo.css">
</head>

<body onLoad="setearMascara()">

<!-- Barra Superior -->
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

              <a class="brand" href="#">Anuncios PHP</a>

               <ul class="nav pull-right">
                  <li class="divider-vertical"></li>

                  <li class="dropdown">
                      <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user icon-white"></i>
                        <?php  echo $_SESSION['usuario'];?> <b class="caret"></b></a>

                        <ul class="dropdown-menu">
                          <li><a href="#confirmar" data-toggle="modal"><i class="icon-off"></i> <span>Cerrar ses&iacuteon</span></a></li> 

                        </ul>
                  </li>
               </ul>
           </div>
          </div>
      </div>
  </div>

<!-- Barra de navegacion -->
  <div class="span3" data-spy="affix">
        <ul class="nav nav-tabs nav-stacked barracategoria">
          <li><h4 class="lblCategoria">Categorias</h4></li>
          <li><a href="">Electronica</a></li>
          <li><a href="">Computadoras</a></li>
          <li><a href="">Videojuegos</a></li>
          <li><a href="">Artic&uacute;los Gamers</a></li>
          <li><a href="">Otros</a></li>
        </ul> 

    </div>

<!-- Pestañas -->
  <div  class="contenedor tab-content">
    <ul class="nav nav-tabs pestaña" id="Pestañas">
      <li><a href="#anuncio" class="active" data-toggle="tab">Mis Anuncios</a></li>
      <li><a href="#perfil" data-toggle="tab">Perfil</a></li>
     
    </ul>

<!-- Perfil del usuario -->
  <div class="contenedorPerfil span centrar tab-pane fade" id="perfil">
    <h1> Bienvenido ! de nuevo, <?php echo $_SESSION['usuario']; ?></h1>
    <div class="infoUsuario">
      <h4>Foto de perfil</h4>
      <img src='libreria/img.php?src=imagenes/nophoto.jpg&w=140&h=140' class='imagenPerfil img-polaroid'>
      <br />
      <a href="#subirimagen" data-toggle="modal" class="btnSubir btn btn-info">Subir Imagen</a>
      <h5>Plan: Gratis</h5>
      <h4>Cantidad de anuncios: 0</h4>
    </div>

    <!-- Formulario de modificación -->
      <div id="frmModificar">
        <form method="POST" action="" class="form-horizontal frmRegistrar"> 
          <table class="tblAgregar">
            <tbody class="espacio">
              <tr>
                <th>Nombre</th>
                <td><input type="text" name="txtNombre" value="<?php echo $_POST['txtNombre'] ?>" required /> </td>
        
                <th>Apellido</th>
                <td><input type="text" name="txtApellido" value="<?php echo $_POST['txtApellido'] ?>" required /> </td>
              </tr>

              <tr>
                <th>Nombre de usuario</th>
                <td><input type="text" name="txtUsuario"value="<?php echo $_POST['txtUsuario'] ?>" required /> </td>
           
                <th>Email</th>
                <td><input type="email" name="txtEmail" placeholder="Prueba@hotmail.com" value="<?php echo $_POST['txtEmail'] ?>"required /> </td>
              </tr>

              <tr>
                <th>Cedula</th>
                <td><input type="text" id="txtCedula" name="txtCedula" id="inputError" placeholder="000-0000000-0" required/> </td>
         
                <th>Telefono</th>
                <td><input type="text" name="txtTelefono" placeholder="(000) 000-0000" value="<?php echo $_POST['txtTelefono'] ?>"required /> </td>
              </tr>

              <tr>
                <td colspan="4" class="centrar"><input type="submit" value="Modificar" class="btn btn-success" id="btnRegistro" name="btnRegistro" /></td>

              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>

<!-- Panel de Anuncios -->
    <div id="anuncio" class="fade">
      <h2>Publicar Anuncio</h2> 
      <form method="POST" action="" enctype="multipart/form-data">

          <div class="seccionOpcion">
            <span class="textoAnuncio">Eliga la categoria del anuncio</span>
            <select name="txtCategoria">
              <option>Electronica</option>
              <option>Computadoras</option>
              <option>Videojuegos</option>
              <option>Artic&uacute;los Videojuegos</option>
              <option>Otros</option>
            </select>
          </div>

          <div class="seccionOpcion">
            <span class="textoAnuncio">Titulo que desea en el anuncio</span>
            <input type="text" name="txtTitulo" placeholder="Escriba Su Titulo Aqui" />
          </div>
        
          <div class="seccionOpcion">
            <span class="textoAnuncio">Ubicacion del anuncio</span>
            <h5>Provincia</h5>
            <select name="txtProvincia" onchange="setearDireccion()">
              <option value="Azua de compostela">Azua de Compostela</option>
              <option value="Bahoruco">Bahoruco</option>
              <option value="Barahona">Barahona</option>
              <option value="Dajabon">Dajabon</option>
              <option value="Distrito Nacional">Distrito Nacional</option>
              <option value="Duarte">Duarte</option>
              <option value="El Seibo">El Seibo</option>
              <option value="Elias Pina">Elias Pi&ntilde;a</option>
              <option value="Espaillat">Espaillat</option>
              <option value="Hato Mayor">Hato Mayor</option>
              <option value="Hermanas Mirabal">Hermanas Mirabal</option>
              <option value="Independencia">Independencia</option>
              <option value="La Altagracia">La Altagracia</option>
              <option value="La Romana">La Romana</option>
              <option value="La Vega">La Vega</option>
              <option value="Maria Trinidad Sanchez">Mar&iacute;a Trinidad S&aacute;nchez</option>
              <option value="Monsenor Nouel">Monse&ntilde;or Nouel</option>
              <option value="Monte Cristi">Monte Cristi</option>
              <option value="Monte Plata">Monte Plata</option>
              <option value="Pedernales">Pedernales</option>
              <option value="Peravia">Peravia</option>
              <option value="Puerto Plata">Puerto Plata</option>
              <option value="Samana">Saman&aacute;</option>
              <option value="San Cristobal">San Crist&oacute;bal</option>
              <option value="San Jose De Ocoa">San Jos&eacute; De Ocoa</option>
              <option value="San Juan">San Juan</option>
              <option value="San Pedro De Macoris">San Pedro De Macor&iacute;s</option>
              <option value="Sanchez Ramirez">S&aacute;nchez Ram&iacute;rez</option>
              <option value="Santiago">Santiago</option>
              <option value="Santiago Rodriguez">Santiago Rodr&iacute;guez</option>
              <option selected="selected" value="Santo Domingo">Santo Domingo</option>
              <option value="Valverde">Valverde</option> 
            </select>
          </div>

           <div class="seccionOpcion">
            <span class="textoAnuncio">Direccion de su anuncio</span>
            <input type="text" name="txtDireccion" id="direccion"/>

          </div>

          <div id="map_canvas"></div>

          <fieldset class="fldFotos">
            <legend>Por favor solamente suba imagenes tipo .JPG,.PNG y GIF</legend>
            <tr>
              <td><h4>1.</h4></td>
              <td><input type="file" /></td>
              <td><h4>2.</h4></td>
              <td><input type="file" /></td>
              <td><h4>3.</h4></td>
              <td><input type="file" /></td>
            </tr>
          </fieldset>
      </form>
    </div>
  </div>

<!-- Confirmar Cerrar Sesión-->
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

<!-- Subir Imagen -->
  <div id="subirimagen" class="modal hide fade" tabindex="-1" rol="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
             <h3 id="myModalLabel">Subir Foto</h3>

          </div>

          <div class="modal-body">
             Seguro que desea salir de aplicacion ?

          </div>

          <div class="modal-footer">
             <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
             <a class="btn btn-primary" href="_selft" target="_self">Aceptar</a>
             
          </div>
    </div>  

<!-- Scripts -->
   <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>
      <script type="text/javascript" src="js/funciones.js"></script>
      <script type="text/javascript" src="js/bootstrap-affix.js"></script>
      <script type="text/javascript" src="js/jquery.inputmask.js"></script>
      <script type="text/javascript" src="js/tooltips.js"></script>
          <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDP4uFegmOaMhjScvEbHXmAAuUuLHEdOw0&sensor=true"></script>

    <script type="text/javascript" src="js/googleMapGeocoder.js"></script>

</body>
</html>