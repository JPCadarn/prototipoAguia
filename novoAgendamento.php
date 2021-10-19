<?php
	require_once('conexao.php');
	require_once('utils.php');
	
	$conexao = new Conexao();
	$_POST['data'] = Utils::formataDataBD($_POST['data']);	
	$tipoInspecao = $_POST['tipo_inspecao'];
	unset($_POST['tipo_inspecao']);
	
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
	$idAgendamento = $conexao->executarQuery($query);
	if($idAgendamento){
		
		$nomeInspecao = 'Inspeção automática gerada pelo agendamento ID: '.$idAgendamento;
		$query = "
			INSERT INTO inspecoes
			(ponte_id, nome, descricao)
			VALUES
			(".$_POST['ponte_id'].", '".$nomeInspecao."', '".$_POST['detalhes']."')
		";
		if($conexao->executarQuery($query)){
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}
	}
?>