<?php  
	
	include_once("libreria/engine.php");
	if ($_SESSION['userLogin'] && unserialize($_SESSION['userLogin'])->confirmar == true ) { 


	}else{
		header("Location:index.php");

	}

