<?php  
	
	include 'libreria/engine.php';
	$categorias = categoria::getCategorias();
	$anuncio = new anuncio($_GET['idAnuncio']);
	$idFotos = anuncio::getFotos($_GET['idAnuncio']);
	$idFotos = explode(",", $idFotos[0]);
  $usuario = new usuario($anuncio->idusuario);

?>
<html>
  <head>
    <title>Busqueda Avanzada</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/otroestilo.css">
    <script type="text/javascript">
    	function ini(){
    		$('.carousel').carousel( {interval: 2000});

    	}


    </script>
  </head>

<body onload="ini()">

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

<!-- Info Anuncio -->
	<div id="detalleAnuncio">
	  <div class="well tituloAnuncio">
		  <h2 class="negro"><?php echo $anuncio->titulo; ?></h2>

	  </div>

	  <div class="panel panel-info panelAnuncio " id="panelFotos">
	  	<div class="panel-heading"> <h4 >Anuncio ID: <?php echo $anuncio->idanuncio; ?></h4></div>
	  		<div id="myCarousel" class="carousel slide">
			  <ol class="carousel-indicators">
			  	<?php  
				  	for ($i=0; $i < 3; $i++) { 
				  		echo "<li data-target='#myCarousel' data-slide-to='$i' class='active'></li>";

				  	}

			    ?>
			  </ol>

			  <div class="carousel-inner">
			  	<?php  
				  	for ($i=0; $i < 3; $i++) { 
					  echo "<div class='item'><img src='libreria/img.php?src=imagenes/{$idFotos[0]}.jpg&amp;w=200&amp;h=200' /></div>";
			
					}

			    ?>
			  </div>
			  <!-- Carousel nav -->
			  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
			  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
			</div>

	  </div>

	  <div class="panel panel-info panelAnuncio">
	  	<div class="panel-heading"> <h4 >Informaci&oacute;n del Vendedor</h4></div>

	  	<img src="libreria/img.php?src=imagenes/nophoto.jpg&amp;w=100&amp;h=100" class="img-polaroid imagenArticulo">
	  		<article class="infoUsuario">
          <strong>Nombre Completo:</strong> <?php echo $usuario->nombre;?> <?php echo $usuario->apellido ?> <br />
          <strong>Cedula:</strong> <?php  echo $usuario->cedula;?><br />
	  			<strong>Telefono:</strong> <?php  echo $usuario->telefono;?>

	  		</article>

	</div>

  <div class="panel panel-info panelAnuncio panelInfoAnuncio">
        <div class="panel-heading"> <h4 >Informaci&oacute;n del Anuncio</h4></div>
         <p><?php  echo $anuncio->descripcion; ?></p>
    

  </div>
</div>
<!-- Scripts -->
  <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>