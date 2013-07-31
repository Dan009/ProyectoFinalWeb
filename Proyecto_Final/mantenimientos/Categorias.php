<?php
  include("../libreria/engine.php");

  $categoria = new categoria();
  $categorias = $categoria->getCategorias();
  echo "<pre>";
  var_dump($categorias);
  echo "</pre>";
  exit();
    
?>
<!DOCTYPE html >
<html>
<head>
<title>Mantenimientos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"> 
<link rel="stylesheet" type="text/css" href="../css/otroestilo.css"> 
</head>

<body id="bdMatenimiento">
<div class="container-fluid">
      <table class="table table-bordered tblCategoria">
        <thead>
          <th>ID</th>
          <th>Categoria</th>
          <th>Descripcion</th>
          <th>Modificar</th>
          <th>Eliminar</th>
        </thead>

        <tbody>
            <tr>  
              <td></td>
              <td></td>
              <td></td>
              <td>
                <a href="#">Modificar</a>
                
              </td>  

              <td>
                <a href="#">Eliminar</a>

              </td>

            </tr>
        </tbody>
      </table>

      <form method="POST" action="">
        <table id="tblCategoria" class="excepcion">
            <tr><td colspan="2"> <h2 class="centrar">Agrega Una Nueva Categoria</h2></td></tr>
              <tr>  
                <th>Nombre</th>
                <td><input type="text" name="txtNombre" required="required" /></td>

              </tr>

              <tr>
                <th>Descripcion</th>
                <td>
                  <textarea id="txtDescripcion" name="txtDescripcion" required="required" placeholder="¿De que se trata esta categoria ?" maxlength="150"></textarea> <h5>Longitud de descripcion Max. 150 letras</h5>
              </td>

              </tr>

              </tr>

              <tr>
                <td colspan="5" class="centrar"><input type="submit" id="btnRegistro" class="btn btn-success" value="Agregar"/> </td>

              </tr>
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

<!-- Scripts -->
  <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.js"></script>

</div>
</body>
</html>
