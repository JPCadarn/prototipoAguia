<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('SessionService.php');
	require_once('Cidades.php');
	
	SessionService::validarLoginFeito();
	$conexao = new Conexao();
?>

<!DOCTYPE html>
<html>
	<?php
		Utils::tagHead();
	?>
	<body>
		<?php
			Utils::navBar();
			echo "<div class='row'>";
			$pontes = $conexao->executarQuery('SELECT pontes.id, pontes.nome, pontes.descricao, pontes.resumo, pontes.id_usuario FROM pontes LEFT JOIN usuarios ON pontes.id_usuario = usuarios.id LEFT JOIN clientes ON usuarios.id_cliente = clientes.id WHERE clientes.id = '.SessionService::getIdCliente());
			if(count($pontes)){
				foreach($pontes as $ponte){
					$imagem = $conexao->executarQuery("SELECT imagem FROM imagens_pontes WHERE ponte_id = {$ponte['id']} ORDER BY id ASC LIMIT 1");
					if(isset($imagem[0]['imagem'])){
						$imagem = $imagem[0]['imagem'];
					}else{
						$imagem = '';
					}
					echo "
							<div class='col s12 m3'>
								<div class='card medium'>
									<div class='card-image'>
										<img src='assets/fotos/$imagem'>
									</div>
									<div>
										<div class='card-content'>
											<span class='card-title'>{$ponte['nome']}</span>
											<p>".str_replace(PHP_EOL, '<br>', $ponte['resumo'])."</p>
										</div>
										<div class='card-action center'>
											<a href='ponteDetalhes.php?id={$ponte['id']}'><i class='material-icons tooltipped indigo-text text-darken-4' data-position='bottom' data-tooltip='Detalhes'>info</i></a>
											<a target='_blank' href='pontesRelatorio.php?id={$ponte['id']}'><i class='material-icons tooltipped indigo-text text-darken-4' data-position='bottom' data-tooltip='Relatório'>print</i></a>
										</div>
									</div>
								</div>
							</div>
					";
				}
			}else{
				echo "<h6 class='centralizar'>Nenhuma ponte cadastrada";
			}
		?>
		</div>

		<div class="fixed-action-btn">
  			<a data-target="modalCadastro" class="indigo darken-4 btn-large modal-trigger btn-floating waves-effect waves-light">
    			<i class="large material-icons">add</i>
  			</a>
		</div>

		<div id="modalCadastro" class="modal">
			<div class="modal-title">
				<h4 class="center">Ficha de Inspeção Cadastral</h4>
			</div>
			<div class="modal-content">
				<div class="row">
					<form action="novaPonte.php" id="formCadastroOAE" method="POST" class="col s12" enctype="multipart/form-data" autocomplete="off">
						<ul class="collapsible expandable popout">
							<li class="active">
								<div class="collapsible-header"><i class="material-icons">location_on</i>Identicação e Localização</div>
								<div class="collapsible-body">
									<div class="row">
										<div class="input-field col s12 m6">
											<input id="via" name="via" type="text" required>
											<label for="via">Via ou Municipio</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="nome" name="nome" type="text" required>
											<label for="nome">Nome da OAE</label>
										</div>
										<?php
											Utils::renderSelect('estado', Cidades::ESTADOS, 'Estado', 'Selecione o estado da OAE', 'nome', 's12 m6');
											echo "<div id='div_cidades' class='input-field col s12 m6'>";
											echo "<select disabled id='cidade' name='cidade'>";
											echo "<option value='' disabled selected>Selecione a cidade da OAE</option>";
											echo "</select>";
											echo "<label>Cidade</label>";
											echo "</div>";
											$ReflectionClass = new ReflectionClass(Cidades::class);
											$constantes = $ReflectionClass->getConstants();
											unset($constantes['ESTADOS']);
											ksort($constantes);
											foreach($constantes as $estado => $cidades){
												Utils::renderSelectNameIdDiferentesOculto($estado, 'cidade', $cidades, 'Cidade', 'Selecione a cidade da OAE', 'nome', 's21 m6');
											}
										?>
										<div class="input-field col s12 m6">
											<input id="data_construcao" name="data_construcao" class="mask-date" type="text">
											<label for="data_construcao">Data de Inauguração</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="trem_tipo" name="trem_tipo" type="text">
											<label for="trem_tipo">Trem-Tipo</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="sentido" name="sentido" type="text">
											<label for="sentido">Sentido</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="localizacao" name="localizacao" type="text">
											<label for="localizacao">Localização</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="latitude" name="latitude" type="text" class="mask-coord validate" required pattern="\d\dº\s\d\d\&lsquo;\s\d\d&quot;\s[A-Z]">
											<label for="latitude">Latitude</label>
											<span class="helper-text" data-error="As coordenadas precisam seguir o padrão 00º 00' 00&quot; A"></span>
										</div>
										<div class="input-field col s12 m6">
											<input id="longitude" name="longitude" type="text" class="mask-coord validate" required pattern="\d\dº\s\d\d\&lsquo;\s\d\d&quot;\s[A-Z]">
											<label for="longitude">Longitude</label>
											<span class="helper-text" data-error="As coordenadas precisam seguir o padrão 00º 00' 00&quot; A"></span>
										</div>
										<div class="input-field col s12 m6">
											<input id="projetista" name="projetista" type="text">
											<label for="projetista">Projetista</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="construtor" name="construtor" type="text">
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
											<input id="comprimento_estrutura" name="comprimento_estrutura" class="mask-decimal" type="text">
											<label for="comprimento_estrutura">Comprimento (metros)</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="largura_estrutura" name="largura_estrutura" class="mask-decimal" type="text">
											<label for="largura_estrutura">Largura (metros)</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="largura_acostamento" name="largura_acostamento" class="mask-decimal" type="text">
											<label for="largura_acostamento">Largura do Acostamento (metros)</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="largura_refugio" name="largura_refugio" class="mask-decimal" type="text">
											<label for="largura_refugio">Largura do Refúgio (metros)</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="largura_passeio" name="largura_passeio" class="mask-decimal" type="text">
											<label for="largura_passeio">Largura do Passeio (metros)</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="sistema_construtivo" name="sistema_construtivo" type="text">
											<label for="sistema_construtivo">Sistema Construtivo (Tabela A.3 - NBR 9452)</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="natureza_transposicao" name="natureza_transposicao" type="text">
											<label for="natureza_transposicao">Natureza de Transposição (Tabela A.4 - NBR 9452)</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="material_construcao" name="material_construcao" type="text">
											<label for="material_construcao">Material (Tabela A.5 - NBR 9452)</label>
										</div>
										<h5 class="center">Seção Tipo <i class='tiny material-icons tooltipped' data-position='bottom' data-tooltip='Favor anexar as imagens correspondentes na seção Imagens'>info</i></h5>
										<div class="input-field col s12 m6">
											<input id="longitudinal_super" name="longitudinal_super" type="text">
											<label for="longitudinal_super">Longitudinal da superestrutura</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="transversal_super" name="transversal_super" type="text">
											<label for="transversal_super">Transversal da superestrutura</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="mesoestrutura_tipo" name="mesoestrutura_tipo" type="text">
											<label for="mesoestrutura_tipo">Mesoestrutura (Tabela A.2 - NBR 9452) </label>
										</div>
										<div class="input-field col s12 m6">
											<input id="infraestrutura" name="infraestrutura" type="text">
											<label for="infraestrutura">Infraestrutura (Tabela A.2 - NBR 9452)</label>
										</div>
										<h5 class="center">Características Particulares</h5>
										<div class="input-field col s12 m6">
											<input id="nro_vaos" name="nro_vaos" type="number">
											<label for="nro_vaos">Número de Vãos</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="nro_apoios" name="nro_apoios" type="number">
											<label for="nro_apoios">Número de Apoios</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="nro_pilares_apoio" name="nro_pilares_apoio" type="number">
											<label for="nro_pilares_apoio">Número de Pilares por Apoio</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="aparelhos_apoio" name="aparelhos_apoio" type="text">
											<label for="aparelhos_apoio">Aparelhos de Apoio</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="comprimento_vao_tipico" name="comprimento_vao_tipico" class="mask-decimal" type="text">
											<label for="comprimento_vao_tipico">Comprimento do vão típico (metros)</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="comprimento_maior_vao" name="comprimento_maior_vao" class="mask-decimal" type="text">
											<label for="comprimento_maior_vao">Comprimento do maior vão (metros)</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="altura_pilares" name="altura_pilares" class="mask-decimal" type="text">
											<label for="altura_pilares">Altura dos pilares (metros)</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="juntas_dilatacao" name="juntas_dilatacao" type="text">
											<label for="juntas_dilatacao">Juntas de dilatação</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="encontros" name="encontros" type="text">
											<label for="encontros">Encontros</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="descricao" name="descricao" type="text">
											<label for="descricao">Outras Características</label>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="collapsible-header"><i class="material-icons">landscape</i>Características Funcionais</div>
								<div class="collapsible-body">
									<div class="row">
										<div class="input-field col s12 m6">
											<input id="caracteristicas_plani" name="caracteristicas_plani" type="text">
											<label for="caracteristicas_plani">Características plani-altimétricas</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="nro_faixas" name="nro_faixas" type="number">
											<label for="nro_faixas">Número de Faixas</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="acostamento" name="acostamento" type="text">
											<label for="acostamento">Acostamento</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="refugios" name="refugios" type="text">
											<label for="refugios">Refúgios</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="passeio" name="passeio" type="text">
											<label for="passeio">Passeio</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="barreira_rigida" name="barreira_rigida" type="text">
											<label for="barreira_rigida">Barreira rígida</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="material_pavimento" name="material_pavimento" type="text">
											<label for="material_pavimento">Material do pavimento</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="pingadeiras" name="pingadeiras" type="text">
											<label for="pingadeiras">Pingadeiras</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="guarda_corpo" name="guarda_corpo" type="text">
											<label for="guarda_corpo">Guarda-Corpo</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="drenos" name="drenos" type="text">
											<label for="drenos">Dreno</label>
										</div>
										<div class="input-field col s12">
											<input id="freq_passagem_carga" name="freq_passagem_carga" type="text">
											<label for="freq_passagem_carga">Frequencia passagem carga especial</label>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="collapsible-header"><i class="material-icons">block</i>Registro de Anomalias</div>
								<div class="collapsible-body">
									<div class="row">
										<h5 class="center">Elementos Estruturais</h5>
										<div class="input-field col s12">
											<textarea class="materialize-textarea" id="superestrutura" name="superestrutura" type="text"></textarea>
											<label for="superestrutura">Superestrutura</label>
										</div>
										<div class="input-field col s12">
											<textarea class="materialize-textarea" id="mesoestrutura" name="mesoestrutura" type="text"></textarea>
											<label for="mesoestrutura">Mesoestrutura (Tabela A.2 - NBR 9452)</label>
										</div>
										<div class="input-field col s12">
											<textarea class="materialize-textarea" id="infraestrutura_anomalia" name="infraestrutura_anomalia" type="text"></textarea>
											<label for="infraestrutura_anomalia">Infraestrutura</label>
										</div>
										<div class="input-field col s12">
											<textarea class="materialize-textarea" id="aparelhos_apoio_anomalia" name="aparelhos_apoio_anomalia" type="text"></textarea>
											<label for="aparelhos_apoio_anomalia">Aparelhos de apoio</label>
										</div>
										<div class="input-field col s12">
											<textarea class="materialize-textarea" id="juntas_dilatacao_anomalia" name="juntas_dilatacao_anomalia" type="text"></textarea>
											<label for="juntas_dilatacao_anomalia">Juntas de dilatação</label>
										</div>
										<div class="input-field col s12">
											<textarea class="materialize-textarea" id="encontros_anomalia" name="encontros_anomalia" type="text"></textarea>
											<label for="encontros_anomalia">Encontros</label>
										</div>
										<h5 class="center">Elementos da pista ou funcionais</h5>
										<div class="input-field col s12 m6">
											<input id="pavimento_anomalia" name="pavimento_anomalia" type="text">
											<label for="pavimento_anomalia">Pavimento</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="acostamento_refugio_anomalia" name="acostamento_refugio_anomalia" type="text">
											<label for="acostamento_refugio_anomalia">Acostamento e refúgio</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="drenagem_anomalia" name="drenagem_anomalia" type="text">
											<label for="drenagem">Drenagem</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="guarda_corpo_anomalia" name="guarda_corpo_anomalia" type="text">
											<label for="guarda_corpo_anomalia">Guarda-Corpo</label>
										</div>
										<div class="input-field col s12">
											<input id="barreira_defesa" name="barreira_defesa" type="text">
											<label for="barreira_defesa">Barreiras concreto/defensa metálica</label>
										</div>
										<h5 class="center">Outros Elementos</h5>
										<div class="input-field col s12 m6">
											<input id="taludes" name="taludes" type="text">
											<label for="taludes">Taludes</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="iluminacao" name="iluminacao" type="text">
											<label for="iluminacao">Iluminação</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="sinalizacao" name="sinalizacao" type="text">
											<label for="sinalizacao">Sinalização</label>
										</div>
										<div class="input-field col s12 m6">
											<input id="protecao_pilares" name="protecao_pilares" type="text">
											<label for="protecao_pilares">Proteção de pilares</label>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="collapsible-header"><i class="material-icons">photo_camera</i>Imagens</div>
								<div class="collapsible-body">
									<div class="row">
										<div class="file-field input-field">
											<div class="btn indigo darken-4">
												<span>Imagens</span>
												<input name="images[]" required type="file" multiple accept="image/*" required="" aria-required="true">
											</div>
											<div class="file-path-wrapper">
												<input class="file-path validate" type="text" placeholder="Anexe aqui as imagens da ponte">
											</div>
										</div>
										<div class="input-field col s12">
											<textarea class="materialize-textarea" id="resumo" name="resumo" type="text" required></textarea>
											<label for="resumo">Resumo da situação e recomendações</label>
										</div>
									</div>
								</div>
							</li>
						</ul>
						<button class="indigo darken-4 float-right  waves-effect waves-circle waves-light btn-floating btn-large" type="submit" value="Create">
							<i class="large material-icons">check</i>
						</button>
					</form>
				</div>
			</div>
		</div>
		
		<?php
		Utils::scriptsJs();
		?>
		<script type='text/javascript' src='assets/js/cidades.js'></script>
	</body>
</html>