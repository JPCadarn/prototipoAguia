<?php
	require_once('conexao.php');
	$conexao = new Conexao();
	$query = "DELETE FROM pontes WHERE id = {$_GET['id']}";
	$conexao->executarQuery($query);
	$query = "DELETE FROM imagens_pontes WHERE ponte_id = {$_GET['id']}";
	$conexao->executarQuery($query);
	$query = "DELETE FROM agendamentos WHERE ponte_id = {$_GET['id']}";
	$conexao->executarQuery($query);
	$query = "DELETE FROM inspecoes WHERE ponte_id = {$_GET['id']}";
	$conexao->executarQuery($query);
	header('Location: pontes.php');
?>