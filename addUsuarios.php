<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('class/usuarioModel.php');
//creamos una instancia de la clase rolModel
$usuarios = new usuarioModel;

print_r($_POST);
if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
	$nombre = strip_tags($_POST['nombre']);
	$email = strip_tags($_POST['email']);
	$password = strip_tags($_POST['password']);
	$rolid = strip_tags($_POST['rol_id']);
	

	if (!$nombre) {
		$mensaje = 'Ingrese el nombre del usuario';
	}elseif(!$email){
		$mensaje = 'Ingrese mail válido';
	}elseif(!$password){
		$mensaje = 'Ingrese contraseña';
	}elseif(!$rolid){
		$mensaje = 'Ingrese rol';
	}else{

		//consulta por la existencia del rol ingresao
		$res = $usuarios->getUsuarioNombre($nombre);
		$res = $usuarios->getUsuarioEmail($email);
		$res = $usuarios->getUsuarioPass($password);
		$res = $usuarios->getUsuarioRol($rolid);
		

		if ($res) {
			$mensaje = 'El usuario ingresado ya existe';
		}else{
			$res = $usuarios->setUsuarios($nombre,$email,$password,$rolid);

			if ($res) {
				$msg = 'ok';
				header('Location: usuarios.php?m=' . $msg);
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nuevo USuario</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid">
		<?php include('header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Nuevo Usuario</h3>
				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre del Usuario</label>
						<input type="text" name="nombre" value="<?php echo @($nombre); ?>" placeholder="Ingrese nombre del usuario" class="form-control">
					</div>
					<div class="form-group">
						<label>Email del Usuario</label>
						<input type="text" name="email" value="<?php echo @($email); ?>" placeholder="Ingrese email del usuario" class="form-control">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="text" name="password" value="<?php echo @($password); ?>" placeholder="Ingrese una contraseña" class="form-control">
					</div>
					<div class="form-group">
						<label>Rol</label>
						<input type="text" name="rol_id" value="<?php echo @($rolid); ?>" placeholder="Ingrese rol del usuario" class="form-control">
					</div>
					
					
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="usuarios.php" class="btn btn-link">Volver</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>