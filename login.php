<?php

	if(session_status() <> PHP_SESSION_ACTIVE){
		session_start();
	}
	require_once('conexao.php');
	$conexao = new Conexao();
	$conexao->conectar();

	$query = "
		SELECT *
		FROM usuarios
		WHERE usuario = '{$_POST['login']}'
	";
	$dadosUser = $conexao->executarQuery($query);

	if(!empty($dadosUser)){
		$validacaoSenha = password_verify($_POST['senha'], $dadosUser[0]['senha']);
		if($validacaoSenha){
			$_SESSION['visitantes'] = false;
			$_SESSION['userId'] = $dadosUser[0]['id'];
			header('Location: dash.php');
		}else{
			header('Location: index.php?login_errado=true');
		}
	}else{
		header('Location: index.php?login_errado=true');
	}
?>