<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('../class/clienteModel.php');
require('../class/config.php');
//creamos una instancia de la clase rolModel
$clientes = new clienteModel;

//print_r($_POST);
if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
	$nombre = strip_tags($_POST['nombre']);
	$rut = strip_tags($_POST['rut']);
	$direccion = strip_tags($_POST['dirección']);
	$nacimiento = strip_tags($_POST['fecha_nacimiento']);
	$pers = strip_tags($_POST['persona']);

	if (!$nombre) {
		$mensaje = 'Ingrese el nombre del cliente';
	}elseif(!$rut){
		$mensaje = 'Ingrese rut válido';
	}elseif(!$direccion){
		$mensaje = 'Ingrese dirreción del cliente';
	}elseif(!$nacimiento){
		$mensaje = 'Ingrese fecha de nacimiento del cliente';
	}elseif(!$pers){
		$mensaje = 'Ingrese tipo de persona';
	}else{

		//consulta por la existencia del rol ingresao
		$res = $clientes->getClienteNombre($nombre);
		$res = $clientes->getClienteRut($rut);
		$res = $clientes->getClienteDireccion($direccion);
		$res = $clientes->getClienteFnac($nacimiento);
		//$res = $clientes->getClientePersona($pers);

		if ($res) {
			$mensaje = 'El cliente ingresado ya existe';
		}else{
			$res = $clientes->setClientes($nombre, $rut, $direccion, $nacimiento, $pers);

			if ($res) {
				$msg = 'ok';
				header('Location: index.php?m=' . $msg);
			}
		}
	}
}
if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador' OR 'Vendedor'):
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nuevo Cliente</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Nuevo Cliente</h3>
				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre completo del Cliente</label>
						<input type="text" name="nombre" value="<?php echo @($nombre); ?>" placeholder="Ingrese nombre del cliente" class="form-control">
					</div>
					<div class="form-group">
						<label>Rut del Cliente</label>
						<input type="text" name="rut" value="<?php echo @($rut); ?>" placeholder="Ingrese rut del cliente" class="form-control">
					</div>
					<div class="form-group">
						<label>Dirección</label>
						<input type="text" name="dirección" value="<?php echo @($direccion); ?>" placeholder="Ingrese dirección del cliente" class="form-control">
					</div>
					<div class="form-group">
						<label>Fecha Nacimiento</label>
						<input type="text" name="fecha_nacimiento" value="<?php echo @($nacimiento); ?>" placeholder="Ingrese fecha de nacimiento en formato aaaa:mm:dd" class="form-control">
					</div>
					<div class="form-group">
						<label>Tipo de persona</label>
						<input type="text" name="persona" value="<?php echo @($pers); ?>" placeholder="Ingrese tipo de persona (1 = Natural o 2 = Empresa)" class="form-control">
					</div>
					
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-outline-success">Guardar</button>
						<a href="index.php" class="btn btn-link">Volver</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php else: 
	header('Location: ' . BASE_URL . 'index.php');
	endif; 
?>