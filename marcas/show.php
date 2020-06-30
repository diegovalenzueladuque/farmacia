<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('../class/marcaModel.php');
require('../class/prodModel.php');
require('../class/config.php');
//creamos una instancia de la clase rolModel
$marcas = new marcaModel;
$productos = new prodModel;

//print_r($_GET);

if (isset($_GET['id'])) {
	//recuperamos y sanitizamos el dato que viene por cabecera
	$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
	

	$res = $marcas->getMarcaId($id);
	$producto = $productos->getProductoMarca($id);
	//print_r($producto);exit;
	if (!$res) {
		$_SESSION['danger'] = 'El dato no es válido';
	}
}

//print_r($res);
if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador'):
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Marca</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Marca</h3>
				<!--Valida o notifica que el registro se ha realizado-->
				<?php if(isset($_GET['m'])): ?>
					<p class="alert alert-success">La marca se ha modificado correctamente</p>
				<?php endif; ?>

				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<table class="table table-hover table-light">
					<tr>
						<th>Nombre:</th>
						<td><?php echo $res['nombre']; ?></td>
					</tr>
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
				</table>
				<p>
					<a href="edit.php?id=<?php echo $res['id']; ?>" class="btn btn-outline-warning">Editar</a>
					<a href="index.php" class="btn btn-link">Volver</a>
					<a href="del.php?id=<?php echo $res['id']; ?>" class="btn btn-outline-danger">Eliminar</a>
					<a href="<?php echo BASE_URL . 'productos/addxmarca.php?id=' . $res['id']; ?>" class="btn btn-outline-primary">Agregar Producto</a>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 mt-3">
				<h3>Productos asociados a <?php echo $res['nombre']; ?></h3>

				<?php if(isset($producto) && count($producto)): ?>
					<table class="table table-hover">
						<th>Producto</th>
						<th>Código</th>
						<th>Categoria</th>
						<th>Activo</th>
						<?php foreach($producto as $p): ?>
							<tr>
								<td>
									<a href="<?php echo BASE_URL . 'productos/show.php?id=' . $p['id']; ?>"><?php echo $p['nombre']; ?></a>
								</td>
								<td><?php echo $p['codigo']; ?></td>
								<td><?php echo $p['categoria']; ?></td>
								<td>
									<?php if($p['activo'] == 1): ?> Si <?php else: ?> No <?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				<?php else: ?>
					<p class="text-info mt-3">No hay productos asociados a esta marca</p>
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