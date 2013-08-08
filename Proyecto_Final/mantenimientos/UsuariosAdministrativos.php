<?php
  include("../libreria/engine.php");

  $admins = admin::getAdmins();
  $admin = new admin();
  
    if ($_GET && $_GET['id'] > 0) {
       if ($_GET['accion'] == "Modificar") {
          $admin->idadmin = $_GET['id'];
          $admin->cargar();

       }else{
        $admin->idadmin = $_GET['id'];
        $admin->eliminarAdmin();
        $admins = admin::getAdmins();
        
       }
    }

    if ($_POST) {
      $admin->nombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:$admin->nombre;
      $admin->claveAdmin = (isset($_POST['txtClaveAdmin']))?$_POST['txtClaveAdmin']:$admin->claveAdmin;
      $admin->guardar();
      $admins = admin::getAdmins();

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

<body id="bdMatenimiento" onLoad="validar()">

  <div class="container-fluid">
    <table id="tblAdmins" class="table table-condensed borde">
      <thead>
        <tr>
          <th>ID</th>
          <th>admin</th>
          <th>Modificar</th>
          <th>Eliminar</th>
        </tr>
      </thead>

      <tbody>
        <?php 
            if ($admins) {
              foreach ($admins as $dato) {
                echo "
                  <tr> 
                    <td>{$dato['idadmin']}</td> 
                    <td>{$dato['nombre']}</td>
                    <td><a href='?accion=Modificar&id={$dato['idadmin']}'>Modificar</a></td>
                    <td><a href='?accion=Eliminar&id={$dato['idadmin']}'>Eliminar</a></td>

                  </tr>";
        
              }

            }else {
               echo "<tr><td colspan='5' class='centrar'><h1 class='centrar'>No hay admins agregadas</h1></td></tr>";

            }

        ?>
      </tbody>
    </table>

    <fieldset class="fldAdmin borde">
      <form method="POST" action="">
        <table id="tblAdmin">
          <tr><td colspan="2"> <h2 class="centrar">Agregar Administrador</h2></td></tr>
            <tr>  
              <th>Nombre</th>
              <td><input type="text" name="txtNombre" value="<?php echo $admin->nombre; ?>" required="required" /></td>
            </tr>

            <tr>
              <th>Contrase&ntilde;a</th>
              <td>
                <input type="password" id="txtClave" name="txtClave" required="required" />  

              </td>
            </tr>


            <tr id="error1" class="magia">
              <td colspan='2'>
               <div class='alert alert-error'>
                  <button type='button' class='close' data-dismiss='alert'>x</button>
                   <span>La constrase&ntilde;a digitada es muy corta</span>
                </div> 
              </td> 
            </tr>

            <tr>
              <td colspan="2" class="centrar">
                <input type="submit" id="btnRegistro" class="btn btn-success" value="Agregar"/>

              </td>
            </tr>
        </table>
      </form>
    </fieldset>
  </div>

<!-- Modal Confirmar -->
  <div id="confirmar" class="modal hide fade" tabindex="-1" rol="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
       <h3 id="myModalLabel">Confirmar</h3>
    </div>

    <div class="modal-body">  
     <?php 
      echo "<h3 class='centrar'>Confirme el registro que desea eliminar</h3>";
        echo "
          <table>
            <thead>
              <th>ID</th>
              <th>Nombre</th>
              <th>Eliminar</th>
            </thead>
              <tbody>
            ";

         echo  "</table>";

      ?>
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
