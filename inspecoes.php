<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('InspecaoService.php');
	require_once('SessionService.php');
	SessionService::validarLoginFeito();
	$conexao = new Conexao();
	echo '<!DOCTYPE html>';
	Utils::tagHead();
	echo '<body>';
	Utils::navBar();

	$inspecoes = $conexao->executarQuery('
		SELECT 
			pontes.id, 
			pontes.nome AS ponte_nome, 
			inspecoes.nome, 
			inspecoes.descricao, 
			inspecoes.id AS id_inspecao, 
			inspecoes.status, 
			inspecoes.data_inspecao, 
			inspecoes.tipo_inspecao 
		FROM pontes 
		INNER JOIN inspecoes ON pontes.id = inspecoes.ponte_id 
		LEFT JOIN usuarios ON pontes.id_usuario = usuarios.id 
		LEFT JOIN clientes ON usuarios.id_cliente = clientes.id
		WHERE clientes.id = '.SessionService::getIdCliente());
	$inspecoesAgrupadas = Utils::agruparArrayPorChave($inspecoes, 'id');
	
	if(count($inspecoes)){
		echo "<div class='container'>";
			foreach($inspecoesAgrupadas as $groupInspecao){
				echo "<ul class='collapsible expandable popout'>";
					echo "<li>";
						echo "<div class='collapsible-header'>".$groupInspecao[0]['ponte_nome']." - ".$groupInspecao[0]['id']."</div>";
						echo "<div class='collapsible-body'>"; 
						InspecaoService::renderCardsInspecaoGroup($groupInspecao);
						echo "</div>";
					echo "</li>";
				echo "</ul>";
			}
		echo "</div>";
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
								<div class="row">
									<div class="input-field col s12">
										<textarea class="materialize-textarea" id="obs" name="obs" type="text"></textarea>
										<label for="obs">Resumo</label>
									</div>
								</div>
							</div>
						</li>
					</ul>
					<button class="indigo darken-4  waves-effect waves-circle waves-light btn-floating btn-large float-right" type="submit" value="Create">
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