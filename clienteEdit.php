<?php
	require_once('conexao.php');
	require_once('utils.php');
	if(!isset($_GET['id']) || $_GET['id'] == ''){
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}else{
		$conexao = new Conexao();
		$cliente = $conexao->executarQuery("SELECT * FROM clientes WHERE id = ".$_GET['id'])[0];
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
		<?php
			Utils::navBar();
		?>
		<div class="row">
			<form action="editCliente.php" method="POST" class="col s12" autocomplete="off">
				<div class="row">
					<input type="hidden" id="id" name="id" value="<?php echo $_GET['id'];?>">
					<div class="input-field col s12 m6">
						<input id="nome" value="<?php echo $cliente['nome']; ?>" name="nome" type="text">
						<label for="nome">Nome</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="data_nascimento" value="<?php echo Utils::formataData($cliente['data_nascimento']); ?>" name="data_nascimento" class="mask-date" type="text">
						<label for="data_nascimento">Data de Nascimento</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="cpf_cnpj" value="<?php echo $cliente['cpf_cnpj']; ?>" name="cpf_cnpj" type="text" class="mask-cpfcnpj">
						<label for="cpf_cnpj">CPF/CNPJ</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="telefone" value="<?php echo $cliente['telefone']; ?>" name="telefone" type="text" class="mask-telefone">
						<label for="telefone">Telefone</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="email" value="<?php echo $cliente['email']; ?>" name="email" type="email">
						<label for="email">Email</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="cep" value="<?php echo $cliente['cep']; ?>" name="cep" type="text" class="mask-cep">
						<label for="cep">CEP</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="endereco" value="<?php echo $cliente['endereco']; ?>" name="endereco" type="text">
						<label for="endereco">Endereço</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="bairro" value="<?php echo $cliente['bairro']; ?>" name="bairro" type="text">
						<label for="bairro">Bairro</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="numero" value="<?php echo $cliente['numero']; ?>" name="numero" type="text">
						<label for="numero">Número</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="complemento" value="<?php echo $cliente['complemento']; ?>" name="complemento" type="text">
						<label for="complemento">Complemento</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="estado" value="<?php echo $cliente['estado']; ?>" name="estado" type="text">
						<label for="estado">Complemento</label>
					</div>
					<div class="input-field col s12 m6">
						<input id="cidade" value="<?php echo $cliente['cidade']; ?>" name="cidade" type="text">
						<label for="cidade">Cidade</label>
					</div>
					<div class="input-field col s12">
						<input id="referencia" value="<?php echo $cliente['referencia']; ?>" name="referencia" type="text">
						<label for="referencia">Referência</label>
					</div>
					<button class=" waves-effect waves-circle waves-light btn-floating btn-large float-right" type="submit" value="Create">
						<i class="large material-icons">check</i>
					</button>
				</div>
			</form>
		</div>
		<?php Utils::scriptsJs(); ?>
	</body>
</html>