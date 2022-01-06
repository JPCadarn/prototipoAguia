<?php

require_once('conexao.php');

class InspecaoService{
	public const camposIndiceLocalizacao = [
		['id' => 40, 'descricao' => 'Centro Urbano'],
		['id' => 35, 'descricao' => 'Rodovia Federal'],
		['id' => 25, 'descricao' => 'Rodovia Estadual'],
		['id' => 15, 'descricao' => 'Área Urbana Municipal'],
		['id' => 5, 'descricao' => 'Área Rural Municipal']
	];

	public const camposVolumeTrafego = [
		['id' => 40, 'descricao' => 'Muito alto, com muitos engarrafamentos'],
		['id' => 35, 'descricao' => 'Alto, com poucos engarrafamentos'],
		['id' => 25, 'descricao' => 'Moderado, com ou sem engarrafamento'],
		['id' => 15, 'descricao' => 'Baixo, sem engarrafamento'],
		['id' => 5, 'descricao' => 'Muito baixo, sem engarrafamento']
	];

	public const camposLarguraOAE = [
		['id' => 20, 'descricao' => 'Muito larga (maior que 17m) '],
		['id' => 15, 'descricao' => 'Larga (14-17m)'],
		['id' => 10, 'descricao' => 'Média (10-14m)'],
		['id' => 6, 'descricao' => 'Estreita (6,5-10m)'],
		['id' => 3, 'descricao' => 'Muito estreita (menos que 6,5m)']
	];

	public const camposFsPesoAlto = [
		['id' => 5, 'descricao' => 'Precária'],
		['id' => 3.75, 'descricao' => 'Sofrível'],
		['id' => 2.5, 'descricao' => 'Boa aparentemente'],
		['id' => 1.25, 'descricao' => 'Boa'],
		['id' => 0, 'descricao' => 'Muito boa']
	];

	public const camposFsPesoMedio = [
		['id' => 4, 'descricao' => 'Precária'],
		['id' => 3, 'descricao' => 'Sofrível'],
		['id' => 2, 'descricao' => 'Boa aparentemente'],
		['id' => 1, 'descricao' => 'Boa'],
		['id' => 0, 'descricao' => 'Muito boa']
	];

	public const camposFsPesoBaixo = [
		['id' => 3, 'descricao' => 'Precária'],
		['id' => 2.25, 'descricao' => 'Sofrível'],
		['id' => 1.5, 'descricao' => 'Boa aparentemente'],
		['id' => 0.75, 'descricao' => 'Boa'],
		['id' => 0, 'descricao' => 'Muito boa']
	];

	public const camposFcLargura = [
		['id' => 10, 'descricao' => 'Muito larga (acima de 17 m)'],
		['id' => 8, 'descricao' => 'Larga (14-17 m)'],
		['id' => 6, 'descricao' => 'Média (10-14 m)'],
		['id' => 4, 'descricao' => 'Estreita (7-10 m)'],
		['id' => 2, 'descricao' => 'Muito estreita (abaixo de 7 m)']
	];

	public const camposFcCarga = [
		['id' => 10, 'descricao' => 'Muito alta (maior que 30 toneladas)'],
		['id' => 8, 'descricao' => 'Alta (25-30 toneladas)'],
		['id' => 6, 'descricao' => 'Média (18-25 toneladas)'],
		['id' => 4, 'descricao' => 'Baixa (13-18 toneladas)'],
		['id' => 2, 'descricao' => 'Muito baixa (menor que 13 toneladas)']
	];

	public const camposFcSuperficie = [
		['id' => 10, 'descricao' => 'Nota 1'],
		['id' => 8, 'descricao' => 'Nota 2'],
		['id' => 6, 'descricao' => 'Nota 3'],
		['id' => 4, 'descricao' => 'Nota 4'],
		['id' => 2, 'descricao' => 'Nota 5']
	];

	public const camposFcPistaRolamento = [
		['id' => 5, 'descricao' => 'Está em pior estado que as pistas de acesso à ponte'],
		['id' => 3, 'descricao' => 'Está no mesmo estado que as pistas de acesso à ponte'],
		['id' => 1, 'descricao' => 'Está em melhor estado que as pistas de acesso à ponte']
	];

