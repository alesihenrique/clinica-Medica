<?php
include_once 'consulta.class.php';

class ConsultaPlano extends Consulta{

	function __construct(PlanoSaude $plano,Medico $medico,Paciente $paciente,$dataConsulta,$horario){
		parent::__construct($medico,$paciente,$dataConsulta,$horario);
		$this->plano = $plano;
	}
}
?>