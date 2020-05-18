 <?php
require('modelo.php');

class proveedorModel extends Modelo
{
	public function __construct(){
		//disponemos de lo declarado en el constructor de la clase modelo
		parent::__construct();
	}

	//traemos todos los roles de la tabla roles
	public function getProveedores(){
		//consulta a la tabla roles usando el objeto db de la clase modelo
		$proveedores = $this->_db->query("SELECT id, nombre, rut FROM proveedores ORDER BY nombre");

		//retornamos lo que haya en la tabla roles
		return $proveedores->fetchAll();
	}

	public function getProveedorId($id){
		$id = (int) $id;

		$proveedor = $this->_db->prepare("SELECT id, nombre, rut, dirección, email, contacto, created_at, updated_at FROM proveedores WHERE id = ?");
		$proveedor->bindParam(1, $id);
		$proveedor->execute();

		return $proveedor->fetch();
	}

	public function getProveedorNombre($nombre){
		$proveedor = $this->_db->prepare("SELECT id FROM proveedores WHERE nombre = ?");
		$proveedor->bindParam(1, $nombre);
		$proveedor->execute();

		return $proveedor->fetch();
	}

	public function getProveedorRut($rut){
		$proveedor = $this->_db->prepare("SELECT id FROM proveedores WHERE rut = ?");
		$proveedor->bindParam(1, $rut);
		$proveedor->execute();

		return $proveedor->fetch();
	}

	public function getProveedorDireccion($direccion){
		$proveedor = $this->_db->prepare("SELECT id FROM proveedores WHERE dirección = ?");
		$proveedor->bindParam(1, $direccion);
		$proveedor->execute();

		return $proveedor->fetch();
	}

	public function getProveedorEmail($email){
		$proveedor = $this->_db->prepare("SELECT id FROM proveedores WHERE email = ?");
		$proveedor->bindParam(1, $email);
		$proveedor->execute();

		return $proveedor->fetch();
	}

	public function getProveedorContacto($contacto){		
		$proveedor = $this->_db->prepare("SELECT id FROM proveedores WHERE contacto = ?");
		$proveedor->bindParam(1, $contacto);
		$proveedor->execute();

		return $proveedor->fetch();
	}

	public function setProveedores($nombre, $rut, $direccion, $email, $contacto){
		$proveedor = $this->_db->prepare("INSERT INTO proveedores VALUES(null, ?, ?, ?, ?, ?, now(), now())");
		$proveedor->bindParam(1,$nombre);//definimos el valor de cada ?
		$proveedor->bindParam(2,$rut);
		$proveedor->bindParam(3,$direccion);
		$proveedor->bindParam(4,$email);
		$proveedor->bindParam(5,$contacto);
		$proveedor->execute();//ejecutamos la consulta

		$row = $proveedor->rowCount(); //devuelve la cantidad de registros insertados
		return $row;
	}
}