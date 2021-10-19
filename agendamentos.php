<?php
	require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();
	$queryAgendamentos = '
		SELECT 
			a.*,
			p.nome AS ponte_nome
		FROM agendamentos a
		INNER JOIN pontes p ON a.ponte_id = p.id
	';
	$pontes = $conexao->executarQuery('SELECT id, nome FROM pontes');
	$agendamentos = $conexao->executarQuery($queryAgendamentos);
	$opcoesInspecao = [
		['id' => 'cadastral', 'tipo' => 'Cadastral'],
		['id' => 'rotineira', 'tipo' => 'Rotineira'],
		['id' => 'especial', 'tipo' => 'Especial'],
		['id' => 'extraordinaria', 'tipo' => 'Extraordinária']
	];
	echo '<!DOCTYPE html>';
	Utils::tagHead();
	echo '<body>';
	Utils::navBar();

	echo "
	<div class='fixed-action-btn'>
		<a data-target='modalCadastro' class='btn-large modal-trigger btn-floating waves-effect waves-light purple darken-4'>
			<i class='large material-icons'>add</i>
		</a>
	</div>";
	echo "<div id='modalCadastro' class='modal bottom-sheet'>";
	echo "<div class='modal-title'>";
	echo "<h4 class='center'>Adicionar Agendamento</h4>";
	echo "</div>";
	echo "<div class='modal-content'>";
	echo "<div class='row'>";
	echo "<form action='novoAgendamento.php' method='POST' class='col s12' autocomplete='off'>";
	Utils::renderSelect('ponte_id', $pontes, 'Ponte', 'Selecione a ponte', 'nome');
	echo "<div class='input-field col s6'>";
	echo "<input id='data' name='data' class='mask-date' type='text'>";
	echo "<label for='data'>Data do Agendamento</label>";
	echo "</div>";
	echo "<div class='input-field col s6'>";
	echo "<input id='horario' name='horario' type='text' class='mask-hora'>";
	echo "<label for='horario'>Horário do Agendamento</label>";
	echo "</div>";
	echo "<div class='input-field col s12'>";
	echo "<input id='detalhes' name='detalhes' type='text'>";
	echo "<label for='detalhes'>Detalhes do Agendamento</label>";
	Utils::renderSelect('tipo_inspecao', $opcoesInspecao, 'Tipo de Inspeção', 'Selecione o tipo de inspeção', 'tipo');
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
	echo "<div class='row'>";

	foreach($agendamentos as $agendamento){
		$imagem = $conexao->executarQuery('SELECT imagem FROM imagens_pontes WHERE ponte_id = '.$agendamento['ponte_id'].' ORDER BY id ASC LIMIT 1');
		if(isset($imagem[0]['imagem'])){
			$imagem = $imagem[0]['imagem'];
		}else{
			$imagem = '';
		}
		echo "
			<div class='col s12 m6'>
				<div class='card horizontal'>
					<div class='card-image'>
						<img src='assets/fotos/$imagem'>
						<span class='card-title'>Agendamento {$agendamento['id']} - {$agendamento['ponte_nome']}</span>
					</div>
					<div class='card-stacked'>
						<div class='card-content'>
							<p>" . Utils::formataData($agendamento['data']) . ' - '. $agendamento['horario']. "</p>
							<p>{$agendamento['detalhes']}</p>
						</div>
					</div>
				</div>
			</div>
		";
	}
	echo "</div>";

	Utils::scriptsJs();
	echo '</body>';
	echo '</html>';
?>