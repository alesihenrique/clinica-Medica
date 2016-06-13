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
<font face="Verdana, Geneva, sans-serif"><h2>SOBRE O SISTEMA:</h2>
<img src="../../CURSO_PHP/BASICO/imagens/tempo.png" width="260" height=" 300">
<br>
<p>Sistema de gerenciamento de informações da clínica <b>Pró-saúde</b>, desenvolvido por:<b> Alysson Gomes</b>(Possuie todos os direitos reservados), desenvolvido em Janeiro de 2015. Utilizando as seguintes linguagens de programação:<b> PHP, HTML, CSS</b>.Foram utilizados as seguintes ferramentas de desenvolvimento:<b>Adobe Dreamweaver CS6(Editor do HTML e CSS) e Sublime Text 2(Editor do PHP)</b>.</p></font>
<br>
<br>
<font face="Verdana, Geneva, sans-serif"><h2><center>Alysson Gomes soluções em informatica!</center><h2></font>

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