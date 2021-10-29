<?php

require_once('conexao.php');
require_once('utils.php');
require_once('ImpressaoHelper.php');

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
		$this->pdf->SetTopMargin(40);
		$this->pdf->SetFont('times', '', 11);
	}

	private function getDados(){
		$ponte = $this->conexao->executarQuery("SELECT * FROM pontes WHERE id = ".$this->idPonte)[0];
		$imagens = $this->conexao->executarQuery('SELECT * FROM imagens_pontes WHERE ponte_id = '.$this->idPonte.' LIMIT 8');
		$agendamentos = $this->conexao->executarQuery('SELECT * FROM agendamentos WHERE ponte_id = '.$this->idPonte.' LIMIT 3');
		
		return [
			'ponte' => $ponte,
			'imagens' => $imagens,
			'agendamentos' => $agendamentos
		];
	}

	private function imprimirPrimeiraPagina(){
		$this->pdf->AddPage();
		$this->pdf->Cell(40, self::ALTURA_LINHA, sprintf('Código: %s', $this->dados['ponte']['id']), 'LTRB', self::MESMA_LINHA, 'C');
		$this->pdf->Cell(100, self::ALTURA_LINHA, sprintf('Localidade: %s', $this->dados['ponte']['via']), 'LTRB', self::MESMA_LINHA, 'C');
		$this->pdf->Cell(40, self::ALTURA_LINHA, sprintf('Data: %s', Utils::formataData($this->dados['ponte']['data_construcao'])), 'LTRB', self::QUEBRA_LINHA, 'C');

		$this->pdf->Cell(40, self::ALTURA_LINHA, sprintf('Curso D\'Água:'), 'LTRB', self::MESMA_LINHA, 'C');
		$this->pdf->Cell(100, self::ALTURA_LINHA, sprintf('%s', $this->dados['ponte']['natureza_transposicao']), 'LTRB', self::MESMA_LINHA, 'C');
		$this->pdf->Cell(40, self::ALTURA_LINHA, sprintf('Idade: %s', Utils::calculaDiferencaDatas($this->dados['ponte']['data_construcao'], date('Y-m-d'), '%y anos')), 'LTRB', self::QUEBRA_LINHA, 'C');

		$this->pdf->Cell(40, self::ALTURA_LINHA, sprintf('Localização:'), 'LTRB', self::MESMA_LINHA, 'C');
		$this->pdf->Cell(70, self::ALTURA_LINHA, sprintf('Latitude: %s', $this->dados['ponte']['latitude']), 'LTRB', self::MESMA_LINHA, 'C');
		$this->pdf->Cell(70, self::ALTURA_LINHA, sprintf('Longitude: %s', Utils::formataData($this->dados['ponte']['longitude'])), 'LTRB', self::QUEBRA_LINHA, 'C');

		$somaLargura = Utils::somarArray($this->dados['ponte'], ['largura_estrutura', 'largura_acostamento', 'largura_refugio', 'largura_passeio']);
		$this->pdf->Cell(90, self::ALTURA_LINHA, sprintf('Comprimento: %s', $this->dados['ponte']['comprimento_estrutura']).' metros', 'LTRB', self::MESMA_LINHA, 'C');
		$this->pdf->Cell(90, self::ALTURA_LINHA, sprintf('Longitude: %s', $somaLargura), 'LTRB', self::QUEBRA_LINHA, 'C');

		$this->pdf->Cell(90, self::ALTURA_LINHA, sprintf('Material Superestrutura: %s', $this->dados['ponte']['material_construcao']), 'LTRB', self::MESMA_LINHA, 'C');
		$this->pdf->Cell(90, self::ALTURA_LINHA, sprintf('Tipologia da Estrutura: %s', $this->dados['ponte']['transversal_super']), 'LTRB', self::QUEBRA_LINHA, 'C');
	}

	private function imprimirImagens(){
		foreach($this->dados['imagens'] as $imagem){
			$caminho = "assets/fotos/".$imagem['imagem'];
			$tag = "<p><img src=\"".$caminho."\"></p>";
			$this->pdf->writeHTML($tag, true, false, true, true);
		}
	}
}

?>