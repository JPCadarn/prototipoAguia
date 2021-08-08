<?php

    class RankeamentoService{
        const ALFA1 = 0.4;
        const ALFA2 = 0.6;

        private $dados;

        public function __construct($dados){
            $this->dados = $dados;
        }

        public function calcularIMP(){
            $indiceValorSocial = $this->calcularIndiceValorSocial();
            $indiceSaudeEstrutura = $this->calcularIndiceSaudeEstrutura();
            return self::ALFA1 * $indiceValorSocial + self::ALFA2 * $indiceSaudeEstrutura;
        }

        public function calcularIndiceValorSocial(){
            return $indiceLocalizao + $indiceLargura + $indiceVolumeTrafego;
        }

        private function calcularIndiceLocalizao(){
            //ToDo implementar
        }

		private function calcularIndicelargura(){
            //ToDo implementar
        }

		private function calcularIndiceVolumeTrafego(){
            //ToDo implementar
        }

		public function calcularIndiceSaudeEstrutura(){
			$fatorSeguranca = $this->calcularFatorSeguranca();
			$fatorConservacao = $this->calcularFatorConservacao();
			$fatorImpacto = $this->calcularFatorImpacto();
			return $fatorSeguranca + $fatorConservacao + $fatorImpacto;
		}

		private function calcularFatorSeguranca(){
			//ToDo implementar
		}

		private function calcularFatorConservacao(){
			//ToDo implementar
		}

		private function calcularFatorImpacto(){
			//ToDo implementar
		}
    }
?>