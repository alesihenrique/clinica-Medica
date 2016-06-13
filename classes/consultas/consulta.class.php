<?php

abstract class Consulta{
	
	protected $dataConsulta;
	protected $horario;
	protected $queixas_pacientes;
	protected $prescricoes_exames;
	protected $resultados_exames_respostas_tratamentos;
	protected $plano;
	protected $medico;
	protected $paciente;

	function __construct(Medico $medico,Paciente $paciente,$dataConsulta,$horario){
		$this->dataConsulta = $dataConsulta;
		$this->horario = $horario;	
		$this->medico = $medico;
		$this->paciente = $paciente;
	}

	function efetuarPagamento(){
		return false;
	}

	function getDataConsulta(){
		return $this->dataConsulta;
	}

	function getHorario(){
		return $this->horario;
	}

	function getQueixasPacientes(){
		return $this->queixas_pacientes;
	}

	function getPrescricoesExames(){
		return $this->prescricoes_exames;
	}

	function getResultados(){
		return $this->resultados_exames_respostas_tratamentos;
	}

	function getPlano(){
		return $this->plano;
	}

	function getMedico(){
		return $this->medico;
	}

	function getPaciente(){
		return $this->paciente;
	}

}
?>