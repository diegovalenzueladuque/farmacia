 <?php
require('modelo.php');

class prodModel extends Modelo
{
	public function __construct(){
		//disponemos de lo declarado en el constructor de la clase modelo
		parent::__construct();
	}

	//traemos todos los roles de la tabla roles
	public function getProductos(){
		//consulta a la tabla roles usando el objeto db de la clase modelo
		$productos = $this->_db->query("SELECT id, nombre, código FROM productos ORDER BY nombre");

		//retornamos lo que haya en la tabla roles
		return $productos->fetchAll();
	}

	public function getProductoId($id){
		$id = (int) $id;

		$producto = $this->_db->prepare("SELECT id, nombre, código, categoria_id, marca_id, descripción, created_at, updated_at FROM productos WHERE id = ?");
		$producto->bindParam(1, $id);
		$producto->execute();

		return $producto->fetch();
	}

	public function getProductoNombre($nombre){
		$producto = $this->_db->prepare("SELECT id FROM productos WHERE nombre = ?");
		$producto->bindParam(1, $nombre);
		$producto->execute();

		return $producto->fetch();
	}

	public function getProductoCodigo($codigo){
		$producto = $this->_db->prepare("SELECT id FROM productos WHERE código = ?");
		$producto->bindParam(1, $codigo);
		$producto->execute();

		return $producto->fetch();
	}

	public function getProductoCategoria($categoria){
		$categoria = (int) $categoria;

		$producto = $this->_db->prepare("SELECT id FROM productos WHERE categoria_id = ?");
		$producto->bindParam(1, $categoria);
		$producto->execute();

		return $producto->fetch();
	}

	public function getProductoMarca($marca){
		$marca = (int) $marca;

		$producto = $this->_db->prepare("SELECT id FROM productos WHERE marca_id = ?");
		$producto->bindParam(1, $marca);
		$producto->execute();

		return $producto->fetch();
	}

	public function getProductoDescripcion($descripcion){
		$producto = $this->_db->prepare("SELECT id FROM productos WHERE descripción = ?");
		$producto->bindParam(1, $descripcion);
		$producto->execute();

		return $producto->fetch();
	}

	public function setProductos($nombre, $codigo, $categoria, $marca, $descripcion){
		$producto = $this->_db->prepare("INSERT INTO productos VALUES(null, ?, ?, ?, ?, ?, now(), now())");
		$producto->bindParam(1,$nombre);//definimos el valor de cada ?
		$producto->bindParam(2,$codigo);
		$producto->bindParam(3,$categoria);
		$producto->bindParam(4,$marca);
		$producto->bindParam(5,$descripcion);
		$producto->execute();//ejecutamos la consulta

		$row = $producto->rowCount(); //devuelve la cantidad de registros insertados
		return $row;
	}
}