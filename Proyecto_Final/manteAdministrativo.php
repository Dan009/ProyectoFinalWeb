<?php 
session_start();

  $inactividad = 900;

  if ($_SESSION['vida_sesion']) {
    $vida_sesion = time() - $_SESSION['tiempo_sesion'];
      if ($vida_sesion > $inactividad) {
          echo "<script>alert('Tu sesion sera cerrada')</script>";

      }
   }

  $_SESSION['tiempo_sesion'] = time();

 ?>
<!DOCTYPE html >
<html>
<head>
  <title>Mantenimientos</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> 
  <link rel="stylesheet" type="text/css" href="css/otroestilo.css"> 
    
</head>

<body id="bdMatenimiento">

<!-- Barra de Navegación -->
  <div id="main_container">
    <div class="header">
      <div class="navbar navbar-inverse">
         <div class='navbar-inner'>
            <div id="container">
              <div class="nav-collapse">
                 <ul class="nav">
                  <li class="dropdown" target="_self"> <a class="dropdown-toggle" data-toggle="dropdown">Mantenimientos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       <li><a href='#'><span>Moderar Usuarios</span></a></li>
                       <li><a href='#.html'><span>Mantenimiento de Categorias</span></a></li>
                       <li><a href='#.html'><span>Moderar Anuncios</span></a></li>
                       <li><a href='#.html'><span>Moderar Anuncios</span></a></li>
                    </ul>

                  </li>
                 </ul>

                 <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <li class="dropdown">
                     <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i><?php echo strtoupper($_SESSION['usuario']); ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="index.html" target="_self"><i class="icon-off"></i> Cerrar ses&iacuteon</a></li> 

                        </ul>
                    </li>

                 </ul>
            </div> <!--Cierra el collapse-->
          </div> <!--Cierra el container-->
         </div> <!--Cierra el nav inner-->
      </div> <!--Cierra el navbar-->
     </div> <!--Cierra el header-->
  </div> <!--Cierra el main_container-->

<!-- Barra de navegacion -->
  <div id="menuMantenimiento" class="container-fluid">
    <div class="row-fluid">
      <div class="span2">
          <ul class="nav nav-tabs nav-stacked barracategoria">
            <li><a href="mantenimientos/UsuariosFrecos.html" target="pantalla">Moderar Usuario</a></li>
            <li><a href="mantenimientos/Categorias.php" target="pantalla">Mantenimiento de Categorias</a></li>
            <li><a href="mantenimientos/ModerarAnuncios.html" target="pantalla">Moderar Anuncios</a></li>
            <li>
              <a href="mantenimientos/UsuariosAdministrativos.html" target="pantalla">
                Mantenimiento de Administradores

              </a>
            </li>
         </ul> 

      </div>

      <div class="span2">
        <iframe id="pantalla"></iframe>
      </div>
    </div>
  </div>

<!-- Confirmar Logout -->
  <div id="confirmar" class="modal hide fade" tabindex="-1" rol="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
           <h3 id="myModalLabel">Confirmar</h3>
        </div>

        <div class="modal-body">  
            
          Seguro que desea salir ?

        </div>

        <div class="modal-footer">
           <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
           <a href="index.html" class="btn btn-primary">Aceptar</a>

        </div>
    </div> 

<!-- Scripts -->
  <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/funciones.js"></script>

</body>
</html>
