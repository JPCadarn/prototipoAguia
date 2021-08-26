<?php
	require_once('conexao.php');

	class UsuariosService{
		public static function renderUsuarios($dadosUsuario){
			$conexao = new Conexao();
			$usuarios = $conexao->executarQuery("SELECT * FROM usuarios WHERE chave = '".$dadosUsuario['chave']."' AND tipo = 'normal'");
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
			echo "<div class='row'>";
			Utils::mostraMensagemErro();
			echo "</div>";
			echo "<div id='modalCadastro' class='modal'>";
			echo "<br>";
			echo "<br>";
			echo "<div class='modal-title'>";
			echo "<h4 class='center'>Cadastro de Usuários</h4>";
			echo "</div>";
			echo "<div class='modal-content'>";
			echo "<div class='row'>";
			echo "<form action='novoUsuario.php' method='POST' class='col s12' autocomplete='off'>";
			echo "<div class='row'>";
			echo "<div class='input-field col s12 m6'>";
			echo "<input id='nome' name='nome' type='text'>";
			echo "<label for='nome'>Nome</label>";
			echo "</div>";
			echo "<div class='input-field col s12 m6'>";
			echo "<input id='senha' name='senha' type='password'>";
			echo "<label for='senha'>Senha</label>";
			echo "</div>";
			echo "<div class='input-field col s12 m6'>";
			echo "<input id='email' name='email' type='email'>";
			echo "<label for='email'>Email</label>";
			echo "</div>";
			echo "<div class='input-field col s12 m6'>";
			echo "<input id='chave' name='chave' type='text'>";
			echo "<label for='chave'>Chave</label>";
			echo "</div>";
			echo "<div class='fixed-action-btn'>";
			echo "<div class='fixed-action-btn'>";
			echo "<button class='modal-close waves-effect waves-circle waves-light btn-floating btn-large purple darken-4' type='submit' value='Create'>";
			echo "<i class='large material-icons'>check</i>";
			echo "</button>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</form>";
			echo "</div>";
			echo "</div>";
			echo "</div>";

			echo "
				<div class='fixed-action-btn'>
					<a data-target='modalCadastro' class='btn-large modal-trigger btn-floating waves-effect waves-light purple darken-4'>
						<i class='large material-icons'>add</i>
					</a>
				</div>";
		}
	}
?>