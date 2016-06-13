<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="stylesheet" type="text/css" href="../css/mensagens.css">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
	<title>Tela Principal</title>
</head>
<body>
<?php
	$user = $_COOKIE['user'];
	$tipo = @$_COOKIE['tipo'];
	switch($tipo){
		case 0: $tipo = 'atendente'; break;
		case 1: $tipo = 'médico';break;
		case 2: $tipo = 'gerente';break;
		case 3: $tipo = 'administrador';break;
	}
	if($user != null){
?>
<div class="ContainerTop PainelTop"> 
<br>
<a href="../logoff.php">[SAIR]</a>
<h3>SISTEMA DE GERENCIAMENTO: CLÍNICA PRÓ-SAÚDE</h3>
<h4>BEM-VINDO(a) <?php echo $tipo."(a) ".$user ?></h4>
</div>
	<section class="PainelMenu">
		<h2><center>MENU</center></h2>
	<nav>
			<ul>
				<li><a href="../principal.php">HOME</a></li>
				<li><a href="#">CADASTROS</a>
                    <ul>
                        <li><a href="cadastro_plano.php">PLANOS DE SAÚDE</a></li>
                        <li><a href="cadastro_medico.php">MÉDICOS</a></li>
                        <li><a href="cadastro_paciente.php">PACIENTES</a></li>
                    </ul>
                </li>
                 <?
                if($tipo != 'atendente' and $tipo != 'médico' ){
				?>
				<li><a href="#">CONSULTAS</a>
                	<ul>
                        <li><a href="consultas_diarias.php">CONSULTAS DIÁRIAS</a></li>
                    </ul>
                </li>
                <? } ?>
                <li><a href="#">MARCAR CONSULTA</a>
                    <ul>
                        <li><a href="consulta_particular.php">CONSULTA PARTICULAR</a></li>
                        <li><a href="consulta_plano.php">CONSULTA POR PLANO</a></li>
                    </ul>
                </li>
				<li><a href="#">DISP. MÉDICA</a>
                	<ul>
                        <li><a href="disp_por_espec.php">POR ESPECIALIDADE</a></li>
                        <li><a href="disp_por_hora_espec.php">POR HORARIO/ESPEC.</a></li>
                    </ul>
                </li>
                 <?
                if($tipo == 'médico' or  $tipo == 'administrador'){
				?>
				 <li><a href="#">OBSERVAÇÕES</a>
                	<ul>
                        <li><a href="visualiza_consulta_anterior.php">VISUALIZAR CONS.</a></li>
                    </ul>
                </li>
                <? } ?>
				<li><a href="sobre.php">SOBRE</a></li>
			</ul>
		</nav>
	</section>
<div class="ContainerPrincipal PainelPrincipal">
<font face="Verdana, Geneva, sans-serif">
<h2>CADASTRO DE PACIENTES</h2>
</font>

<form id="form1" name="form1" method="post" action="grava_paciente.php">
  <p>
    <label for="tf_nome">NOME:</label>
    <input name="tf_nome" type="text" id="tf_nome" maxlength="25" />
    <label for="tf_endereco">ENDEREÇO:</label>
    <input name="tf_endereco" type="text" id="tf_endereco" size="40" maxlength="11" />
  </p>
  <p>&nbsp;</p>
  <p>
    <label for="tf_cpf">CPF:</label>
    <input name="tf_cpf" type="text" id="tf_cpf" maxlength="11" />
    <label for="tf_telefone">TELEFONE:</label>
    <input name="tf_telefone" type="text" id="tf_telefone" maxlength="25" />
  </p>
  <p>&nbsp;</p>
  <p>
    <input type="submit" name="bt_cadastro" id="bt_cadastro" value="CADASTRAR" />
    <input type="reset" name="button" id="button" value="LIMPAR" />
</p>
  <p>&nbsp;</p>
</form>
<?php
	if(@$_GET['note']){
		if($_GET['tipo'] == 1){
    		echo "<div align='center' class='ConfirmaContainer msgConfirma'> <h3>".$_GET['note']."</h3> </div>";
		}else if ($_GET['tipo'] == 2) {
			echo "<div align='center' class='ErroContainer2 msgErro2'> <h3>".$_GET['note']."</h3> </div>";
		}else{
			echo "<div align='center' class='AtencaoContainer msgAtencao'> <h3>".$_GET['note']."</h3> </div>";
		}
	}
?>
</div>
<div class="ContainerRodape PainelRodape">
	<br>
	<font face="Verdana, Geneva, sans-serif" color="#FFFFFF"><h1>Todos Direitos reservados ©</h1></font>
	<ul class="social">
		<li><a href="https://www.facebook.com/alysson.gomesdesousa" target="_blank">Facebook</a></li>
		<li><a href="http://instagram.com/alyssonasn" target="_blank">Instagram</a></li>
		<li><a href="https://plus.google.com/u/0/+AlyssonGomesdeSousa/about" target="_blank">Google+</a></li>
	</ul>
</div>
<?php
	}else{
		header("Location: ../index.php?note=Efetue o login para ter acesso!");
		exit();
	}
?>
</body>