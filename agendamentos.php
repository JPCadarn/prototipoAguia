<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('SessionService.php');
	require_once('AgendamentoService.php');

	SessionService::validarLoginFeito();
	$conexao = new Conexao();
	$queryAgendamentos = '
		SELECT 
			a.*,
			p.nome AS ponte_nome
		FROM agendamentos a
		INNER JOIN pontes p ON a.ponte_id = p.id
		LEFT JOIN usuarios ON p.id_usuario = usuarios.id 
		LEFT JOIN clientes ON usuarios.id_cliente = clientes.id
		WHERE clientes.id = '.SessionService::getIdCliente();
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
		<a data-target='modalCadastro' class='indigo darken-4 btn-large modal-trigger btn-floating waves-effect waves-light'>
			<i class='large material-icons'>add</i>
		</a>
	</div>";
	echo "<div id='modalCadastro' class='modal'>";
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
	echo "<button class='indigo darken-4 float-right waves-effect waves-circle waves-light btn-floating btn-large' type='submit' value='Create'>";
	echo "<i class='large material-icons'>check</i>";
	echo "</button>";
	echo "</div>";
	echo "</form>";
	echo "</div>";
	echo "</div>";
	echo "</div>";

	$agendamentosAgrupados = Utils::agruparArrayPorChave($agendamentos, 'ponte_id');
	
	if(count($agendamentos)){
		echo "<div class='container'>";
			foreach($agendamentosAgrupados as $groupAgendamento){
				echo "<ul class='collapsible expandable popout'>";
					echo "<li>";
						echo "<div class='collapsible-header'>".$groupAgendamento[0]['ponte_nome']." - ".$groupAgendamento[0]['id']."</div>";
						echo "<div class='collapsible-body'>"; 
						AgendamentoService::renderCardsAgendamentoAgrupado($groupAgendamento);
						echo "</div>";
					echo "</li>";
				echo "</ul>";
			}
		echo "</div>";
	}else{
		echo "<h6>Nenhum agendamento cadastrado</h6>";
	}

	Utils::scriptsJs();
	echo '</body>';
	echo '</html>';
?>