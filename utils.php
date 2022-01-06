<?php

require_once('SessionService.php');

class Utils{

	public static function ordenarArrayMultiDimensional($array, $chave){
		$colunas = array_column($array, $chave);
		array_multisort($colunas, SORT_DESC, $array);

		return $array;
	}
	
	public static function navBar(){
		if(session_status() <> PHP_SESSION_ACTIVE){
			session_start();
		}
		$userType = SessionService::getUserType();
		if($userType == 'aguia'){
			self::renderNavBarAguia();
		}elseif($userType == 'admin'){
			self::renderNavBarAdmin();
		}elseif($userType == 'normal'){
			self::renderNavBar();
		}else{
			self::renderNavBarSemLogin();
		}
	}

	public static function renderNavBarAguia(){
		echo "
			<nav>
				<div class='nav-wrapper grey lighten-1'>
					<a href='dash.php' class='brand-logo imagem-logo' tabIndex='-1'>
						<img class='responsive-img' tabIndex='-1' id='logo' src='assets/Logo/logo_novo_corte.png'/>
					</a>
					<a href='#' data-target='mobile-demo' class='sidenav-trigger'><i class='material-icons'>menu</i></a>
					<ul id='itens_menu' class='right hide-on-med-and-down'>
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

	public static function renderNavBarAdmin(){
		echo "
			<nav>
				<div class='nav-wrapper grey lighten-1'>
				<a href='dash.php' class='brand-logo imagem-logo' tabIndex='-1'>
					<img class='responsive-img' tabIndex='-1' id='logo' src='assets/Logo/logo_novo_corte.png'/>
				</a>
					<a href='#' data-target='mobile-demo' class='sidenav-trigger'><i class='material-icons'>menu</i></a>
					<ul id='itens_menu' class='right hide-on-med-and-down'>
						<li><a href='pontes.php'>Pontes</a></li>
						<li><a href='agendamentos.php'>Agendamentos</a></li>
						<li><a href='inspecoes.php'>Inspeções</a></li>
						<li><a href='usuarios.php'>Usuários</a></li>
						<li><a href='logout.php'>Logout</a></li>
						<li><a href='minhaConta.php'>Minha Conta</a></li>
					</ul>
					<ul id='dropdownEstruturas' class='dropdown-content'>
						<li><a href='pontes.php'>Pontes</a></li>
						<li><a href='agendamentos.php'>Agendamentos</a></li>
						<li><a href='inspecoes.php'>Inspeções</a></li>
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
				
	public static function renderNavBar(){
		echo "
			<nav>
					<div class='nav-wrapper grey lighten-1'>
					<a href='dash.php' class='brand-logo imagem-logo' tabIndex='-1'>
						<img class='responsive-img' tabIndex='-1' id='logo' src='assets/Logo/logo_novo_corte.png'/>
					</a>
					<a href='#' data-target='mobile-demo' class='sidenav-trigger'><i class='material-icons'>menu</i></a>
					<ul id='itens_menu' class='right hide-on-med-and-down'>
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
				<div class='nav-wrapper grey lighten-1'>
					<a href='dash.php' class='brand-logo center imagem-logo' tabIndex='-1'>
						<img class='responsive-img' tabIndex='-1' id='logo' src='assets/Logo/logo_novo_corte.png'/>
					</a>
					<a href='#' data-target='mobile-demo' class='sidenav-trigger'><i class='material-icons'>menu</i></a>
					<ul class='right hide-on-med-and-down'>
						<li><a href='login.php'>Login</a></li>
					</ul>
				</div>
			</nav>
			<ul class='sidenav' id='mobile-demo'>
				<li><a href='login.php'>Login</a></li>
			</ul>
		";
	}

	public static function tagHead($titulo = 'Infrasil - O portal da infraestrutura brasileira'){
		echo "
			<head>
				<!--Import Google Icon Font-->
				<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
				<!--Import materialize.css-->
				<link type='text/css' rel='stylesheet' href='assets/materialize/css/materialize.min.css'  media='screen,projection'/>
				<link rel='stylesheet' href='assets/css/main.css'>
				<!--Let browser know website is optimized for mobile-->
				<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
				<link rel='icon' href='assets/Logo/logo_novo_clean.png' type='image/x-icon'>
				<title>".$titulo."</title>
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

	public static function calculaDiferencaDatas($data1, $data2, $formato){
		$datetime1 = date_create($data1);
		$datetime2 = date_create($data2);
	
		$interval = date_diff($datetime1, $datetime2);
	
		return $interval->format($formato);
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

	public static function renderSelect($idName, $opcoes, $label, $opcaoDisabled, $campoValor, $tamanho = 's12'){
		echo "<div class='input-field col ".$tamanho."'>";
		echo "<select id='$idName' name='$idName'>";
		echo "<option value='' disabled selected>$opcaoDisabled</option>";
		foreach($opcoes as $opcao){
			echo '<option value='.$opcao['id'].'>'.$opcao[$campoValor].'</option>';
		}
		echo "</select>";
		echo "<label>$label</label>";
		echo "</div>";
	}

	public static function renderSelectNameIdDiferentesOculto($id, $name, $opcoes, $label, $opcaoDisabled, $campoValor, $tamanho = 's12'){
		echo "<div id='div_".$id."' class='oculto input-field col ".$tamanho."'>";
		echo "<select id='$id' name='$name'>";
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

	public static function agruparArrayPorChave($array, $chave){
		$retorno = [];

		foreach($array as $valor){
			$retorno[$valor[$chave]][] = $valor;
		}

		return $retorno;
	}

	public static function somarArray($array, $chaves){
		$soma = 0;

		foreach ($chaves as $chave) {
			$soma += $array[$chave];
		}

		return $soma;
	}
}

?>