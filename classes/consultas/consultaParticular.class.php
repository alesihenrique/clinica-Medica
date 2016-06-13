<?php
include_once 'consulta.class.php';

class ConsultaParticular extends Consulta{
	
	private $valor_consulta;

	function __construct(Medico $medico,Paciente $paciente,$dataConsulta,$horario,$valor_consulta){
		parent::__construct($medico,$paciente,$dataConsulta,$horario);
		$this->valor_consulta = $valor_consulta;
	}

	function getValorConsulta(){
		return $this->valor_consulta;
	}
}
?>