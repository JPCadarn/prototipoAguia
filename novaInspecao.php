<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('SessionService.php');

	$conexao = new Conexao();
	$_POST['data_inspecao'] = implode('-', array_reverse(explode('/', $_POST['data_inspecao'])));
	$idUsuario = SessionService::getUserId();
	$idInspecao = $_POST['id_inspecao'];
	$_POST['id_usuario'] = $idUsuario;
	unset($_POST['id_inspecao']);

	$chaves = array_keys($_POST);
	$imagens = [];
	$valores = array_values($_POST);
	$camposValores = [];

	foreach($chaves as $index => $chave){
		$camposValores [] = "{$chaves[$index]} = '{$valores[$index]}'";
	}
	$camposValores = implode(', ', $camposValores);
	$conexao->updateById('inspecoes', $idInspecao, $camposValores);
	
	// for($i = 0; $i < count($_FILES['images']['name']); $i++){
	// 	$nomeImagem = str_replace(['.', ',', '/', '\\'], '_', password_hash($_FILES['images']['name'][$i], PASSWORD_BCRYPT)).'.'.explode('/', $_FILES['images']['type'][$i])[1];
	// 	$imagens[] = $nomeImagem;
	// 	$destino = explode('models', dirname(__FILE__))[0].'\\assets\\fotos\\'.$nomeImagem;
	// 	if(rename($_FILES['images']['tmp_name'][$i], $destino)){
	// 		$queryImagens = "
	// 		INSERT INTO imagens_inspecoes
	// 		(inspecao_id, imagem, id_usuario)
	// 		VALUES
	// 		($idInspecao, '$nomeImagem', $idUsuario)
	// 		";
	// 		$conexao->executarQuery($queryImagens);
	// 	}
	// }
	header('Location: inspecoes.php');
?>