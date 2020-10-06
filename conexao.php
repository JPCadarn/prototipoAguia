<?php
	class Conexao{
		const serverName = 'localhost';
		const userName = 'root';
		const senha = '';
		const dbName = 'aguia'; 

		function conectar(){
			try{
				$conexao = new mysqli($this::serverName, $this::userName, $this::senha, $this::dbName);
				$conexao->autocommit(true);
				return $conexao;
			} catch(Exception $e){
				return false;
			}
		}

		function desconectar($conexao){
			$conexao->close();
		}

		function executarQuery($query){
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
	}
?>