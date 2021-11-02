<?php

require_once('conexao.php');
require_once('utils.php');
require_once('ImpressaoHelper.php');
require_once('RankeamentoService.php');

class RelatorioPonte extends TCPDF{
	const QUEBRA_LINHA = 1;
	const MESMA_LINHA = 0;
	const ALTURA_LINHA = 4;

	private $idPonte;
	private $conexao;
	private $pdf;
	private $dados;

	public function __construct($idPonte)
	{
		$this->idPonte = $idPonte;
		$this->conexao = new Conexao();
		$this->pdf = new ImpressaoHelper();
	}

	public function imprimir(){
		$this->setarConfiguracoes();
		$this->dados = $this->getDados();

		$this->imprimirPrimeiraPagina();
		$this->imprimirSegundaPagina();
		$this->imprimirImagens();
		$this->pdf->Output('RelatorioINFRASIL.pdf', 'I');
	}

	private function setarConfiguracoes(){
		$this->pdf->SetCreator(PDF_CREATOR);
		$this->pdf->SetAuthor('INFRASIL');
		$this->pdf->SetTitle('Relatório de Infraestrutura - Estrutura ID '.$this->idPonte);
		$this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->pdf->SetMargins(30, 40);
		$this->pdf->SetFont('times', '', 12);
	}

	private function getDados(){
		$ponte = $this->conexao->executarQuery("SELECT * FROM pontes WHERE id = ".$this->idPonte)[0];
		$imagens = $this->conexao->executarQuery('SELECT * FROM imagens_pontes WHERE ponte_id = '.$this->idPonte);
		$agendamentos = $this->conexao->executarQuery('SELECT * FROM agendamentos WHERE ponte_id = '.$this->idPonte.' LIMIT 3');
		$inspecoes = $this->conexao->executarQuery("SELECT inspecoes.* FROM inspecoes WHERE inspecoes.status = 'Avaliado'");
		
		return [
			'ponte' => $ponte,
			'imagens' => $imagens,
			'agendamentos' => $agendamentos,
			'inspecoes' => $inspecoes
		];
	}

	private function imprimirPrimeiraPagina(){
		$this->pdf->AddPage();

		$html = "<p><b>Código: </b>".$this->dados['ponte']['id']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Localidade: </b>".$this->dados['ponte']['via']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Nome da Estrutura: </b>".$this->dados['ponte']['nome']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Data de Inauguração: </b>".Utils::formataData($this->dados['ponte']['data_construcao'])."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Natureza da Transposição: </b>".$this->dados['ponte']['natureza_transposicao']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Idade: </b>".Utils::calculaDiferencaDatas($this->dados['ponte']['data_construcao'], date('Y-m-d'), '%y')." anos </p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Latitude: </b>".$this->dados['ponte']['latitude']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Longitude: </b>".$this->dados['ponte']['longitude']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Comprimento: </b>".$this->dados['ponte']['comprimento_estrutura']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Largura: </b>".Utils::somarArray($this->dados['ponte'], ['largura_estrutura', 'largura_acostamento', 'largura_refugio', 'largura_passeio', ])." metros</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Material: </b>".$this->dados['ponte']['material_construcao']."</p><br>";
		$this->pdf->writeHTML($html);
		
		$RankeamentoService = new RankeamentoService($this->dados['inspecoes']);
		$html = $RankeamentoService->renderRankeamentos(true);
		$this->pdf->writeHTML($html);
	}

