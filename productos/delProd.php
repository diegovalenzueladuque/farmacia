<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('../class/prodModel.php');
require('../class/marcaModel.php');
require('../class/catModel.php');
require('../class/config.php');
//creamos una instancia de la clase rolModel
$productos = new prodModel;

//print_r($_GET);

if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];

	$res = $productos->getProductoId($id);

	if ($res){
		$sql = $productos->deleteProductos($id);

		if ($sql) {
			# code...
			$msg = 'OK';
			header('Location: productos.php?mg=' . $msg);
		}else{
			$msg = 'Error';
			header('Location: productos.php?er=' . $msg);
		}

	}else{
		$msg = 'Error';
		header('Location: productos.php?e=' . $msg);
	}
}