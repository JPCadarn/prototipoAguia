<?php
	require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();
	$_POST['data_nascimento'] = Utils::formataDataBD($_POST['data_nascimento']);
	$_POST['telefone'] = Utils::formataTelefoneBD($_POST['telefone']);
	$_POST['cep'] = Utils::formataCepBD($_POST['cep']);
	$chaves = array_keys($_POST);
	$valores = array_values($_POST);
	$valoresTratados = [];
	$imagens = [];
	foreach($valores as $valor){
		$valoresTratados[] = "'$valor'";
	}
	foreach($chaves as $index => $chave){
		$camposValores [] = "{$chaves[$index]} = '{$valores[$index]}'";
	}
	$camposValores = implode(',', $camposValores);
	$query = "
		UPDATE clientes
		SET $camposValores
		WHERE id = {$_POST['id']}
	";
	$idCliente = $conexao->executarQuery($query);
	header('Location: clientes.php');
?>