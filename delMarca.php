<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('class/marcaModel.php');
//creamos una instancia de la clase rolModel
$marcas = new marcaModel;

//print_r($_GET);

if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];

	$res = $marcas->getMarcaId($id);

	if ($res){
		$sql = $marcas->deleteMarcas($id);

		if ($sql) {
			# code...
			$msg = 'OK';
			header('Location: marcas.php?mg=' . $msg);
		}else{
			$msg = 'Error';
			header('Location: marcas.php?er=' . $msg);
		}

	}else{
		$msg = 'Error';
		header('Location: marcas.php?e=' . $msg);
	}
}