<?php

class ConnectionFactory{
	
	private static $server = 'localhost';
	private static $user = 'root';
	private static $pass = '';
	private static $database = 'clinica';

	private static $connetion;
	private static $connetion_base;

	//Contesto estático, deve conter variaveis estáticas
	static function getConnection(){
		try{
			self::$connetion = mysql_connect(self::$server,self::$user,self::$pass);
			self::$connetion_base  = mysql_select_db(self::$database,self::$connetion);
			//echo "Conecao estabelecida com sucesso!<br>";
			return self::$connetion;
		}catch(Exception $error){
			echo $excecao->getFile().": ".$excecao->getLine()." # ".$excecao->getMessage();
			return null;
		}
		return null;
	}
}

echo ConnectionFactory::getConnection();
?>