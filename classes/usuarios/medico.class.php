<?php
include_once 'usuario.class.php';
include_once 'especialidade.class.php';

class Medico extends Usuario{
	
	private $telefone;
	private $numCRM;
	private $endereco;
	private $diasAtend;
	private $especialidade;
	private $plano;
	private $consultas;

	function __construct($nome,$login,$senha,$telefone,$numCRM,$endereco,$diasAtend,PlanoSaude $plano, Especialidade $especialidade){
		parent::__construct($login,$senha,$nome);
		$this->telefone = $telefone;
		$this->numCRM = $numCRM;
		$this->endereco = $endereco;
		$this->diasAtend = $diasAtend;
		$this->especialidade = $especialidade;
		$this->plano = $plano;
	}

	function registrarObservacao($tipoObservacao,$obs,$idconsulta){
		return $this->conectUser->addObservacao($obs,$tipoObservacao,$idconsulta);
	}

	function visualizarObservacoes($tipoObservacao){
		return "";
	}

	function visualizarConsultas(){
		return $this->conectUser->visualizaConsultasAnteriores($this->numCRM);
	}

	function getTelefone(){
		return $this->telefone;
	}

	function getEndereco(){
		return $this->endereco;
	}

	function getNumCRM(){
		return $this->numCRM;
	}

	function getDiasAtend(){
		return $this->diasAtend;
	}

	function getEspecialidade(){
		return $this->especialidade;
	}

	function getPlano(){
		return $this->plano;
	}
	
}
?>