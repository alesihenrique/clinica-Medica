<?php
include_once '../classes/usuarios/atendente.class.php';
include_once '../classes/usuarios/medico.class.php';
include_once '../classes/plano_paciente/planoSaude.class.php';
include_once '../classes/db_conection_dao/clinica_dao.class.php';

$atend = new Atendente('','','');
//echo $_POST['tf_nome']."/".$_POST['tf_endereco']."/".$_POST['tf_crm']."/".$_POST['tf_login']."/".$_POST['tf_senha']."/".$_POST['especialidade']."/".$_POST['planos']."<br>";
if($_POST['tf_nome'] != "" and $_POST['tf_endereco'] != "" and $_POST['tf_crm'] != "" and $_POST['tf_login'] != "" and $_POST['tf_senha'] != "" and $_POST['especialidade'] != "" and $_POST['planos'] != "" and $_POST['tf_telefone'] != ""){
	$dias = $_POST['dias'];
	$diasAtend = "";
	for($i = 0; $i <(count($dias));$i++){
		$diasAtend .= $dias[$i];
	}
	$medico = new Medico($_POST['tf_nome'],$_POST['tf_login'],$_POST['tf_senha'],$_POST['tf_telefone'],$_POST['tf_crm'],$_POST['tf_endereco'],$diasAtend,new PlanoSaude($_POST['planos'],'','',''),new Especialidade('',$_POST['especialidade']));
	if($atend->cadastraMedico($medico)){
		header("Location: cadastro_medico.php?note=Novo Médico Cadastrado!&tipo=1");
		exit();
	}else{
		header("Location: cadastro_medico.php?note=Erro ao cadastrar&tipo=2");
	    exit();
	}

}else{
	header("Location: cadastro_medico.php?note=Não deixe campos vazios!&tipo=3");
	exit();
}
?>