<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require('class/rolModel.php');
//creamos una instancia de la clase rolModel
$roles = new rolModel;

//print_r($_GET);

if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];

	$res = $roles->getRolId($id);

	if ($res){
		$sql = $roles->deleteRoles($id);

		if ($sql) {
			# code...
			$msg = 'OK';
			header('Location: roles.php?mg=' . $msg);
		}else{
			$msg = 'Error';
			header('Location: roles.php?er=' . $msg);
		}

	}else{
		$msg = 'Error';
		header('Location: roles.php?e=' . $msg);
	}
}