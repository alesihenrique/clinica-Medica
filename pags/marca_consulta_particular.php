<?php
include_once '../classes/usuarios/atendente.class.php';
include_once '../classes/usuarios/medico.class.php';
include_once '../classes/usuarios/especialidade.class.php';
include_once '../classes/plano_paciente/paciente.class.php';
include_once '../classes/plano_paciente/planoSaude.class.php';
include_once '../classes/db_conection_dao/clinica_dao.class.php';
include_once '../classes/consultas/consultaParticular.class.php';

$atend = new Atendente('','','');
if($_POST['cb_medico'] != "" and $_POST['cb_paciente'] != "" and $_POST['tf_valor'] != "" and $_POST['tf_data'] != "" and $_POST['tf_hora'] != ""){
	$data = explode('/',$_POST['tf_data']);
	$hora = explode(':',$_POST['tf_hora']);
	$valor = settype($_POST['tf_valor'],'double');
	if(count($data) == 3 and count($hora) == 2 and $valor){
		$medico = new Medico($_POST['cb_medico'],'','','','','','',new PlanoSaude('','','',''),new Especialidade('',''));
		$paciente = new Paciente($_POST['cb_paciente'],'','','');
		$consulta = new ConsultaParticular($medico,$paciente,$_POST['tf_data'],$_POST['tf_hora'],$_POST['tf_valor']);
		if($atend->marcarConsultaParticular($consulta)){
			header("Location: consulta_particular.php?note=Consulta Marcada com sucesso!&tipo=1");
			exit();
		}else{
			header("Location: consulta_particular.php?note=Erro ao marcar consulta(É possivel que o horario já esteja ocupado)&tipo=2");
		    exit();
		}
	}else{
		header("Location: consulta_particular.php?note=Verifique o formato da data/hora e valor(Ex.: 10/10/10,08:00,100.00)&tipo=3");
		exit();
	}
}else{
	header("Location: consulta_particular.php?note=Não deixe campos vazios!&tipo=3");
	exit();
}
?>