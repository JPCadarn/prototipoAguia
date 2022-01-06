<?php
	class Conexao{
		
		private const serverNameTest = 'localhost';
		private const userNameTest = 'root';
		private const senhaTest = '';
		private const dbNameTest = 'aguia'; 
		
		private const serverName = 'localhost';
		private const userName = 'infras12_aguia';
		private const senha = 'Qz7Kg&fGdF55';
		private const dbName = 'infras12_infrasil'; 

		public function conectar(){
			try{
				if($_SERVER['MIBDIRS'] == 'C:/xampp/php/extras/mibs'){
					$conexao = new mysqli($this::serverNameTest, $this::userNameTest, $this::senhaTest, $this::dbNameTest);
				}else{
					$conexao = new mysqli($this::serverName, $this::userName, $this::senha, $this::dbName);
				}
				$conexao->autocommit(true);
				return $conexao;
			} catch(Exception $e){
				return false;
			}
		}

		public function desconectar($conexao){
			$conexao->close();
		}

		public function executarQuery($query){
			$conexao = $this->conectar();
				
			$retorno = [];
			$retorno = $conexao->query($query);
			
			if(is_object($retorno) OR is_array($retorno))
				$retorno = $retorno->fetch_all(MYSQLI_ASSOC);
			elseif(is_bool($retorno) AND !$retorno){
				$conexao->query("ROLLBACK");
				return $conexao->error;
			}elseif(is_bool($retorno)){
				$retorno = $conexao->insert_id;
			}

			$this->desconectar($conexao);
			
			return $retorno;
		}

		public function insert($tabela, $chaves, $valores){
			$query = "
				INSERT INTO $tabela
				($chaves)
				VALUES
				($valores)
			";
			return $this->executarQuery($query);
		}

		public function updateById($tabela, $id, $valores){
			$query = "
				UPDATE $tabela
				SET $valores
				WHERE id = $id
			";
			
			return $this->executarQuery($query);
		}
	}
?>