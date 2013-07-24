<?php

class usuario extends genclas{
	public $id;
	public $usuario;
	public $nombre;
	public $clave;
	public $confirmar;

	public function __construct($usuario,$clave,$id = 0){
		parent::__construct('usuario',$id);
		$this->usuario = mysqli_real_escape_string(asgMng::getCon(),$usuario);
		$this->clave = mysqli_real_escape_string(asgMng::getCon(),$clave);
		$sql = "select * from agente where usuario= '$this->usuario' and clave=MD5('$this->clave');";
		$rs = asgMng::query($sql);
		
			if (mysqli_num_rows($rs) > 0) {
				$fila = mysqli_fetch_assoc($rs);
				$this->id = $fila['idagente'];
				$this->nombre = $fila['nombre'];
				$this->confirmar = true;

			}else {
					$this->confirmar = false;
					
			}

	}

	public function guardar($id= 0){
		$sql = "INSERT INTO usuario(clave) VALUES(MD5('$this->clave'));";
		asgMng::query($sql);
		parent::guardar();

	}

	static function obtenerTodosUsuarios(){
		$usuarios = array();
		$sql = "select cedula,email from usuario;";
		$rs = asgMng::query($sql);

			while($fila = mysqli_fetch_assoc($rs)){
				$usuarios[] = $fila;

			}

		return $usuarios;

	}

}

