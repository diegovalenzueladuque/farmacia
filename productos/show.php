<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('../class/prodModel.php');
require_once('../class/catModel.php');
require('../class/imagenModel.php');
require('../class/config.php');
require_once('../class/catModel.php');
//creamos una instancia de la clase rolModel
$productos = new prodModel;
$imagenes = new imagenModel;

//print_r($_GET);

if (isset($_GET['id'])) {
	//recuperamos y sanitizamos el dato que viene por cabecera
	$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

	$res = $productos->getProductoId($id);
	$img = $imagenes->getImagenProducto($id);
	//print_r($img);exit;

	if (!$res) {
		$mensaje = 'El dato consultado no existe';
	}
}

//print_r($res);
if(isset($_SESSION['autenticado']) && ($_SESSION['rol'] == 'Administrador') || ($_SESSION['rol'] == 'Vendedor') || ($_SESSION['rol'] == 'Supervisor(a)')):
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Productos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Producto</h3>
				<!--Valida o notifica que el registro se ha realizado-->
				<?php if(isset($_GET['m'])): ?>
					<p class="alert alert-success">El producto se ha modificado correctamente</p>
				<?php endif; ?>

				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<table class="table table-hover table-light">
					<tr>
						<th>Producto:</th>
						<td><?php echo $res['nombre']; ?></td>
					</tr>
					<tr>
						<th>Código:</th>
						<td><?php echo $res['codigo']; ?></td>
					</tr>
					<tr>
						<th>Valor:</th>
						<td>$<?php echo $res['precio']; ?></td>
					</tr>
					<tr>
						<th>Categoría:</th>
						<td><?php echo $res['categoria']; ?></td>
					</tr>
					<tr>
						<th>Marca:</th>
						<td><?php echo $res['marca']; ?></td>
					</tr>
					<tr>
						<th>Descripción:</th>
						<td><?php echo $res['descripcion']; ?></td>
					</tr>
					<?php if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador'): ?>
					<tr>
						<th>Fecha de creación:</th>
						<td>
							<?php
								$fecha_reg = new DateTime($res['created_at']);
								echo $fecha_reg->format('d-m-Y H:i:s');
							?>
						</td>
					</tr>
					<tr>
						<th>Fecha de modificación:</th>
						<td>
							<?php
								$fecha_mod = new DateTime($res['updated_at']);
								echo $fecha_mod->format('d-m-Y H:i:s');
							?>
						</td>
					</tr>
					<?php endif; ?>
				</table>
				<p>
					<?php if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador'): ?>
					<a href="edit.php?id=<?php echo $res['id']; ?>" class="btn btn-outline-warning">Editar</a>
					<a href="del.php?id=<?php echo $res['id']; ?>" class="btn btn-outline-danger">Eliminar</a>
					<a href="<?php echo BASE_URL . 'imagenes/addxProd.php?id=' . $res['id']; ?>" class="btn btn-outline-primary">Agregar Imagen</a>
					<?php endif; ?>
					<a href="index.php" class="btn btn-link">Volver</a>
					
				</p>
			</div>
			<div class="col-md-6 mt-3">
				<h4>Imágenes asociadas a <?php echo $res['nombre']; ?></h4>
				<?php if(isset($img) && count($img)): ?>
					<?php foreach($img as $img): ?>
						<div class="col-md-6">
							<h5><?php echo $img['titulo']; ?></h5>
							<img src="<?php echo BASE_IMG . 'productos/' . $img['nombre']; ?>" class="img-thumbnail" >
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<p class="text-info">No hay imágenes asociadas</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</body>
</html>
<?php else: 
	header('Location: ' . BASE_URL . 'index.php');
	endif; 
?>