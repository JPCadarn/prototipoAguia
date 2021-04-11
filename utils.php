<?php

class Utils{
	public function renderNavBar(){
		echo "
			<nav>
				<div class='nav-wrapper purple darken-4'>
					<a href='index.php' class='brand-logo center' tabIndex='-1'>
						<img class='imagem-logo responsive-img' tabIndex='-1' id='logo' src='assets/Logo/Branco.png'/>
					</a>
					<a href='#' data-target='mobile-demo' class='sidenav-trigger'><i class='material-icons'>menu</i></a>
					<ul class='right hide-on-med-and-down'>
						<li><a href='pontes.php'>Pontes</a></li>
						<li><a href='agendamentos.php'>Agendamentos</a></li>
						<li><a href='inspecoes.php'>Inspeções</a></li>
						<li><a href='logout.php'>Logout</a></li>
						<li><a href='#'>Minha Conta</a></li>
					</ul>
				</div>
			</nav>
			<ul class='sidenav' id='mobile-demo'>
				<li><a href='pontes.php'>Pontes</a></li>
				<li><a href='agendamentos.php'>Agendamentos</a></li>
				<li><a href='inspecoes.php'>Inspeções</a></li>
				<li><a href='logout.php'>Logout</a></li>
				<li><a href='#'>Minha Conta</a></li>
			</ul>
		";
	}

	public function tagHead(){
		echo "
			<head>
				<!--Import Google Icon Font-->
				<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
				<!--Import materialize.css-->
				<link type='text/css' rel='stylesheet' href='assets/materialize/css/materialize.min.css'  media='screen,projection'/>
				<link rel='stylesheet' href='assets/css/main.css'>
				<!--Let browser know website is optimized for mobile-->
				<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
			</head>
		";
	}

	public function scriptsJs(){
		echo "
			<script type='text/javascript' src='assets/js/jquery-3.4.1.js'></script>
			<script type='text/javascript' src='assets/materialize/js/materialize.min.js'></script>
			<script type='text/javascript' src='assets/js/main.js'></script>
		";
	}

	public function formataData($data){
		return implode('/', array_reverse(explode('-', $data)));
	}

	public function renderSelect($idName, $opcoes, $label, $opcaoDisabled, $campoValor){
		echo "<div class='input-field col s12'>";
		echo "<select id='$idName' name='$idName'>";
		echo "<option value='' disabled selected>$opcaoDisabled</option>";
		foreach($opcoes as $opcao){
			echo '<option value='.$opcao['id'].'>'.$opcao[$campoValor].'</option>';
		}
		echo "</select>";
		echo "<label>$label</label>";
		echo "</div>";
	}
}

?>