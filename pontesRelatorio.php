<?php

require_once('RelatorioPonte.php');

$idPonte = $_GET['id'];

if(empty($idPonte)){
	echo '<h1>Ponte Inválida</h1>';
}else{
	$RelatorioPonte = new RelatorioPonte($idPonte);
	$RelatorioPonte->imprimir();
}

?>