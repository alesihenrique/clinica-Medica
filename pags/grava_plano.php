<?php
include_once '../classes/usuarios/atendente.class.php';
include_once '../classes/plano_paciente/planoSaude.class.php';
include_once '../classes/db_conection_dao/clinica_dao.class.php';

$atend = new Atendente('','','');
if($_POST['tf_razao'] != "" and $_POST['tf_cnpj'] != "" and $_POST['tf_endereco'] != "" and $_POST['tf_telefone'] != ""){
	$plano = new PlanoSaude($_POST['tf_razao'],$_POST['tf_cnpj'],$_POST['tf_endereco'],$_POST['tf_telefone']);
	if($atend->cadastraPlano($plano)){
		header("Location: cadastro_plano.php?note=Novo Plano de Saúde Cadastrado!&tipo=1");
		exit();
	}else{
		header("Location: cadastro_plano.php?note=Erro ao cadastrar&tipo=2");
	    exit();
	}
}else{
	header("Location: cadastro_plano.php?note=Não deixe campos vazios!&tipo=3");
	exit();
}
?>