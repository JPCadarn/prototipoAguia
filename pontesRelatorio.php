<?php

require_once('RelatorioPonte.php');
require_once('SessionService.php');
require_once('utils.php');

SessionService::validarLoginFeitoEVisitante();

$idPonte = $_GET['id'];

if(empty($idPonte)){
	echo '<h1>Ponte Inválida</h1>';
}else{
	$RelatorioPonte = new RelatorioPonte($idPonte);
	$RelatorioPonte->imprimir();
}

?>