<?php
	require_once('conexao.php');
	$conexao = new Conexao();
	if(!isset($_GET['id']) || $_GET['id'] == ''){

	}else{
		$dados = $conexao->executarQuery('SELECT * FROM pontes WHERE id = '.$_GET['id'])[0];
		$imagens = $conexao->executarQuery("SELECT imagem FROM imagens_pontes WHERE ponte_id = {$_GET['id']}");
		$agendamentos = $conexao->executarQuery("SELECT * FROM agendamentos WHERE ponte_id = {$_GET['id']}");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="assets/materialize/css/materialize.min.css"  media="screen,projection"/>
		<link rel="stylesheet" href="assets/css/main.css">
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body>
		<nav>
			<div class="nav-wrapper purple darken-4">
				<a href='index.php' class='brand-logo center' tabIndex='-1'>
					<img class='imagem-logo responsive-img' tabIndex='-1' id='logo' src='assets/Logo/Branco.png'/>
				</a>
				<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li><a href="pontes.php">Pontes</a></li>
					<li><a href="agendamentos.php">Agendamentos</a></li>
					<li><a href="logout.php">Logout</a></li>
					<li><a href="#">Minha Conta</a></li>
				</ul>
			</div>
		</nav>
		
		<ul class="sidenav" id="mobile-demo">
			<li><a href="pontes.php">Pontes</a></li>
			<li><a href="agendamentos.php">Agendamentos</a></li>
			<li><a href="logout.php">Logout</a></li>
			<li><a href="#">Minha Conta</a></li>
		</ul>

		<!--JavaScript at end of body for optimized loading-->
		<script type="text/javascript" src="assets/js/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script>
		<script type="text/javascript" src="assets/js/main.js"></script>
	</body>
</html>