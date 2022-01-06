
<?php
	require_once('utils.php');
	require_once('Cidades.php');
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
	<link rel="icon" href="assets/Logo/logo_novo_clean.png" type="image/x-icon">
</head>
<body>
	<center>
		<img class="responsive-img imagem-login" src="assets/Logo/logo_novo_corte.png" />

		<div class="container center">

			<?php
				if(isset($_GET['login_errado']) && $_GET['login_errado'] == true){
					echo "<h5 class='red-text'>Usuário ou Senha estão incorretos.</h5>";
					echo "<div class='section'></div>";
				}
			?>

			<h1>Site em manutenção</h1>
			<h3>No momento, o site encontra-se em manutenção para melhorias na ferramenta</h3>
		</div>
	</center>
	<?php
		exit;
	?>

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
		<div class="parallax"><img src="assets/home/bridge1.jpg" alt="Unsplashed background img 1"></div>
	</div>


	<div class="container">
		<div class="section">

			<!--   Icon Section   -->
			<div class="row">
				<h5 class="center">Consulta do estado das OAE de sua cidade</h5>
				<form action="buscarOAE.php" method="POST">
					<?php
						Utils::renderSelect('estado', Cidades::ESTADOS, 'Estado', 'Selecione o estado da OAE', 'nome', 's12 m6');
						echo "<div id='div_cidades' class='input-field col s12 m6'>";
						echo "<select disabled id='cidade' name='cidade'>";
						echo "<option value='' disabled selected>Selecione a cidade da OAE</option>";
						echo "</select>";
						echo "<label>Cidade</label>";
						echo "</div>";
						$ReflectionClass = new ReflectionClass(Cidades::class);
						$constantes = $ReflectionClass->getConstants();
						unset($constantes['ESTADOS']);
						ksort($constantes);
						foreach($constantes as $estado => $cidades){
							Utils::renderSelectNameIdDiferentesOculto($estado, 'cidade', $cidades, 'Cidade', 'Selecione a cidade da OAE', 'nome', 's21 m6');
						}
					?>
					<button target="_blank" class="indigo darken-4 float-right  waves-effect waves-circle waves-light btn-floating btn-large" type="submit" value="Create">
						<i class="large material-icons">search</i>
					</button>
				</form>
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
		<div class="parallax"><img src="assets/home/obras2.jpg" alt="Unsplashed background img 2"></div>
	</div>

	<div class="container">
		<div class="section">
		<div class="row">
				<div class="col s12 m4">
					<div class="icon-block">
						<h2 class="center indigo-text"><i class="material-icons">attach_money</i></h2>
						<h5 class="center">Otimizando os gastos públicos</h5>
						<p class="light">
							Com os gráficos e relatórios técnicos gerados pelo sistema do Infrasil, os gastos públicos se tornam mais eficientes, menos onerosos e priorizam sua utilização onde mais se necessita.
						</p>
					</div>
				</div>

				<div class="col s12 m4">
					<div class="icon-block">
						<h2 class="center indigo-text"><i class="material-icons">lock_open</i></h2>
						<h5 class="center">Transparência</h5>
						<p class="light">
							As obras de infraestrutura do município catalogadas e gerenciadas de forma eficiente, proporcionando ao público a geração de relatórios completos. 
							Assim, a gestão pública se torna cada vez mais transparente.
						</p>
					</div>
				</div>

				<div class="col s12 m4">
					<div class="icon-block">
						<h2 class="center indigo-text"><i class="material-icons">highlight</i></h2>
						<h5 class="center">Amigável ao uso</h5>
						<p class="light">
							Feito com layout moderno e de fácil uso. Sem instalações complexas e necessidade de cadastro.
							A Infrasil tornou o acesso a informação mais fácil para o cidadão.
						</p>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div id="modalPesquisa" class="modal large">
		<div class="modal-title">
			<br>
			<h4 class="center">Consulte as OAE de sua cidade</h4>
		</div>
		<form action="buscarOAE.php" method="POST">
		<div class="modal-content">
			<?php
				Utils::renderSelect('estado', Cidades::ESTADOS, 'Estado', 'Selecione o estado da OAE', 'nome', 's12 m6');
				echo "<div id='div_cidades' class='input-field col s12 m6'>";
				echo "<select disabled id='cidade' name='cidade'>";
				echo "<option value='' disabled selected>Selecione a cidade da OAE</option>";
				echo "</select>";
				echo "<label>Cidade</label>";
				echo "</div>";
				$ReflectionClass = new ReflectionClass(Cidades::class);
				$constantes = $ReflectionClass->getConstants();
				unset($constantes['ESTADOS']);
				ksort($constantes);
				foreach($constantes as $estado => $cidades){
					Utils::renderSelectNameIdDiferentesOculto($estado, 'cidade', $cidades, 'Cidade', 'Selecione a cidade da OAE', 'nome', 's21 m6');
				}
			?>
			</div>
			<div class="modal-footer">
				<div class="col s12 center">
					<h3><i class="mdi-content-send indigo-text"></i></h3>
					<h5>Entre em contato</h5>
					<p class="center light">
						Deseja contratar o serviço, precisa de suporte ou apenas deseja tirar dúvidas? Nossos contatos são:<br>
						Comercial: comercial@infrasil.com.br<br>
						Suporte: suporte@infrasil.com.br
					</p>
				</div>
				<button target="_blank" class="indigo darken-4 float-right  waves-effect waves-circle waves-light btn-floating btn-large" type="submit" value="Create">
					<i class="large material-icons">check</i>
				</button>
			</div>
		</form>
	</div>

	<footer class="page-footer indigo">
	<div class="container">
		<div class="row">
			<div class="col l6 s12">
			<h5 class="white-text">Contato</h5>
			<p class="grey-text text-lighten-4">
				Comercial: comercial@infrasil.com.br<br>
				Suporte: suporte@infrasil.com.br
			</p>
			</div>
		</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>
			</div>
		</div>
	</footer>


	<!--  Scripts-->
	<?php
		Utils::scriptsJs();
	?>
	<script type='text/javascript' src='assets/js/cidades.js'></script>
	</body>
</html>
