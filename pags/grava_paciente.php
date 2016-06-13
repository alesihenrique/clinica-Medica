<?php
include_once '../classes/usuarios/atendente.class.php';
include_once '../classes/plano_paciente/paciente.class.php';
include_once '../classes/db_conection_dao/clinica_dao.class.php';

$atend = new Atendente('','','');
if($_POST['tf_nome'] != "" and $_POST['tf_endereco'] != "" and $_POST['tf_cpf'] != "" and $_POST['tf_telefone'] != ""){
	$paciente = new Paciente($_POST['tf_nome'],$_POST['tf_cpf'],$_POST['tf_endereco'],$_POST['tf_telefone']);
	if($atend->cadastraPaciente($paciente)){
		header("Location: cadastro_paciente.php?note=Novo Paciente Cadastrado!&tipo=1");
		exit();
	}else{
		header("Location: cadastro_paciente.php?note=Erro ao cadastrar&tipo=2");
	    exit();
	}
}else{
	header("Location: cadastro_paciente.php?note=Não deixe campos vazios!&tipo=3");
	exit();
}
?>