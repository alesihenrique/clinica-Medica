<?php
include_once 'usuario.class.php';
include_once 'medico.class.php';
include_once 'especialidade.class.php';

class Atendente extends Usuario{
	
	function __construct($login,$senha,$nome){
		parent::__construct($login,$senha,$nome);
	}

	function cadastraMedico(Medico $medico){
		return $this->conectUser->addMedico($medico);
	}

	function cadastraPaciente(Paciente $paciente){
		return $this->conectUser->addPaciente($paciente);
	}

	function cadastraPlano(PlanoSaude $plano){
		return $this->conectUser->addPlano($plano);
	}

	function marcarConsultaParticular(ConsultaParticular $consulta){
		return $this->conectUser->marcaConsultaParticular($consulta);
	}

	function marcarConsultaPlano(ConsultaPlano $consulta){
		return $this->conectUser->marcaConsultaPlano($consulta);
	}

	function verificarDisponibilidadeMedico(Medico $medico){
		return null;
	}

	function consultaPorEspecialidade(Especialidade $especialidade){
		return $this->conectUser->consultaMedicosEspecialidade($especialidade);
	}

	function consultaHoraDataEspecialidade(Especialidade $especialidade,$data,$hora){
		return $this->conectUser->consultaMedicosEspecialidadeDataHora($especialidade,$data,$hora);
	}
}
?>