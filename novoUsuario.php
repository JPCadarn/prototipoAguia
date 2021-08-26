<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('UsuariosHelper.php');
	$conexao = new Conexao();
	$usuariosHelper = new UsuariosHelper();
	$_POST['senha'] = password_hash($_POST['senha'], PASSWORD_BCRYPT);
	$_POST['tipo'] = 'normal';
	$_POST['id_cliente'] = $conexao->executarQuery("SELECT id FROM cliente WHERE chave ='".$_POST['chave']."'");
	$chaves = implode(',', array_keys($_POST));
	$valores = array_values($_POST);
	$valoresTratados = [];
	$imagens = [];
	foreach($valores as $valor){
		$valoresTratados[] = "'$valor'";
	}
	$valoresTratados = implode(',', $valoresTratados);
	$validacaoChave = $usuariosHelper->validarChaveCliente($_POST['chave']);
	if($validacaoChave){
		$query = "
			INSERT INTO usuarios
			($chaves)
			VALUES
			($valoresTratados)
		";
		$idUsuario = $conexao->executarQuery($query);
		$mensagemErro = '';
	}else{
		$mensagemErro = '?mensagemErro=104';
	}
	header('Location: usuarios.php'.$mensagemErro);
?>