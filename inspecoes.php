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
		<div class="modal-title">
			<h4 class="center">Adicionar inspeção</h4>
		</div>
		<div id="formCadastro" class="modal-content">
			<div class="row">
				<form id="formulario" action="novaInspecao.php" method="POST" class="col s12" enctype="multipart/form-data" autocomplete="off">
					<?php
						echo "{$utils->renderSelect('inspecao_id', $agendamentos, 'Agendamento', 'Selecione o agendamento', 'detalhes')}";
					?>
					<div class="col s12">
						<ul class="tabs">
							<li class="tab col s12 m2"><a class="purple-text text-darken-4" href="#formIdentificacao">Identicação e Localização</a></li>
							<li class="tab col s12 m2"><a class="purple-text text-darken-4" href="#formEstrutura">Características da Estrutura</a></li>
							<li class="tab col s12 m2"><a class="purple-text text-darken-4" href="#formFuncionais">Características Funcionais</a></li>
							<li class="tab col s12 m2"><a class="purple-text text-darken-4" href="#formAnomalias">Registro de Anomalias</a></li>
							<li class="tab col s12 m2"><a class="purple-text text-darken-4" href="#formImagens">Imagens</a></li>
						</ul>
					</div>
					<div id="formIdentificacao" class="col s12">
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field">
									<input type="range" min="1" max="5" value="3" id="via" name="via" />
								</p>
								<label for="via">Via ou Municipio</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="" name="nome" /></p>
								<label for="nome">Nome da OAE</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="data_construcao" name="data_construcao" type="text" class="datepicker">
								<label for="data_construcao">Data de Construção</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="trem_tipo" name="trem_tipo" /></p>
								<label for="trem_tipo">Trem-Tipo</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="sentido" name="sentido" /></p>
								<label for="sentido">Sentido</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="localizacao" name="localizacao" /></p>
								<label for="localizacao">Localização</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="latitude" name="latitude" /></p>
								<label for="latitude">Latitude</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="longitude" name="longitude" /></p>
								<label for="longitude">Longitude</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="projetista" name="projetista" /></p>
								<label for="projetista">Projetista</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="construtor" name="construtor" /></p>
								<label for="construtor">Construtor</label>
							</div>
						</div>
					</div>
					<div id="formEstrutura" class="col s12">
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="comprimento_estrutura" name="comprimento_estrutura" /></p>
								<label for="comprimento_estrutura">Comprimento</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="largura_estrutura" name="largura_estrutura" /></p>
								<label for="largura_estrutura">Largura</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="largura_acostamento" name="largura_acostamento" /></p>
								<label for="largura_acostamento">Largura do Acostamento</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="largura_refugio" name="largura_refugio" /></p>
								<label for="largura_refugio">Largura do Refúgio</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="largura_passeio" name="largura_passeio" /></p>
								<label for="largura_passeio">Largura do Passeio</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="sistema_construtivo" name="sistema_construtivo" /></p>
								<label for="sistema_construtivo">Sistema Construtivo</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="natureza_transposicao" name="natureza_transposicao" /></p>
								<label for="natureza_transposicao">Natureza da Transposição</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="material_construcao" name="material_construcao" /></p>
								<label for="material_construcao">Material</label>
							</div>
						</div>
						<h5 class="center">Seção Tipo</h5>
						<div class="row">
							<div class="input-field col s4">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="longitudinal_super" name="longitudinal_super" /></p>
								<label for="longitudinal_super">Longitudinal da superestrutura</label>
							</div>
							<div class="input-field col s4">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="transversal_super" name="transversal_super" /></p>
								<label for="transversal_super">Transversal da superestrutura</label>
							</div>
							<div class="input-field col s4">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="mesoestrutura_tipo" name="mesoestrutura_tipo" /></p>
								<label for="mesoestrutura_tipo">Mesoestrutura </label>
							</div>
						</div>
					</div>
					<div id="formFuncionais" class="col s12">
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="caracteristicas_plani" name="caracteristicas_plani" /></p>
								<label for="caracteristicas_plani">Características plani-altimétricas</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="nro_faixas" name="nro_faixas" /></p>
								<label for="nro_faixas">Número de Faixas</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="acostamento" name="acostamento" /></p>
								<label for="acostamento">Acostamento</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="refugios" name="refugios" /></p>
								<label for="refugios">Refúgios</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="passeio" name="passeio" /></p>
								<label for="passeio">Passeio</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="barreira_rigida" name="barreira_rigida" /></p>
								<label for="barreira_rigida">Barreira rígida</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="material_pavimento" name="material_pavimento" /></p>
								<label for="material_pavimento">Material do pavimento</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="pingadeiras" name="pingadeiras" /></p>
								<label for="pingadeiras">Pingadeiras</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="guarda_corpo" name="guarda_corpo" /></p>
								<label for="guarda_corpo">Guarda-Corpo</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="drenos" name="drenos" /></p>
								<label for="drenos">Dreno</label>
							</div>
						</div>
					</div>
					<div id="formAnomalias" class="col s12">
						<h5 class="center">Elementos Estruturas</h5>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="superestrutura" name="superestrutura" /></p>
								<label for="superestrutura">Superestrutura</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="mesoestrutura" name="mesoestrutura" /></p>
								<label for="mesoestrutura">Mesoestrutura</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="infraestrutura" name="infraestrutura" /></p>
								<label for="infraestrutura">Infraestrutura</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="aparelhos_apoio_anomalia" name="aparelhos_apoio_anomalia" /></p>
								<label for="aparelhos_apoio_anomalia">Aparelhos de apoio</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="juntas_dilatacao_anomalia" name="juntas_dilatacao_anomalia" /></p>
								<label for="juntas_dilatacao_anomalia">Juntas de dilatação</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="encontros_anomalia" name="encontros_anomalia" /></p>
								<label for="encontros_anomalia">Encontros</label>
							</div>
						</div>
						<h5 class="center">Elementos da pista ou funcionais</h5>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="pavimento_anomalia" name="pavimento_anomalia" /></p>
								<label for="pavimento_anomalia">Pavimento</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="acostamento_refugio_anomalia" name="acostamento_refugio_anomalia" /></p>
								<label for="acostamento_refugio_anomalia">Acostamento e refúgio</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="drenagem_anomalia" name="drenagem_anomalia" /></p>
								<label for="drenagem">Drenagem</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="guarda_corpo_anomalia" name="guarda_corpo_anomalia" /></p>
								<label for="guarda_corpo_anomalia">Guarda-Corpo</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="barreira_defesa" name="barreira_defesa" /></p>
								<label for="barreira_defesa">Barreiras concreto/defensa metálica</label>
							</div>
						</div>
						<h5 class="center">Outros Elementos</h5>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="taludes" name="taludes" /></p>
								<label for="taludes">Taludes</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="iluminacao" name="iluminacao" /></p>
								<label for="iluminacao">Iluminação</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="sinalizacao" name="sinalizacao" /></p>
								<label for="sinalizacao">Sinalização</label>
							</div>
							<div class="input-field col s12 m6">
								<p class="range-field"><input type="range" min="1" max="5" value="3" id="protecao_pilares" name="protecao_pilares" /></p>
								<label for="protecao_pilares">Proteção de pilares</label>
							</div>
						</div>
					</div>
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