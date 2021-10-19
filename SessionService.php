<?php
	class SessionService{
		private static function iniciarSessao(){
			if(session_status() <> PHP_SESSION_ACTIVE){
				session_start();
			}
		}

		public static function getUserId(){
			self::iniciarSessao();
			return $_SESSION['userId'];
		}

		public static function getUserType(){
			self::iniciarSessao();
			return $_SESSION['userType'];
		}

		public static function getIdCliente(){
			self::iniciarSessao();
			return $_SESSION['idCliente'];
		}
	}
?>