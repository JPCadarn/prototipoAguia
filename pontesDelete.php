<?php
	require_once('conexao.php');
	$conexao = new Conexao();
	$query = "DELETE  pontes FROM pontes WHERE id = {$_GET['id']}
	";
	$conexao->executarQuery($query);
	header('Location: pontes.php');
?>