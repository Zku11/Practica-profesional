<?php
	class AccesoBD{
		private static $direccion="localhost";
		//Usar usuario de nivel bajo (no administrador)<<<<<<<<<<<<<<<<<<<<
		private static $usuario="id17772144_root"; //root
		private static $contrasena="bZfS[8#[Ur)6z=%"; //
		private static $nombreBd="id17772144_calculadorabd";//calculadorabd
		private static $enlace=false;

		//Devuelve siempre la misma conexión, si no existe se crea una.
		public static function Conexion(){
			if(self::$enlace==false){
				self::$enlace = new mysqli (self::$direccion, self::$usuario, self::$contrasena, self::$nombreBd);
				self::$enlace->set_charset("utf8");
				if (self::$enlace->connect_error) {
	    			die("Error de conexión: " . $conn->connect_error);
				}
			}
			return self::$enlace;
		}

		//Cierra la conexión si está abierta.
		public static function Desconexion(){
			if(self::$enlace!=false){
				self::$enlace->close();
				self::$enlace=false;
			}
		}
	}
?>