 <?php
require_once('modelo.php');

class prodModel extends Modelo
{
	public function __construct(){
		//disponemos de lo declarado en el constructor de la clase modelo
		parent::__construct();
	}

	//traemos todos los roles de la tabla roles
	public function getProductos(){
		//consulta a la tabla roles usando el objeto db de la clase modelo
		$productos = $this->_db->query("SELECT p.id, p.nombre AS producto, p.codigo, p.precio, p.activo as estado, c.nombre AS categoria, m.nombre AS marca FROM productos p INNER JOIN categorías c ON p.categoria_id = c.id INNER JOIN marcas m ON p.marca_id = m.id ORDER BY p.nombre;");

		//retornamos lo que haya en la tabla roles
		return $productos->fetchAll();
	}

	public function getProductoId($id){
		$id = (int) $id;

		$prod = $this->_db->prepare("SELECT p.id, p.nombre, p.codigo, p.precio,	c.nombre as categoria, m.nombre as marca, p.descripcion, p.activo, p.created_at, p.updated_at FROM productos p INNER JOIN categorías c ON c.id =p.categoria_id INNER JOIN marcas m ON m.id = p.marca_id WHERE p.id = ?");
		$prod->bindParam(1, $id);
		$prod->execute();

		return $prod->fetch();
	}

	public function getProductoCodigo($codigo){
		$prod = $this->_db->prepare("SELECT p.id, p.nombre, p.codigo, p.precio, c.nombre as categoria, m.nombre as marca, p.descripcion, p.created_at, p.updated_at FROM productos p INNER JOIN categorías c ON c.id =p.categoria_id INNER JOIN marcas m ON m.id = p.marca_id ORDER BY p.nombre WHERE p.codigo = ?");
		$prod->bindParam(1, $codigo);
		$prod->execute();

		return $prod->fetch();
	}

	public function getProductoNombre($nombre){
		$producto = $this->_db->prepare("SELECT id FROM productos WHERE nombre = ?");
		$producto->bindParam(1, $nombre);
		$producto->execute();

		return $producto->fetch();
	}

	
	public function getProductoCategoria($categoria){
		$categoria = (int) $categoria;

		$producto = $this->_db->prepare("SELECT p.id, p.nombre, p.codigo, p.precio, c.nombre as categoria, m.nombre as marca, p.descripcion, p.activo, p.created_at, p.updated_at FROM productos p INNER JOIN categorías c ON c.id = p.categoria_id INNER JOIN marcas m ON m.id = p.marca_id WHERE p.categoria_id = ? ORDER BY c.nombre");
		$producto->bindParam(1, $categoria);
		$producto->execute();

		return $producto->fetchall();
	}

	public function getProductoMarca($marca){
		$marca = (int) $marca;

		$producto = $this->_db->prepare("SELECT p.id, p.nombre, p.codigo, p.precio, c.nombre as categoria, m.nombre as marca, p.descripcion, p.activo, p.created_at, p.updated_at FROM productos p INNER JOIN categorías c ON c.id = p.categoria_id INNER JOIN marcas m ON m.id = p.marca_id WHERE p.marca_id = ? ORDER BY p.nombre");
		$producto->bindParam(1, $marca);
		$producto->execute();

		return $producto->fetchall();
	}

	public function getProductoDescripcion($descripcion){
		$producto = $this->_db->prepare("SELECT id FROM productos WHERE descripción = ?");
		$producto->bindParam(1, $descripcion);
		$producto->execute();

		return $producto->fetch();
	}

	public function setProductos($nombre, $codigo, $precio, $categoria, $marca, $descripcion){
		$categoria = (int) $categoria;
		$marca = (int) $marca;
		$producto = $this->_db->prepare("INSERT INTO productos VALUES(null, ?, ?, ?, ?, ?, ?, now(), now())");
		$producto->bindParam(1,$nombre);//definimos el valor de cada ?
		$producto->bindParam(2,$codigo);
		$producto->bindParam(3,$precio);
		$producto->bindParam(4,$categoria);
		$producto->bindParam(5,$marca);
		$producto->bindParam(6,$descripcion);
		$producto->execute();//ejecutamos la consulta

		$row = $producto->rowCount(); //devuelve la cantidad de registros insertados
		return $row;
	}

	public function editProductos($id, $nombre, $codigo, $precio, $activo, $categoria, $marca, $descripcion){
		$id = (int) $id;
		$precio = (int) $precio;
		$categoria = (int) $categoria;
		$marca = (int) $marca;
		$activo = (int) $activo;

		$producto = $this->_db->prepare("UPDATE productos SET nombre = ?, codigo = ?, precio = ?, activo = ?, categoria = ?, marca = ?, descripcion = ?, updated_at = now() WHERE id = ?");
		$producto->bindParam(1, $nombre);
		$producto->bindParam(2, $codigo);
		$producto->bindParam(3, $precio);
		$producto->bindParam(4, $activo);
		$producto->bindParam(5, $categoria);
		$producto->bindParam(6, $marca);
		$producto->bindParam(7, $descripcion);		
		$producto->bindParam(8, $id);
		$producto->execute();

		$row = $producto->rowCount();
		return $row;
	}

	public function deleteProductos($id){
		$id = (int) $id;

		$producto =$this->_db->prepare("DELETE FROM productos WHERE id = ?");
		$producto->bindParam(1, $id);
		$producto->execute();

		$row = $producto->rowCount();

		return $row;

	}
}
