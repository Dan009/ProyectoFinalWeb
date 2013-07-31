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

			$this->usuario = mysqli_real_escape_string(asgMng::getCon(),$usuario);
			$this->clave = mysqli_real_escape_string(asgMng::getCon(),$clave);
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

	class admin extends genclas{
		public $id;
		public $usuario;
		public $clave;
		public $confirmar;

		function __construct($usuario,$clave){
			parent::__construct('administrador',$id);
			$this->usuario = mysqli_real_escape_string(asgMng::getCon(),$usuario);
			$this->clave = mysqli_real_escape_string(asgMng::getCon(),$clave);
			$sql = "select * from administrador where nombre = '$this->usuario' and clave = MD5($this->clave);";
			$rs = asgMng::query($sql) or die('Problemas iniciando sesion');

				if (mysqli_num_rows($rs) > 0) {
					$fila = mysqli_fetch_assoc($rs);
					$this->id = $fila['idagente'];
					$this->usuario = $fila['nombre'];
					$this->confirmar = true;

				}else {
						$this->confirmar = false;
						
				}

		}
	}

	class categoria extends genclas{

		function __construct( $id=0 ){
			parent::__construct('categoria',$id);

		}

		function getCategorias(){
			$categorias = array();
			$sql = "select * from categoria;";

			$rs = asgMng::query($sql);

			while($fila = mysqli_fetch_assoc($rs)) {
				$categorias[] = $fila;

			}

			return $categorias;

		}

	}