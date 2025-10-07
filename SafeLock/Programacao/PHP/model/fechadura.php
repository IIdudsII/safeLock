<?php
class Fechadura implements JsonSerializable{

	//atributos da classe
	private $codigo;
	private $nome;
	private $pin;
	private $cdUser;


	//metodo para gerar o json
	function jsonSerialize(){
		return 
		[
			'idFechadura' 	=> $this->codigo,
			'nome'	 	=> $this->nome,
			'pin'	 	=> $this->pin,
			'cdUser'	 	=> $this->cdUser
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
        $comandoSql = "insert into fechadura (nome, pin, idUser) values (?,?,?)";
        $valores = array($this->nome, $this->pin, $this->cdUser);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);

	}

	function atualizar(){
        $comandoSql = "update fechadura set nome = ?, pin = ?, idUser = ? where idFechadura = ?";
        $valores = array($this->nome, $this->pin, $this->cdUser, $this->codigo);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);
        }
    

	function excluir(){
        $comandoSql = "delete from fechadura where idFechadura = ?";
        $valores = array($this->codigo);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);
	}

	function consultar(){
        $comandoSql = "select * from fechadura";
        $exec = $this->con->prepare($comandoSql);
        $exec->execute();

        $dados = array();

	foreach ($exec->fetchAll() as $value) {
		$usu = new Fechadura;
		$usu->nome  		= $value["nome"];
		$usu->pin  		= $value["pin"];
		$usu->cdUser  		= $value["idUser"];
		$usu->codigo		= $value["idFechadura"];	
		$dados[] = $usu;		
		}
		return $dados;
	}

	function retornarDados(){
        $comandoSql = "select * from fechadura where idFechadura = ?";
        $valores = array($this->codigo);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);

        $value  = $exec->fetch();

        $usu = new Fechadura;

        $usu->nome 		= $value["nome"];
		$usu->pin  		= $value["pin"];
		$usu->cdUser  		= $value["idUser"];
        $usu->codigo		= $value["idFechadura"];
        return $usu;
	}

    function retornarDadosNome(){
        $comandoSql = "select * from fechadura where nome = ?";
        $valores = array($this->nome);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);

        $value  = $exec->fetch();

        $usu = new Fechadura;

        $usu->nome 		= $value["nome"];
		$usu->pin  		= $value["pin"];
		$usu->cdUser  		= $value["idUser"];
        $usu->codigo		= $value["idFechadura"];
        return $usu;
    }

	function verPin() {
        $comandoSql = "SELECT * FROM fechadura WHERE pin = :pin";
        $exec = $this->con->prepare($comandoSql);
        $exec->bindParam(":pin", $this->pin);
        $exec->execute();
        $verCad = $exec->fetch();
    
        if ($verCad) {
            echo 'PIN Existente';
        } else {
            echo 'PIN Inexistente';
        }
    }


	function consultarFecha(){
        $comandoSql = "select * from fechadura where idUser = ?";
		$valores = array($this->cdUser);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);
		$dados = array(); 

		$fechadura = $exec->fetchAll(PDO::FETCH_OBJ);
        return $fechadura;
	
	}

	function retornarFechadura(){   

        $comandoSql = "SELECT * FROM fechadura WHERE nome = :nome AND pin = :pin";
        $exec = $this->con->prepare($comandoSql);
        $exec->bindParam(":nome", $this->nome);
        $exec->bindParam(":pin", $this->pin);
        $exec->execute();
        $fechadura = $exec->fetch(PDO::FETCH_OBJ);
    
        return $fechadura;
    
	}

}
?>
