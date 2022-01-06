<?php
	require_once('utils.php');
	require_once('conexao.php');
	require_once('SessionService.php');
	require_once('ContaService.php');
	SessionService::validarLoginFeito();

	$conexao = new Conexao();
	$dadosUsuario = $conexao->executarQuery('SELECT * FROM usuarios WHERE id = '.SessionService::getUserId())[0];

	Utils::tagHead();
	echo "<body>";
	Utils::navBar();
	echo "<div class='container'>";
	ContaService::renderMinhaConta($dadosUsuario);
	echo "</div>";
	Utils::scriptsJs();
	echo "<script type='text/javascript' src='assets/js/validarSenha.js'></script>";
	echo "</body>";
?>