	private function imprimirSegundaPagina(){
		$this->pdf->AddPage();

		$html = '';

		$html = "<p><b>Via ou municípo</b>:".$this->dados['ponte']['via']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Nome da OAE</b>:".$this->dados['ponte']['nome']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Ano de construção (ou época aprox.)</b>:".implode('/', array_reverse(explode('-', $this->dados['ponte']['data_construcao'])))."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Trem-tipo</b>:".$this->dados['ponte']['trem_tipo']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Sentido</b>:".$this->dados['ponte']['sentido']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Localização (km ou endereço)</b>:".$this->dados['ponte']['localizacao']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Coord. Geo. (long./lat.)</b>:".$this->dados['ponte']['longitude'].' | '.$this->dados['ponte']['latitude']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Projetista</b>:".$this->dados['ponte']['projetista']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Construtor</b>:".$this->dados['ponte']['construtor']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Comprimento total (m)</b>:".$this->dados['ponte']['comprimento_estrutura']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Largura da faixa (m)</b>:".$this->dados['ponte']['largura_estrutura']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Largura do acostamento (m)</b>:".$this->dados['ponte']['largura_acostamento']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Largura do refúgio (m)</b>:".$this->dados['ponte']['largura_refugio']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Largura do passeio (m)</b>:".$this->dados['ponte']['largura_passeio']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Sistema construtivo</b>:".$this->dados['ponte']['sistema_construtivo']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Natureza da transposição</b>:".$this->dados['ponte']['natureza_transposicao']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Material</b>:".$this->dados['ponte']['material_construcao']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Longitudinal da superestrutura</b>:".$this->dados['ponte']['longitudinal_super']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Transversal da superestrutura</b>:".$this->dados['ponte']['transversal_super']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Mesoestrutura</b>:".$this->dados['ponte']['mesoestrutura_tipo']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Número de vãos</b>:".$this->dados['ponte']['nro_vaos']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Número de apoios</b>:".$this->dados['ponte']['nro_apoios']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Número de pilares por apoio</b>:".$this->dados['ponte']['nro_pilares_apoio']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Aparelhos de apoio (quantidade de tipo)</b>:".$this->dados['ponte']['aparelhos_apoio']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Comprimento do vão típico (m)</b>:".$this->dados['ponte']['comprimento_vao_tipico']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Comprimento do maior vão (m)</b>:".$this->dados['ponte']['comprimento_maior_vao']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Altura dos pilares (m)</b>:".$this->dados['ponte']['altura_pilares']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Juntas de dilatação (quantidade e tipo)</b>:".$this->dados['ponte']['juntas_dilatacao']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Encontros</b>:".$this->dados['ponte']['encontros']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Outras peculiaridades</b>:".$this->dados['ponte']['outras']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Características plani-altimétricas</b>:".$this->dados['ponte']['caracteristicas_plani']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Número de faixas</b>:".$this->dados['ponte']['nro_faixas']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Acostamento</b>:".$this->dados['ponte']['acostamento']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Refúgios</b>:".$this->dados['ponte']['refugios']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Passeio</b>:".$this->dados['ponte']['passeio']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Barreira rígida</b>:".$this->dados['ponte']['barreira_rigida']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Material do pavimento</b>:".$this->dados['ponte']['material_pavimento']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Pingadeiras</b>:".$this->dados['ponte']['pingadeiras']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Guarda-corpo</b>:".$this->dados['ponte']['guarda_corpo']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Drenos</b>:".$this->dados['ponte']['drenos']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Frequencia passagem carga especial</b>:".$this->dados['ponte']['freq_passagem_carga']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Superestrutura</b>:".$this->dados['ponte']['superestrutura']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Mesoestrutura</b>:".$this->dados['ponte']['mesoestrutura']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Infraestrutura</b>:".$this->dados['ponte']['infraestrutura']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Aparelhos de apoio</b>:".$this->dados['ponte']['aparelhos_apoio_anomalia']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Juntas de dilatação</b>:".$this->dados['ponte']['juntas_dilatacao_anomalia']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Encontros</b>:".$this->dados['ponte']['encontros_anomalia']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Pavimento</b>:".$this->dados['ponte']['pavimento_anomalia']."</p>";
		$this->pdf->writeHTML($html);
		
		$html = "<p><b>Acostamento e refúgio</b>:".$this->dados['ponte']['acostamento_refugio_anomalia']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Drenagem</b>:".$this->dados['ponte']['drenagem_anomalia']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Guarda-corpo</b>:".$this->dados['ponte']['guarda_corpo_anomalia']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Barreiras concreto/defensa metálica</b>:".$this->dados['ponte']['barreira_defesa']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Taludes</b>:".$this->dados['ponte']['taludes']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Iluminação</b>:".$this->dados['ponte']['iluminacao']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Sinalização</b>:".$this->dados['ponte']['sinalizacao']."</p>";
		$this->pdf->writeHTML($html);

		$html = "<p><b>Proteção de pilares</b>:".$this->dados['ponte']['protecao_pilares']."</p>";
		$this->pdf->writeHTML($html);
	}
	
	private function imprimirImagens(){
		$this->pdf->AddPage();
		foreach($this->dados['imagens'] as $imagem){
			$caminho = "assets/fotos/".$imagem['imagem'];
			$tag = "<p><b><img src=\"".$caminho."\"></p>";
			$this->pdf->writeHTML($tag, true, false, true, true);
		}
	}
}

?>