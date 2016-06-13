<?php
require_once 'conectionFactory.class.php';
/*require_once '../plano_paciente/planoSaude.class.php';*/

class ClinicaDAO{
	
	private $connection;

	function __construct(){
		$this->connection = ConnectionFactory::getConnection();
	}

	function logar(Usuario $user,$tipo){
		/* usuarios:
		0 - Atendente
		1 - Medico
		2 - gerente
		3 - Administrador
		*/
		$sql_select = "select * from usuario where nome = '".$user->getLogin()."' and senha = '".$user->getSenha()."' and tipo = ".$tipo;
		$resultset = mysql_query($sql_select,$this->connection);
        print($resultset);
		if(mysql_num_rows($resultset) != 0){
			while($registro = mysql_fetch_array($resultset)){
				$user->setNome($registro['nome_user']);
			}
			return true;
		}else{
			return false;
		}
	}

	function addPlano(PlanoSaude $plano){
		$sql_insert = "insert into plano_saude(razaoSocial,numCNPJ,endereco,telefone) values ('".$plano->getRazaoSocial()."','".$plano->getNumCNPJ()."','".$plano->getEndereco()."','".$plano->getTelefone()."')";
		$resultset = @mysql_query($sql_insert,$this->connection);	
		if($resultset){
			return true;
		}else{
			return false;
		}
	}

	function addPaciente(Paciente $paciente){
		$sql_insert = "insert into paciente(nome,numCPF,endereco,telefone) values ('".$paciente->getNome()."','".$paciente->getNumCPF()."','".$paciente->getEndereco()."','".$paciente->getTelefone()."')";
		$resultset = mysql_query($sql_insert,$this->connection);	
		var_dump($resultset);
		if($resultset){
			return true;
		}else{
			return false;
		}
	}

	function buscaEspe($especialidade) {
		$sql2 = "select * from especialidade where nome = '".$especialidade."'";
		$resultset = mysql_query($sql2,$this->connection);

		if(mysql_num_rows($resultset) != 0){
			while($registro = mysql_fetch_array($resultset)){
				$especialidades = $registro['idespeci'];		
			}
			return $especialidades;
		}else{
			return -1;
		}
	}

	function buscaIdMedIdPlano($nomeMedico,$razaoSocial) {
		$sql2 = "select idmedic from medico where nome = '".$nomeMedico."'";
		$sql1 = "select idplano from plano_saude where razaoSocial = '".$razaoSocial."'";
		$resultset = mysql_query($sql2,$this->connection);
		$resultset1 = mysql_query($sql1,$this->connection);

		if(mysql_num_rows($resultset) != 0 and mysql_num_rows($resultset1) != 0){
			while($registro = mysql_fetch_array($resultset) and $registro2 = mysql_fetch_array($resultset1)){
				$ids = $registro['idmedic']."/".$registro2['idplano'];		
			}
			return $ids;
		}else{
			return -1;
		}
	}

	function addMedico(Medico $medico){
		$insert_medico = "insert into medico(nome,telefone,numCRM,endereco,idespecialidade,dias) values ('"
			.$medico->getNome()."','"
			.$medico->getTelefone()."','"
			.$medico->getNumCRM()."','"
			.$medico->getEndereco()."','"
			.self::buscaEspe($medico->getEspecialidade()->getNome())."','"
			.$medico->getDiasAtend()."')";

		$resultset = mysql_query($insert_medico,$this->connection);

		$ids = explode('/', self::buscaIdMedIdPlano($medico->getNome(),$medico->getPlano()->getRazaoSocial()));
		$insert_plano = "insert into medico_plano(idmedic,idplano) values (".$ids[0].",".$ids[1].")";

		$insert_usuario = "insert into usuario(nome,senha,tipo,nome_user) values ('".$medico->getLogin()."','".$medico->getSenha()."',1,'".$medico->getNome()."')";

		echo $insert_plano."<br>";
		
		$resultset1 = mysql_query($insert_plano,$this->connection);
		$resultset2 = mysql_query($insert_usuario,$this->connection);

		if($resultset and $resultset1 and $resultset2){
			return true;
		}else{
			return false;
		}
	}

