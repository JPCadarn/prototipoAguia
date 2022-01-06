<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('ClientesService.php');
	require_once('SessionService.php');
	SessionService::validarLoginFeito();

	$conexao = new Conexao();	
	$clienteService = new ClientesService();

	echo '<!DOCTYPE html>';
	Utils::tagHead();
	echo '<body>';
	Utils::navBar();

	$clientes = $clienteService->getDadosClientesFormatados();
	Utils::row();
	if(is_array($clientes) && count($clientes) > 0){
		foreach($clientes as $cliente){
			echo "
				<div class='col s12'>
					<div class='card center'>
						<div>
							<div class='card-content'>
								<span class='card-title'>{$cliente['nome']}</span>
								<p>{$cliente['data_nascimento']}</p>
								<p>{$cliente['cpf_cnpj']}</p>
								<p>{$cliente['endereco']}</p>
								<p>{$cliente['telefone']}</p>
								<p>{$cliente['email']}</p>
								<p>{$cliente['chave']}</p>
							</div>
							<div class='card-action center'>
								<a href='clienteEdit.php?id={$cliente['id']}'><i class='material-icons'>edit</i> Editar</a>
							</div>
						</div>
					</div>
				</div>
			";
		}
	}else{
		echo "<h6 class='centralizar'>Nenhum cliente cadastrado";
	}
?>

	<div class="fixed-action-btn">
		<a data-target="modalCadastro" class="indigo darken-4 btn-large modal-trigger btn-floating waves-effect waves-light">
			<i class="large material-icons">add</i>
		</a>
	</div>

	<div id="modalCadastro" class="modal">
		<br>
		<br>
		<div class="modal-title">
			<h4 class="center">Cadastro de Cliente</h4>
		</div>
		<div class="modal-content">
			<div class="row">
				<form action="novoCliente.php" method="POST" class="col s12" autocomplete="off">
					<div class="row">
						<div class="input-field col s12 m6">
							<input id="nome" name="nome" type="text">
							<label for="nome">Nome</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="data_nascimento" name="data_nascimento" class="mask-date" type="text">
							<label for="data_nascimento">Data de Nascimento</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="cpf_cnpj" name="cpf_cnpj" type="text" class="mask-cpfcnpj">
							<label for="cpf_cnpj">CPF/CNPJ</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="telefone" name="telefone" type="text" class="mask-telefone">
							<label for="telefone">Telefone</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="email" name="email" type="email">
							<label for="email">Email</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="cep" name="cep" type="text" class="mask-cep">
							<label for="cep">CEP</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="endereco" name="endereco" type="text">
							<label for="endereco">Endereço</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="bairro" name="bairro" type="text">
							<label for="bairro">Bairro</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="numero" name="numero" type="text">
							<label for="numero">Número</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="complemento" name="complemento" type="text">
							<label for="complemento">Complemento</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="estado" name="estado" type="text">
							<label for="estado">Complemento</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="cidade" name="cidade" type="text">
							<label for="cidade">Cidade</label>
						</div>
						<div class="input-field col s12">
							<input id="referencia" name="referencia" type="text">
							<label for="referencia">Referência</label>
						</div>
						<button class="indigo darken-4  waves-effect waves-circle waves-light btn-floating btn-large float-right" type="submit" value="Create">
							<i class="large material-icons">check</i>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php
	Utils::scriptsJs();
	echo '</body>';
	echo '</html>';
?>