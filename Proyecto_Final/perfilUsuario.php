<?php  
session_start();
include("libreria/seguridad.php");

 $magia = "magia";
 $categorias = categoria::getCategorias();

    if($_POST){
      $anuncio = new anuncio();
      $sobrepesado = false;

     foreach ($_FILES as $foto) {
        if($foto["size"] > 3000000) {
           $sobrepesado = true;

        }

     }

        if (!$sobrepesado) {
            $anuncio->titulo = (isset($_POST['txtTitulo']))?$_POST['txtTitulo']:$anuncio->titulo;
            $anuncio->descripcion = (isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:$anuncio->descripcion;
            $anuncio->categoria = (isset($_POST['txtCategoria']))?$_POST['txtCategoria']:$anuncio->categoria;
            $anuncio->idusuario = $_GET['id'];
            $anuncio->latitud = (isset($_POST['txtLatitud']))?$_POST['txtLatitud']:$anuncio->latitud;
            $anuncio->longitud = (isset($_POST['txtLongitud']))?$_POST['txtLongitud']:$anuncio->longitud;
          
            $anuncio->guardar();

            /*
              @params
                idanuncio,
                fotos

            */
     
            $fotos = $anuncio->agregarFotos($anuncio->idquery,$_FILES);
            $fotos = explode(",", $fotos);

            // Nombrar las fotos
            foreach ($_FILES as $foto) {
              for ($i=0; $i < sizeof($fotos); $i++) { 
                move_uploaded_file($foto['tmp_name'],  "imagenes/{$fotos[$i]}.jpg");
                  
              }

            }

        }else{
          $magia = '';

        }
         
    }

    if (isset($_GET['buscar']) && isset($_GET['query'])){
      header("Location:index.php?buscar&query={$_GET['query']}");

    }

?>

<html>
<head>
  <title>Perfil</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/otroestilo.css">
  <META http-equiv=Content-Type content="text/html; charset=utf-8">
</head>

<body onLoad="setearMascara()">

<!-- Barra Superior -->
  <div class="navbar navbar-inverse" id="overview">
       <div class='navbar-inner'>
          <div id="container">
            <div class="nav-collapse">
              <form method="GET" action="" class="form-search" > 
                <div class="input-append">
                  <input type="text" class="span2 search-query" name="query" />
                  <button  type="submit" class="btn" name="buscar">Buscar</button>
                </div>
              </form>

              <a class="brand" href="index.php">Anuncios PHP</a>

               <ul class="nav pull-right">
                  <li class="divider-vertical"></li>

                  <li class="dropdown">
                      <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user icon-white"></i>
                        <?php  echo unserialize($_SESSION['userLogin'])->usuario;?> <b class="caret"></b></a>

                        <ul class="dropdown-menu">
                          <li><a href="libreria/logout.php" data-toggle="modal"><i class="icon-off"></i> <span>Cerrar ses&iacuteon</span></a></li> 

                        </ul>
                  </li>
               </ul>
           </div>
          </div>
      </div>
  </div>

<!-- Barra de navegacion -->
  <div class="span3" data-spy="affix">
    <ul class="nav nav-tabs nav-stacked barraCategoriaPerfil">
      <li><h3 class="lblCategoria">Categorias</h3></li>
      <?php 

        foreach ($categorias as $categoria) {
          echo "<li><a href='index.php?query={$categoria['nombre']}'>{$categoria['nombre']}</a></li>";

        }
         
     ?>
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
    <h1> Bienvenido <?php echo unserialize($_SESSION['userLogin'])->usuario; ?></h1>
    <div class="infoUsuario">
      <h4>Foto de perfil</h4>
      <img src='libreria/img.php?src=imagenes/nophoto.jpg&w=140&h=140' class='imagenPerfil img-polaroid'>
      <br />
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
             <?php 
        foreach ($categorias as $categoria) {
           echo "<option>{$categoria['nombre']}</option>";

        }
         
     ?>
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
              <option value="Neiba">Neiba</option>
              <option value="Barahona">Barahona</option>
              <option value="Dajabon">Dajab&oacute;n</option>
              <option value="Distrito Nacional">Distrito Nacional</option>
              <option value="San Francisco de Macoris">San Francisco de Macor&iacute;s</option>
              <option value="El Seibo">El Seibo</option>
              <option value="Comendador">Comendador</option>
              <option value="Moca">Moca</option>
              <option value="Hato Mayor">Hato Mayor</option>
              <option value="Salcedo">Salcedo</option>
              <option value="Independencia">Independencia</option>
              <option value="La Altagracia,Higuey">La Altagracia,Higuey</option>
              <option value="La Romana">La Romana</option>
              <option value="La Vega">La Vega</option>
              <option value="Nagua">Nagua</option>
              <option value="Monsenor Nouel">Monse&ntilde;or Nouel</option>
              <option value="Monte Cristi">Monte Cristi</option>
              <option value="Monte Plata">Monte Plata</option>
              <option value="Pedernales">Pedernales</option>
              <option value="Peravia">Peravia</option>
              <option value="Puerto Plata">Puerto Plata</option>
              <option value="Samana">Saman&aacute;</option>
              <option value="San Cristobal">San Crist&oacute;bal</option>
              <option value="San Jose De Ocoa">San Jos&eacute; De Ocoa</option>
              <option value="San Juan de la Maguana ">San Juan de la Maguana </option>
              <option value="San Pedro De Macoris">San Pedro De Macor&iacute;s</option>
              <option value="Cotui">Cotu&iacute;</option>
              <option value="Santiago">Santiago</option>
              <option value="San Ignacio de Sabaneta">San Ignacio de Sabaneta</option>
              <option selected="selected" value="Santo Domingo">Santo Domingo</option>
              <option value="Valverde">Valverde</option> 
            </select>
          </div>

         <div class="seccionOpcion">
            <span class="textoAnuncio">Direccion de su anuncio</span>
            <input type="text" name="txtDireccion" id="direccion" />
            <input type="text" name="txtLatitud" id="lat" />
            <input type="text" name="txtLongitud" id="long" />

          </div>

        <div id="map_canvas"></div>

      <div class="seccionOpcion">
        <span class="textoAnuncio">Descripc&iacute;on de su anuncio</span>
        <textarea name="txtDescripcion" maxlength="200"></textarea>
        <h5>Tama&ntilde;o Max. 200 letras</h5>

      </div>

        <fieldset class="fldFotos">
         <legend>Por favor solamente suba imagenes tipo .JPG, .PNG y .GIF y su peso sea menor que 3 MB</legend>

           <div id="errorFoto" class="<?php echo $magia; ?>">
                <div class='alert alert-error'>
                  <button type='button' class='close' data-dismiss='alert'>x</button>
                  <span>Una de las imagenes subidas tiene un tama&ntilde;o mayor a 3 MB</span>
                            
                </div> 
              </div>

             <table class="tblFotos">
                  <tr>
                    <td><h4>1.</h4></td>
                  </tr>

                  <tr>
                    <td><input type="file" name="txtFoto1" accept="image/*"/></td>

                  </tr>

                  <tr>
                    <td><h4>2.</h4></td>
                  </tr>

                  <tr>
                    <td><input type="file" name="txtFoto2" accept="image/*" /></td>
                  </tr>

                  <tr>
                    <td><h4>3.</h4></td>
                  </tr>

                  <tr>
                    <td><input type="file" name="txtFoto3" accept="image/*"/></td>
                  </tr>
              </table>

          
        </fieldset>
        <input style="margin: 30px 0 0 360px;" type="submit" value="Aceptar" class="btn btn-success" id="btnRegistro" name="btnRegistro"/>

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
       <a href="logout.php" class="btn btn-primary">Aceptar</a>
       
    </div>
  </div>

<!-- Subir Imagen -->
  <div id="subirimagen" class="modal hide fade" tabindex="-1" rol="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="GET" action="" enctype="multipart/form-data">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
         <h3 id="myModalLabel">Subir Foto</h3>

      </div>
     
      <div class="modal-body">
        <div id="imagenPerfil">
           <img src="libreria/img.php?src=imagenes/nophoto.jpg&amp;w=140&amp;h=140" class="img-polaroid" />

        </div>

        <input type="file" accept="image/*"name="txtFotoPerfil"/>
        
      </div>

      <div class="modal-footer">
         <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
         <button type="submit" class="btn btn-primary">Aceptar</button>
         
      </div>
    </form>
  </div>  

<!-- Scripts -->
   <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
    <script type="text/javascript" src="js/bootstrap-affix.js"></script>
    <script type="text/javascript" src="js/jquery.inputmask.js"></script>
    <script type="text/javascript" src="js/tooltips.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDP4uFegmOaMhjScvEbHXmAAuUuLHEdOw0&sensor=true"></script>

</body>
</html>