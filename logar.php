<?php
include_once 'classes/usuarios/usuario.class.php';
include_once 'classes/db_conection_dao/clinica_dao.class.php';

$user = new Usuario($_POST['login'],$_POST['senha'],'');
$tipo = $_POST['tipo_usuario'];

if($user->logar($tipo)){
	setcookie("user",$user->getNome());
	setcookie("tipo",$tipo);
	header("Location: principal.php?tipo=$tipo");
	exit();
}else{
	header("Location: index.php?note=Login ou senha inválidos!");
    exit();
}
?>