<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('class/proveedorModel.php');
//creamos una instancia de la clase rolModel
$proveedores = new proveedorModel;

print_r($_POST);
if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
	$nombre = strip_tags($_POST['nombre']);
	$rut = strip_tags($_POST['rut']);
	$direccion = strip_tags($_POST['dirección']);
	$email = strip_tags($_POST['email']);
	$contacto = strip_tags($_POST['contacto']);

	if (!$nombre) {
		$mensaje = 'Ingrese el nombre del proveedor';
	}elseif(!$rut){
		$mensaje = 'Ingrese rut válido';
	}elseif(!$direccion){
		$mensaje = 'Ingrese dirreción del proveedor';
	}elseif(!$email){
		$mensaje = 'Ingrese fecha de email del cliente';
	}elseif(!$contacto){
		$mensaje = 'Ingrese tipo de contacto';
	}else{

		//consulta por la existencia del rol ingresao
		$res = $proveedores->getProveedorNombre($nombre);
		$res = $proveedores->getProveedorRut($rut);
		$res = $proveedores->getProveedorDireccion($direccion);
		$res = $proveedores->getProveedorEmail($email);
		$res = $proveedores->getProveedorContacto($contacto);

		if ($res) {
			$mensaje = 'El cliente ingresado ya existe';
		}else{
			$res = $proveedores->setProveedores($nombre,$rut,$direccion,$email,$contacto);

			if ($res) {
				$msg = 'ok';
				header('Location: proveedores.php?m=' . $msg);
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nuevo Proveedor</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid">
		<?php include('header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Nuevo Proveedor</h3>
				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre del Proveedor</label>
						<input type="text" name="nombre" value="<?php echo @($nombre); ?>" placeholder="Ingrese nombre del proveedor" class="form-control">
					</div>
					<div class="form-group">
						<label>Rut del Proveedor</label>
						<input type="text" name="rut" value="<?php echo @($rut); ?>" placeholder="Ingrese rut del proveedor" class="form-control">
					</div>
					<div class="form-group">
						<label>Dirección</label>
						<input type="text" name="dirección" value="<?php echo @($direccion); ?>" placeholder="Ingrese dirección del proveedor" class="form-control">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" value="<?php echo @($email); ?>" placeholder="Ingrese email del proveedor" class="form-control">
					</div>
					<div class="form-group">
						<label>Nombre del contacto</label>
						<input type="text" name="contacto" value="<?php echo @($contacto); ?>" placeholder="Ingrese nombre del contacto" class="form-control">
					</div>
					
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-outline-success">Guardar</button>
						<a href="proveedores.php" class="btn btn-link">Volver</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>