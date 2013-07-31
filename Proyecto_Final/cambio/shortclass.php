<?php

class usuario extends genclas{
	public $id;
	public $usuario;
	public $nombre;
	public $clave;
	public $confirmar;

	public function __construct(){
		parent::__construct('usuario',$id);

	}

	function guardar($id= 0){
		$sql = "INSERT INTO usuario(clave) VALUES(MD5('$this->clave')) where idusuario = 3;";
		asgMng::query($sql);
		parent::guardar();

	}

	static function obtenerTodosUsuarios(){
		$usuarios = array();
		$sql = "select * from usuario;";
		$rs = asgMng::query($sql);

			while($fila = mysqli_fetch_assoc($rs)){
				$usuarios[] = $fila;

			}

		return $usuarios;

	}

	public function logear($usuario,$clave){
		$usuario = mysql_real_escape_string($usuario);
		$clave = mysql_real_escape_string($clave);
		echo 'Problemas men problemas everywhere';
		exit();
		$sql = "select * from usuario where nombreusuario = '$this->usuario' and clave=MD5('$this->clave');";
		$rs = asgMng::query($sql) or die('Problemas men problemas everywhere');

			if (mysqli_num_rows($rs) > 0) {
				$fila = mysqli_fetch_assoc($rs);
				$this->id = $fila['idagente'];
				$this->nombre = $fila['nombre'];
				$this->confirmar = true;

			}else {
					$this->confirmar = false;
					
			}

	}
}

