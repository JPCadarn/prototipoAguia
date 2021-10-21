<?php

class Utils{
	public static function navBar(){
		if(session_status() <> PHP_SESSION_ACTIVE){
			session_start();
		}
		if(isset($_SESSION['userId']) && isset($_SESSION['userType']) && ($_SESSION['userType'] == 'aguia')){
			self::renderNavBarAguia();
		}elseif(isset($_SESSION['userId']) && isset($_SESSION['userType']) && ($_SESSION['userType'] == 'admin')){
			self::renderNavBarAdmin();
		}elseif(isset($_SESSION['userId'])){
			self::renderNavBar();
		}else{
			self::renderNavBarSemLogin();
		}
	}

	public static function ordenarArrayMultiDimensional($array, $chave){
		$colunas = array_column($array, $chave);
		array_multisort($colunas, SORT_DESC, $array);

		return $array;
	}

	public static function renderNavBarAdmin(){
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
						<li><a href='usuarios.php'>Usuários</a></li>
						<li><a href='logout.php'>Logout</a></li>
						<li><a href='minhaConta.php'>Minha Conta</a></li>
					</ul>
				</div>
			</nav>
			<ul class='sidenav' id='mobile-demo'>
				<li><a href='pontes.php'>Pontes</a></li>
				<li><a href='agendamentos.php'>Agendamentos</a></li>
				<li><a href='inspecoes.php'>Inspeções</a></li>
				<li><a href='usuarios.php'>Usuários</a></li>
				<li><a href='logout.php'>Logout</a></li>
				<li><a href='minhaConta.php'>Minha Conta</a></li>
			</ul>
		";
	}

	public static function renderNavBarAguia(){
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
						<li><a href='usuarios.php'>Usuários</a></li>
						<li><a href='clientes.php'>Clientes</a></li>
						<li><a href='logout.php'>Logout</a></li>
						<li><a href='minhaConta.php'>Minha Conta</a></li>
					</ul>
				</div>
			</nav>
			<ul class='sidenav' id='mobile-demo'>
				<li><a href='pontes.php'>Pontes</a></li>
				<li><a href='agendamentos.php'>Agendamentos</a></li>
				<li><a href='inspecoes.php'>Inspeções</a></li>
				<li><a href='usuarios.php'>Usuários</a></li>
				<li><a href='clientes.php'>Clientes</a></li>
				<li><a href='logout.php'>Logout</a></li>
				<li><a href='minhaConta.php'>Minha Conta</a></li>
			</ul>
		";
	}

	public static function renderNavBar(){
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
						<li><a href='minhaConta.php'>Minha Conta</a></li>
					</ul>
				</div>
			</nav>
			<ul class='sidenav' id='mobile-demo'>
				<li><a href='pontes.php'>Pontes</a></li>
				<li><a href='agendamentos.php'>Agendamentos</a></li>
				<li><a href='inspecoes.php'>Inspeções</a></li>
				<li><a href='logout.php'>Logout</a></li>
				<li><a href='minhaConta.php'>Minha Conta</a></li>
			</ul>
		";
	}

	public static function renderNavBarSemLogin(){
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
						<li><a href='index.php'>Login</a></li>
					</ul>
				</div>
			</nav>
			<ul class='sidenav' id='mobile-demo'>
				<li><a href='pontes.php'>Pontes</a></li>
				<li><a href='agendamentos.php'>Agendamentos</a></li>
				<li><a href='inspecoes.php'>Inspeções</a></li>
				<li><a href='index.php'>Login</a></li>
			</ul>
		";
	}

	public static function tagHead(){
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

	public static function scriptsJs(){
		echo "
			<script type='text/javascript' src='assets/js/jquery-3.4.1.js'></script>
			<script type='text/javascript' src='assets/materialize/js/materialize.min.js'></script>
			<script type='text/javascript' src='assets/js/main.js'></script>
			<script type='text/javascript' src='assets/vendors/jQuery-Mask-Plugin-master/src/jquery.mask.js'></script>
			<script type='text/javascript' src='assets/js/mascaras.js'></script>
		";
	}

	public static function formataData($data){
		return implode('/', array_reverse(explode('-', $data)));
	}

	public static function formataDataBD($data){
		return implode('-', array_reverse(explode('/', $data)));
	}

	public static function formataCoordenadasBD($coord){
		return str_replace(['º ', '\' ', '" '], '', $coord);
	}

	public static function formataDecimalBD($valor){
		return str_replace(['.', ','], ['', '.'], $valor);
	}

	public static function formataDateTime($dateTime){
		$DateTime = new DateTime($dateTime);
		return $DateTime->format('d/m/Y H:i:s');
	}

	public static function formataTelefone($telefone){
		$retorno = substr_replace($telefone, '(', 0, 0);
		return substr_replace($retorno, ') ', 3, 0);
	}

	public static function formataEnderecoCliente($cliente){
		return sprintf('%s, %s-%s, %s, %s-%s, CEP: %s', $cliente['endereco'], $cliente['numero'], $cliente['complemento'], $cliente['bairro'], $cliente['cidade'], $cliente['estado'], $cliente['cep']);
	}

	public static function formataTelefoneBD($fone){
		return str_replace(['(', ')', '-', ' '], '', $fone);
	}
	
	public static function formataCepBD($fone){
		return str_replace('-', '', $fone);
	}

	public static function formataCpfCnpj($cpfCnpj){
		if(strlen($cpfCnpj) == 14){
			//XX.XXX.XXX/0001-XX
			$retorno = substr_replace($cpfCnpj, '.', 2, 0);
			$retorno = substr_replace($retorno, '.', 6, 0);
			$retorno = substr_replace($retorno, '/', 10, 0);
			$retorno = substr_replace($retorno, '-', 15, 0);
		}else{
			//XXX.XXX.XXX-XX
			$retorno = substr_replace($cpfCnpj, '.', 3, 0);
			$retorno = substr_replace($retorno, '.', 7, 0);
			$retorno = substr_replace($retorno, '-', 11, 0);
		}

		return $retorno;
	}

	public static function renderSelect($idName, $opcoes, $label, $opcaoDisabled, $campoValor){
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

	public static function renderSelectSemDiv($idName, $opcoes, $label, $opcaoDisabled, $campoValor){
		echo "<select id='$idName' name='$idName'>";
		echo "<option value='' disabled selected>$opcaoDisabled</option>";
		foreach($opcoes as $opcao){
			echo '<option value='.$opcao['id'].'>'.$opcao[$campoValor].'</option>';
		}
		echo "</select>";
		echo "<label>$label</label>";
	}

	public static function row(){
		echo "<div class='row'>";
	}

	public static function varDump($dados){
		echo '<pre>';
		var_dump($dados);
		exit;
	}

	public static function printR($dados){
		echo '<pre>';
		print_r($dados);
		exit;
	}

	public static function mostraMensagemErro(){
		if(isset($_GET['mensagemErro'])){
			$mensagemErro = self::getMensagemErro($_GET['mensagemErro']);
			$tagErro = "
				<div class='erro'>
					$mensagemErro
				</div>
			";
			echo $tagErro;
		}
	}

	public static function getMensagemErro($codigoErro){
		switch ($codigoErro){
			case '104':
				return 'Chave de Usuário Inválida';
				break;
			default:
				return '';
				break;
		}
	}
}

?>