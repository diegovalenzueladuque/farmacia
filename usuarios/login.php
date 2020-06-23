<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

require('../class/usuarioModel.php');


//print_r($POST);
if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
	//creamos una instancia de la clase rolModel y usuarioModel
	$usuarios = new usuarioModel;

	$email = trim(strip_tags($_POST['email']));
	$clave = trim(strip_tags($_POST['password']));

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$mensaje = 'Ingresa tu email';
	}elseif (!$clave) {
		$mensaje = 'Ingresa tu password';
	}else{
		//verificar que el usuario este registrado
		$res = $usuarios->getUsuarioRegistrado($email, $clave);

		if ($res) {
			//inicio de session
			$_SESSION['autenticado'] = 'si';//esta variable de session inicializa una session de un usuario
			$_SESSION['id'] = $res['id'];//esta variable de session guarda el id del usuario registrado
			$_SESSION['nombre'] = $res['nombre'];//esta variable de session guarda el nombre del usuario
			$_SESSION['email'] = $res['email'];//esta variable de session guarda el email del usuario
			$_SESSION['rol'] = $res['rol'];//esta variable de session guarda el nombre del rol del usuario
			$_SESSION['rol_id'] = $res['rol_id'];//esta variable de session guarda el rol_id de la tabla usuarios
			
			header('Location: ../index.php');
		}else{
			$mensaje = 'El usuario o el password no son correctos';
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login Usuario</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" rel="stylesheet" type="text/css"/>
	<script src="https://kit.fontawesome.com/f923ea5b38.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid">
		<?php include('../partials/header.php'); ?><br><br>
		<div class="d-flex justify-content-center h-100 bg-transparent">
			<div class="card" style="width: 28rem">
				<div class="card-header bg-success" style="border-radius: 5px;">
					<h3 class="text-light" style="text-align: center">Login Usuario</h3>
					<?php if(isset($mensaje)): ?>
						<p class="alert alert-danger"><?php echo $mensaje; ?></p>
					<?php endif; ?>
				</div><br>
				<div class="card-body">
						<form action="" method="post">
							
							<div class="input-group form-group justify-content-center">
								<label class="input-group">Email</label>
								<span class="input-group-text"><i class="fas fa-at"></i></span>
								<input type="email" name="email" placeholder="Tu email" class="form-control">
							</div><br><br>
							
							<div class="input-group form-group justify-content-center">
								<label class="input-group">Contraseña</label>
								<span class="input-group-text"><i class="fas fa-key"></i></span>
								<input type="password" name="password" class="form-control" placeholder="Tu contraseña">
							</div><br>
							<div class="card-footer-fluid bg-transparent" style="text-align: center">
								<div class="form-group">
									<input type="hidden" name="enviar" value="si" >
									<button type="submit" class="btn btn-success" >Enviar</button>
								</div>
							</div>	
						</form>
				</div>
					
				
			</div>	
		</div>
	</div>
</body>
</html>