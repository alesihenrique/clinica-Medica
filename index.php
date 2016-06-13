<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/mensagens.css">
	<title>Tela de Login</title>
</head>
<body background="img/fundo-main.jpg">

<div align="center" class="divContainer divLoginPainel">
<form id="form1" name="form1" method="post" action="logar.php">
	<p>
    <label for="login">ACESSO AO SISTEMA</label>
    </p>
  <p>
    <label for="login">LOGIN:</label>
    <input type="text" name="login" id="login" />
  </p>
  <p>
    <label for="senha">SENHA:</label>
    <input type="password" name="senha" id="senha" />
  </p>
  <p>USUÁRIO:</p>
  <p>
    <select name="tipo_usuario" id="tipo_usuario">
      <option value="0">ATENDENTE</option>
      <option value="1">MÉDICO</option>
      <option value="2">GERENTE</option>
      <option value="3">ADMINISTRADOR</option>
    </select>
  </p>
  <p>
    <input type="submit" name="entrar" id="entrar" value="ENTRAR" />
    <input type="reset" name="limpar" id="limpar" value="LIMPAR" />
  </p>
</form>
</div>
<?php
  if(@$_GET['note']){
    echo "<div align='center' class='ErroContainer msgErro'> <h3>".$_GET['note']."</h3> </div>";
  }
?>
</body>
</html>   