	function listaEspecialidades(){
		$sql_select = "select * from especialidade";
		$resultset = mysql_query($sql_select,$this->connection);

		if(mysql_num_rows($resultset) != 0){
			while($registro = mysql_fetch_array($resultset)){
				$especialidades[] = $registro['nome'];		
			}
			return $especialidades;
		}else{
			return null;
		}
	}

	function listaPlanos(){
		$sql_select = "select razaoSocial from plano_saude";
		$resultset = mysql_query($sql_select,$this->connection);

		if(mysql_num_rows($resultset) != 0){
			while($registro = mysql_fetch_array($resultset)){
				$planos[] = $registro['razaoSocial'];		
			}
			return $planos;
		}else{
			return null;
		}
	}

	function listaPacientes(){
		$sql_select = "select nome from paciente";
		$resultset = mysql_query($sql_select,$this->connection);

		if(mysql_num_rows($resultset) != 0){
			while($registro = mysql_fetch_array($resultset)){
				$pacientes[] = $registro['nome'];		
			}
			return $pacientes;
		}else{
			return null;
		}
	}

	function listaMedicos(){
		$sql_select = "select nome from medico";
		$resultset = mysql_query($sql_select,$this->connection);

		if(mysql_num_rows($resultset) != 0){
			while($registro = mysql_fetch_array($resultset)){
				$medicos[] = $registro['nome'];		
			}
			return $medicos;
		}else{
			return null;
		}
	}

	function consultaMedicosEspecialidade(Especialidade $especialidade){
		$sql_select = "select * from medico where idespecialidade = ".self::buscaEspe($especialidade->getNome());
		$resultset = mysql_query($sql_select,$this->connection);
		if(mysql_num_rows($resultset) != 0){
			while($registro = mysql_fetch_array($resultset)){
				$medicos[] = $registro['nome']."/".$registro['telefone']."/".$registro['numCRM'];		
			}
			return $medicos;
		}else{
			return null;
		}
	}

	function consultaMedicosEspecialidadeDataHora(Especialidade $especialidade,$data,$hora){
		$sql_select1 = "select * from consulta_particular_plano where data = '".$data."' and hora = '".$hora."'";
		$resultset_consultas = mysql_query($sql_select1,$this->connection);

		$d = explode('/', $data);
		$mes = settype($d[1], 'int');
		$dia = settype($d[0], 'int');
		$d[2] = "20".$d[2];
		$ano = settype($d[2], 'int');
		$data_teste = mktime(0,0,0,$mes,$dia,$ano);
		$dia_semana = date("w",$data_teste);//retornando o dia da semana
		$sql_select = "select * from medico where idespecialidade = ".self::buscaEspe($especialidade->getNome());
		$resultset_medicos = mysql_query($sql_select,$this->connection);

		if(mysql_num_rows($resultset_consultas) != 0 ){
			while ($registro1 = mysql_fetch_array($resultset_consultas)){
				while($registro = mysql_fetch_array($resultset_medicos)){
					$dias_medico = $registro['dias'];
					if( $registro1['medico'] != $registro['nome'] and substr_count($dias_medico, $dia_semana) != 0){
						$medicos[] = $registro['nome']."/".$registro['telefone']."/".$registro['numCRM'];
					}		
				}
			}
			return $medicos;
		}else{
			while($registro = mysql_fetch_array($resultset_medicos)){
				$dias_medico = $registro['dias'];
				if(substr_count($dias_medico, $dia_semana) != 0){
					$medicos[] = $registro['nome']."/".$registro['telefone']."/".$registro['numCRM'];

				}		
			}
			return $medicos;
		}
		return null;
	}

	function verificaConsulta(Consulta $consulta){
		$sql_select = "select * from consulta_particular_plano where data ='".$consulta->getDataConsulta()."' and hora = '".$consulta->getHorario()."' and medico = '".$consulta->getMedico()->getNome()."'";
		$resultset = mysql_query($sql_select,$this->connection);
		if(mysql_num_rows($resultset) != 0){
			return false;
		}else{
			return true;
		}
	}

