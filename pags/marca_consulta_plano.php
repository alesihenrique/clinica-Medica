<?php
include_once '../classes/usuarios/atendente.class.php';
include_once '../classes/usuarios/medico.class.php';
include_once '../classes/usuarios/especialidade.class.php';
include_once '../classes/plano_paciente/paciente.class.php';
include_once '../classes/plano_paciente/planoSaude.class.php';
include_once '../classes/db_conection_dao/clinica_dao.class.php';
include_once '../classes/consultas/consultaPlano.class.php';

$atend = new Atendente('','','');
if($_POST['cb_medico'] != "" and $_POST['cb_paciente'] != "" and $_POST['cb_plano'] != "" and $_POST['tf_data'] != "" and $_POST['tf_hora'] != ""){
	$data = explode('/',$_POST['tf_data']);
	$hora = explode(':',$_POST['tf_hora']);
	if(count($data) == 3 and count($hora) == 2){
		$plano = new PlanoSaude($_POST['cb_plano'],'','','');
		$medico = new Medico($_POST['cb_medico'],'','','','','','',$plano,new Especialidade('',''));
		$paciente = new Paciente($_POST['cb_paciente'],'','','');

		$consulta = new ConsultaPlano($plano,$medico,$paciente,$_POST['tf_data'],$_POST['tf_hora']);
		//echo $atend->marcarConsultaPlano($consulta);
		if($atend->marcarConsultaPlano($consulta)){
			header("Location: consulta_plano.php?note=Consulta Marcada com sucesso!&tipo=1");
			exit();
		}else{
			header("Location: consulta_plano.php?note=Erro ao marcar consulta(É possivel que o horario já esteja ocupado)&tipo=2");
		    exit();
		}
	}else{
		header("Location: consulta_plano.php?note=Verifique o formato da data/hora(Ex.: 10/10/10,08:00)&tipo=3");
		exit();
	}
}else{
	header("Location: consulta_plano.php?note=Não deixe campos vazios!&tipo=3");
	exit();
}
?>