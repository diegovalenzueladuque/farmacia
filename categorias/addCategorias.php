<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('../class/catModel.php');
require('../class/config.php');
//creamos una instancia de la clase rolModel
$categorias = new catModel;

//print_r($_POST);
if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
	$nombre = strip_tags($_POST['nombre']);
	$codigo = strip_tags($_POST['código']);

	if (!$nombre) {
		$mensaje = 'Ingrese el nombre de la categoría';
	}elseif(!$codigo){
		$mensaje = 'Ingrese código de la categoría';
	}else{

		//consulta por la existencia del rol ingresao
		$res = $categorias->getCategoriaNombre($nombre);
		$res = $categorias->getCategoriaCodigo($codigo);

		if ($res) {
			$mensaje = 'La categoría ingresada ya existe';
		}else{
			$res = $categorias->setCategorias($nombre, $codigo);

			if ($res) {
				$msg = 'ok';
				header('Location: categorias.php?m=' . $msg);
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
	<title>Nueva Categoría</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Nueva Categoría</h3>
				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre de la categoría</label>
						<input type="text" name="nombre" value="<?php echo @($nombre); ?>" placeholder="Ingrese nombre de la categoría" class="form-control">
					</div>
					<div class="form-group">
						<label>Código de la Categoría</label>
						<input type="text" name="código" value="<?php echo @($codigo); ?>" placeholder="Ingrese código de la categoría" class="form-control">
					</div>
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="categorias.php" class="btn btn-link">Volver</a>
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