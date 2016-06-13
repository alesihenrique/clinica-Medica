<?php

class Paciente{
	
	private $nome;
	private $numCPF;
	private $endereco;
	private $telefone;
	private $medicos;

	function __construct($nome,$numCPF,$endereco,$telefone){
		$this->nome = $nome;
		$this->numCPF = $numCPF;
		$this->endereco = $endereco;
		$this->telefone = $telefone;
	}

	function getNome(){
		return $this->nome;
	}

	function getEndereco(){
		return $this->endereco;
	}

	function getNumCPF(){
		return $this->numCPF;
	}

	function getTelefone(){
		return $this->telefone;
	}
	

}
?>