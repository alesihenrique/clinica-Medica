<?php

class Usuario{

	protected $nome;
	protected $login;
	protected $senha;
	protected $conectUser;


	function __construct($login,$senha,$nome){
		$this->login = $login;
		$this->senha = $senha;
		$this->nome = $nome;
		$this->conectUser = new ClinicaDAO();
	}

	function logar($tipo){
		return $this->conectUser->logar($this,$tipo);
	}

	function getLogin(){
		return $this->login;
	}

	function getSenha(){
		return $this->senha;
	}

	function getNome(){
		return $this->nome;
	}

	function setNome($nome){
		$this->nome = $nome;
	}
}
/*
$user = new Usuario('aly','aly','Alysson');
echo $user->logar(3);
*/
?>
