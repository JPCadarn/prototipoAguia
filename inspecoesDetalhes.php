<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('InspecaoService.php');
	$conexao = new Conexao();
	if(!isset($_GET['id']) || $_GET['id'] == ''){
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}else{
		$inspecao = $conexao->executarQuery("SELECT inspecoes.*, usuarios.nome AS usuario_nome FROM inspecoes INNER JOIN usuarios ON inspecoes.id_usuario = usuarios.id WHERE inspecoes.id = {$_GET['id']}")[0];
		$imagens = $conexao->executarQuery("SELECT imagem FROM imagens_inspecoes WHERE inspecao_id = {$_GET['id']}");
		
		$opcoesInspecao = [
			['id' => 'cadastral', 'tipo' => 'Cadastral'],
			['id' => 'rotineira', 'tipo' => 'Rotineira'],
			['id' => 'especial', 'tipo' => 'Especial'],
			['id' => 'extraordinaria', 'tipo' => 'Extraordinária']
		];
	}
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
		
		<div class="row">
			<h3>Ficha de Inspeção Cadastral - <?php echo $inspecao['nome']?></h3>
			<ul class="collapsible expandable popout">
				<li class="active">
					<div class="collapsible-header"><i class="material-icons">location_on</i>Identicação e Localização</div>
					<div class="collapsible-body">
						<p><span class="negrito">Via ou municípo: </span><span><?php echo $inspecao['via'];?></span></p>
						<p><span class="negrito">Via ou Municipio: </span><?php echo $inspecao['via'];?></label></p>
						<p><span class="negrito">Nome da OAE: </span><?php echo $inspecao['nome'];?></label></p>
						<p><span class="negrito">Data de Inspeçao: </span><?php echo Utils::formataData($inspecao['data_inspecao']);?></label></p>
						<p><span class="negrito">Trem-Tipo: </span><?php echo $inspecao['trem_tipo'];?></label></p>
						<p><span class="negrito">Sentido: </span><?php echo $inspecao['sentido'];?></label></p>
						<p><span class="negrito">Localização: </span><?php echo $inspecao['localizacao'];?></label></p>
						<p><span class="negrito">Latitude: </span><?php echo $inspecao['latitude'];?></label></p>
						<p><span class="negrito">Longitude: </span><?php echo $inspecao['longitude'];?></label></p>
						<p><span class="negrito">Projetista: </span><?php echo $inspecao['projetista'];?></label></p>
						<p><span class="negrito">Construtor: </span><?php echo $inspecao['construtor'];?></label></p>
					</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">build</i>Características da Estrutura</div>
					<div class="collapsible-body">
						<p><span class='negrito'>Comprimento: </span><span><?php echo $inspecao['comprimento_estrutura'];?></span></p>
						<p><span class='negrito'>Largura: </span><span><?php echo $inspecao['largura_estrutura'];?></span></p>
						<p><span class='negrito'>Largura do Acostamento: </span><span><?php echo $inspecao['largura_acostamento'];?></span></p>
						<p><span class='negrito'>Largura do Refúgio: </span><span><?php echo $inspecao['largura_refugio'];?></span></p>
						<p><span class='negrito'>Largura do Passeio: </span><span><?php echo $inspecao['largura_passeio'];?></span></p>
						<p><span class='negrito'>Sistema Construtivo: </span><span><?php echo $inspecao['sistema_construtivo'];?></span></p>
						<p><span class='negrito'>Natureza da Transposição: </span><span><?php echo $inspecao['natureza_transposicao'];?></span></p>
						<p><span class='negrito'>Material: </span><span><?php echo $inspecao['material_construcao'];?></span></p>
						<p><span class='negrito'>Longitudinal da superestrutura: </span><span><?php echo $inspecao['longitudinal_super'];?></span></p>
						<p><span class='negrito'>Transversal da superestrutura: </span><span><?php echo $inspecao['transversal_super'];?></span></p>
						<p><span class='negrito'>Mesoestrutura : </span><span><?php echo $inspecao['mesoestrutura_tipo'];?></span></p>
					</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">landscape</i>Características Funcionais</div>
					<div class="collapsible-body">
						<p><span class='negrito'>Características plani-altimétricas: </span><span><?php echo $inspecao['caracteristicas_plani']?></span> 
						<p><span class='negrito'>Número de Faixas: </span><span><?php echo $inspecao['nro_faixas']?></span> 
						<p><span class='negrito'>Acostamento: </span><span><?php echo $inspecao['acostamento']?></span> 
						<p><span class='negrito'>Refúgios: </span><span><?php echo $inspecao['refugios']?></span> 
						<p><span class='negrito'>Passeio: </span><span><?php echo $inspecao['passeio']?></span> 
						<p><span class='negrito'>Barreira rígida: </span><span><?php echo $inspecao['barreira_rigida']?></span> 
						<p><span class='negrito'>Material do pavimento: </span><span><?php echo $inspecao['material_pavimento']?></span> 
						<p><span class='negrito'>Pingadeiras: </span><span><?php echo $inspecao['pingadeiras']?></span> 
						<p><span class='negrito'>Guarda-Corpo: </span><span><?php echo $inspecao['guarda_corpo']?></span> 
						<p><span class='negrito'>Dreno: </span><span><?php echo $inspecao['drenos']?></span> 
					</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">block</i>Registro de Anomalias</div>
					<div class="collapsible-body">
						<h5 class='center'>Elementos Estruturais</h5>
						<p><span class='negrito'>Superestrutura: </span><span><?php echo $inspecao['superestrutura']?></span>
						<p><span class='negrito'>Mesoestrutura: </span><span><?php echo $inspecao['mesoestrutura']?></span>
						<p><span class='negrito'>Infraestrutura: </span><span><?php echo $inspecao['infraestrutura']?></span>
						<p><span class='negrito'>Aparelhos de apoio: </span><span><?php echo $inspecao['aparelhos_apoio_anomalia']?></span>
						<p><span class='negrito'>Juntas de dilatação: </span><span><?php echo $inspecao['juntas_dilatacao_anomalia']?></span>
						<p><span class='negrito'>Encontros: </span><span><?php echo $inspecao['encontros_anomalia']?></span>
						<h5 class='center'>Elementos da pista ou funcionais</h5>
						<p><span class='negrito'>Pavimento: </span><span><?php echo $inspecao['pavimento_anomalia']?></span>
						<p><span class='negrito'>Acostamento e refúgio: </span><span><?php echo $inspecao['acostamento_refugio_anomalia']?></span>
						<p><span class='negrito'>Drenagem: </span><span><?php echo $inspecao['drenagem_anomalia']?></span>
						<p><span class='negrito'>Guarda-Corpo: </span><span><?php echo $inspecao['guarda_corpo_anomalia']?></span>
						<p><span class='negrito'>Barreiras concreto/defensa metálica: </span><span><?php echo $inspecao['barreira_defesa']?></span>
						<h5 class='center'>Outros Elementos</h5>
						<p><span class='negrito'>Taludes: </span><span><?php echo $inspecao['taludes']?></span>
						<p><span class='negrito'>Iluminação: </span><span><?php echo $inspecao['iluminacao']?></span>
						<p><span class='negrito'>Sinalização: </span><span><?php echo $inspecao['sinalizacao']?></span>
						<p><span class='negrito'>Proteção de pilares: </span><span><?php echo $inspecao['protecao_pilares']?></span>
					</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">grade</i>Notas</div>
					<div class="collapsible-body">
						<p><span class='negrito'>Índice de Localização: </span><span><?php echo InspecaoService::camposIndiceLocalizacao[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposIndiceLocalizacao, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Índice de Volume de Tráfego: </span><span><?php echo InspecaoService::camposVolumeTrafego[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposVolumeTrafego, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Índice de Largura da OAE: </span><span><?php echo InspecaoService::camposLarguraOAE[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposLarguraOAE, 'id'))]['descricao'];?></span>
						<h5 class='center'>Fator de Segurança</h5>
						<p><span class='negrito'>Geometria e condições várias: </span><span><?php echo InspecaoService::camposFsPesoAlto[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFsPesoAlto, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Acessos: </span><span><?php echo InspecaoService::camposFsPesoMedio[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFsPesoMedio, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Cursos d'água: </span><span><?php echo InspecaoService::camposFsPesoMedio[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFsPesoMedio, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Encontros e fundações: </span><span><?php echo InspecaoService::camposFsPesoAlto[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFsPesoAlto, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Apoios intermediários: </span><span><?php echo InspecaoService::camposFsPesoAlto[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFsPesoAlto, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Aparelhos de apoio: </span><span><?php echo InspecaoService::camposFsPesoAlto[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFsPesoAlto, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Superestrutura: </span><span><?php echo InspecaoService::camposFsPesoAlto[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFsPesoAlto, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Pista de rolamento: </span><span><?php echo InspecaoService::camposFsPesoMedio[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFsPesoMedio, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Juntas de dilatação: </span><span><?php echo InspecaoService::camposFsPesoMedio[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFsPesoMedio, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Barreiras e guarda-corpos: </span><span><?php echo InspecaoService::camposFsPesoBaixo[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFsPesoBaixo, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Sinalização: </span><span><?php echo InspecaoService::camposFsPesoBaixo[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFsPesoBaixo, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Instalações de utilidade pública: </span><span><?php echo InspecaoService::camposFsPesoBaixo[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFsPesoBaixo, 'id'))]['descricao'];?></span>
						<h5 class='center'>Fator de Conservação </h5>
						<p><span class='negrito'>Largura da plataforma: </span><span><?php echo InspecaoService::camposFcLargura[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFcLargura, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Capacidade de carga: </span><span><?php echo InspecaoService::camposFcCarga[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFcCarga, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Superfície da plataforma: </span><span><?php echo InspecaoService::camposFcSuperficie[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFcSuperficie, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Pista de rolamento: </span><span><?php echo InspecaoService::camposFcPistaRolamento[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFcPistaRolamento, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Outros: </span><span><?php echo InspecaoService::camposFcOutros[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFcOutros, 'id'))]['descricao'];?></span>
						<h5 class='center'>Fator de Impacto </h5>
						<p><span class='negrito'>Espaço livre: </span><span><?php echo InspecaoService::camposFiEspacoLivre[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFiEspacoLivre, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Localização da Ponte: </span><span><?php echo InspecaoService::camposFiLocal[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFiLocal, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Saúde física da ponte: </span><span><?php echo InspecaoService::camposFiSaude[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFiSaude, 'id'))]['descricao'];?></span>
						<p><span class='negrito'>Outros: </span><span><?php echo InspecaoService::camposFiOutros[array_search($inspecao['nota_indice_localizacao'], array_column(InspecaoService::camposFiOutros, 'id'))]['descricao'];?></span>
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

		<?php
		Utils::scriptsJs();
		?>
	</body>
</html>