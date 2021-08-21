<?php
	require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();
	$queryInspecoes = '
		SELECT 
			i.*,
			p.nome AS ponte_nome
		FROM inspecoes p
		INNER JOIN pontes p ON i.ponte_id = p.id
	';
	$agendamentos = $conexao->executarQuery('SELECT id, detalhes FROM agendamentos');
	$inspecoes = $conexao->executarQuery($queryInspecoes);
	echo '<!DOCTYPE html>';
	Utils::tagHead();
	echo '<body>';
	Utils::navBar();

	$pontes = $conexao->executarQuery('SELECT pontes.id, pontes.nome, pontes.descricao FROM pontes INNER JOIN inspecoes ON pontes.id = inspecoes.ponte_id');
	$pontesSelect = $conexao->executarQuery('SELECT pontes.id, pontes.nome, pontes.descricao FROM pontes');
	if(count($pontes)){
		foreach($pontes as $ponte){
			$imagem = $conexao->executarQuery("SELECT imagem FROM imagens_pontes WHERE ponte_id = {$ponte['id']} ORDER BY id ASC LIMIT 1");
			if(isset($imagem[0]['imagem'])){
				$imagem = $imagem[0]['imagem'];
			}else{
				$imagem = '';
			}
			echo "
				<div class='row'>
					<div class='col s12 m4'>
							<div class='card'>
								<div class='card-image'>
								<a href='ponteDetalhes.php?id={$ponte['id']}'>
									<img src='assets/fotos/$imagem'>
								</a>
								<span class='card-title'>{$ponte['nome']}</span>
							</div>
							<div class='card-content'>
								<p>{$ponte['descricao']}</p>
							</div>
						</div>
					</div>
				</div>
			";
		}
	}else{
		echo "<h6 class='centralizar'>Nenhuma inspeção cadastrada";
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
			<h4 class="center">Adicionar Inspeção</h4>
		</div>
		<div id="formCadastro" class="modal-content">
			<div class="row">
				<form id="formulario" action="novaInspecao.php" method="POST" class="col s12" enctype="multipart/form-data" autocomplete="off">
					<div class="input-field col s12">
						<select id="tipo_inspecao" name="tipo_inspecao">
							<option value='' disabled selected>Tipo de Inspeção</option>
							<option value="cadastral">Inspeção Cadastral</option>
							<option value="rotineira">Inspeção Rotineira</option>
							<option value="especial">Inspeção Especial</option>
							<option value="extraordinaria">Inspeção Extraordinaria</option>
						</select>
					</div>
					<?php
						Utils::renderSelect('ponte_id', $pontesSelect, 'Ponte', 'Selecione a ponte', 'nome');
					?>
					<ul class="collapsible expandable">
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
										<input id="data_construcao" name="data_construcao" type="date">
										<label for="data_construcao">Data de Construção</label>
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
									$camposIndiceLocalizacao = [
										['id' => 40, 'descricao' => 'Centro Urbano'],
										['id' => 35, 'descricao' => 'Rodovia Federal'],
										['id' => 25, 'descricao' => 'Rodovia Estadual'],
										['id' => 15, 'descricao' => 'Área Urbana Municipal'],
										['id' => 5, 'descricao' => 'Área Rural Municipal']
									];
									Utils::renderSelectSemDiv('nota_indice_localizacao', $camposIndiceLocalizacao, 'Índice de Localização', 'Índice de Localização', 'descricao');
									$camposVolumeTrafego = [
										['id' => 40, 'descricao' => 'Muito alto, com muitos engarrafamentos'],
										['id' => 35, 'descricao' => 'Alto, com poucos engarrafamentos'],
										['id' => 25, 'descricao' => 'Moderado, com ou sem engarrafamento'],
										['id' => 15, 'descricao' => 'Baixo, sem engarrafamento'],
										['id' => 5, 'descricao' => 'Muito baixo, sem engarrafamento']
									];
									Utils::renderSelectSemDiv('nota_indice_volume_trafego', $camposVolumeTrafego, 'Índice de Volume de Tráfego', 'Índice de Volume de Tráfego', 'descricao');
									$camposLarguraOAE = [
										['id' => 20, 'descricao' => 'Muito larga (maior que 17m) '],
										['id' => 15, 'descricao' => 'Larga (14-17m)'],
										['id' => 10, 'descricao' => 'Média (10-14m)'],
										['id' => 6, 'descricao' => 'Estreita (6,5-10m)'],
										['id' => 3, 'descricao' => 'Muito estreita (menos que 6,5m)']
									];
									Utils::renderSelectSemDiv('nota_indice_largura_oae', $camposLarguraOAE, 'Índice de Largura da OAE', 'Índice de Largura da OAE', 'descricao');
									echo "<h5 class='center'>Fator de Segurança</h5>";
									$camposFsPesoAlto = [
										['id' => 5, 'descricao' => 'Precária'],
										['id' => 3.75, 'descricao' => 'Sofrível'],
										['id' => 2.5, 'descricao' => 'Boa aparentemente'],
										['id' => 1.25, 'descricao' => 'Boa'],
										['id' => 0, 'descricao' => 'Muito boa']
									];
									$camposFsPesoMedio = [
										['id' => 4, 'descricao' => 'Precária'],
										['id' => 3, 'descricao' => 'Sofrível'],
										['id' => 2, 'descricao' => 'Boa aparentemente'],
										['id' => 1, 'descricao' => 'Boa'],
										['id' => 0, 'descricao' => 'Muito boa']
									];
									$camposFsPesoBaixo = [
										['id' => 3, 'descricao' => 'Precária'],
										['id' => 2.25, 'descricao' => 'Sofrível'],
										['id' => 1.5, 'descricao' => 'Boa aparentemente'],
										['id' => 0.75, 'descricao' => 'Boa'],
										['id' => 0, 'descricao' => 'Muito boa']
									];
									Utils::renderSelectSemDiv('nota_geometria_condicoes', $camposFsPesoAlto, 'Geometria e condições várias', 'Geometria e condições várias', 'descricao');
									Utils::renderSelectSemDiv('nota_acessos', $camposFsPesoMedio, 'Acessos', 'Acessos', 'descricao');
									Utils::renderSelectSemDiv('nota_cursos_agua', $camposFsPesoMedio, 'Cursos d\'água', 'Cursos d\'água', 'descricao');
									Utils::renderSelectSemDiv('nota_encontros_fundacoes', $camposFsPesoAlto, 'Encontros e fundações', 'Encontros e fundações', 'descricao');
									Utils::renderSelectSemDiv('nota_apoios_intermediarios', $camposFsPesoAlto, 'Apoios intermediários', 'Apoios intermediários', 'descricao');
									Utils::renderSelectSemDiv('nota_aparelhos_apoio', $camposFsPesoAlto, 'Aparelhos de apoio', 'Aparelhos de apoio', 'descricao');
									Utils::renderSelectSemDiv('nota_superestrutura', $camposFsPesoAlto, 'Superestrutura', 'Superestrutura', 'descricao');
									Utils::renderSelectSemDiv('nota_pista_rolamento', $camposFsPesoMedio, 'Pista de rolamento', 'Pista de rolamento', 'descricao');
									Utils::renderSelectSemDiv('nota_juntas_dilatacao', $camposFsPesoMedio, 'Juntas de dilatação', 'Juntas de dilatação', 'descricao');
									Utils::renderSelectSemDiv('nota_barreiras_guardacorpos', $camposFsPesoBaixo, 'Barreiras e guarda-corpos', 'Barreiras e guarda-corpos', 'descricao');
									Utils::renderSelectSemDiv('nota_sinalizacao', $camposFsPesoBaixo, 'Sinalização', 'Sinalização', 'descricao');
									Utils::renderSelectSemDiv('nota_instalacoes_util_publica', $camposFsPesoBaixo, 'Instalações de utilidade pública', 'Instalações de utilidade pública', 'descricao');
									echo "<h5 class='center'>Fator de Conservação </h5>";
									$camposFcLargura = [
										['id' => 10, 'descricao' => 'Muito larga (acima de 17 m)'],
										['id' => 8, 'descricao' => 'Larga (14-17 m)'],
										['id' => 6, 'descricao' => 'Média (10-14 m)'],
										['id' => 4, 'descricao' => 'Estreita (7-10 m)'],
										['id' => 2, 'descricao' => 'Muito estreita (abaixo de 7 m)']
									];
									$camposFcCarga = [
										['id' => 10, 'descricao' => 'Muito alta (maior que 30 toneladas)'],
										['id' => 8, 'descricao' => 'Alta (25-30 toneladas)'],
										['id' => 6, 'descricao' => 'Média (18-25 toneladas)'],
										['id' => 4, 'descricao' => 'Baixa (13-18 toneladas)'],
										['id' => 2, 'descricao' => 'Muito baixa (menor que 13 toneladas)']
									];
									$camposFcSuperficie = [
										['id' => 10, 'descricao' => 'Nota 1'],
										['id' => 8, 'descricao' => 'Nota 2'],
										['id' => 6, 'descricao' => 'Nota 3'],
										['id' => 4, 'descricao' => 'Nota 4'],
										['id' => 2, 'descricao' => 'Nota 5']
									];
									$camposFcPistaRolamento = [
										['id' => 5, 'descricao' => 'Está em pior estado que as pistas de acesso à ponte'],
										['id' => 3, 'descricao' => 'Está no mesmo estado que as pistas de acesso à ponte'],
										['id' => 1, 'descricao' => 'Está em melhor estado que as pistas de acesso à ponte']
									];
									$camposFcOutros = [
										['id' => 5, 'descricao' => 'Vida útil remanescente baixa'],
										['id' => 3, 'descricao' => 'Vida útil remanescente média'],
										['id' => 1, 'descricao' => 'Vida útil remanescente alta']
									];
									Utils::renderSelectSemDiv('nota_largura_plataforma', $camposFcLargura, 'Largura da plataforma', 'Largura da plataforma', 'descricao');
									Utils::renderSelectSemDiv('nota_capacidade_carga', $camposFcCarga, 'Capacidade de carga', 'Capacidade de carga', 'descricao');
									Utils::renderSelectSemDiv('nota_superficie_plataforma', $camposFcSuperficie, 'Superfície da plataforma', 'Superfície da plataforma', 'descricao');
									Utils::renderSelectSemDiv('nota_pista_rolamento_fc', $camposFcPistaRolamento, 'Pista de rolamento', 'Pista de rolamento', 'descricao');
									Utils::renderSelectSemDiv('nota_outros_fc', $camposFcOutros, 'Outros', 'Outros', 'descricao');
									echo "<h5 class='center'>Fator de Impacto </h5>";
									$camposFiEspacoLivre = [
										['id' => 5, 'descricao' => 'Frequentemente inviabiliza a passagem de navios'],
										['id' => 3, 'descricao' => 'Inviabiliza a passagem de navios algumas vezes'],
										['id' => 1, 'descricao' => 'Não inviabiliza a passagem de navios'],
									];
									$camposFiLocal = [
										['id' => 3, 'descricao' => 'Centro urbano'],
										['id' => 2.4, 'descricao' => 'Rodovia Federal'],
										['id' => 1.8, 'descricao' => 'Rodovia Estadual'],
										['id' => 1.2, 'descricao' => 'Área urbana municipal'],
										['id' => 0.6, 'descricao' => 'Área rural municipal']
									];
									$camposFiSaude = [
										['id' => 1, 'descricao' => 'Nota 1'],
										['id' => 0.8, 'descricao' => 'Nota 2'],
										['id' => 0.6, 'descricao' => 'Nota 3'],
										['id' => 0.4, 'descricao' => 'Nota 4'],
										['id' => 0.2, 'descricao' => 'Nota 5']
									];
									$camposFiOutros = [
										['id' => 1, 'descricao' => 'Alto impacto em terceiros'],
										['id' => 0.6, 'descricao' => 'Impacto moderado em terceiros'],
										['id' => 0.2, 'descricao' => 'Baixo impacto em terceiros']
									];
									Utils::renderSelectSemDiv('nota_espaco_livre', $camposFiEspacoLivre, 'Espaço livre', 'Espaço livre', 'descricao');
									Utils::renderSelectSemDiv('nota_localizacao_ponte', $camposFiLocal, 'Localização da Ponte', 'Localização da Ponte', 'descricao');
									Utils::renderSelectSemDiv('nota_saude_fisica_ponte', $camposFiSaude, 'Saúde física da ponte', 'Saúde física da ponte', 'descricao');
									Utils::renderSelectSemDiv('nota_outros_fi', $camposFiOutros, 'Outros', 'Outros', 'descricao');
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
	</body>
</html>