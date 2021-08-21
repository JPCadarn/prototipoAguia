<?php
	require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();
	$_POST['data_nascimento'] = implode('-', array_reverse(explode('/', $_POST['data_nascimento'])));
	$_POST['chave'] = password_hash('chave de acesso', PASSWORD_BCRYPT);
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