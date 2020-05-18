 <?php
require('modelo.php');

class usuarioModel extends Modelo
{
	public function __construct(){
		//disponemos de lo declarado en el constructor de la clase modelo
		parent::__construct();
	}

	//traemos todos los roles de la tabla roles
	public function getUsuarios(){
		//consulta a la tabla roles usando el objeto db de la clase modelo
		$usuarios = $this->_db->query("SELECT id, nombre, email FROM usuarios ORDER BY nombre");

		//retornamos lo que haya en la tabla roles
		return $usuarios->fetchAll();
	}

	public function getUsuarioId($id){
		$id = (int) $id;

		$usuario = $this->_db->prepare("SELECT id, nombre, email, password, rol_id, created_at, updated_at FROM usuarios WHERE id = ?");
		$usuario->bindParam(1, $id);
		$usuario->execute();

		return $usuario->fetch();
	}

	public function getUsuarioNombre($nombre){
		$usuario = $this->_db->prepare("SELECT id FROM usuarios WHERE nombre = ?");
		$usuario->bindParam(1, $nombre);
		$usuario->execute();

		return $usuario->fetch();
	}

	public function getUsuarioEmail($email){
		$usuario = $this->_db->prepare("SELECT id FROM usuarios WHERE email = ?");
		$usuario->bindParam(1, $email);
		$usuario->execute();

		return $usuario->fetch();
	}

	public function getUsuarioPass($password){
		$usuario = $this->_db->prepare("SELECT id FROM usuarios WHERE password = ?");
		$usuario->bindParam(1, $password);
		$usuario->execute();

		return $usuario->fetch();
	}
	
	public function getUsuarioRol($rolid){
		$rolid = (int) $rolid;

		$usuario = $this->_db->prepare("SELECT id FROM usuarios WHERE nombre = ?");
		$usuario->bindParam(1, $rolid);
		$usuario->execute();

		return $usuario->fetch();
	}

	

	public function setUsuarios($nombre, $email, $password, $rolid){
		$usuario = $this->_db->prepare("INSERT INTO usuarios VALUES(null, ?, ?, md5(?), ?, now(), now())");
		$usuario->bindParam(1,$nombre);//definimos el valor de cada ?
		$usuario->bindParam(2,$email);
		$usuario->bindParam(3,$password);
		$usuario->bindParam(4,$rolid);
		
		$usuario->execute();//ejecutamos la consulta

		$row = $usuario->rowCount(); //devuelve la cantidad de registros insertados
		return $row;
	}
}