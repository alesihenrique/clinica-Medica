<?php

class PlanoSaude{

	private $razaoSocial;
	private $numCNPJ;
	private $endereco;
	private $telefone;
	private $medicos;

	function __construct($razaoSocial,$numCNPJ,$endereco,$telefone){
		$this->razaoSocial = $razaoSocial;
		$this->numCNPJ = $numCNPJ;
		$this->endereco = $endereco;
		$this->telefone = $telefone;
	}

	function getRazaoSocial(){
		return $this->razaoSocial;
	}

	function getEndereco(){
		return $this->endereco;
	}

	function getNumCNPJ(){
		return $this->numCNPJ;
	}

	function getTelefone(){
		return $this->telefone;
	}
}
?>