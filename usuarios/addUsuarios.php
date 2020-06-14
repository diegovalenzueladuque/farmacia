<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('../class/rolModel.php');
require('../class/usuarioModel.php');
require('../class/config.php');
//creamos una instancia de la clase rolModel
$roles = new rolModel;
$usuarios = new usuarioModel;

//print_r($_POST);
if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
	$nombre = trim(strip_tags($_POST['nombre']));
	$email = trim(strip_tags($_POST['email']));
	$rol = (int) $_POST['rol'];
	$clave = trim(strip_tags($_POST['password']));
	$reclave = trim(strip_tags($_POST['repassword']));
	

	if (!$nombre) {
		$mensaje = 'Ingrese el nombre del usuario';
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$mensaje = 'Ingrese mail válido';
	}elseif(!$rol){
		$mensaje = 'Seleccione rol';
	}elseif(!$clave || strlen($clave) < 8){
		$mensaje = 'la contraseña del usuario debe tener al menos 8 caracteres';
	}elseif($clave != $reclave){
		$mensaje = 'Contraseña no coincide';
	}else{

	
		$res = $usuarios->getUsuarioEmail($email);
		
		

		if ($res) {
			$mensaje = 'El usuario ingresado ya existe';
		}else{
			
			$sql = $usuarios->setUsuario($nombre, $email, $clave, $rol);

			if ($sql) {
				$_SESSION['success'] = 'El usuario se ha registrado correctamente';
				header('Location: usuarios.php?m=');
				# code...
			}else{
				$_SESSION['danger'] = 'El usuario no se ha registrado';
				header('Location: usuarios.php?e=');
			}
		}
	}
}
if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador'):
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
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Nuevo Usuario</h3>
				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre del Usuario</label>
						<input type="nombre" name="nombre" value="<?php echo @($nombre); ?>" placeholder="Ingrese nombre del usuario" class="form-control">
					</div>
					<div class="form-group">
						<label>Email del Usuario</label>
						<input type="email" name="email" value="<?php echo @($email); ?>" placeholder="Ingrese email del usuario" class="form-control">
					</div>
					
					<div class="form-group">
						<label>Rol</label>
						<select name="rol" class="form-control">
							<option value="">Seleccione...</option>
							<?php
								$res = $roles->getRoles();
								foreach ($res as $r ): 
							?>
							<option value="<?php echo $r['id']; ?>"><?php echo $r ['nombre']; ?></option>
						<?php endforeach ?>

						</select>
						
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" value="<?php echo @($clave); ?>" placeholder="Ingrese una contraseña" class="form-control">
					</div>
					<div class="form-group">
						<label>Confirme Password</label>
						<input type="password" name="repassword" value="<?php echo @($reclave); ?>" placeholder="Confirme contraseña" class="form-control">
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
<?php else: ?>
	<p class="text-info">Acceso restringido</p>
<?php endif; ?>