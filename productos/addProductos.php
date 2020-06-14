<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('../class/prodModel.php');
require('../class/catModel.php');
require('../class/marcaModel.php');
require('../class/config.php');
//creamos una instancia de la clase rolModel
$productos = new prodModel;
$categorias = new catModel;
$marcas = new marcaModel;

print_r($_POST);
if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
	$nombre = strip_tags($_POST['nombre']);
	$codigo = strip_tags($_POST['código']);
	$categoria = strip_tags($_POST['categoria_id']);
	$marca = strip_tags($_POST['marca_id']);
	$descripcion = strip_tags($_POST['descripción']);

	if (!$nombre) {
		$mensaje = 'Ingrese el nombre del producto';
	}elseif(!$codigo){
		$mensaje = 'Ingrese código del producto';
	}elseif(!$categoria){
		$mensaje = 'Ingrese categoría del producto';
	}elseif(!$marca){
		$mensaje = 'Ingrese marca del producto';
	}elseif(!$descripcion){
		$mensaje = 'Ingrese descripción del producto';
	}else{

		//consulta por la existencia del rol ingresao
		$res = $productos->getProductoNombre($nombre);
		/*$res = $productos->getProductoCodigo($codigo);
		$res = $productos->getProductoCategoria($categoria);
		$res = $productos->getProductoMarca($marca);
		$res = $productos->getProductoDescripcion($descripcion);*/

		if ($res) {
			$mensaje = 'El producto ingresado ya existe';
		}else{
			$res = $productos->setProductos($nombre,$codigo,$categoria,$marca,$descripcion);

			if ($res) {
				$msg = 'ok';
				header('Location: productos.php?m=' . $msg);
			}
		}
	}
}
if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador' || 'Vendedor'):
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nuevo Producto</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Nuevo Producto</h3>
				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre del Producto</label>
						<input type="text" name="nombre" value="<?php echo @($nombre); ?>" placeholder="Ingrese nombre del producto" class="form-control">
					</div>
					<div class="form-group">
						<label>Código del Producto</label>
						<input type="text" name="código" value="<?php echo @($codigo); ?>" placeholder="Ingrese código del producto" class="form-control">
					</div>
					<div class="form-group">
						<label>Categoría</label>
						<select name="categoria_id" class="form-control">
							<option value="">Seleccione...</option>
							<?php
								$res = $categorias->getCategorias();
								foreach ($res as $r ): 
							?>
							<option value="<?php echo $r['id']; ?>"><?php echo $r ['nombre']; ?></option>
						<?php endforeach ?>

						</select>
						
					</div>
					<div class="form-group">
						<label>Marca</label>
						<select name="marca_id" class="form-control">
							<option value="">Seleccione...</option>
							<?php
								$res = $marcas->getMarcas();
								foreach ($res as $r ): 
							?>
							<option value="<?php echo $r['id']; ?>"><?php echo $r ['nombre']; ?></option>
						<?php endforeach ?>

						</select>
						
					</div>
					
					
					<div class="form-group">
						<label>Descripción</label>
						<input type="text" name="descripción" value="<?php echo @($descripcion); ?>" placeholder="Ingrese descripción del producto" class="form-control">
					</div>
					
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="productos.php" class="btn btn-link">Volver</a>
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