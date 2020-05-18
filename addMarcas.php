<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('class/marcaModel.php');
//creamos una instancia de la clase rolModel
$marca = new marcaModel;

//print_r($res);
if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
	$nombre = strip_tags($_POST['nombre']);

	if (!$nombre) {
		$mensaje = 'Ingrese el nombre de la marca';
	}else{

		//consulta por la existencia del rol ingresao
		$res = $marca->getMarcaNombre($nombre);

		if ($res) {
			$mensaje = 'La marca ingresada ya existe';
		}else{
			$res = $marca->setMarcas($nombre);

			if ($res) {
				$msg = 'ok';
				header('Location: marcas.php?m=' . $msg);
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nueva Marca</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid">
		<?php include('header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Nueva Marca</h3>
				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre de la Marca</label>
						<input type="text" name="nombre" value="<?php echo @($nombre); ?>" placeholder="Ingrese nueva marca" class="form-control">
					</div>
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="marcas.php" class="btn btn-link">Volver</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>