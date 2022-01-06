<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('InspecaoService.php');
	require_once('SessionService.php');
	SessionService::validarLoginFeito();
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
	<?php
		Utils::tagHead();
	?>
	<body>
		<?php
			Utils::navBar();
		?>
		
		<div class="row">
			<h3>Ficha de Inspeção Cadastral - <?php echo $inspecao['nome']?></h3>
			<ul class="collapsible expandable popout">
				<li class="active">
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
						<h5 class='center'>Observações</h5>
						<p><span><?php echo $inspecao['obs'];?></span>
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