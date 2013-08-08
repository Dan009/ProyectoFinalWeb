<?php
  session_start();
  include 'libreria/engine.php';

  $categorias = categoria::getCategorias();
  $mapaMostrar = false;
  $listaMostrar = false;
  $funcion = "";

    if (isset($_GET['buscar']) && isset($_GET['query']) && isset($_GET['tipo'])) {
      if ($_GET['tipo'] == 'lista') {
          $resultados = buscador::busquedaAvanzada($_GET['query'],$_GET['txtCategoria']);
          $listaMostrar = true;
          $mapaMostrar = false;

      }else{
         $resultados = buscador::busquedaAvanzada($_GET['query'],$_GET['txtCategoria']);
         $mapaMostrar = true;
         $listaMostrar = false;
         $funcion = "setearMapa()";

         echo " <script type='text/javascript'>
                
                function setearMapa(){
                  var latLng = new google.maps.LatLng(18.505331,-69.986397);

                   var myOptions = {
                      center: latLng,
                      zoom: 10,
                      mapTypeId: google.maps.MapTypeId.ROADMAP

                    }; 

                    var map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);";
                  
                    foreach ($resultados as $anuncio) {
                      $nombreMarker = "marker{$anuncio['idanuncio']}";

                      echo " 
                        latLng = new google.maps.LatLng({$anuncio['latitud']},{$anuncio['longitud']});

                        $nombreMarker  = new google.maps.Marker({
                          map: map,
                          position: latLng,
                          title: '{$anuncio['titulo']}',
                          url: 'verAnuncio.php?idAnuncio={$anuncio['idanuncio']}'
                           });
                                ";
                        
                        echo " google.maps.event.addListener($nombreMarker , 'click', function() {  window.location.href = this.url; }); }";
                        
                    }

             echo "</script>";

      }

    }

?>

<html>
  <head>
    <title>Busqueda Avanzada</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/otroestilo.css">
  </head>
<body onLoad="<?php echo $funcion; ?>">

<!-- Barra superior-->
  <div class="navbar navbar-inverse" id="overview">
    <div class='navbar-inner'>
        <div id="container">
          <div class="nav-collapse">
            <a class="brand" href="index.php">Anuncios PHP</a>
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

<!--Barra de navegación-->
  <div class="span2" data-spy="affix">
      <ul class="nav nav-tabs nav-stacked barracategoria">
        <li><h3 class="lblCategoria">Categorias</h3></li>
         <?php 
            foreach ($categorias as $categoria) {
               echo "<li><a href=''>{$categoria['nombre']}</a></li>";

            }
         
          ?>

  </div>

<!-- Panel Busqueda Avanzada-->
  <div class="contenido busquedaAvanzada">
    <form method="GET" action="">
      <h3>Busqueda Avanzada</h3>

      <div class="seccionOpcion">
        <label for="txtTexto">Texto a buscar</label>
        <input type="text" name="query" id="txtTexto" required="required" />

      </div>

      <div class="seccionOpcion">
        <label for="txtCategoria">Categoria</label>
          <select name="txtCategoria" id="txtCategoria" required="required">
            <?php 
              foreach ($categorias as $categoria) {
                 echo "<option>{$categoria['nombre']}</option>";

              }
             
            ?>

          </select>
      </div>

      <div class="seccionOpcion">
        <h4>Vista</h4>
        <label class="radio">
          <input type="radio" name="tipo" value="lista" required="required" />
          Lista
        </label>

        <label class="radio">
          <input type="radio" name="tipo" value="mapa" required="required" />
          Mapa
        </label>

      </div>
      <input type="submit" name="buscar" class="btn btn-info btnBuscar" value="Buscar" required="required" onclick="setearMapa()"/>
    
    </form>
    
      <?php 
       if ($listaMostrar || $mapaMostrar) {
          if ($listaMostrar) {
             echo "
            <table class='table table-condensed tblAnuncios'>
              <thead>
                <tr>
                  <th>Titulo</th>
                  <th>Cantidad de fotos</th>
                  <th>Ver anuncio</th>
                </tr>
              </thead><tbody>";

            foreach ($resultados as $anuncio) {
              echo "
                <tr class='info'>
                  <td>{$anuncio['titulo']}</td>
                  <td>{$anuncio['fotos']}</td>
                  <td><a href='verAnuncio.php?idAnuncio={$anuncio['idanuncio']}'>Ver detalles</a></td>
                </tr>";

            }
            echo "</tbody></table>";

          }else if ($mapaMostrar){
            echo " <div id='map_canvas'>";

          }

       }

      ?>

  </div>

<!-- Scripts -->
  <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDP4uFegmOaMhjScvEbHXmAAuUuLHEdOw0&sensor=true&region=DO"></script>

</body>
</html>