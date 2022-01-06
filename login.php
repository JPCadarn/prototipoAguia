<?php
	require_once('utils.php');
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
		<?php
			if(!$_GET['batatafrita'] == 'S' || !isset($_GET['batatafrita'])){
				header('Location: index.php');
			}

			if(session_status() <> PHP_SESSION_ACTIVE){
				session_start();
			}

			if(isset($_SESSION['userId'])){
				header('Location: dash.php');
			}
		?>

		<center>
			<img class="responsive-img imagem-login" src="assets/Logo/logo_novo_corte.png" />

			<div class="container center">

				<?php
					if(isset($_GET['login_errado']) && $_GET['login_errado'] == true){
						echo "<h5 class='red-text'>Usuário ou Senha estão incorretos.</h5>";
						echo "<div class='section'></div>";
					}
				?>

				<div class="z-depth-1 grey lighten-4 row card-login">
					<form class="col s12" method="POST" action='fazerLogin.php'>
						<div class='row'>
							<div class='input-field col s12'>
								<input required type='text' name='login'/>
								<label for='email'>Usuário</label>
							</div>
						</div>
						<div class='row'>
							<div class='input-field col s12'>
								<input required type='password' name='senha'/>
								<label for='password'>Senha</label>
							</div>
						</div>
						<div class='row'>
							<button type='submit' name='btn_login' class='indigo darken-4 col s12 btn btn-large waves-effect'>Login</button>
						</div>
					</form>
				</div>
			</div>
		</center>

		<!--JavaScript at end of body for optimized loading-->
		<script type="text/javascript" src="assets/js/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script>
		<script type="text/javascript" src="assets/js/main.js"></script>
	</body>
</html>