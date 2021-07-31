<?php
	require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();
	$utils = new Utils();
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
	$utils->tagHead();
	echo '<body>';
	$utils->navBar();

	$pontes = $conexao->executarQuery('SELECT id, nome, descricao FROM pontes WHERE inspecao_id IS NOT NULL');
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
							<div class="collapsible-header"><i class="material-icons">photo_camera</i>Imagens</div>
							<div class="collapsible-body">
								
							</div>
						</li>
					</ul>
					<div class="fixed-action-btn">
						<div class="fixed-action-btn">
							<button class="modal-close waves-effect waves-circle waves-light btn-floating btn-large purple darken-4" type="submit" value="Create">
								<i class="large material-icons">check</i>
							</button>
						</div>
					</div>
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