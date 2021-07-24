<?php
	require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();
	$utils = new Utils();
	$_POST['data_nascimento'] = implode('-', array_reverse(explode('/', $_POST['data_nascimento'])));
	$chaves = implode(',', array_keys($_POST));
	$valores = array_values($_POST);
	$valoresTratados = [];
	$imagens = [];
	foreach($valores as $valor){
		$valoresTratados[] = "'$valor'";
	}
	$valoresTratados = implode(',', $valoresTratados);
	$query = "
		INSERT INTO clientes
		($chaves)
		VALUES
		($valoresTratados)
	";
	$idCliente = $conexao->executarQuery($query);
	header('Location: clientes.php');
?>