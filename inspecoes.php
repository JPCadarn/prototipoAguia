<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('InspecaoService.php');
	$conexao = new Conexao();
	$queryInspecoes = '
		SELECT 
			i.*,
			p.nome AS ponte_nome
		FROM inspecoes i
		INNER JOIN pontes p ON i.ponte_id = p.id
	';
	$agendamentos = $conexao->executarQuery('SELECT id, detalhes FROM agendamentos');
	$inspecoes = $conexao->executarQuery($queryInspecoes);
	echo '<!DOCTYPE html>';
	Utils::tagHead();
	echo '<body>';
	Utils::navBar();

	$pontes = $conexao->executarQuery('SELECT pontes.id, inspecoes.nome, inspecoes.descricao, inspecoes.id AS id_inspecao, inspecoes.status, inspecoes.data_inspecao FROM pontes INNER JOIN inspecoes ON pontes.id = inspecoes.ponte_id');
	if(count($pontes)){
		foreach($pontes as $ponte){
			$imagem = $conexao->executarQuery("SELECT imagem FROM imagens_pontes WHERE ponte_id = {$ponte['id']} ORDER BY id ASC LIMIT 1");
			if(isset($imagem[0]['imagem'])){
				$imagem = $imagem[0]['imagem'];
			}else{
				$imagem = '';
			}
			echo "<div class='row'>";
			echo "<div class='col s12 m4'>";
			echo "<div class='card medium'>";
			echo "<div class='card-image'>";
			echo "<img src='assets/fotos/$imagem'>";
			echo "</a>";
			echo "<span class='card-title'>{$ponte['nome']}</span>";
			echo "</div>";
			echo "<div class='card-content'>";
			if($ponte['status'] == 'Aberto'){
				echo "<a id='btnAvaliarInspecao{$ponte['id_inspecao']}' data-id='{$ponte['id_inspecao']}' data-target='modalAvaliar' data-position='bottom' data-tooltip='Avaliar' class='modal-trigger tooltipped btn-floating btn-large halfway-fab waves-effect waves-light purple darken-4'><i class='material-icons'>thumbs_up_down</i></a>";
			}elseif($ponte['status'] == 'Avaliado'){
				echo "<a data-position='bottom' href='inspecoesDetalhes.php?id={$ponte['id_inspecao']}'' data-tooltip='Detalhes' class='modal-trigger tooltipped btn-floating btn-large halfway-fab waves-effect waves-light purple darken-4'><i class='material-icons'>info_outline</i></a>";
			}
			echo "<p>{$ponte['descricao']}</p>";
			echo "<p>".Utils::formataData($ponte['data_inspecao'])."</p>";
			echo "<p>{$ponte['status']}</p>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
		
		}
	}else{
		echo "<h6 class='centralizar'>Nenhuma inspeção cadastrada";
	}
