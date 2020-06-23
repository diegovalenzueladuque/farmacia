<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('../class/catModel.php');
require('../class/config.php');
//creamos una instancia de la clase rolModel
$categorias = new catModel;

//print_r($_GET);

if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];

	$res = $categorias->getCategoriaId($id);

	if ($res){
		$sql = $categorias->deleteCategorias($id);

		if ($sql) {
			# code...
			$msg = 'OK';
			header('Location: index.php?mg=' . $msg);
		}else{
			$msg = 'Error';
			header('Location: index.php?er=' . $msg);
		}

	}else{
		$msg = 'Error';
		header('Location: index.php?e=' . $msg);
	}
}