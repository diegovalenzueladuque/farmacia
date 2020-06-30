<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

require('../class/prodModel.php');
require('../class/imagenModel.php');
require('../class/carritoModel.php');
require('../class/config.php');
//creamos una instancia de la clase rolModel

$productos = new prodModel;
$imagenes = new imagenModel;
$carrito = new carritoModel;

//print_r($_GET);
if (isset($_GET['id'])) {
	//recuperamos y sanitizamos el dato que viene por cabecera
	$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
	//$id = (int) $id;

	$res = $productos->getProductoId($id);
	//print_r($prod);exit;
	$img = $imagenes->getImagenProducto($id);

	if (!$res) {
		$_SESSION['danger'] = 'El dato no es válido';
	}

	if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
		$cantidad = (int) $_POST['cantidad'];

		if (!$cantidad) {
			$mensaje = 'Seleccione una cantidad';
		}else{
			// procesamos datos
			$usuario = $_SESSION['id'];
			$precio = $res['precio'];
			$total = $precio * $cantidad;

			//guardar los datos en la tabla carrito
			$carr = $carrito->setCarrito($usuario, $cantidad, $id, $total);

			if ($carr) {
				$_SESSION['success'] = 'Su pedido se ha registrado correctamente';
				header('Location: ../index.php');
			}else{
				$mensaje = 'Su pedido no se ha procesado... intente mas tarde';
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
	<title>Oferta</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Oferta</h3>
				<!--Valida o notifica que el registro se ha realizado-->
				<?php if($res): ?>
					<table class="table table-hover">
						<tr>
							<th>Producto:</th>
							<td><?php echo $res['nombre']; ?></td>
						</tr>
						<tr>
							<th>Código:</th>
							<td><?php echo $res['codigo']; ?></td>
						</tr>
						<tr>
							<th>Precio:</th>
							<td>$ <?php echo number_format($res['precio'],0,',','.'); ?></td>
						</tr>
						<tr>
							<th>Categoria:</th>
							<td><?php echo $res['categoria']; ?></td>
						</tr>
						<tr>
							<th>Marca:</th>
							<td><?php echo $res['marca']; ?></td>
						</tr>
						<tr>
							<th>Descripcion:</th>
							<td><?php echo $res['descripcion']; ?></td>
						</tr>

					</table>
					<a href="../index.php" class="btn btn-link">Volver</a>

					<?php if(isset($mensaje)): ?>
						<p class="alert alert-danger"><?php echo $mensaje; ?></p>
					<?php endif; ?>

					<?php if(isset($_SESSION['autenticado'])): ?>
						<form action="" method="post" class="form-inline">
							<div class="form-group">
								<select name="cantidad" class="form-control">
								<option value="">Cantidad...</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
							</div>
							<div class="form-group">
								<input type="hidden" name="enviar" value="si">
								<button type="submit" class="btn btn-outline-primary">AGREGAR AL CARRITO</button>
							</div>

						</form>
					<?php else: ?>
						<p class="text-info">Para comprar debes iniciar sesion o registrarte</p>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</body>
</html>