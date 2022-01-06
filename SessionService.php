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
			return isset($_SESSION['userType']) ? $_SESSION['userType'] : '';
		}

		public static function getIdCliente(){
			self::iniciarSessao();
			return $_SESSION['idCliente'];
		}

		public static function validarLoginFeito(){
			self::iniciarSessao();
			if(!isset($_SESSION['userId'])){
				header('Location: index.php');
			}
		}

		public static function validarLoginFeitoEVisitante(){
			self::iniciarSessao();
			if(!isset($_SESSION['userId']) && $_SESSION['visitante'] === false){
				header('Location: index.php');
			}
		}

		public static function setVisitante($visitante){
			self::iniciarSessao();
			$_SESSION['visitante'] = $visitante;
		}

		public static function getVisitante(){
			self::iniciarSessao();
			return isset($_SESSION['visitante']) ? $_SESSION['visitante'] : false;
		}
	}
?>