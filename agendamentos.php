<?php
	require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();
	$utils = new Utils();
	$queryAgendamentos = '
		SELECT 
			a.*,
			p.nome AS ponte_nome
		FROM agendamentos a
		INNER JOIN pontes p
	';
	$pontes = $conexao->executarQuery('SELECT id, nome FROM pontes');
	$agendamentos = $conexao->executarQuery($queryAgendamentos);
	echo '<!DOCTYPE html>';
	$utils->tagHead();
	echo '<body>';
	$utils->renderNavBar();

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
	echo "{$utils->renderSelect('ponte_id', $pontes, 'Ponte', 'Selecione a ponte', 'nome')}";
	echo "<div class='input-field col s6'>";
	echo "<input id='data' name='data' type='text' class='datepicker'>";
	echo "<label for='data'>Data do Agendamento</label>";
	echo "</div>";
	echo "<div class='input-field col s6'>";
	echo "<input id='horario' name='horario' type='text' class='timepicker'>";
	echo "<label for='horario'>Horário do Agendamento</label>";
	echo "</div>";
	echo "<div class='input-field col s12'>";
	echo "<input id='detalhes' name='detalhes' type='text'>";
	echo "<label for='detalhes'>Detalhes do Agendamento</label>";
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
						<a data-position='bottom' href='agendamentosDelete.php?id={$agendamento['id']}' data-tooltip='Excluir' class='tooltipped btn-floating btn-large halfway-fab waves-effect waves-light purple darken-4'><i class='material-icons'>delete</i></a>
					</div>
					<div class='card-stacked'>
						<div class='card-content'>
							<p>{$utils->formataData($agendamento['data'])} - {$agendamento['horario']}</p>
							<p>{$agendamento['detalhes']}</p>
						</div>
					</div>
				</div>
			</div>
		";
	}
	echo "</div>";

	$utils->scriptsJs();
	echo '</body>';
	echo '</html>';
?>