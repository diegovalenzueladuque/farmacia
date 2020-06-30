<?php
require_once('modelo.php');

class imagenModel extends Modelo
{

	public function __construct(){
		parent::__construct();
	}

	public function getImagenes(){
		$img = $this->_db->query("SELECT img.nombre as imagen, p.id, p.nombre as producto, p.precio FROM imagenes img INNER JOIN productos p ON img.producto_id = p.id WHERE img.portada = 1 AND p.activo = 1");

		return $img->fetchall();
	}
	public function getImagenesClientes(){
		$img = $this->_db->query("SELECT imgc.nombre as imagen, c.id, c.nombre as cliente FROM img_cliente imgc INNER JOIN clientes c ON imgc.cliente_id = c.id WHERE imgc.portada = 1 AND c.persona = 1");

		return $img->fetchall();
	}

	public function getImagenNombre($nombre){
		$id = (int) $id;

		$img = $this->_db->prepare("SELECT id FROM imagenes WHERE id = ?");
		$img->bindParam(1, $nombre);
		$prod->execute();

		return $img->fetch();
	}

	public function getImagenProducto($producto){
		$producto = (int) $producto;

		$img = $this->_db->prepare("SELECT id, titulo, descripcion, nombre FROM imagenes WHERE producto_id = ?");
		$img->bindParam(1, $producto);
		$img->execute();

		return $img->fetchall();
	}

	public function getImagenCliente($cliente){
		$cliente = (int) $cliente;

		$img = $this->_db->prepare("SELECT id, titulo, descripcion, nombre FROM img_cliente WHERE cliente_id = ?");
		$img->bindParam(1, $cliente);
		$img->execute();

		return $img->fetchall();
	}

	public function setImagen($titulo, $imagen, $descripcion, $producto, $portada){
		$producto = (int) $producto;
		$portada = (int) $portada;

		$img = $this->_db->prepare("INSERT INTO imagenes VALUES(null, ?, ?, ?, ?, ?, now(), now())");
		$img->bindParam(1, $titulo);
		$img->bindParam(2, $imagen);
		$img->bindParam(3, $descripcion);
		$img->bindParam(4, $producto);
		$img->bindParam(5, $portada);
		$img->execute();

		$row = $img->rowCount();
		return $row;
	}
	public function setImagenCliente($titulo, $imagen, $descripcion, $portada, $cliente){
		$cliente = (int) $cliente;
		$portada = (int) $portada;

		$img = $this->_db->prepare("INSERT INTO img_cliente VALUES(null, ?, ?, ?, ?, ?, now(), now())");
		$img->bindParam(1, $titulo);
		$img->bindParam(2, $imagen);
		$img->bindParam(3, $descripcion);
		$img->bindParam(4, $portada);
		$img->bindParam(5, $cliente);		
		$img->execute();

		$row = $img->rowCount();
		return $row;
	}
}