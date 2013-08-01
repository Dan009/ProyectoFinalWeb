<!DOCTYPE html >
<html>
<head>
<title>Mantenimientos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"> 
<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/otros.js"></script>

</head>
<body style="background-color: #97cae4; margin: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #3b5564;">
<div class="container-fluid" style="width:900px; height: auto; margin:0 15px; padding: 0; font-size: 18px;">
   <form method="POST" action="">
      <table class="table">
        <thead style="text-align:center;">
          <th>ID</th>
          <th>Titulo</th>
          <th>Descripcion</th>
          <th>Categoria</th>
          <th>Fotos</th>
          <th style="color:red;">Bannear</th>

        </thead>

        <tbody>
            <tr>  
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td style="text-align:center;">
                <a href="#">Eliminar</a>

              </td>
            </tr>
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
