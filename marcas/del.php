<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('../class/marcaModel.php');
require('../class/config.php');
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