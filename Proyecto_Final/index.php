<?php  
  session_start();
  include 'libreria/engine.php';

  $categorias = categoria::getCategorias();
  $anuncios = anuncio::getAnuncios();

    if (isset($_GET['buscar']) && isset($_GET['query'])){
      $anuncios = buscador::buscar($_GET['q']);

    }else if(isset($_GET['query'])){
      $anuncios = buscador::buscarCategoria($_GET['query']);
      

    }
    
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
                <a class="brand" href="#">Anuncios PHP</a>
                  <ul class="nav">
                    <li><a href="busquedaAvanzada.php">Busqueda Avanzada</a></li>
                    <li><a href="#">Busqueda:</a></li>

                    <form method="GET" action="" class="form-search">
                      <div class="input-append">
                        <input type="text" class="span2 search-query" name="query" />
                      
                        <button type="submit" class="btn">Buscar</button>
                      </div>
                    </form>
                  </ul>

                 <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <li class="dropdown">
                     <?php 
                      
                        $nombreSesion = "Iniciar Sesi&oacute;n";

                        if (isset($_SESSION['userLogin'])){   
                          $nombreusuario = unserialize($_SESSION['userLogin'])->nombre;

                            echo " 
                             <a href='' class='dropdown-toggle' data-toggle='dropdown'>
                              <i class='icon-user icon-white'></i>
                              $nombreusuario <b class='caret'></b></a>

                              <ul class='dropdown-menu'>
                                <li><a href='libreria/logout.php' data-toggle='modal'><i class='icon-off'></i> <span>Cerrar ses&iacuteon</span></a></li> 

                              </ul>";

                        }else{
                          echo "<a href='#iniciarsesion' data-toggle='modal'><i class='icon-user icon-white'></i> $nombreSesion </a>";

                        }

                       ?>
                    
                  </li>
                </ul>
            </div>
         </div>
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
                      <input type="submit" class="btn btn-primary" name="btnLogin" id="btnLogin" value="Aceptar" />
                  </div>
                </div>

              </form>
          </div>

          <div class="modal-footer">
            <a href="agregarUsuario.php" class="registro"> &iquest;Eres nuevo? Que esperas para registrarte :D </a>

          </div>
      </div>

  <!--Barra de navegación-->
    <div class="span2" data-spy="affix">
        <ul class="nav nav-tabs nav-stacked barracategoria">
          <li><h3 class="lblCategoria">Categorias</h3></li>
           <?php 
              foreach ($categorias as $categoria) {
                 echo "<li><a href='index.php?query={$categoria['nombre']}'>{$categoria['nombre']}</a></li>";

              }
           
            ?>
        </ul>
    </div>

  <!-- Panel de Anuncios -->
    <div class="contenidoAnuncio">
        <?php 

            if ($anuncios) {
               foreach ($anuncios as $anuncio) {
                $primerafoto = explode(",", $anuncio['idfotos']);

                echo "
                  <section>
                    <h1>{$anuncio['titulo']}</h1>
                    <img src='libreria/img.php?src=imagenes/$primerafoto[0].jpg&w=140&h=140' class='imagenArticulo img-polaroid'>
                    <article class='articulo'>
                      <p class='nombre'><strong>Nombre: </strong> {$anuncio['nombre']} ({$anuncio['nombreusuario']})</p>
                      <p>
                        <strong>Descripc&iacute;on: </strong>{$anuncio['descripcion']}
                      </p>

                      <aside><strong>Fecha de publicacion:</strong> {$anuncio['fecha_publicada']} <br /> <strong>Categoria:</strong> {$anuncio['categoria']} <br /> <strong>Fotos:</strong> {$anuncio['fotos']} </aside>
                    </article>
                  </section> <br>";

                }

              }else{
                echo "<h2>No hay resultados que mostrar</h2>";

              }

         ?>
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