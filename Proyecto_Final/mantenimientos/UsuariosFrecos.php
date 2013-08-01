<?php  
  include '../libreria/engine.php';
  $usuarios = usuario::obtenerTodosUsuarios();

?>
<!DOCTYPE html >
<html>
<head>
<title>Mantenimientos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../css/otroestilo.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"> 
<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>

</head>
<body id="bdMatenimiento">
<div class="modeUsuario">
   <form method="POST" action="">
      <table class="table table-condensed tblUsuario">
        <thead style="text-align:center;">
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Email</th>
          <th>Cedula</th>
          <th>Nombre Usuario</th>
          <th>N. de Anuncios</th>
          <th style="color:red;">Bannear</th>
        </thead>
          <tbody>
            <?php  
              foreach ($usuarios as $usuario) {
                  echo "<tr>  
                    <td>{$usuario['idusuario']}</td>
                    <td>{$usuario['nombre']}</td>
                    <td>{$usuario['apellido']}</td>
                    <td>{$usuario['email']}</td>
                    <td>{$usuario['cedula']}</td>
                    <td>{$usuario['nombreusuario']}</td>
                    <td>Te lo debo</td>
                    <td style='text-align:center;'>
                      <a href='#'>Eliminar</a>

                    </td>

                  </tr>";

                }
                ?>
          </tbody>
      </table>
   </form>
</div>

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
</div>
</body>
</html>
