<?php

	class usuario extends genclas{
		public $id;
		public $usuario;
		public $nombre;
		public $clave;
		public $confirmar;

		public function __construct($id = 0){
			parent::__construct('usuario',$id);

		}

		function guardar(){
			parent::guardar();
			$this->id = mysqli_insert_id(asgMng::getCon());
			$sql = "UPDATE usuario SET clave = MD5('$this->clave') where idusuario = $this->id";
			asgMng::query($sql);

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
			$sql = "select * from usuario where nombreusuario = '$this->usuario' and clave=MD5($this->clave);";
			$rs = asgMng::query($sql) or die('Problemas iniciando sesion');

				if (mysqli_num_rows($rs) > 0) {
					$fila = mysqli_fetch_assoc($rs);
					$this->confirmar = true;
					$this->id =  $fila['idusuario'];
					$this->nombre =  $fila['nombreusuario'];


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
	
		function __construct(){
			parent::__construct('administrador',$id);

		}

		function loguear($usuario,$clave){
			$this->usuario = mysqli_real_escape_string(asgMng::getCon(),$usuario);
			$this->clave = mysqli_real_escape_string(asgMng::getCon(),$clave);
			$sql = "select * from administrador where nombre = '$this->usuario' and claveAdmin = MD5('$this->clave');";
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

		function guardar($id= 0){
			parent::guardar();
			$this->id = mysqli_insert_id(asgMng::getCon());
			$sql = "UPDATE admin SET claveAdmin = MD5('$this->clave') where idadmin = $this->id";
			asgMng::query($sql);	

		}

		function eliminarAdmin(){
			$sql = "Delete from administrador where idadmin = $this->idadmin";
			asgMng::query($sql);

		}

		static function getAdmins(){
			$admins = array();
			$sql = "SELECT * FROM administrador GROUP BY idadmin ASC ";

			$rs = asgMng::query($sql);

			while($fila = mysqli_fetch_assoc($rs)) {
				$admins[] = $fila;

			}

			return $admins;

		}

	}

	class categoria extends genclas{

		function __construct( $id=0 ){
			parent::__construct('categoria',$id);

		}

		function eliminarCategoria($id){
			$sql = "Delete from categoria where idcategoria = $id";
			asgMng::query($sql);

		}

		static function getCategorias(){
			$categorias = array();
			$sql = "SELECT * FROM categoria GROUP BY idcategoria ASC ";

			$rs = asgMng::query($sql);

			while($fila = mysqli_fetch_assoc($rs)) {
				$categorias[] = $fila;

			}

			return $categorias;

		}

	}

	class anuncio extends genclas{
		function __construct($id=0) {
			parent::__construct('anuncio',$id);

		}

		function agregarFotos($idanuncio,$fotos){
			$ids = "";

			foreach ($fotos as $foto) {
				if(!($foto['error'] == 4)){
				  $sql = "INSERT INTO fotos(idanuncio,nombre,tipo) 
				  VALUES('$idanuncio','{$foto['name']}','{$foto['type']}')";	
				  asgMng::query($sql);
				  $idFotoAgregada = mysqli_insert_id(asgMng::getCon()); 
				  $ids = $ids."$idFotoAgregada,";
	
				}

			}

		  $ids = trim($ids,",");
		  $sql = "UPDATE anuncio SET idfotos = $ids where idanuncio = $idanuncio";

		  asgMng::query($sql);

		  return $ids;
			
		}

		static function getFotos($id){
			$idFotos = array();

			$sql = "SELECT idfotos FROM anuncio WHERE idanuncio = $id";
			$rs = asgMng::query($sql);

			while($fila = mysqli_fetch_assoc($rs)) {
				$idFotos[] = $fila['idfotos'];

			}

			return $idFotos;

		}

		static function getAnuncios(){
			$categorias = array();
			$sql = "SELECT usua.nombre as nombre, usua.nombreusuario as nombreusuario, a.*,
			( SELECT COUNT( * ) 
			FROM fotos
			WHERE ft.idanuncio = a.idanuncio
			) AS fotos
			FROM anuncio a, fotos ft, usuario usua
			GROUP BY idanuncio ASC ";

			$rs = asgMng::query($sql);

			while($fila = mysqli_fetch_assoc($rs)) {
				$categorias[] = $fila;

			}

			return $categorias;
			
		}

	}

	class buscador{

		static function buscar($query){
			$resultados = array();

			$sql = "SELECT usua.nombre as nombre, usua.nombreusuario as nombreusuario, a.*,
			( SELECT COUNT( * ) 
			FROM fotos
			WHERE ft.idanuncio = a.idanuncio) AS fotos
			FROM anuncio a, fotos ft, usuario usua
			WHERE (titulo LIKE  '%$q%' OR descripcion LIKE  '%$q%')
			GROUP BY idanuncio ASC";

			$rs = asgMng::query($sql);

			while($fila = mysqli_fetch_assoc($rs)) {
				$resultados[] = $fila;

			}

			return $resultados;
			
		}

		static function busquedaAvanzada($query,$categoria){
			$resultados = array();

			$sql = "SELECT a.titulo,a.idanuncio,a.latitud,a.longitud,
			(SELECT COUNT(*) FROM fotos
			WHERE ft.idanuncio = a.idanuncio) AS fotos
			FROM anuncio a, fotos ft WHERE categoria = '$categoria' AND titulo LIKE '%$query%'";

			$rs = asgMng::query($sql);

			while($fila = mysqli_fetch_assoc($rs)) {
				$resultados[] = $fila;

			}

			return $resultados;

		}

		static function buscarCategoria($categoria){
			$resultados = array();

			$sql = "SELECT usua.nombre as nombre, usua.nombreusuario as nombreusuario, a.*,
			( SELECT COUNT( * ) 
			FROM fotos
			WHERE ft.idanuncio = a.idanuncio) AS fotos
			FROM anuncio a, fotos ft, usuario usua
			WHERE categoria = '$categoria'
			GROUP BY idanuncio ASC";

			$rs = asgMng::query($sql);

			while($fila = mysqli_fetch_assoc($rs)) {
				$resultados[] = $fila;

			}

			return $resultados;

		}

	}