?>
	<div id="modalAvaliar" class="modal">
		<br>
		<br>
		<div class="modal-title">
			<h4 class="center">Avaliar Inspeção</h4>
		</div>
		<div id="formCadastro" class="modal-content">
			<div class="row">
				<form id="formulario" action="novaInspecao.php" method="POST" class="col s12" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" value="" name="id_inspecao" id="id_inspecao">
					<input type="hidden" value="Avaliado" name="status" id="status">
					<ul class="collapsible expandable popout">
						<li class="active">
							<div class="collapsible-header"><i class="material-icons">location_on</i>Identicação e Localização</div>
							<div class="collapsible-body">
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" id="via" name="via" />
										<label for="via">Via ou Municipio</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="" name="nome" />
										<label for="nome">Nome da OAE</label>
									</div>
									<div class="input-field col s12 m6">
										<input id="data_inspecao" name="data_inspecao" class="mask-date" type="text">
										<label for="data_inspecao">Data de Inspeçao</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="trem_tipo" name="trem_tipo" />
										<label for="trem_tipo">Trem-Tipo</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="sentido" name="sentido" />
										<label for="sentido">Sentido</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="localizacao" name="localizacao" />
										<label for="localizacao">Localização</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="latitude" name="latitude" />
										<label for="latitude">Latitude</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="longitude" name="longitude" />
										<label for="longitude">Longitude</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="projetista" name="projetista" />
										<label for="projetista">Projetista</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="construtor" name="construtor" />
										<label for="construtor">Construtor</label>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="collapsible-header"><i class="material-icons">build</i>Características da Estrutura</div>
							<div class="collapsible-body">
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" id="comprimento_estrutura" name="comprimento_estrutura" />
										<label for="comprimento_estrutura">Comprimento</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="largura_estrutura" name="largura_estrutura" />
										<label for="largura_estrutura">Largura</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="largura_acostamento" name="largura_acostamento" />
										<label for="largura_acostamento">Largura do Acostamento</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="largura_refugio" name="largura_refugio" />
										<label for="largura_refugio">Largura do Refúgio</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="largura_passeio" name="largura_passeio" />
										<label for="largura_passeio">Largura do Passeio</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="sistema_construtivo" name="sistema_construtivo" />
										<label for="sistema_construtivo">Sistema Construtivo</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="natureza_transposicao" name="natureza_transposicao" />
										<label for="natureza_transposicao">Natureza da Transposição</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="material_construcao" name="material_construcao" />
										<label for="material_construcao">Material</label>
									</div>
									<h5 class="center">Seção Tipo</h5>
									<div class="input-field col s4">
										<input type="text" id="longitudinal_super" name="longitudinal_super" />
										<label for="longitudinal_super">Longitudinal da superestrutura</label>
									</div>
									<div class="input-field col s4">
										<input type="text" id="transversal_super" name="transversal_super" />
										<label for="transversal_super">Transversal da superestrutura</label>
									</div>
									<div class="input-field col s4">
										<input type="text" id="mesoestrutura_tipo" name="mesoestrutura_tipo" />
										<label for="mesoestrutura_tipo">Mesoestrutura </label>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="collapsible-header"><i class="material-icons">landscape</i>Características Funcionais</div>
							<div class="collapsible-body">
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" id="caracteristicas_plani" name="caracteristicas_plani" />
										<label for="caracteristicas_plani">Características plani-altimétricas</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="nro_faixas" name="nro_faixas" />
										<label for="nro_faixas">Número de Faixas</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" id="acostamento" name="acostamento" />
										<label for="acostamento">Acostamento</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="refugios" name="refugios" />
										<label for="refugios">Refúgios</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" id="passeio" name="passeio" />
										<label for="passeio">Passeio</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="barreira_rigida" name="barreira_rigida" />
										<label for="barreira_rigida">Barreira rígida</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" id="material_pavimento" name="material_pavimento" />
										<label for="material_pavimento">Material do pavimento</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="pingadeiras" name="pingadeiras" />
										<label for="pingadeiras">Pingadeiras</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" id="guarda_corpo" name="guarda_corpo" />
										<label for="guarda_corpo">Guarda-Corpo</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" id="drenos" name="drenos" />
										<label for="drenos">Dreno</label>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="collapsible-header"><i class="material-icons">block</i>Registro de Anomalias</div>
							<div class="collapsible-body">
								<h5 class="center">Elementos Estruturais</h5>
									<div class="row">
										<div class="input-field col s12 m6">
											<input type="text" id="superestrutura" name="superestrutura" />
											<label for="superestrutura">Superestrutura</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="text" id="mesoestrutura" name="mesoestrutura" />
											<label for="mesoestrutura">Mesoestrutura</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="text" id="infraestrutura" name="infraestrutura" />
											<label for="infraestrutura">Infraestrutura</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="text" id="aparelhos_apoio_anomalia" name="aparelhos_apoio_anomalia" />
											<label for="aparelhos_apoio_anomalia">Aparelhos de apoio</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="text" id="juntas_dilatacao_anomalia" name="juntas_dilatacao_anomalia" />
											<label for="juntas_dilatacao_anomalia">Juntas de dilatação</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="text" id="encontros_anomalia" name="encontros_anomalia" />
											<label for="encontros_anomalia">Encontros</label>
										</div>
										<h5 class="center">Elementos da pista ou funcionais</h5>
										<div class="input-field col s12 m6">
											<input type="text" id="pavimento_anomalia" name="pavimento_anomalia" />
											<label for="pavimento_anomalia">Pavimento</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="text" id="acostamento_refugio_anomalia" name="acostamento_refugio_anomalia" />
											<label for="acostamento_refugio_anomalia">Acostamento e refúgio</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="text" id="drenagem_anomalia" name="drenagem_anomalia" />
											<label for="drenagem">Drenagem</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="text" id="guarda_corpo_anomalia" name="guarda_corpo_anomalia" />
											<label for="guarda_corpo_anomalia">Guarda-Corpo</label>
										</div>
										<div class="input-field col s12">
											<input type="text" id="barreira_defesa" name="barreira_defesa" />
											<label for="barreira_defesa">Barreiras concreto/defensa metálica</label>
										</div>
										<h5 class="center">Outros Elementos</h5>
										<div class="input-field col s12 m6">
											<input type="text" id="taludes" name="taludes" />
											<label for="taludes">Taludes</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="text" id="iluminacao" name="iluminacao" />
											<label for="iluminacao">Iluminação</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="text" id="sinalizacao" name="sinalizacao" />
											<label for="sinalizacao">Sinalização</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="text" id="protecao_pilares" name="protecao_pilares" />
											<label for="protecao_pilares">Proteção de pilares</label>
										</div>
									</div>
							</div>
						</li>
						<li>
							<div class="collapsible-header"><i class="material-icons">grade</i>Notas</div>
							<div class="collapsible-body">
								<?php
									Utils::renderSelectSemDiv('nota_indice_localizacao', InspecaoService::camposIndiceLocalizacao, 'Índice de Localização', 'Índice de Localização', 'descricao');
									Utils::renderSelectSemDiv('nota_indice_volume_trafego', InspecaoService::camposVolumeTrafego, 'Índice de Volume de Tráfego', 'Índice de Volume de Tráfego', 'descricao');
									Utils::renderSelectSemDiv('nota_indice_largura_oae', InspecaoService::camposLarguraOAE, 'Índice de Largura da OAE', 'Índice de Largura da OAE', 'descricao');
									echo "<h5 class='center'>Fator de Segurança</h5>";
									Utils::renderSelectSemDiv('nota_geometria_condicoes', InspecaoService::camposFsPesoAlto, 'Geometria e condições várias', 'Geometria e condições várias', 'descricao');
									Utils::renderSelectSemDiv('nota_acessos', InspecaoService::camposFsPesoMedio, 'Acessos', 'Acessos', 'descricao');
									Utils::renderSelectSemDiv('nota_cursos_agua', InspecaoService::camposFsPesoMedio, 'Cursos d\'água', 'Cursos d\'água', 'descricao');
									Utils::renderSelectSemDiv('nota_encontros_fundacoes', InspecaoService::camposFsPesoAlto, 'Encontros e fundações', 'Encontros e fundações', 'descricao');
									Utils::renderSelectSemDiv('nota_apoios_intermediarios', InspecaoService::camposFsPesoAlto, 'Apoios intermediários', 'Apoios intermediários', 'descricao');
									Utils::renderSelectSemDiv('nota_aparelhos_apoio', InspecaoService::camposFsPesoAlto, 'Aparelhos de apoio', 'Aparelhos de apoio', 'descricao');
									Utils::renderSelectSemDiv('nota_superestrutura', InspecaoService::camposFsPesoAlto, 'Superestrutura', 'Superestrutura', 'descricao');
									Utils::renderSelectSemDiv('nota_pista_rolamento', InspecaoService::camposFsPesoMedio, 'Pista de rolamento', 'Pista de rolamento', 'descricao');
									Utils::renderSelectSemDiv('nota_juntas_dilatacao', InspecaoService::camposFsPesoMedio, 'Juntas de dilatação', 'Juntas de dilatação', 'descricao');
									Utils::renderSelectSemDiv('nota_barreiras_guardacorpos', InspecaoService::camposFsPesoBaixo, 'Barreiras e guarda-corpos', 'Barreiras e guarda-corpos', 'descricao');
									Utils::renderSelectSemDiv('nota_sinalizacao', InspecaoService::camposFsPesoBaixo, 'Sinalização', 'Sinalização', 'descricao');
									Utils::renderSelectSemDiv('nota_instalacoes_util_publica', InspecaoService::camposFsPesoBaixo, 'Instalações de utilidade pública', 'Instalações de utilidade pública', 'descricao');
									echo "<h5 class='center'>Fator de Conservação </h5>";
									Utils::renderSelectSemDiv('nota_largura_plataforma', InspecaoService::camposFcLargura, 'Largura da plataforma', 'Largura da plataforma', 'descricao');
									Utils::renderSelectSemDiv('nota_capacidade_carga', InspecaoService::camposFcCarga, 'Capacidade de carga', 'Capacidade de carga', 'descricao');
									Utils::renderSelectSemDiv('nota_superficie_plataforma', InspecaoService::camposFcSuperficie, 'Superfície da plataforma', 'Superfície da plataforma', 'descricao');
									Utils::renderSelectSemDiv('nota_pista_rolamento_fc', InspecaoService::camposFcPistaRolamento, 'Pista de rolamento', 'Pista de rolamento', 'descricao');
									Utils::renderSelectSemDiv('nota_outros_fc', InspecaoService::camposFcOutros, 'Outros', 'Outros', 'descricao');
									echo "<h5 class='center'>Fator de Impacto </h5>";
									Utils::renderSelectSemDiv('nota_espaco_livre', InspecaoService::camposFiEspacoLivre, 'Espaço livre', 'Espaço livre', 'descricao');
									Utils::renderSelectSemDiv('nota_localizacao_ponte', InspecaoService::camposFiLocal, 'Localização da Ponte', 'Localização da Ponte', 'descricao');
									Utils::renderSelectSemDiv('nota_saude_fisica_ponte', InspecaoService::camposFiSaude, 'Saúde física da ponte', 'Saúde física da ponte', 'descricao');
									Utils::renderSelectSemDiv('nota_outros_fi', InspecaoService::camposFiOutros, 'Outros', 'Outros', 'descricao');
								?>
							</div>
						</li>
						<li>
							<div class="collapsible-header"><i class="material-icons">photo_camera</i>Imagens</div>
							<div class="collapsible-body">
								<div class="row">
									<div class="file-field input-field">
										<div class="btn purple darken-4">
											<span>Imagens</span>
											<input name="images[]" required type="file" multiple accept="image/*">
										</div>
										<div class="file-path-wrapper">
											<input class="file-path validate" type="text" placeholder="Anexe aqui as imagens da inspeção">
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
					<button class="modal-close waves-effect waves-circle waves-light btn-floating btn-large purple darken-4 float-right" type="submit" value="Create">
						<i class="large material-icons">check</i>
					</button>
				</form>
			</div>
		</div>
	</div>

		<!--JavaScript at end of body for optimized loading-->
		<script type="text/javascript" src="assets/js/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script>
		<script type="text/javascript" src="assets/js/main.js"></script>
		<script type="text/javascript" src="assets/js/inspecoes.js"></script>
	</body>
</html>