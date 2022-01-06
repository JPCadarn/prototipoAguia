<?php
	require_once('utils.php');
	require_once('conexao.php');
	require_once('SessionService.php');
	require_once('UsuariosService.php');
	SessionService::validarLoginFeito();

	$conexao = new Conexao();
	
	if(SessionService::getUserType() != 'aguia'){
		$dadosUsuario = $conexao->executarQuery('SELECT * FROM usuarios WHERE id_cliente = '.SessionService::getIdCliente());
	}else{
		$dadosUsuario = $conexao->executarQuery('SELECT * FROM usuarios');
	}

	Utils::tagHead();
	echo "<body>";
	Utils::navBar();
	echo "<div class='container'>";
	UsuariosService::renderUsuarios($dadosUsuario);
	echo "</div>";
	Utils::scriptsJs();
	echo "<script type='text/javascript' src='assets/js/validarSenha.js'></script>";
	echo "</body>";
?>