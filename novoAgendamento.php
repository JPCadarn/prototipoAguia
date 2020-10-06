<?php
	require_once('conexao.php');
	$conexao = new Conexao();
	$_POST['data'] = implode('-', array_reverse(explode('/', $_POST['data'])));
	$chaves = implode(',', array_keys($_POST));
	$valores = array_values($_POST);
	foreach($valores as $valor){
		$valoresTratados[] = "'$valor'";
	}
	$valoresTratados = implode(',', $valoresTratados);
	$query = "
		INSERT INTO agendamentos
		($chaves)
		VALUES
		($valoresTratados)
	";
	if($conexao->executarQuery($query)){
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
?>