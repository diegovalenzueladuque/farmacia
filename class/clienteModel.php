 <?php
require('modelo.php');

class clienteModel extends Modelo
{
	public function __construct(){
		
		parent::__construct();
	}

	
	public function getClientes(){
		
		$clientes = $this->_db->query("SELECT id, nombre, rut, dirección, fecha_nacimiento FROM clientes ORDER BY nombre;");

		
		return $clientes->fetchAll();
	}

	public function getClienteId($id){
		$id = (int) $id;

		$cliente = $this->_db->prepare("SELECT id, nombre, rut, dirección, fecha_nacimiento, persona, created_at, updated_at FROM clientes WHERE id = ?");
		$cliente->bindParam(1, $id);
		$cliente->execute();

		return $cliente->fetch();
	}

	public function getClienteNombre($nombre){
		$cliente = $this->_db->prepare("SELECT id FROM clientes WHERE nombre = ?");
		$cliente->bindParam(1, $nombre);
		$cliente->execute();

		return $cliente->fetch();
	}

	public function getClienteRut($rut){
		$cliente = $this->_db->prepare("SELECT id FROM clientes WHERE rut= ?");
		$cliente->bindParam(1, $rut);
		$cliente->execute();

		return $cliente->fetch();
	}

	public function getClienteDireccion($direccion){
		$cliente = $this->_db->prepare("SELECT id FROM clientes WHERE dirección = ?");
		$cliente->bindParam(1, $direccion);
		$cliente->execute();

		return $cliente->fetch();
	}

	public function getClienteFnac($nacimiento){
		$cliente = $this->_db->prepare("SELECT id FROM clientes WHERE fecha_nacimiento = ?");
		$cliente->bindParam(1, $nacimiento);
		$cliente->execute();

		return $cliente->fetch();
	}

	/*public function getClientePersona($pers){
		$pers = (int) $pers;
		
		$cliente = $this->_db->prepare("SELECT id FROM clientes WHERE persona = ?");
		$cliente->bindParam(1, $persona);
		$cliente->execute();

		return $cliente->fetch();
	}*/

	public function setClientes($nombre, $rut, $direccion, $nacimiento, $pers){
		$pers = (int) $pers;

		$cliente = $this->_db->prepare("INSERT INTO clientes VALUES(null, ?, ?, ?, ?, ?, now(), now())");
		$cliente->bindParam(1,$nombre);//definimos el valor de cada ?
		$cliente->bindParam(2,$rut);
		$cliente->bindParam(3,$direccion);
		$cliente->bindParam(4,$nacimiento);
		$cliente->bindParam(5,$pers);
		$cliente->execute();//ejecutamos la consulta

		$row = $cliente->rowCount(); //devuelve la cantidad de registros insertados
		//print_r($row);exit;
		return $row;
	}

	public function editCliente($nombre, $direccion, $pers){
		$pers = (int) $pers;
		

		$cliente = $this->_db->prepare("UPDATE clientes SET nombre = ?, dirección = ? persona = ? WHERE id = ?");
		$cliente->bindParam(1, $nombre);
		$cliente->bindParam(2, $direccion);
		$cliente->bindParam(3, $pers);
		$cliente->execute();

		$row = $cliente->rowCount();
		return $row;
	}

	public function deleteClientes($id){
		$id = (int) $id;

		$cliente =$this->_db->prepare("DELETE FROM usuarios WHERE id = ?");
		$cliente->bindParam(1, $id);
		$cliente->execute();

		$row = $usu->rowCount();

		return $row;

	}
}