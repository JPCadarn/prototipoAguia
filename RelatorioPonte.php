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
		$this->imprimirImagens();
		$this->pdf->Output('RelatorioINFRASIL.pdf');
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