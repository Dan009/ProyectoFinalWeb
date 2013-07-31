<?php 
  while ($reg=mysql_fetch_array($registros){
    echo "<pre>".var_dump($reg)."</pre>";
    exit();
    echo "id del vuelo: ".$reg['id_vuelo']."<br>";
    echo "Destino: ".$reg['destino']."<br>";
    echo "Hora: ".$reg['hora']."<br>";
    echo "Hora: ".$reg['fecha']."<br>";

    echo "<br>";
    echo "<hr>";
}


 ?>