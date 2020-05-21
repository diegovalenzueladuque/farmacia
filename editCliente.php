<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('class/clienteModel.php');
//creamos una instancia de la clase rolModel
$clientes = new clienteModel;

//print_r($_GET);

if (isset($_GET['id'])) {
	//recuperamos y sanitizamos el dato que viene por cabecera
	$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
	//$id = (int) $id;

	$res = $clientes->getClienteId($id);
	

	if (!$res) {
		$msg = 'error';
		header('Location: usuarios.php?e=' . $msg);
	}

	if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
		//sanitizamos el dato
		//print_r($_POST);exit;
		$nombre = trim(strip_tags($_POST['nombre']));
		$direccion = trim(strip_tags($_POST['dirección']));
		$pers = trim(strip_tags($_POST['persona']));

		if (!$nombre) {
			$mensaje = 'Ingrese el nombre del cliente';
		}elseif(!$email){
			$mensaje = 'Ingrese correo del cliente';
		}elseif(!$pers){
			$mensaje = 'Ingrese tipo de persona';
		}
		else{
			//print_r($id);exit;
			//actualizamos el usuario
			$sql = $usuarios->editCliente($nombre, $email, $pers);
			//$sql = $usuarios->editPassword($id, $clave);
			//print_r($res);exit;
			if ($sql) {
				$msg = 'ok';
				header('Location: verCliente.php?m=' . $msg . '&id=' . $id);
			}
		}
	}
}

//print_r($res);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cliente</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid">
		<?php include('header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Cliente</h3>
				<!--Valida o notifica que el registro se ha realizado-->
				<?php if(isset($_GET['m'])): ?>
					<p class="alert alert-success">El cliente se ha modificado correctamente</p>
				<?php endif; ?>

				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre del cliente</label>
						<input type="text" name="nombre" value="<?php echo $res['nombre']; ?>" placeholder="Nombre del cliente" class="form-control">
					</div>
					<div class="form-group">
						<label>Cambie su dirección</label>
						<input type="text" name="email" value="<?php echo $res['dirección']; ?>" placeholder="indique nueva dirección" class="form-control">
					</div>
					<div class="form-group">
						<label>Cambie tipo de persona</label>
						<input type="text" name="persona" value="<?php echo $res['persona']; ?>" placeholder="indique nueva dirección" class="form-control">
					</div>
					
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Modificar</button>
						<a href="clientes.php" class="btn btn-link">Volver</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>