	public const camposFcOutros = [
		['id' => 5, 'descricao' => 'Vida útil remanescente baixa'],
		['id' => 3, 'descricao' => 'Vida útil remanescente média'],
		['id' => 1, 'descricao' => 'Vida útil remanescente alta']
	];

	public const camposFiEspacoLivre = [
		['id' => 5, 'descricao' => 'Frequentemente inviabiliza a passagem de navios'],
		['id' => 3, 'descricao' => 'Inviabiliza a passagem de navios algumas vezes'],
		['id' => 1, 'descricao' => 'Não inviabiliza a passagem de navios'],
	];

	public const camposFiLocal = [
		['id' => 3, 'descricao' => 'Centro urbano'],
		['id' => 2.4, 'descricao' => 'Rodovia Federal'],
		['id' => 1.8, 'descricao' => 'Rodovia Estadual'],
		['id' => 1.2, 'descricao' => 'Área urbana municipal'],
		['id' => 0.6, 'descricao' => 'Área rural municipal']
	];

	public const camposFiSaude = [
		['id' => 1, 'descricao' => 'Nota 1'],
		['id' => 0.8, 'descricao' => 'Nota 2'],
		['id' => 0.6, 'descricao' => 'Nota 3'],
		['id' => 0.4, 'descricao' => 'Nota 4'],
		['id' => 0.2, 'descricao' => 'Nota 5']
	];

	public const camposFiOutros = [
		['id' => 1, 'descricao' => 'Alto impacto em terceiros'],
		['id' => 0.6, 'descricao' => 'Impacto moderado em terceiros'],
		['id' => 0.2, 'descricao' => 'Baixo impacto em terceiros']
	];

	public const tipos = [
		'cadastral' => 'Cadastral',
		'rotineira' => 'Rotineira',
		'especial' => 'Especial',
		'extraordinaria' => 'Extraordinária'
	];

	public static function renderCardsInspecaoGroup($groupInspecao){
		$conexao = new Conexao();

		echo "<div class='row collapsible-row'>";
		foreach($groupInspecao as $inspecao){
			$imagem = $conexao->executarQuery("SELECT imagem FROM imagens_pontes WHERE ponte_id = {$inspecao['id']} ORDER BY id ASC LIMIT 1");
			if(isset($imagem[0]['imagem'])){
				$imagem = $imagem[0]['imagem'];
			}else{
				$imagem = '';
			}
			echo "<div class='col s12 m4'>";
			echo "<div class='card medium'>";
			echo "<div class='card-image'>";
			echo "<img src='assets/fotos/$imagem'>";
			echo "</a>";
			echo "<span class='card-title'>{$inspecao['nome']}</span>";
			echo "</div>";
			echo "<div class='card-content'>";
			if($inspecao['status'] == 'Aberto'){
				echo "<a id='btnAvaliarInspecao{$inspecao['id_inspecao']}' data-id='{$inspecao['id_inspecao']}' data-target='modalAvaliar' data-position='bottom' data-tooltip='Avaliar' class='indigo darken-4 modal-trigger tooltipped btn-floating btn-large halfway-fab waves-effect waves-light'><i class='material-icons'>thumbs_up_down</i></a>";
			}elseif($inspecao['status'] == 'Avaliado'){
				echo "<a data-position='bottom' href='inspecoesDetalhes.php?id={$inspecao['id_inspecao']}'' data-tooltip='Detalhes' class='indigo darken-4 modal-trigger tooltipped btn-floating btn-large halfway-fab waves-effect waves-light'><i class='material-icons'>info_outline</i></a>";
			}
			echo "<p>{$inspecao['descricao']}</p>";
			echo "<p>".Utils::formataData($inspecao['data_inspecao'])." - ".InspecaoService::tipos[$inspecao['tipo_inspecao']]." - ID ".$inspecao['id_inspecao']."</p>";
			echo "<p><b>Status: </b>{$inspecao['status']}</p>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
		}
		echo "</div>";
	}
}