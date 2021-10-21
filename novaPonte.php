<?php
	require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();
	$_POST['data_construcao'] = Utils::formataDataBD($_POST['data_construcao']);
	$_POST['latitude'] = Utils::formataCoordenadasBD($_POST['latitude']);
	$_POST['longitude'] = Utils::formataCoordenadasBD($_POST['longitude']);
	$_POST['comprimento_estrutura'] = Utils::formataDecimalBD($_POST['comprimento_estrutura']);
	$_POST['largura_estrutura'] = Utils::formataDecimalBD($_POST['largura_estrutura']);
	$_POST['largura_acostamento'] = Utils::formataDecimalBD($_POST['largura_acostamento']);
	$_POST['largura_refugio'] = Utils::formataDecimalBD($_POST['largura_refugio']);
	$_POST['largura_passeio'] = Utils::formataDecimalBD($_POST['largura_passeio']);
	$_POST['comprimento_vao_tipico'] = Utils::formataDecimalBD($_POST['comprimento_vao_tipico']);
	$_POST['comprimento_maior_vao'] = Utils::formataDecimalBD($_POST['comprimento_maior_vao']);
	$_POST['altura_pilares'] = Utils::formataDecimalBD($_POST['altura_pilares']);
	$_POST['nro_faixas'] = Utils::formataDecimalBD($_POST['nro_faixas']);
	$chaves = implode(',', array_keys($_POST));
	$valores = array_values($_POST);
	$valoresTratados = [];
	$imagens = [];
	foreach($valores as $valor){
		$valoresTratados[] = "'$valor'";
	}
	$valoresTratados = implode(',', $valoresTratados);
	$query = "
		INSERT INTO pontes
		($chaves)
		VALUES
		($valoresTratados)
	";
	$idPonte = $conexao->executarQuery($query);
	for($i = 0; $i < count($_FILES['images']['name']); $i++){
		$nomeImagem = str_replace(['.', ',', '/', '\\'], '_', password_hash($_FILES['images']['name'][$i], PASSWORD_BCRYPT)).'.'.explode('/', $_FILES['images']['type'][$i])[1];
		$imagens[] = $nomeImagem;
		$destino = explode('models', dirname(__FILE__))[0].'\\assets\\fotos\\'.$nomeImagem;
		if(rename($_FILES['images']['tmp_name'][$i], $destino)){
			$queryImagens = "
			INSERT INTO imagens_pontes
			(ponte_id, imagem)
			VALUES
			($idPonte, '$nomeImagem')
			";
			$conexao->executarQuery($queryImagens);
		}
	}
	for($i = 1; $i <= 20; $i++){
		$nomeInspecao = 'Inspeção automática gerada ao cadastrar a estrutura.';
		$dataInspecao = date('Y-m-d', strtotime($_POST['data_construcao']." $i year"));
		$queryRotineira = "
			INSERT INTO inspecoes
			(ponte_id, nome, descricao, data_inspecao, tipo_inspecao)
			VALUES
			(".$idPonte.", '".$nomeInspecao."', '$nomeInspecao', '$dataInspecao', 'rotineira')
		";
		$conexao->executarQuery($queryRotineira);
	}
	for($i = 1; $i <= 4; $i++){
		$nomeInspecao = 'Inspeção automática gerada ao cadastrar a estrutura.';
		$anosInspecao = $i * 5;
		$dataInspecao = date('Y-m-d', strtotime($_POST['data_construcao']." $anosInspecao year"));
		$queryEspecial = "
			INSERT INTO inspecoes
			(ponte_id, nome, descricao, data_inspecao, tipo_inspecao)
			VALUES
			(".$idPonte.", '".$nomeInspecao."', '$nomeInspecao', '$dataInspecao', 'especial')
		";
		$conexao->executarQuery($queryEspecial);
	}
	
	header('Location: pontes.php');
?>