<?php
	require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();
	$utils = new Utils();

	class ClientesService{
		public function getDadosClientesFormatados(){
			$conexao = new Conexao();
			$clientes = $conexao->executarQuery("SELECT * FROM clientes");
			return $this->formatarDadosClientes($clientes);
		}

		private function formatarDadosClientes($clientes){
			$utils = new Utils();
			foreach($clientes as $idCliente => $cliente){
				$clientes[$idCliente]['data_nascimento'] = $utils->formataData($cliente['data_nascimento']);
				$clientes[$idCliente]['telefone'] = $utils->formataTelefone($cliente['telefone']);
				$clientes[$idCliente]['cpf_cnpj'] = $utils->formataCpfCnpj($cliente['cpf_cnpj']);
			}
			
			return $clientes;
		}
	}
?>