<?php
require('modelo.php');

class catModel extends Modelo
{
	public function __construct(){
		//disponemos de lo declarado en el constructor de la clase modelo
		parent::__construct();
	}

	//traemos todos los roles de la tabla roles
	public function getCategorias(){
		//consulta a la tabla roles usando el objeto db de la clase modelo
		$categorias = $this->_db->query("SELECT id, nombre, código FROM categorías ORDER BY id DESC");

		//retornamos lo que haya en la tabla roles
		return $categorias->fetchall();
	}

	public function getCategoriaId($id){
		$id = (int) $id;

		$categoria = $this->_db->prepare("SELECT id, nombre, código, created_at, updated_at FROM categorías WHERE id = ?");
		$categoria->bindParam(1, $id);
		$categoria->execute();

		return $categoria->fetch();
	}

	public function getCategoriaNombre($nombre){
		$categoria = $this->_db->prepare("SELECT id FROM categorías WHERE nombre = ?");
		$categoria->bindParam(1, $nombre);
		$categoria->execute();

		return $categoria->fetch();
	}

	public function getCategoriaCodigo($codigo){
		$categoria = $this->_db->prepare("SELECT id FROM categorías WHERE código = ?");
		$categoria->bindParam(1, $codigo);
		$categoria->execute();

		return $categoria->fetch();
	}	

	public function setCategorias($nombre, $codigo){
		$categoria = $this->_db->prepare("INSERT INTO categorías VALUES(null, ?, ?, now(), now())");
		$categoria->bindParam(1, $nombre); 
		$categoria->bindParam(2, $codigo);//definimos el valor de cada ?
		$categoria->execute();//ejecutamos la consulta

		$row = $categoria->rowCount(); //devuelve la cantidad de registros insertados
		return $row;
	}
}