	function marcaConsultaParticular(ConsultaParticular $consulta){
		$sql_insert = "insert into consulta_particular_plano(paciente,medico,data,hora,valor) values ('".$consulta->getPaciente()->getNome()."','".$consulta->getMedico()->getNome()."','".$consulta->getDataConsulta()."','".$consulta->getHorario()."',".$consulta->getValorConsulta().")";
		if(self::verificaConsulta($consulta)){
			$resultset = mysql_query($sql_insert,$this->connection);
			if($resultset){
				return true;
			}else{
				return false;
			}
		}
		return false;
	}

	function marcaConsultaPlano(ConsultaPlano $consulta){
		$sql_insert = "insert into consulta_particular_plano(paciente,medico,data,hora,plano) values ('".$consulta->getPaciente()->getNome()."','".$consulta->getMedico()->getNome()."','".$consulta->getDataConsulta()."','".$consulta->getHorario()."','".$consulta->getPlano()->getRazaoSocial()."')";
		//echo $sql_insert."<br>";
		if(self::verificaConsulta($consulta)){
			$resultset = mysql_query($sql_insert,$this->connection);
			//echo $resultset."<br>";
			if($resultset){
				return true;
			}else{
				return false;
			}
		}
		return false;
	}
	
	function consultasDoDia($dia,$tipo){
		$sql_select = "select * from consulta_particular_plano where data = '".$dia."'";
		if($tipo == 1){
			$sql_select .= " and valor > 0";
		}else if($tipo == 2){
			$sql_select .= " and plano != '' ";
		}
		$resultset = mysql_query($sql_select,$this->connection);
		if(mysql_num_rows($resultset) != 0){
			while($registro = mysql_fetch_array($resultset)){
				$consultas[] = $registro['paciente']."@".$registro['medico']."@".$registro['data']."@".$registro['hora'];		
			}
			return $consultas;
		}else{
			return null;
		}
	}

	function buscaMedico($crm) {
		$sql2 = "select nome from medico where numCRM = '".$crm."'";
		$resultset = mysql_query($sql2,$this->connection);

		if(mysql_num_rows($resultset) != 0){
			while($registro = mysql_fetch_array($resultset)){
				$medico = $registro['nome'];		
			}
			return $medico;
		}else{
			return "";
		}
	}

	function visualizaConsultasAnteriores($crm){
		$sql_select = "select * from consulta_particular_plano where medico = '".self::buscaMedico($crm)."'";
		$resultset = mysql_query($sql_select,$this->connection);
		if(mysql_num_rows($resultset) != 0){
			while($registro = mysql_fetch_array($resultset)){
				$consultas[] = $registro['idconsulta']."@".$registro['paciente']."@".$registro['data']."@".$registro['hora'];		
			}
			return $consultas;
		}else{
			return null;
		}
	}

	function mostraConsulta($idconsulta){
		$sql_select = "select * from consulta_particular_plano where idconsulta = ".$idconsulta;
		$resultset = mysql_query($sql_select,$this->connection);
		if(mysql_num_rows($resultset) != 0){
			while($registro = mysql_fetch_array($resultset)){
				$consulta = $registro['idconsulta']."@".$registro['paciente']."@".$registro['data']."@".$registro['observacao']."@".$registro['tipoObservacao'];		
			}
			return $consulta;
		}else{
			return null;
		}	
	}

	function addObservacao($observacao,$tipo,$idconsulta){
		$sql_update = "update consulta_particular_plano set observacao = '".$observacao."' , tipoObservacao = '".$tipo."' where idconsulta = ".$idconsulta;	
		$resultset = mysql_query($sql_update,$this->connection);
			if($resultset){
				return true;
			}
			return false;
	}
	
}
/*
$dao = new ClinicaDAO();
echo $dao->buscaEspe('Educador Fisico');*/
?>