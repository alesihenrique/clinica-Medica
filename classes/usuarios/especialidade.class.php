<?php
class Especialidade{
	
	private $codigo;
	private $nome;

	function __construct($codigo,$nome){
		$this->codigo = $codigo;
		$this->nome = $nome;
	}

	function getNome(){
		return $this->nome;
	}
}
?>