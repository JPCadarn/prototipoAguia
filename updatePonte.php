<?php
	require_once('conexao.php');
	$conexao = new Conexao();
	$_POST['data_construcao'] = implode('-', array_reverse(explode('/', $_POST['data_construcao'])));
	$chaves = array_keys($_POST);
	$valores = array_values($_POST);
	$camposValores = [];
	foreach($chaves as $index => $chave){
		$camposValores [] = "{$chaves[$index]} = '{$valores[$index]}'";
	}
	$camposValores = implode(',', $camposValores);
	$query = "
		UPDATE pontes
		SET $camposValores
		WHERE id = {$_POST['id']}
	";
	$idPonte = $conexao->executarQuery($query);
	header('Location: pontes.php');
?>