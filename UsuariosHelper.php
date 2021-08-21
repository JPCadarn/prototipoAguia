<?php
	require_once('conexao.php');
	require_once('utils.php');

	class UsuariosHelper{
		public function validarChaveCliente($chave){
			$conexao = new Conexao();
			$chaveExiste = $conexao->executarQuery("SELECT id, chave FROM clientes WHERE chave = '$chave'");
			if(!empty($chaveExiste)){
				return ($chaveExiste[0]['chave'] == $chave);
			}else{
				return false;
			}
		}
	}
?>