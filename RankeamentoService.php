<?php

	require_once('InspecaoService.php');

	class RankeamentoService{
		const ALFA1 = 0.4;
		const ALFA2 = 0.6;

		private $inspecoes;

		public function __construct($inspecoes){
			$this->inspecoes = $inspecoes;
		}

		public function renderGrafico(){
			$agrupamentoNotas = $this->agruparInspecoes();
			echo "<script>renderChart('pie', $agrupamentoNotas)</script>";
		}

		private function agruparInspecoes(){
			$grupos = [];
			foreach($this->inspecoes as $inspecao){
				$imps[$inspecao['ponte_id']] = $this->calcularIMP($inspecao)['imp'];
			}
			foreach($imps as $imp){
				$grupos[intval($imp/20)+1][] = $imp;
			}
			$retorno = [
				'countUm' => isset($grupos[1]) ? count($grupos[1]) : 0,
				'countDois' => isset($grupos[2]) ? count($grupos[2]) : 0,
				'countTres' => isset($grupos[3]) ? count($grupos[3]) : 0,
				'countQuatro' => isset($grupos[4]) ? count($grupos[4]) : 0,
				'countCinco' => isset($grupos[5]) ? count($grupos[5]) : 0
			];
			return json_encode($retorno);
		}

		public function renderRankeamentos($retornarHtml = false, $limite = 10){
			$imps = [];
			foreach($this->inspecoes as $inspecao){
				$imps[$inspecao['ponte_id']] = $this->calcularIMP($inspecao);
			}
			$imps = Utils::ordenarArrayMultiDimensional($imps, 'imp');
			$html = '';
			$html .= "<table class='striped centered responsive-table'>";
			$html .= "<thead>";
			$html .= "<tr>";
			$html .= "<th>Tipo de Inspeção</th>";
			$html .= "<th>OAE</th>";
			$html .= "<th>Data de Inspeção</th>";
			$html .= "<th>IVS</th>";
			$html .= "<th>ISE</th>";
			$html .= "<th>IMP</th>";
			$html .= "</tr>";
			$html .= "</thead>";
			$html .= "<tbody>";
			$contador = 0;
			foreach($imps as $inspecao){
				if($contador == $limite){
					break;
				}
				$html .= "<tr>";
				$html .= "<td>".InspecaoService::tipos[$inspecao['tipo_inspecao']]."</td>";
				$html .= "<td>".$inspecao['descricao']."</td>";
				$html .= "<td>".Utils::formataData($inspecao['data_inspecao'])."</td>";
				$html .= "<td>".$inspecao['ivs']."</td>";
				$html .= "<td>".$inspecao['ise']."</td>";
				$html .= "<td>".$inspecao['imp']."</td>";
				$html .= "</tr>";
				$contador++;
			}
			$html .= "</tbody>";
			$html .= "</table>";

			if($retornarHtml){
				return $html;
			}

			echo $html;
		}

		public function renderRankeamentosRelatorio($idPonte){
			$imps = [];

			foreach($this->inspecoes as $inspecao){
				$imps[$inspecao['ponte_id']] = $this->calcularIMP($inspecao);
			}

			$imps = Utils::ordenarArrayMultiDimensional($imps, 'imp');

			$html = '';
			$html .= "<table>";
			$html .= "<thead>";
			$html .= "<tr>";
			$html .= "<th><b>Tipo de Inspeção</b></th>";
			$html .= "<th><b>Nome da OAE</b></th>";
			$html .= "<th><b>Data de Inspeção</b></th>";
			$html .= "<th><b>Pontuação</b></th>";
			$html .= "</tr>";
			$html .= "</thead>";
			$html .= "<tbody>";
			$contador = 0;

			$imps = array_splice($imps, 0, 9);

			foreach($imps as $inspecao){
				$html .= "<tr>";
				$html .= "<td>".InspecaoService::tipos[$inspecao['id']]."</td>";
				$html .= "<td>".$inspecao['ponte_nome']."</td>";
				$html .= "<td>".Utils::formataData($inspecao['data_inspecao'])."</td>";
				$html .= "<td>".$inspecao['imp']."</td>";
				$html .= "</tr>";
				$contador++;
			}
			$html .= "</tbody>";
			$html .= "</table>";
			
			return $html;
		}

		public function getPosicaoPonte($idPonte){
			$imps = [];

			foreach($this->inspecoes as $inspecao){
				$imps[$inspecao['ponte_id']] = $this->calcularIMP($inspecao);
			}
			$imps = Utils::ordenarArrayMultiDimensional($imps, 'imp');

			return array_search($idPonte, array_column($imps, 'ponte_id')) + 1;
		}

		public function calcularIMP($inspecao){
			$indiceValorSocial = $this->calcularIndiceValorSocial($inspecao);
			$indiceSaudeEstrutura = $this->calcularIndiceSaudeEstrutura($inspecao);
			$imp = self::ALFA1 * $indiceValorSocial + self::ALFA2 * $indiceSaudeEstrutura;
			return [
				'ivs' => $indiceValorSocial, 
				'ise' => $indiceSaudeEstrutura, 
				'imp' => $imp,
				'descricao' => substr($inspecao['nome'], 0, 50),
				'id' => $inspecao['id'],
				'ponte_id' => $inspecao['ponte_id'],
				'data_inspecao' => $inspecao['data_inspecao'],
				'ponte_nome' => $inspecao['ponte_nome'],
				'tipo_inspecao' => $inspecao['tipo_inspecao']
			];
		}

		public function calcularIndiceValorSocial($inspecao){
			return $inspecao['nota_indice_localizacao'] + $inspecao['nota_indice_volume_trafego'] + $inspecao['nota_indice_largura_oae'];
		}

		public function calcularIndiceSaudeEstrutura($inspecao){
			$fatorSeguranca = $this->calcularFatorSeguranca($inspecao);
			$fatorConservacao = $this->calcularFatorConservacao($inspecao);
			$fatorImpacto = $this->calcularFatorImpacto($inspecao);
			return $fatorSeguranca + $fatorConservacao + $fatorImpacto;
		}

		private function calcularFatorSeguranca($inspecao){
			return $inspecao['nota_geometria_condicoes'] +
				   $inspecao['nota_acessos'] +
				   $inspecao['nota_cursos_agua'] +
				   $inspecao['nota_encontros_fundacoes'] +
				   $inspecao['nota_apoios_intermediarios'] +
				   $inspecao['nota_aparelhos_apoio'] +
				   $inspecao['nota_superestrutura'] +
				   $inspecao['nota_pista_rolamento'] +
				   $inspecao['nota_juntas_dilatacao'] +
				   $inspecao['nota_barreiras_guardacorpos'] +
				   $inspecao['nota_sinalizacao'] +
				   $inspecao['nota_instalacoes_util_publica'];
		}

		private function calcularFatorConservacao($inspecao){
			return $inspecao['nota_largura_plataforma'] +
				   $inspecao['nota_capacidade_carga'] +
				   $inspecao['nota_superficie_plataforma'] +
				   $inspecao['nota_pista_rolamento_fc'] +
				   $inspecao['nota_outros_fc'];
		}

		private function calcularFatorImpacto($inspecao){
			return $inspecao['nota_espaco_livre'] +
				   $inspecao['nota_localizacao_ponte'] +
				   $inspecao['nota_saude_fisica_ponte'] +
				   $inspecao['nota_outros_fi'];
		}
	}
?>