<?php
	require_once('conexao.php');
	$conexao = new Conexao();
	$query = "DELETE FROM agendamentos WHERE id = {$_GET['id']}";
	$conexao->executarQuery($query);
	header('Location: agendamentos.php');
?>