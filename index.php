
<?php
	require_once('utils.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Infrasil - O portal da infraestrutura brasileira</title>

	<!-- CSS  -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="assets/materialize/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="assets/css/main.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="assets/css/home.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
	<nav class="transparent" role="navigation">
		<div class="nav-wrapper container">
			<a href='#' class='brand-logo imagem-navbar' tabIndex='-1'>
				<img class='responsive-img center' tabIndex='-1' id='logo' src='assets/Logo/logo_novo_clean.png'/>
			</a>
			<ul class="right hide-on-med-and-down waves-effect waves-dark">
				<li><a href="login.php">Login</a></li>
			</ul>
			
			<ul id="nav-mobile" class="sidenav">
				<li><a href="login.php">Login</a></li>
			</ul>
			<a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		</div>
	</nav>

	<div id="index-banner" class="parallax-container">
		<div class="section no-pad-bot">
			<div class="container">
				<br><br>
				<img src="assets/Logo/loguito.png" class="header center banner">
				<!-- <div class="row center">
					<h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
				</div> -->
				<br><br>
			</div>
		</div>
		<div class="parallax"><img src="assets/fotos/home/bridge1.jpg" alt="Unsplashed background img 1"></div>
	</div>


	<div class="container">
		<div class="section">

			<!--   Icon Section   -->
			<div class="row">
				<div class="col s12 m4">
					<div class="icon-block">
						<h2 class="center indigo-text"><i class="material-icons">attach_money</i></h2>
						<h5 class="center">Otimize seus custos</h5>
						<p class="light">
							Com os relatórios e gráficos de manutenção prioritária gerados pelo sistema, o Infrasil reduz seus custos enquanto otimiza manutenções.
						</p>
					</div>
				</div>

				<div class="col s12 m4">
					<div class="icon-block">
						<h2 class="center indigo-text"><i class="material-icons">lock_open</i></h2>
						<h5 class="center">Transparente</h5>
						<p class="light">
							Enquanto cataloga e gerencia suas OAE's, disponibilizamos ao público a consulta ao estado das estruturas. Com isso, tornamos a gestão pública mais transparente.
						</p>
					</div>
				</div>

				<div class="col s12 m4">
					<div class="icon-block">
						<h2 class="center indigo-text"><i class="material-icons">highlight</i></h2>
						<h5 class="center">Amigável ao uso</h5>
						<p class="light">Feito com layout moderno e de fácil uso. Sem instalações complexas, apenas </p>
					</div>
				</div>
			</div>

		</div>
	</div>


	<div class="parallax-container valign-wrapper">
		<div class="section no-pad-bot">
			<div class="container">
				<div class="row center">
					<h5 class="header col s12 light">
						A INFRASIL é uma empresa que se propôs a resolver o problema do gerenciamento de obras de infraestrutura pública do país, fornecendo sistemas que possibilitam o correto controle e eficiente tomada de decisões por parte dos responsáveis técnicos em cada municipalidade. Já o portal da INFRASIL tem como principal objetivo tornar-se o “Portal da Transparência” das obras de infraestrutura do Brasil. Desta forma, o cidadão poderá obter informações técnicas a respeito de obras desse gênero, de forma fácil e rápida, fomentando a participação no controle e fiscalização do patrimônio público do país.</h5>
				</div>
			</div>
		</div>
		<div class="parallax"><img src="assets/fotos/home/obras2.jpg" alt="Unsplashed background img 2"></div>
	</div>

	<div class="container">
		<div class="section">

			<div class="row">
				<div class="col s12 center">
					<h3><i class="mdi-content-send indigo-text"></i></h3>
					<h4>Entre em contato</h4>
					<p class="center light">
						Deseja contratar o serviço, precisa de suporte ou apenas deseja tirar dúvidas? Nossos contatos são:<br>
						Comercial: comercial@infrasil.com.br<br>
						Suporte: suporte@infrasil.com.br
					</p>
				</div>
			</div>

		</div>
	</div>

	<footer class="page-footer indigo">
		<div class="container right-align">
			Made by <a class="white-text text-darken-3" href="http://materializecss.com">Materialize</a>
		</div>
				
		<!-- </div> -->
	</footer>


	<!--  Scripts-->
	<?php
		Utils::scriptsJs();
	?>

	</body>
</html>
