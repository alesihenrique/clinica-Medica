<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="stylesheet" type="text/css" href="../css/mensagens.css">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
	<title>Tela Principal</title>
</head>
<body topmargin="10">
<?php
include_once '../classes/db_conection_dao/clinica_dao.class.php';
include_once '../classes/usuarios/medico.class.php';
include_once '../classes/plano_paciente/planoSaude.class.php';
include_once '../classes/usuarios/especialidade.class.php';

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
<center><h3>CONSULTAS ANTERIORES</h3>
  <form id="form1" name="form1" method="post" action="<?php $PHP_SELF ?>">
    <label for="select">CRM:</label>
    <input type="text" name="tf_crm" id="textfield" />
<input type="submit" name="button" id="button" value="PROCURAR" />
  </form>
  <br>
<div align="center" style="width:650px; height: 260px; overflow: auto;">
<table border="0">
    <tr>
		<td width="70" height="20" align="center" valign="middle" bgcolor="#00CC99"><strong>ID</strong></td>    
   		<td width="150" align="center" valign="middle" bgcolor="#00CC99"><strong>PACIENTE</strong></td>
        <td width="120" align="center" valign="middle" bgcolor="#00CC99"><strong>DATA</strong></td>        
        <td width="120" align="center" valign="middle" bgcolor="#00CC99"><strong>HORA</strong></td>
        <td width="70" align="center" valign="middle" bgcolor="#00CC99"><strong>OBS:</strong></td>        
    </tr>
       <?php
        $medico = new Medico('','','','',@$_POST['tf_crm'],'','',new PlanoSaude('','','',''),new Especialidade('',''));
        $medicos = $medico->visualizarConsultas();
		if($medicos != null){
			foreach ($medicos as $e) {
				$campos = explode('@',$e);
      ?>
      <tr valign="middle">
        <td width="70" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $campos[0] ?></td>
        <td width="150" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $campos[1] ?></td>
        <td width="120" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $campos[2] ?></td>
         <td width="120" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $campos[3] ?></td>
         <td width="70" height="30" align="center" valign="middle" bgcolor="#FFFFFF"><a href="add_observacao.php?id=<? echo $campos[0] ?>"><img class="lk" src="../../CURSO_PHP/BASICO/imagens/Notes.png" /></a></td>
      </tr>
      <?php
	        }
		}else{
			echo "<td colspan='5' height='30' bgcolor='#FFFFFF' valign='middle'><div align='center'><strong>NÃO Á CONSULTAS ANTERIORES</strong></div></td>";
		}
      ?>
</table>
</div>
</center>
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