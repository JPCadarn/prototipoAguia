<?php
	require_once('conexao.php');
	$conexao = new Conexao();
	$_POST['data_construcao'] = implode('-', array_reverse(explode('/', $_POST['data_construcao'])));
	$chaves = implode(',', array_keys($_POST));
	$valores = array_values($_POST);
	$valoresTratados = [];
	$imagens = [];
	foreach($valores as $valor){
		$valoresTratados[] = "'$valor'";
	}
	$valoresTratados = implode(',', $valoresTratados);
	$query = "
		INSERT INTO inspecoes
		($chaves)
		VALUES
		($valoresTratados)
	";
	echo '<pre>';
	print_r($_POST);
	print_r($query);
	exit;
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
	header('Location: pontes.php');
?>