<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('SessionService.php');
	SessionService::validarLoginFeito();
	$conexao = new Conexao();
	$chaves = array_keys($_POST);
	$_POST['senha'] = password_hash($_POST['senha'], PASSWORD_BCRYPT);
	$valores = array_values($_POST);
	$camposValores = [];
	foreach($chaves as $index => $chave){
		$camposValores [] = "{$chaves[$index]} = '{$valores[$index]}'";
	}
	$camposValores = implode(',', $camposValores);
	$query = "
		UPDATE usuarios
		SET $camposValores
		WHERE id = {$_POST['id']}
	";
	$idUsuario = $conexao->executarQuery($query);
	header('Location: minhaConta.php'.$mensagemErro);
?>