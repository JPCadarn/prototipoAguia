<?php
	require_once('conexao.php');

	class ContaService{
		public static function renderMinhaConta($dadosUsuario){
			switch($dadosUsuario['tipo']){
				case 'normal':
					self::renderMinhaContaUsuario($dadosUsuario);
					break;
				case 'admin':
					self::renderMinhaContaAdmin($dadosUsuario);
					break;
				case 'aguia':
					self::renderMinhaContaAguia($dadosUsuario);
					break;
				default:
					break;
			}
		}

		private static function renderMinhaContaUsuario($dadosUsuario){
			echo "<ul class='collapsible popout'>";
			echo "<li>";
			echo "<div class='collapsible-header'><i class='material-icons'>lock</i>Meus Dados</div>";
			self::renderFormMeusDados($dadosUsuario);
			echo "</li>";
			echo "</ul>";
		}

		private static function renderMinhaContaAdmin($dadosUsuario){
			echo "<ul class='collapsible popout'>";
			echo "<li>";
			echo "<div class='collapsible-header'><i class='material-icons'>lock</i>Meus Dados</div>";
			echo "<div class='collapsible-body'>";
			self::renderFormMeusDados($dadosUsuario, true);
			echo "</div>";
			echo "</li>";
			echo "<li>";
			echo "<div class='collapsible-header'><i class='material-icons'>people</i>Usuários</div>";
			echo "<div class='collapsible-body'>";
			self::renderUsuarios($dadosUsuario);
			echo "</div>";
			echo "</li>";
			echo "</ul>";
		}
		
		private static function renderMinhaContaAguia($dadosUsuario){
			echo "<ul class='collapsible popout'>";
			echo "<li class='active'>";
			echo "<div class='collapsible-header'><i class='material-icons'>lock</i>Meus Dados</div>";
			echo "<div class='collapsible-body'>";
			self::renderFormMeusDados($dadosUsuario, true);
			echo "</div>";
			echo "</li>";
			echo "<li>";
			echo "<div class='collapsible-header'><i class='material-icons'>attach_money</i>Clientes</div>";
			echo "<div class='collapsible-body'>";
			self::renderClientes();
			echo "</div>";
			echo "</li>";
			echo "<li>";
			echo "<div class='collapsible-header'><i class='material-icons'>people</i>Usuários</div>";
			echo "<div class='collapsible-body'>";
			self::renderUsuarios($dadosUsuario, true);
			echo "</div>";
			echo "</li>";
			echo "</ul>";
		}

		private static function renderFormMeusDados($dadosUsuario, $renderChave = false){
			echo "<div class='row'>";
			if($renderChave){
				echo "
					<div class='input-field col s12'>
						<input disabled id='chave' name='chave' type='text' value='".$dadosUsuario['chave']."'>
						<label for='chave'>Chave</label>
					</div>
				";
			}
			echo "<form action='editUsuario.php' method='POST'>";
			echo "<input type='hidden' name='id' id='id' value=".$dadosUsuario['id'].">";
			echo "
				<div class='input-field col s12'>
					<input id='nome' name='nome' type='text' value='".$dadosUsuario['nome']."'>
					<label for='nome'>Nome</label>
				</div>
			";
			echo "
				<div class='input-field col s12'>
					<input id='email' name='email' type='text' value='".$dadosUsuario['email']."'>
					<label for='email'>Email</label>
				</div>
			";
			echo "
				<div class='input-field col s12'>
					<input id='senha' name='senha' type='text'>
					<label for='senha'>Senha</label>
				</div>
			";
			echo "
				<div class='input-field col s12'>
					<input id='confirme_senha' type='text'>
					<label for='confirme_senha'>Confirme sua Senha</label>
				</div>
			";
			echo "<button id='btnSubmit' class='indigo darken-4 float-right waves-effect waves-circle waves-light btn-floating btn-large' disabled type='submit' value='Create'>";
			echo "<i class='large material-icons'>check</i>";
			echo "</button>";
			echo "</form>";
			echo "</div>";
		}
		
		private static function renderUsuarios($dadosUsuario, $buscarAdmins = false){
			$conexao = new Conexao();
			if($buscarAdmins){
				$usuarios = $conexao->executarQuery("SELECT * FROM usuarios WHERE chave = '".$dadosUsuario['chave']."' AND tipo != 'aguia'");
			}else{
				$usuarios = $conexao->executarQuery("SELECT * FROM usuarios WHERE chave = '".$dadosUsuario['chave']."' AND tipo = 'normal'");
			}
			echo "<div class='row'>";
			echo "<table class='striped centered responsive-table'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>ID Usuário</th>";
			echo "<th>Nome</th>";
			echo "<th>Email</th>";
			echo "<th>Tipo</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			foreach($usuarios as $usuario){
				echo "<tr>";
				echo "<td>".$usuario['id']."</td>";
				echo "<td>".$usuario['nome']."</td>";
				echo "<td>".$usuario['email']."</td>";
				echo "<td>".ucfirst($usuario['tipo'])."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
		}

		private static function renderClientes(){
			$conexao = new Conexao();
			$clientes = $conexao->executarQuery("SELECT * FROM clientes");
			echo "<div class='row'>";
			echo "<table class='striped centered responsive-table'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>ID</th>";
			echo "<th>Nome</th>";
			echo "<th>Data de Nascimento</th>";
			echo "<th>CPF/CNPJ</th>";
			echo "<th>Endereço</th>";
			echo "<th>Telefone</th>";
			echo "<th>Email</th>";
			echo "<th>Data Cadastro</th>";
			echo "<th>Data Atualização</th>";
			echo "<th>Chave</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			foreach($clientes as $cliente){
				echo "<tr>";
				echo "<td>".$cliente['id']."</td>";
				echo "<td>".$cliente['nome']."</td>";
				echo "<td>".Utils::formataData($cliente['data_nascimento'])."</td>";
				echo "<td>".Utils::formataCpfCnpj($cliente['cpf_cnpj'])."</td>";
				echo "<td>".$cliente['endereco']."</td>";
				echo "<td>".$cliente['telefone']."</td>";
				echo "<td>".$cliente['email']."</td>";
				echo "<td>".Utils::formataDateTime($cliente['datetime_cadastro'])."</td>";
				echo "<td>".Utils::formataDateTime($cliente['datetime_atualizacao'])."</td>";
				echo "<td>".$cliente['chave']."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
		}
	}
?>