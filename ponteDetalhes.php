<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('InspecaoService.php');
	require_once('SessionService.php');
	require_once('Cidades.php');

	SessionService::validarLoginFeitoEVisitante();
	$conexao = new Conexao();
	if(!isset($_GET['id']) || $_GET['id'] == ''){
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}else{
		$dados = $conexao->executarQuery('SELECT * FROM pontes WHERE id = '.$_GET['id'])[0];
		$imagens = $conexao->executarQuery("SELECT imagem FROM imagens_pontes WHERE ponte_id = {$_GET['id']}");
		$agendamentos = $conexao->executarQuery("SELECT * FROM agendamentos WHERE ponte_id = {$_GET['id']}");
		$inspecoes = $conexao->executarQuery("SELECT inspecoes.*, usuarios.nome FROM inspecoes INNER JOIN usuarios ON inspecoes.id_usuario = usuarios.id WHERE ponte_id = {$_GET['id']}");
		$opcoesInspecao = [
			['id' => 'cadastral', 'tipo' => 'Cadastral'],
			['id' => 'rotineira', 'tipo' => 'Rotineira'],
			['id' => 'especial', 'tipo' => 'Especial'],
			['id' => 'extraordinaria', 'tipo' => 'Extraordinária']
		];
		$ReflectionClass = new ReflectionClass(Cidades::class);
		$constantes = $ReflectionClass->getConstants();
		$cidades = $constantes['CIDADES_'.strtoupper($dados['estado'])];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			Utils::tagHead();
		?>
	</head>
	<body>
		<?php
			Utils::navBar();
		?>
		
		<div class="row">
			<h3>Ficha de Inspeção Cadastral - <?php echo $dados['nome']?></h3>
			<ul class="collapsible popout">
				<li class="active">
					<div class="collapsible-header"><i class="material-icons">place</i>Identificação e Localização</div>
				  	<div class="collapsible-body">
						<p><span class="negrito">Via ou municípo: </span><span><?php echo $dados['via'];?></span></p>
						<p><span class="negrito">Nome da OAE: </span><span><?php echo $dados['nome'];?></span></p>
						<p><span class="negrito">Município: </span><span><?php echo $cidades[$dados['cidade']]['nome'];?></span></p>
						<p><span class="negrito">Ano de construção (ou época aprox.): </span><span><?php echo implode('/', array_reverse(explode('-', $dados['data_construcao'])));?></span></p>
						<p><span class="negrito">Trem-tipo: </span><span><?php echo $dados['trem_tipo'];?></span></p>
						<p><span class="negrito">Sentido: </span><span><?php echo $dados['sentido'];?></span></p>
						<p><span class="negrito">Localização (km ou endereço): </span><span><?php echo $dados['localizacao'];?></span></p>
						<p><span class="negrito">Coord. Geo. (long./lat.): </span><span><?php echo $dados['longitude'].' | '.$dados['latitude']?></span></p>
						<p><span class="negrito">Projetista: </span><span><?php echo $dados['projetista'];?></span></p>
						<p><span class="negrito">Construtor: </span><span><?php echo $dados['construtor'];?></span></p>
					</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">place</i>Características da Estrutura</div>
					<div class="collapsible-body">
						<p><span class="negrito">Comprimento total (m): </span><span><?php echo $dados['comprimento_estrutura'];?></span></p>
						<p><span class="negrito">Largura da faixa (m): </span><span><?php echo $dados['largura_estrutura'];?></span></p>
						<p><span class="negrito">Largura do acostamento (m): </span><span><?php echo $dados['largura_acostamento'];?></span></p>
						<p><span class="negrito">Largura do refúgio (m): </span><span><?php echo $dados['largura_refugio'];?></span></p>
						<p><span class="negrito">Largura do passeio (m): </span><span><?php echo $dados['largura_passeio'];?></span></p>
						<p><span class="negrito">Sistema Construtivo (Tabela A.3 - NBR 9452) (ver Tabela A3): </span><span><?php echo $dados['sistema_construtivo'];?></span></p>
						<p><span class="negrito">Natureza de Transposição (Tabela A.4 - NBR 9452) (ver Tabela A4): </span><span><?php echo $dados['natureza_transposicao'];?></span></p>
						<p><span class="negrito">Material (ver Tabela A5): </span><span><?php echo $dados['material_construcao'];?></span></p>
						<h6 class="centralizar">Secão tipo</h6>
						<p><span class="negrito">Transversal da superestrutura (ver Tabela A2): </span><span><?php echo $dados['longitudinal_super'];?></span></p>
						<p><span class="negrito">Transversal da superestrutura (ver Tabela A2): </span><span><?php echo $dados['transversal_super'];?></span></p>
						<p><span class="negrito">Mesoestrutura (Tabela A.2 - NBR 9452) (ver Tabela A2): </span><span><?php echo $dados['mesoestrutura_tipo'];?></span></p>
						<h6 class="centralizar">Características Particulares</h6>
						<p><span class="negrito">Número de vãos: </span><span><?php echo $dados['nro_vaos'];?></span></p>
						<p><span class="negrito">Número de apoios: </span><span><?php echo $dados['nro_apoios'];?></span></p>
						<p><span class="negrito">Número de pilares por apoio: </span><span><?php echo $dados['nro_pilares_apoio'];?></span></p>
						<p><span class="negrito">Aparelhos de apoio (quantidade de tipo): </span><span><?php echo $dados['aparelhos_apoio'];?></span></p>
						<p><span class="negrito">Comprimento do vão típico (m): </span><span><?php echo $dados['comprimento_vao_tipico'];?></span></p>
						<p><span class="negrito">Comprimento do maior vão (m): </span><span><?php echo $dados['comprimento_maior_vao'];?></span></p>
						<p><span class="negrito">Altura dos pilares (m): </span><span><?php echo $dados['altura_pilares'];?></span></p>
						<p><span class="negrito">Juntas de dilatação (quantidade e tipo): </span><span><?php echo $dados['juntas_dilatacao'];?></span></p>
						<p><span class="negrito">Encontros: </span><span><?php echo $dados['encontros'];?></span></p>
						<p><span class="negrito">Outras peculiaridades: </span><span><?php echo $dados['outras'];?></span></p>
					</div>
				</li>
				<li>
				  	<div class="collapsible-header"><i class="material-icons">whatshot</i>Características Funcionais</div>
				  	<div class="collapsible-body">
						<p><span class="negrito">Características plani-altimétricas: </span><span><?php echo $dados['caracteristicas_plani']?></span></p>
						<p><span class="negrito">Número de faixas: </span><span><?php echo $dados['nro_faixas'];?></span></p>
						<p><span class="negrito">Acostamento: </span><span><?php echo $dados['acostamento'];?></span></p>
						<p><span class="negrito">Refúgios: </span><span><?php echo $dados['refugios'];?></span></p>
						<p><span class="negrito">Passeio: </span><span><?php echo $dados['passeio'];?></span></p>
						<p><span class="negrito">Barreira rígida: </span><span><?php echo $dados['barreira_rigida'];?></span></p>
						<p><span class="negrito">Material do pavimento: </span><span><?php echo $dados['material_pavimento'];?></span></p>
						<p><span class="negrito">Pingadeiras: </span><span><?php echo $dados['pingadeiras'];?></span></p>
						<p><span class="negrito">Guarda-corpo: </span><span><?php echo $dados['guarda_corpo'];?></span></p>
						<p><span class="negrito">Drenos: </span><span><?php echo $dados['drenos'];?></span></p>
						<p><span class="negrito">Frequencia passagem carga especial: </span><span><?php echo $dados['freq_passagem_carga'];?></span></p>
					</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">whatshot</i>Registro de Anomalias</div>
					<div class="collapsible-body">
						<h6 class="centralizar">Elementos estruturais</h6>
						<p><span class="negrito">Superestrutura: </span><span><?php echo $dados['superestrutura'];?></span></p>
						<p><span class="negrito">Mesoestrutura (Tabela A.2 - NBR 9452): </span><span><?php echo $dados['mesoestrutura'];?></span></p>
						<p><span class="negrito">Infraestrutura (Tabela A.2 - NBR 9452): </span><span><?php echo $dados['infraestrutura'];?></span></p>
						<p><span class="negrito">Aparelhos de apoio: </span><span><?php echo $dados['aparelhos_apoio_anomalia'];?></span></p>
						<p><span class="negrito">Juntas de dilatação: </span><span><?php echo $dados['juntas_dilatacao_anomalia'];?></span></p>
						<p><span class="negrito">Encontros: </span><span><?php echo $dados['encontros_anomalia'];?></span></p>
						<h6 class="centralizar">Elementos da pista ou funcionais</h6>
						<p><span class="negrito">Pavimento: </span><span><?php echo $dados['pavimento_anomalia'];?></span></p>
						<p><span class="negrito">Acostamento e refúgio: </span><span><?php echo $dados['acostamento_refugio_anomalia'];?></span></p>
						<p><span class="negrito">Drenagem: </span><span><?php echo $dados['drenagem_anomalia'];?></span></p>
						<p><span class="negrito">Guarda-corpo: </span><span><?php echo $dados['guarda_corpo_anomalia'];?></span></p>
						<p><span class="negrito">Barreiras concreto/defensa metálica: </span><span><?php echo $dados['barreira_defesa'];?></span></p>
						<h6 class="centralizar">Outros elementos: </h6>
						<p><span class="negrito">Taludes: </span><span><?php echo $dados['taludes'];?></span></p>
						<p><span class="negrito">Iluminação: </span><span><?php echo $dados['iluminacao'];?></span></p>
						<p><span class="negrito">Sinalização: </span><span><?php echo $dados['sinalizacao'];?></span></p>
						<p><span class="negrito">Proteção de pilares: </span><span><?php echo $dados['protecao_pilares'];?></span></p>
				  </div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">av_timer</i>Agendamentos</div>
				  	<div class="collapsible-body centralizar">
						<?php
							foreach($agendamentos as $agendamento){
							?>
								<p>
									<span class="negrito">ID: </span><span><?php echo $agendamento['id'];?></span>
									<span class="negrito">Data: </span><span><?php echo implode('/', array_reverse(explode('-', $agendamento['data'])));?></span>
									<span class="negrito">Horário: </span><span><?php echo $agendamento['horario'];?></span>
									<span class="negrito">Detalhes: </span><span><?php echo $agendamento['detalhes'];?></span>
								</p>
							<?php
							}
						?>
						
					</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">av_timer</i>Inspeções</div>
				  	<div class="collapsible-body centralizar">
						<?php
							foreach($inspecoes as $inspecao){
							?>
								<p>
									<span class="negrito">ID: </span><span><?php echo $inspecao['id'];?></span>
									<span class="negrito">Usuário: </span><span><?php echo $inspecao['nome'];?></span>
									<span class="negrito">Data: </span><span><?php echo implode('/', array_reverse(explode('-', $inspecao['data_inspecao'])));?></span>
									<span class="negrito">Tipo: </span><span><?php echo InspecaoService::tipos[$inspecao['tipo_inspecao']];?></span>
									<span class="negrito">Descrição: </span><span><?php echo $inspecao['descricao'];?></span>
								</p>
							<?php
							}
						?>
						
					</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">photo</i>Imagens</div>
					<div class="collapsible-body">
						<div class="slider">
							<ul class="slides">
								<?php
									foreach($imagens as $imagem){
										echo "<li><img class='materialboxed' src='assets/fotos/{$imagem['imagem']}'></li>";
									}
								?>
							</ul>
						</div>
				  </div>
				</li>
			</ul>
		</div>
		
		<div class="fixed-action-btn">
			<a data-target="modalAgendamento" class="indigo darken-4 btn-large modal-trigger btn-floating waves-effect waves-light">
				<i class="large material-icons">av_timer</i>
			</a>
		</div>

		<?php
		echo "<div id='modalAgendamento' class='modal'>";
		echo "<div class='modal-title'>";
		echo "<h4 class='center'>Adicionar Agendamento</h4>";
		echo "</div>";
		echo "<div class='modal-content'>";
		echo "<div class='row'>";
		echo "<form action='novoAgendamento.php' method='POST' class='col s12' autocomplete='off'>";
		echo "<input id='ponte_id' name='ponte_id' type='hidden' value='".$dados['id']."'>";
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
		echo "<button class='indigo darken-4 float-right  waves-effect waves-circle waves-light btn-floating btn-large' type='submit' value='Create'>";
		echo "<i class='large material-icons'>check</i>";
		echo "</button>";
		echo "</div>";
		echo "</form>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
		echo "<div class='row'>";
		Utils::scriptsJs();
		?>
	</body>
</html>