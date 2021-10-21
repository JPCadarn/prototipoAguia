<?php
	require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();

	class ClientesService{
		public function getDadosClientesFormatados(){
			$conexao = new Conexao();
			$clientes = $conexao->executarQuery("SELECT * FROM clientes");
			return $this->formatarDadosClientes($clientes);
		}

		private function formatarDadosClientes($clientes){
			foreach($clientes as $idCliente => $cliente){
				$clientes[$idCliente]['data_nascimento'] = Utils::formataData($cliente['data_nascimento']);
				$clientes[$idCliente]['telefone'] = Utils::formataTelefone($cliente['telefone']);
				$clientes[$idCliente]['cpf_cnpj'] = Utils::formataCpfCnpj($cliente['cpf_cnpj']);
				$clientes[$idCliente]['endereco'] = Utils::formataEnderecoCliente($cliente);
			}
			
			return $clientes;
		}
	}
?>