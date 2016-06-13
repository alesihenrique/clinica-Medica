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
include_once '../classes/db_conection_dao/clinica_dao.class.php';

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
<center><h3>VISUALIZAR CONSULTAS DIÁRIAS</h3>
<form id="form1" name="form1" method="post" action="<?php $PHP_SELF ?>">
  <label for="tf_dia">INFORME O DIA:</label>
  <input name="tf_dia" type="text" id="tf_dia" maxlength="8" />
  <label for="cb_tipo">TIPO:</label>
  <select name="cb_tipo" id="cb_tipo">
    <option value="1">Particular</option>
    <option value="2">Por Plano de Saude</option>
    <option value="3">Todas</option>
  </select>
  <input type="submit" name="button" id="button" value="PROCURAR" />

</center>
<p>&nbsp;</p>

<br>
<div align="center" >
<table border="0">
    <tr>
		<td width="250" height="20" align="center" valign="middle" bgcolor="#00CC99"><strong>PACIENTE</strong></td>    
   		<td width="250" align="center" valign="middle" bgcolor="#00CC99"><strong>MEDICO</strong></td>
        <td width="80" align="center" valign="middle" bgcolor="#00CC99"><strong>DATA</strong></td>        
        <td width="80" align="center" valign="middle" bgcolor="#00CC99"><strong>HORA</strong></td>        
    </tr>
       <?php
	    $dao = new ClinicaDAO();
        $consultas = @$dao->consultasDoDia($_POST['tf_dia'],$_POST['cb_tipo']);
		//var_dump($consultas);
		if($consultas != null){
			foreach ($consultas as $e) {
				$campos = explode('@',$e);
      ?>
      <tr>
        <td width="250" height="20" align="center" bgcolor="#FFFFFF"><?php echo $campos[0] ?></td>
        <td width="250" align="center" bgcolor="#FFFFFF"><?php echo $campos[1] ?></td>
        <td width="80" align="center" bgcolor="#FFFFFF"><?php echo $campos[2] ?></td>
        <td width="80" align="center" bgcolor="#FFFFFF"><?php echo $campos[3] ?></td>
      </tr>
      <?php
	        }
		}else{
			echo "<td colspan='4' bgcolor='#FFFFFF'><div align='center'><strong>NÃO Á CONSULTAS NESTE DIA</strong></div>      <div align='center'></div></td>";
		}
      ?>
</table>
</form>
</div>
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