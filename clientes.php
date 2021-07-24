<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('ClientesService.php');

	$conexao = new Conexao();
	$utils = new Utils();
	$clienteService = new ClientesService();

	echo '<!DOCTYPE html>';
	$utils->tagHead();
	echo '<body>';
	$utils->renderNavBar();

	$clientes = $clienteService->getDadosClientesFormatados();
	$utils->row();
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
							</div>
							<div class='card-action center'>
								<a href='clienteDetalhes.php?id={$cliente['id']}'><i class='material-icons'>info</i> Detalhes</a>
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
		<a data-target="modalCadastro" class="btn-large modal-trigger btn-floating waves-effect waves-light purple darken-4">
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
							<input id="data_nascimento" name="data_nascimento" type="date">
							<label for="data_nascimento">Data de Nascimento</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="cpf_cnpj" name="cpf_cnpj" type="number" maxlength=14>
							<label for="cpf_cnpj">CPF/CNPJ</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="endereco" name="endereco" type="text">
							<label for="endereco">Endereço</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="telefone" name="telefone" type="text">
							<label for="telefone">Telefone</label>
						</div>
						<div class="input-field col s12 m6">
							<input id="email" name="email" type="email">
							<label for="email">Email</label>
						</div>
						<div class="fixed-action-btn">
							<div class="fixed-action-btn">
								<button class="modal-close waves-effect waves-circle waves-light btn-floating btn-large purple darken-4" type="submit" value="Create">
									<i class="large material-icons">check</i>
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php
	$utils->scriptsJs();
	echo '</body>';
	echo '</html>';
?>