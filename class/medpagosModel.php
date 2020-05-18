<?php
require('modelo.php');

class medPagosModel extends Modelo
{
	public function __construct(){
		//disponemos de lo declarado en el constructor de la clase modelo
		parent::__construct();
	}

	//traemos todos los roles de la tabla roles
	public function getMedPagos(){
		//consulta a la tabla roles usando el objeto db de la clase modelo
		$medpagos = $this->_db->query("SELECT id, nombre FROM medios_pago ORDER BY id DESC");

		//retornamos lo que haya en la tabla roles
		return $medpagos->fetchall();
	}

	public function getMedPagosId($id){
		$id = (int) $id;

		$medpago = $this->_db->prepare("SELECT id, nombre, created_at, updated_at FROM medios_pago WHERE id = ?");
		$medpago->bindParam(1, $id);
		$medpago->execute();

		return $medpago->fetch();
	}

	public function getMedPagosNombre($nombre){
		$medpago = $this->_db->prepare("SELECT id FROM medios_pago WHERE nombre = ?");
		$medpago->bindParam(1, $nombre);
		$medpago->execute();

		return $rol->fetch();
	}

	public function setMediosPago($nombre){
		$medpago = $this->_db->prepare("INSERT INTO medios_pago VALUES(null, ?, now(), now())");
		$medpago->bindParam(1, $nombre); //definimos el valor de cada ?
		$medpago->execute();//ejecutamos la consulta

		$row = $medpago->rowCount(); //devuelve la cantidad de registros insertados
		return $row;
	}
}