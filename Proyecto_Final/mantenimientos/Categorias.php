<?php
  include("../libreria/engine.php");

  $categorias = categoria::getCategorias();
  $categoria = new categoria();

    if ($_GET && $_GET['id'] > 0) {
       if ($_GET['accion'] == "Modificar") {
          $categoria->idcategoria = $_GET['id'];
          $categoria->cargar();

       }else{
        $categoria->idcategoria = $_GET['id'];
        $categoria->eliminarCategoria();
        $categorias = categoria::getCategorias();
        
       }
    }

    if ($_POST) {
      $categoria->nombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:$categoria->nombre;
      $categoria->descripcion = (isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:$categoria->descripcion;
      $categoria->guardar();
      $categorias = categoria::getCategorias();

    }

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
        <tr>
          <th>ID</th>
          <th>Categoria</th>
          <th>Descripcion</th>
          <th>Modificar</th>
          <th>Eliminar</th>
        </tr>
      </thead>

      <tbody>
        <?php 
            if ($categorias) {
              foreach ($categorias as $dato) {
                echo "
                  <tr> 
                    <td>{$dato['idcategoria']}</td> 
                    <td>{$dato['nombre']}</td>
                    <td>{$dato['descripcion']}</td>
                    <td><a href='?accion=Modificar&id={$dato['idcategoria']}'>Modificar</a></td>
                    <td><a href='?accion=Eliminar&id={$dato['idcategoria']}'>Eliminar</a></td>

                  </tr>";
        
              }

            }else {
               echo "<tr><td colspan='5' class='centrar'><h1 class='centrar'>No hay categorias agregadas</h1></td></tr>";

            }

        ?>
      </tbody>
    </table>

    <form method="POST" action="">
      <table id="tblCategoria" class="excepcion">
        <tr><td colspan="2"> <h2 class="centrar">Agregar Una Nueva Categoria</h2></td></tr>
          <tr>  
            <th>Nombre</th>
            <td><input type="text" name="txtNombre" value="<?php echo $categoria->nombre; ?>" required="required" /></td>

          </tr>

          <tr>
            <th>Descripcion</th>
            <td>
              <textarea id="txtDescripcion" name="txtDescripcion" placeholder="¿De que se trata esta categoria ?" maxlength="150" required="required"><?php echo $categoria->descripcion; ?></textarea>
              <h5>Longitud de descripcion Max. 150 letras</h5>
                                                                                     
            </td>
          </tr>

          <tr>
            <td colspan="5" class="centrar">
              <input type="submit" id="btnRegistro" class="btn btn-success" value="Agregar"/>

            </td>
          </tr>
      </table>
    </form>
  </div>

<!-- Modal Confirmar -->
  <div id="confirmar" class="modal hide fade" tabindex="-1" rol="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
       <h3 id="myModalLabel">Confirmar</h3>
    </div>

    <div class="modal-body">  
      
      Seguro que desea salir?;

    </div>

    <div class="modal-footer">
       <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
       <a href="index.html" class="btn btn-primary">Aceptar</a>

    </div>
  </div> 

<!-- Scripts -->
  <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <script type="text/javascript" src="../js/funciones.js"></script>

</body>
</html>
