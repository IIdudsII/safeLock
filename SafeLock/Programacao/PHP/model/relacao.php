<?php
class Relacao implements JsonSerializable{

	//atributos da classe
	private $codUser;
	private $codFecha;
	private $estado;



	//metodo para gerar o json
	function jsonSerialize(){
		return 
		[
            'idRelacao' => $this->codigo,
			'codUser' 	=> $this->codUser,
			'codFecha'	 	=> $this->codFecha,
			'estado'	 => $this->estado,

		];
	}

	//Metodos Get e Set
	function __get($atributo){
		return $this->$atributo;
	}

	function __set($atributo, $value){
		$this->$atributo = $value;
	}

	//acessar o banco de dados
	private $con;
	function __construct(){
		include_once("conexao.php");
		$classe_con = new Conexao();
		$this->con = $classe_con->Conectar();
	}

	
	function cadastrar(){
        $comandoSql = "insert into usuFechadura (codUser, codFechadura, estado) values (?,?,?)";
        $valores = array($this->codUser, $this->codFecha, $this->estado);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);
	}

	function atualizar(){
        $comandoSql = "update usuFechadura set codUser = ?, codFechadura = ?, estado = ? where idRelacao = ?";
        $valores = array($this->codUser, $this->codFecha, $this->estado, $this->codigo);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);
        }
    

	function excluir(){
        $comandoSql = "delete from usuFechadura where idRelacao = ?";
        $valores = array($this->codigo);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);
	}

	function consultar(){
        $comandoSql = "select * from usuFechadura";
        $exec = $this->con->prepare($comandoSql);
        $exec->execute();

        $dados = array();

	foreach ($exec->fetchAll() as $value) {
		$rel = new Relacao;
		$rel->codUser 		= $value["codUser"];
        $rel->codFecha  	= $value["codFechadura"];
		$rel->estado	= $value["estado"];
		$rel->codigo		= $value["idRelacao"];	
		$dados[] = $rel;		
		}
		return $dados;
	}

	function obterUltimoEstadoFechadura($codigo_fechadura) {
        $comandoSql = "SELECT estado FROM usufechadura WHERE codFechadura = ? ORDER BY idRelacao DESC LIMIT 1";

        $valores = array($codigo_fechadura);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);

        $value = $exec->fetch();

        if ($value) {
            return $value["estado"];
        } else {
            return false;
        }
    }

	function retornarDados(){
        $comandoSql = "select * from usuFechadura where idRelacao = ?";
        $valores = array($this->codigo);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);

        $value  = $exec->fetch();

        $rel = new Relacao;

		$rel->codUser 		= $value["codUser"];
        $rel->codFecha  	= $value["codFechadura"];
		$rel->estado	= $value["estado"];
		$rel->codigo		= $value["idRelacao"];	
        return $rel;
	}

	function consultarRel(){
        $comandoSql = "select REPLACE(REPLACE(estado,'1','Aberta'),'0','Fechada') as estado,DATE_FORMAT(horario,'%d/%m/%Y') as data, DATE_FORMAT(horario,'%H:%i') as horario from usufechadura where codFechadura = ?";
		$valores = array($this->codFechadura);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);
		$dados = array(); 

		$relacao = $exec->fetchAll(PDO::FETCH_OBJ);
        return $relacao;
	
	}


	function verCadStat(){
    
	
			$con = mysqli_connect("localhost", "root", "", "bdatualizado");
			$sql = mysqli_query($con, " ") or print mysql_error();
		
			if(mysqli_num_rows($sql)>0) 
				echo ('Fechado'); 
			else 
				echo ('Aberto'); 
		}

	}


	



?>
