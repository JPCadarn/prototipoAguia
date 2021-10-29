<?php
	require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();
	$_POST['data_construcao'] = Utils::formataDataBD($_POST['data_construcao']);
	$_POST['latitude'] = addslashes($_POST['latitude']);
	$_POST['longitude'] = addslashes($_POST['longitude']);
	$_POST['comprimento_estrutura'] = Utils::formataDecimalBD($_POST['comprimento_estrutura']);
	$_POST['largura_estrutura'] = Utils::formataDecimalBD($_POST['largura_estrutura']);
	$_POST['largura_acostamento'] = Utils::formataDecimalBD($_POST['largura_acostamento']);
	$_POST['largura_refugio'] = Utils::formataDecimalBD($_POST['largura_refugio']);
	$_POST['largura_passeio'] = Utils::formataDecimalBD($_POST['largura_passeio']);
	$_POST['comprimento_vao_tipico'] = Utils::formataDecimalBD($_POST['comprimento_vao_tipico']);
	$_POST['comprimento_maior_vao'] = Utils::formataDecimalBD($_POST['comprimento_maior_vao']);
	$_POST['altura_pilares'] = Utils::formataDecimalBD($_POST['altura_pilares']);
	$_POST['nro_faixas'] = Utils::formataDecimalBD($_POST['nro_faixas']);
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