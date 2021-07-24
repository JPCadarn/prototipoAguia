<?php
	require_once('conexao.php');
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
		<nav>
			<div class="nav-wrapper purple darken-4">
				<a href='index.php' class='brand-logo center' tabIndex='-1'>
					<img class='imagem-logo responsive-img' tabIndex='-1' id='logo' src='assets/Logo/Branco.png'/>
				</a>
				<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li><a href="pontes.php">Pontes</a></li>
					<li><a href="agendamentos.php">Agendamentos</a></li>
					<li><a href="logout.php">Logout</a></li>
					<li><a href="#">Minha Conta</a></li>
				</ul>
			</div>
		</nav>
		
		<ul class="sidenav" id="mobile-demo">
			<li><a href="pontes.php">Pontes</a></li>
			<li><a href="agendamentos.php">Agendamentos</a></li>
			<li><a href="logout.php">Logout</a></li>
			<li><a href="#">Minha Conta</a></li>
		</ul>

		<div class='row'>
		<?php
			$pontes = $conexao->executarQuery('SELECT id, nome, descricao FROM pontes');
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
											<p>{$ponte['descricao']}</p>
										</div>
										<div class='card-action center'>
											<a href='ponteDetalhes.php?id={$ponte['id']}'><i class='material-icons'>info</i> Detalhes</a>
											<a href='pontesEdit.php?id={$ponte['id']}'><i class='material-icons'>edit</i> Editar</a>
											<a href='pontesDelete.php?id={$ponte['id']}'><i class='material-icons'>delete</i> Excluir</a>
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
  			<a data-target="modalCadastro" class="btn-large modal-trigger btn-floating waves-effect waves-light purple darken-4">
    			<i class="large material-icons">add</i>
  			</a>
		</div>

		<!-- Modal Structure -->
		<div id="modalCadastro" class="modal">
			<div class="modal-title">
				<h4 class="center">Ficha de Inspeção Cadastral</h4>
			</div>
			<div class="modal-content">
				<div class="row">
					<form action="novaPonte.php" method="POST" class="col s12" enctype="multipart/form-data" autocomplete="off">
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
									<input id="via" name="via" type="text">
									<label for="via">Via ou Municipio</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="nome" name="nome" type="text">
									<label for="nome">Nome da OAE</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="data_construcao" name="data_construcao" type="text" class="datepicker">
									<label for="data_construcao">Data de Construção</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="trem_tipo" name="trem_tipo" type="text">
									<label for="trem_tipo">Trem-Tipo</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="sentido" name="sentido" type="text">
									<label for="sentido">Sentido</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="localizacao" name="localizacao" type="text">
									<label for="localizacao">Localização</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="latitude" name="latitude" type="text">
									<label for="latitude">Latitude</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="longitude" name="longitude" type="text">
									<label for="longitude">Longitude</label>
								</div>
							</div>
							<div class="row">
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
						<div id="formEstrutura" class="col s12">
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="comprimento_estrutura" name="comprimento_estrutura" type="text">
									<label for="comprimento_estrutura">Comprimento</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="largura_estrutura" name="largura_estrutura" type="text">
									<label for="largura_estrutura">Largura</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="largura_acostamento" name="largura_acostamento" type="text">
									<label for="largura_acostamento">Largura do Acostamento</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="largura_refugio" name="largura_refugio" type="text">
									<label for="largura_refugio">Largura do Refúgio</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="largura_passeio" name="largura_passeio" type="text">
									<label for="largura_passeio">Largura do Passeio</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="sistema_construtivo" name="sistema_construtivo" type="text">
									<label for="sistema_construtivo">Sistema Construtivo</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="natureza_transposicao" name="natureza_transposicao" type="text">
									<label for="natureza_transposicao">Natureza da Transposição</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="material_construcao" name="material_construcao" type="text">
									<label for="material_construcao">Material</label>
								</div>
							</div>
							<h5 class="center">Seção Tipo</h5>
							<div class="row">
								<div class="input-field col s4">
									<input id="longitudinal_super" name="longitudinal_super" type="text">
									<label for="longitudinal_super">Longitudinal da superestrutura</label>
								</div>
								<div class="input-field col s4">
									<input id="transversal_super" name="transversal_super" type="text">
									<label for="transversal_super">Transversal da superestrutura</label>
								</div>
								<div class="input-field col s4">
									<input id="mesoestrutura_tipo" name="mesoestrutura_tipo" type="text">
									<label for="mesoestrutura_tipo">Mesoestrutura </label>
								</div>
							</div>
							<h5 class="center">Características Particulares</h5>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="nro_vaos" name="nro_vaos" type="text">
									<label for="nro_vaos">Número de Vãos</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="nro_apoios" name="nro_apoios" type="text">
									<label for="nro_apoios">Número de Apoios</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="nro_pilares_apoio" name="nro_pilares_apoio" type="text">
									<label for="nro_pilares_apoio">Número de Pilares por Apoio</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="aparelhos_apoio" name="aparelhos_apoio" type="text">
									<label for="aparelhos_apoio">Aparelhos de Apoio</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="comprimento_vao_tipico" name="comprimento_vao_tipico" type="text">
									<label for="comprimento_vao_tipico">Comprimento do vão típico</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="comprimento_maior_vao" name="comprimento_maior_vao" type="text">
									<label for="comprimento_maior_vao">Comprimento do maior vão</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="altura_pilares" name="altura_pilares" type="text">
									<label for="altura_pilares">Altura dos pilares</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="juntas_dilatacao" name="juntas_dilatacao" type="text">
									<label for="juntas_dilatacao">Juntas de dilatação</label>
								</div>
							</div>
							<div class="row">
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
						<div id="formFuncionais" class="col s12">
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="caracteristicas_plani" name="caracteristicas_plani" type="text">
									<label for="caracteristicas_plani">Características plani-altimétricas</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="nro_faixas" name="nro_faixas" type="text">
									<label for="nro_faixas">Número de Faixas</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="acostamento" name="acostamento" type="text">
									<label for="acostamento">Acostamento</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="refugios" name="refugios" type="text">
									<label for="refugios">Refúgios</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="passeio" name="passeio" type="text">
									<label for="passeio">Passeio</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="barreira_rigida" name="barreira_rigida" type="text">
									<label for="barreira_rigida">Barreira rígida</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="material_pavimento" name="material_pavimento" type="text">
									<label for="material_pavimento">Material do pavimento</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="pingadeiras" name="pingadeiras" type="text">
									<label for="pingadeiras">Pingadeiras</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="guarda_corpo" name="guarda_corpo" type="text">
									<label for="guarda_corpo">Guarda-Corpo</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="drenos" name="drenos" type="text">
									<label for="drenos">Dreno</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="freq_passagem_carga" name="freq_passagem_carga" type="text">
									<label for="freq_passagem_carga">Frequencia passagem carga especial</label>
								</div>
							</div>
						</div>
						<div id="formAnomalias" class="col s12">
							<h5 class="center">Elementos Estruturais</h5>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="superestrutura" name="superestrutura" type="text">
									<label for="superestrutura">Superestrutura</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="mesoestrutura" name="mesoestrutura" type="text">
									<label for="mesoestrutura">Mesoestrutura</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="infraestrutura" name="infraestrutura" type="text">
									<label for="infraestrutura">Infraestrutura</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="aparelhos_apoio_anomalia" name="aparelhos_apoio_anomalia" type="text">
									<label for="aparelhos_apoio_anomalia">Aparelhos de apoio</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="juntas_dilatacao_anomalia" name="juntas_dilatacao_anomalia" type="text">
									<label for="juntas_dilatacao_anomalia">Juntas de dilatação</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="encontros_anomalia" name="encontros_anomalia" type="text">
									<label for="encontros_anomalia">Encontros</label>
								</div>
							</div>
							<h5 class="center">Elementos da pista ou funcionais</h5>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="pavimento_anomalia" name="pavimento_anomalia" type="text">
									<label for="pavimento_anomalia">Pavimento</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="acostamento_refugio_anomalia" name="acostamento_refugio_anomalia" type="text">
									<label for="acostamento_refugio_anomalia">Acostamento e refúgio</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="drenagem_anomalia" name="drenagem_anomalia" type="text">
									<label for="drenagem">Drenagem</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="guarda_corpo_anomalia" name="guarda_corpo_anomalia" type="text">
									<label for="guarda_corpo_anomalia">Guarda-Corpo</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="barreira_defesa" name="barreira_defesa" type="text">
									<label for="barreira_defesa">Barreiras concreto/defensa metálica</label>
								</div>
							</div>
							<h5 class="center">Outros Elementos</h5>
							<div class="row">
								<div class="input-field col s12 m6">
									<input id="taludes" name="taludes" type="text">
									<label for="taludes">Taludes</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="iluminacao" name="iluminacao" type="text">
									<label for="iluminacao">Iluminação</label>
								</div>
							</div>
							<div class="row">
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
						<div id="formImagens" class="col s12">
							<div class="file-field input-field">
								<div class="btn purple darken-4">
									<span>Imagens</span>
									<input name="images[]" required type="file" multiple accept="image/*">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Anexe aqui as imagens da ponte">
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