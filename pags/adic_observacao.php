<?php
include_once '../classes/usuarios/medico.class.php';
include_once '../classes/plano_paciente/planoSaude.class.php';
include_once '../classes/db_conection_dao/clinica_dao.class.php';

//echo $_POST['tf_nome']."/".$_POST['tf_endereco']."/".$_POST['tf_crm']."/".$_POST['tf_login']."/".$_POST['tf_senha']."/".$_POST['especialidade']."/".$_POST['planos']."<br>";
$id = $_POST['tf_id'];
if($id != null and $_POST['tf_paciente'] != "" and $_POST['tf_data'] != "" and $_POST['tf_obs'] != "" and $_POST['cb_tipo'] != "" ){
	
	$medico = new Medico('','','','','','','',new PlanoSaude('','','',''),new Especialidade('',''));
	if($medico->registrarObservacao($_POST['cb_tipo'],$_POST['tf_obs'] ,$id)){
		header("Location: add_observacao.php?note=Observação adicionada com sucesso!&tipo=1&id=$id");
		exit();
	}else{
		header("Location: add_observacao.php?note=Erro ao adicionar observação&tipo=2&id=$id");
	    exit();
	}

}else{
	header("Location: add_observacao.php?note=Não deixe campos vazios!&tipo=3&id=$id");
	exit();
}
?>