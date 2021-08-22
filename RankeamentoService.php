<?php

    class RankeamentoService{
        const ALFA1 = 0.4;
        const ALFA2 = 0.6;

        private $inspecoes;

        public function __construct($inspecoes){
            $this->inspecoes = $inspecoes;
        }

        public function renderDash(){
            $imps = [];
            foreach($this->inspecoes as $inspecao){
                $imps[$inspecao['ponte_id']] = $this->calcularIMP($inspecao);
            }
            echo "<div class='row col s12 m6'>";
            echo "
            <table class='striped centered responsive-table'>
                <thead>
                    <tr>
                        <th>ID Inspeção</th>
                        <th>Ponte</th>
                        <th>Data de Inspeção</th>
                        <th>IVS</th>
                        <th>ISE</th>
                        <th>IMP</th>
                    </tr>
                </thead>
            
            <tbody>";
            foreach($imps as $inspecao){
                echo "<tr>";
                echo "<td>".$inspecao['id']."</td>";
                echo "<td>".$inspecao['descricao']."</td>";
                echo "<td>".Utils::formataData($inspecao['data_inspecao'])."</td>";
                echo "<td>".$inspecao['ivs']."</td>";
                echo "<td>".$inspecao['ise']."</td>";
                echo "<td>".$inspecao['imp']."</td>";
                echo "</td>";
            }
            echo "</tbody>
            </table>
            ";
            echo "<div>";
        }

        public function calcularIMP($inspecao){
            $indiceValorSocial = $this->calcularIndiceValorSocial($inspecao);
            $indiceSaudeEstrutura = $this->calcularIndiceSaudeEstrutura($inspecao);
            $imp = self::ALFA1 * $indiceValorSocial + self::ALFA2 * $indiceSaudeEstrutura;
            return [
                'ivs' => $indiceValorSocial, 
                'ise' => $indiceSaudeEstrutura, 
                'imp' => $imp,
                'descricao' => substr($inspecao['descricao'], 0, 50),
                'id' => $inspecao['id'],
                'data_inspecao' => $inspecao['data_inspecao']
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