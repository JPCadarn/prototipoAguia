<?php
	require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();
?>

<!DOCTYPE html>
<html>
	<head>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="assets/materialize/css/materialize.min.css"  media="screen,projection"/>
		<link rel="stylesheet" href="assets/css/main.css">
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body>
		<?php
			Utils::navBar();
		?>

		<?php
			$ponte = $conexao->executarQuery('SELECT * FROM pontes WHERE id ='.$_GET['id'])[0];
		?>
		<div class="title">
			<h4 class="center">Alterar Ponte - <?php echo $ponte['nome'] ?></h4>
		</div>
		<div class="modal-content">
			<div class="row">
				<form action="updatePonte.php" method="POST" class="col s12" enctype="multipart/form-data" autocomplete="off">
					<div class="col s12">
						<ul class="tabs center">
							<li class="tab col s12 m2"><a class="purple-text text-darken-4" href="#formIdentificacao">Identicação e Localização</a></li>
							<li class="tab col s12 m2"><a class="purple-text text-darken-4" href="#formEstrutura">Características da Estrutura</a></li>
							<li class="tab col s12 m2"><a class="purple-text text-darken-4" href="#formFuncionais">Características Funcionais</a></li>
							<li class="tab col s12 m2"><a class="purple-text text-darken-4" href="#formAnomalias">Registro de Anomalias</a></li>
						</ul>
					</div>
					<div id="formIdentificacao" class="col s12">
						<div class="row">
							<input id="via" name="id" type="hidden" value=<?php echo $ponte['id'];?>>
							<div class="input-field col s12 m6">
								<input id="via" name="via" type="text" value=<?php echo $ponte['via'];?>>
								<label for="via">Via ou Municipio</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="nome" name="nome" type="text" value=<?php echo $ponte['nome'];?>>
								<label for="nome">Nome da OAE</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="data_construcao" name="data_construcao" class="mask-date" type="text" value=<?php echo Utils::formataData($ponte['data_construcao']);?>>
								<label for="data_construcao">Data de Construção</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="trem_tipo" name="trem_tipo" type="text" value=<?php echo $ponte['trem_tipo'];?>>
								<label for="trem_tipo">Trem-Tipo</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="sentido" name="sentido" type="text" value=<?php echo $ponte['sentido'];?>>
								<label for="sentido">Sentido</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="localizacao" name="localizacao" type="text" value=<?php echo $ponte['localizacao'];?>>
								<label for="localizacao">Localização</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="latitude" name="latitude" type="text" value=<?php echo $ponte['latitude'];?>>
								<label for="latitude">Latitude</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="longitude" name="longitude" type="text" value=<?php echo $ponte['longitude'];?>>
								<label for="longitude">Longitude</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="projetista" name="projetista" type="text" value=<?php echo $ponte['projetista'];?>>
								<label for="projetista">Projetista</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="construtor" name="construtor" type="text" value=<?php echo $ponte['construtor'];?>>
								<label for="construtor">Construtor</label>
							</div>
						</div>
					</div>
					<div id="formEstrutura" class="col s12">
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="comprimento_estrutura" name="comprimento_estrutura" type="text" value=<?php echo $ponte['comprimento_estrutura'];?>>
								<label for="comprimento_estrutura">Comprimento</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="largura_estrutura" name="largura_estrutura" type="text" value=<?php echo $ponte['largura_estrutura'];?>>
								<label for="largura_estrutura">Largura</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="largura_acostamento" name="largura_acostamento" type="text" value=<?php echo $ponte['largura_acostamento'];?>>
								<label for="largura_acostamento">Largura do Acostamento</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="largura_refugio" name="largura_refugio" type="text" value=<?php echo $ponte['largura_refugio'];?>>
								<label for="largura_refugio">Largura do Refúgio</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="largura_passeio" name="largura_passeio" type="text" value=<?php echo $ponte['largura_passeio'];?>>
								<label for="largura_passeio">Largura do Passeio</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="sistema_construtivo" name="sistema_construtivo" type="text" value=<?php echo $ponte['sistema_construtivo'];?>>
								<label for="sistema_construtivo">Sistema Construtivo</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="natureza_transposicao" name="natureza_transposicao" type="text" value=<?php echo $ponte['natureza_transposicao'];?>>
								<label for="natureza_transposicao">Natureza da Transposição</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="material_construcao" name="material_construcao" type="text" value=<?php echo $ponte['material_construcao'];?>>
								<label for="material_construcao">Material</label>
							</div>
						</div>
						<h5 class="center">Seção Tipo</h5>
						<div class="row">
							<div class="input-field col s4">
								<input id="longitudinal_super" name="longitudinal_super" type="text" value=<?php echo $ponte['longitudinal_super'];?>>
								<label for="longitudinal_super">Longitudinal da superestrutura</label>
							</div>
							<div class="input-field col s4">
								<input id="transversal_super" name="transversal_super" type="text" value=<?php echo $ponte['transversal_super'];?>>
								<label for="transversal_super">Transversal da superestrutura</label>
							</div>
							<div class="input-field col s4">
								<input id="mesoestrutura_tipo" name="mesoestrutura_tipo" type="text" value=<?php echo $ponte['mesoestrutura_tipo'];?>>
								<label for="mesoestrutura_tipo">Mesoestrutura </label>
							</div>
						</div>
						<h5 class="center">Características Particulares</h5>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="nro_vaos" name="nro_vaos" type="text" value=<?php echo $ponte['nro_vaos'];?>>
								<label for="nro_vaos">Número de Vãos</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="nro_apoios" name="nro_apoios" type="text" value=<?php echo $ponte['nro_apoios'];?>>
								<label for="nro_apoios">Número de Apoios</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="nro_pilares_apoio" name="nro_pilares_apoio" type="text" value=<?php echo $ponte['nro_pilares_apoio'];?>>
								<label for="nro_pilares_apoio">Número de Pilares por Apoio</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="aparelhos_apoio" name="aparelhos_apoio" type="text" value=<?php echo $ponte['aparelhos_apoio'];?>>
								<label for="aparelhos_apoio">Aparelhos de Apoio</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="comprimento_vao_tipico" name="comprimento_vao_tipico" type="text" value=<?php echo $ponte['comprimento_vao_tipico'];?>>
								<label for="comprimento_vao_tipico">Comprimento do vão típico</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="comprimento_maior_vao" name="comprimento_maior_vao" type="text" value=<?php echo $ponte['comprimento_maior_vao'];?>>
								<label for="comprimento_maior_vao">Comprimento do maior vão</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="altura_pilares" name="altura_pilares" type="text" value=<?php echo $ponte['altura_pilares'];?>>
								<label for="altura_pilares">Altura dos pilares</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="juntas_dilatacao" name="juntas_dilatacao" type="text" value=<?php echo $ponte['juntas_dilatacao'];?>>
								<label for="juntas_dilatacao">Juntas de dilatação</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="encontros" name="encontros" type="text" value=<?php echo $ponte['encontros'];?>>
								<label for="encontros">Encontros</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="descricao" name="descricao" type="text" value=<?php echo $ponte['descricao'];?>>
								<label for="descricao">Outras Características</label>
							</div>
						</div>
					</div>
					<div id="formFuncionais" class="col s12">
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="caracteristicas_plani" name="caracteristicas_plani" type="text" value=<?php echo $ponte['caracteristicas_plani'];?>>
								<label for="caracteristicas_plani">Características plani-altimétricas</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="nro_faixas" name="nro_faixas" type="text" value=<?php echo $ponte['nro_faixas'];?>>
								<label for="nro_faixas">Número de Faixas</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="acostamento" name="acostamento" type="text" value=<?php echo $ponte['acostamento'];?>>
								<label for="acostamento">Acostamento</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="refugios" name="refugios" type="text" value=<?php echo $ponte['refugios'];?>>
								<label for="refugios">Refúgios</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="passeio" name="passeio" type="text" value=<?php echo $ponte['passeio'];?>>
								<label for="passeio">Passeio</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="barreira_rigida" name="barreira_rigida" type="text" value=<?php echo $ponte['barreira_rigida'];?>>
								<label for="barreira_rigida">Barreira rígida</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="material_pavimento" name="material_pavimento" type="text" value=<?php echo $ponte['material_pavimento'];?>>
								<label for="material_pavimento">Material do pavimento</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="pingadeiras" name="pingadeiras" type="text" value=<?php echo $ponte['pingadeiras'];?>>
								<label for="pingadeiras">Pingadeiras</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="guarda_corpo" name="guarda_corpo" type="text" value=<?php echo $ponte['guarda_corpo'];?>>
								<label for="guarda_corpo">Guarda-Corpo</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="drenos" name="drenos" type="text" value=<?php echo $ponte['drenos'];?>>
								<label for="drenos">Dreno</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="freq_passagem_carga" name="freq_passagem_carga" type="text" value=<?php echo $ponte['freq_passagem_carga'];?>>
								<label for="freq_passagem_carga">Frequência passagem carga especial</label>
							</div>
						</div>
					</div>
					<div id="formAnomalias" class="col s12">
						<h5 class="center">Elementos Estruturas</h5>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="superestrutura" name="superestrutura" type="text" value=<?php echo $ponte['superestrutura'];?>>
								<label for="superestrutura">Superestrutura</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="mesoestrutura" name="mesoestrutura" type="text" value=<?php echo $ponte['mesoestrutura'];?>>
								<label for="mesoestrutura">Mesoestrutura</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="infraestrutura" name="infraestrutura" type="text" value=<?php echo $ponte['infraestrutura'];?>>
								<label for="infraestrutura">Infraestrutura</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="aparelhos_apoio_anomalia" name="aparelhos_apoio_anomalia" type="text" value=<?php echo $ponte['aparelhos_apoio_anomalia'];?>>
								<label for="aparelhos_apoio_anomalia">Aparelhos de apoio</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="juntas_dilatacao_anomalia" name="juntas_dilatacao_anomalia" type="text" value=<?php echo $ponte['juntas_dilatacao_anomalia'];?>>
								<label for="juntas_dilatacao_anomalia">Juntas de dilatação</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="encontros_anomalia" name="encontros_anomalia" type="text" value=<?php echo $ponte['encontros_anomalia'];?>>
								<label for="encontros_anomalia">Encontros</label>
							</div>
						</div>
						<h5 class="center">Elementos da pista ou funcionais</h5>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="pavimento_anomalia" name="pavimento_anomalia" type="text" value=<?php echo $ponte['pavimento_anomalia'];?>>
								<label for="pavimento_anomalia">Pavimento</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="acostamento_refugio_anomalia" name="acostamento_refugio_anomalia" type="text" value=<?php echo $ponte['acostamento_refugio_anomalia'];?>>
								<label for="acostamento_refugio_anomalia">Acostamento e refúgio</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="drenagem_anomalia" name="drenagem_anomalia" type="text" value=<?php echo $ponte['drenagem_anomalia'];?>>
								<label for="drenagem">Drenagem</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="guarda_corpo_anomalia" name="guarda_corpo_anomalia" type="text" value=<?php echo $ponte['guarda_corpo_anomalia'];?>>
								<label for="guarda_corpo_anomalia">Guarda-Corpo</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="barreira_defesa" name="barreira_defesa" type="text" value=<?php echo $ponte['barreira_defesa'];?>>
								<label for="barreira_defesa">Barreiras concreto/defensa metálica</label>
							</div>
						</div>
						<h5 class="center">Outros Elementos</h5>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="taludes" name="taludes" type="text" value=<?php echo $ponte['taludes'];?>>
								<label for="taludes">Taludes</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="iluminacao" name="iluminacao" type="text" value=<?php echo $ponte['iluminacao'];?>>
								<label for="iluminacao">Iluminação</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="sinalizacao" name="sinalizacao" type="text" value=<?php echo $ponte['sinalizacao'];?>>
								<label for="sinalizacao">Sinalização</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="protecao_pilares" name="protecao_pilares" type="text" value=<?php echo $ponte['protecao_pilares'];?>>
								<label for="protecao_pilares">Proteção de pilares</label>
							</div>
						</div>
					</div>
					<button class="float-right modal-close waves-effect waves-circle waves-light btn-floating btn-large purple darken-4" type="submit" value="Create">
						<i class="large material-icons">check</i>
					</button>
				</form>
			</div>
		</div>
		
		<!--JavaScript at end of body for optimized loading-->
		<script type="text/javascript" src="assets/js/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script>
		<script type="text/javascript" src="assets/js/main.js"></script>
	</body>
</html>