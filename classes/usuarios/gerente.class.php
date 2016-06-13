<?php
include_once 'usuario.class.php';

class Gerente extends Usuario{
	
	function __construct($login,$senha,$nome){
		parent::__construct($login,$senha,$nome);
	}

	function listarConsultas($data){
		return null;
	}
}
?>