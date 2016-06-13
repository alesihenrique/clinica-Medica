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
<center><h3>MARCAR CONSULTA PARTICULAR</h3></center>
  <form id="form1" name="form1" method="post" action="marca_consulta_particular.php">
    <p>
      <label for="cb_medico">MÉDICO:</label>
      <select name="cb_medico" id="cb_medico">
       <?php
        $dao = new ClinicaDAO();
        $med = $dao->listaMedicos();
        foreach ($med as $e) {
      ?>
        <option value="<?php echo $e ?>"><?php echo $e ?></option>
      <?php
        }
      ?>
      </select>
      <label for="cb_paciente">PACIENTE:</label>
      <select name="cb_paciente" id="cb_paciente">
       <?php
        $dao = new ClinicaDAO();
        $paci = $dao->listaPacientes();
        foreach ($paci as $e) {
      ?>
        <option value="<?php echo $e ?>"><?php echo $e ?></option>
      <?php
        }
      ?>
      </select>
    </p>
    <p>&nbsp;</p>
    <p>
      <label for="tf_hora">HORA:</label>
      <input name="tf_hora" type="text" id="tf_hora" maxlength="5" />
      <label for="tf_data">DATA:</label>
      <input name="tf_data" type="text" id="tf_data" maxlength="8" />
    </p>
    <p>&nbsp;</p>
    <p>
      <label for="tf_valor">VALOR:</label>
      <input type="text" name="tf_valor" id="tf_valor" />
    </p>
    <p>&nbsp;</p>
    <p>
      <input type="submit" name="button" id="button" value="MARCAR CONSULTA" />
      <input type="reset" name="button2" id="button2" value="LIMPAR" />
    </p>
  </form>
  <br>
  <?php
  if(@$_GET['note']){
		if($_GET['tipo'] == 1){
    		echo "<div align='center' class='ConfirmaContainerCon msgConfirmaCon'> <h3>".$_GET['note']."</h3> </div>";
		}else if ($_GET['tipo'] == 2) {
			echo "<div align='center' class='ErroContainerCon msgErroCon'> <h3>".$_GET['note']."</h3> </div>";
		}else{
			echo "<div align='center' class='AtencaoContainerCon msgAtencaoCon'> <h3>".$_GET['note']."</h3> </div>";
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