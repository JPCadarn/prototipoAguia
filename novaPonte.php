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
	$_POST['id_usuario'] = SessionService::getUserId();
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
		$destino = dirname(__FILE__).'/assets/fotos/'.$nomeImagem;
		if(rename($_FILES['images']['tmp_name'][$i], $destino)){
			chmod($destino, 604);
			$queryImagens = "
			INSERT INTO imagens_pontes
			(ponte_id, imagem)
			VALUES
			($idPonte, '$nomeImagem')
			";
			$conexao->executarQuery($queryImagens);
		}
	}

	$nomeInspecao = 'Inspeção cadastral para a OAE '.$idPonte;
	$dataInspecao = date('Y-m-d');
	$detalhesAgendamentoCadastral = 'Agendamento de inspeção cadastral para a OAE '.$idPonte;
	$queryAgendamentoCadastral = "
		INSERT INTO agendamentos
		(data, horario, detalhes, ponte_id, id_usuario)
		VALUES
		('".$dataInspecao."', '12:00:00', '".$detalhesAgendamentoCadastral."', ".$idPonte.", ".SessionService::getUserId().")
	";
	$queryInspecaoCadastral = "
		INSERT INTO inspecoes
		(ponte_id, nome, descricao, data_inspecao, tipo_inspecao, id_usuario)
		VALUES
		(".$idPonte.", '".$nomeInspecao."', '$nomeInspecao', '$dataInspecao', 'cadastral', ".SessionService::getUserId().")
	";
	$conexao->executarQuery($queryAgendamentoCadastral);
	$conexao->executarQuery($queryInspecaoCadastral);

	for($i = 1; $i <= 4; $i++){
		$nomeInspecao = 'Inspeção rotineira automática para a OAE '.$idPonte;
		$dataInspecao = date('Y-m-d', strtotime(date('Y-m-d')." $i year"));
		$detalhesAgendamentoRotineiro = 'Agendamento de inspeção rotineira para a OAE '.$idPonte;
		$queryAgendamentoRotineira = "
			INSERT INTO agendamentos
			(data, horario, detalhes, ponte_id, id_usuario)
			VALUES
			('".$dataInspecao."', '12:00:00', '".$detalhesAgendamentoRotineiro."', ".$idPonte.", ".SessionService::getUserId().")
		";
		$conexao->executarQuery($queryAgendamentoRotineira);
	}

	$nomeInspecao = 'Inspeção especial automática para a OAE '.$idPonte;
	$dataInspecao = date('Y-m-d', strtotime(date('Y-m-d')." 5 year"));
	$detalhesAgendamentoEspecial = 'Agendamento de inspeção especial para a OAE '.$idPonte;
	$queryAgendamentoEspecial = "
		INSERT INTO agendamentos
		(data, horario, detalhes, ponte_id, id_usuario)
		VALUES
		('".$dataInspecao."', '12:00:00', '".$detalhesAgendamentoEspecial."', ".$idPonte.", ".SessionService::getUserId().")
	";
	$conexao->executarQuery($queryAgendamentoEspecial);
	
	header('Location: pontes.php');
?>