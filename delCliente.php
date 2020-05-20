<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('class/clienteModel.php');
//creamos una instancia de la clase rolModel
$clientes = new clienteModel;

//print_r($_GET);

if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];

	$res = $clientes->getClienteId($id);

	if ($res){
		$sql = $clientes->deleteClientes($id);

		if ($sql) {
			# code...
			$msg = 'OK';
			header('Location: clientes.php?mg=' . $msg);
		}else{
			$msg = 'Error';
			header('Location: clientes.php?er=' . $msg);
		}

	}else{
		$msg = 'Error';
		header('Location: clientes.php?e=' . $msg);
	}
}