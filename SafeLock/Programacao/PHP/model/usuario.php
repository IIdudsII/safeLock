<?php
class Usuario implements JsonSerializable{

	//atributos da classe
	private $codigo;
	private $nome;
	private $cpf;
	private $senha;


	//metodo para gerar o json
	function jsonSerialize(){
		return 
		[
			'idUser' 	=> $this->codigo,
			'nome'	 	=> $this->nome,
			'cpf'	 => $this->cpf,
			'senha' 	=> $this->senha,
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
        $comandoSql = "insert into usuario (nome, cpf, senha) values (?,?,?)";
        $valores = array($this->nome, $this->cpf, $this->senha);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);
	}

	function atualizar(){
        $comandoSql = "update usuario set nome = ?, cpf = ?, senha = ? where idUser = ?";
        $valores = array($this->nome, $this->cpf, $this->senha, $this->codigo);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);
        }
    

	function excluir(){
        $comandoSql = "delete from usuario where idUser = ?";
        $valores = array($this->codigo);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);
	}

	function consultar(){
        $comandoSql = "select * from usuario";
        $exec = $this->con->prepare($comandoSql);
        $exec->execute();

        $dados = array();

	foreach ($exec->fetchAll() as $value) {
		$usu = new Usuario;
		$usu->nome  		= $value["nome"];
        $usu->cpf  	= $value["cpf"];
		$usu->senha	= $value["senha"];
		$usu->codigo		= $value["idUser"];	
		$dados[] = $usu;		
		}
		return $dados;
	}

	function retornarDados(){
        $comandoSql = "select * from usuario where idUser = ?";
        $valores = array($this->codigo);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);

        $value  = $exec->fetch();

        $usu = new Usuario;

        $usu->nome 		= $value["nome"];
        $usu->cpf  	= $value["cpf"];
        $usu->senha	= $value["senha"];
        $usu->codigo		= $value["idUser"];
        return $usu;
	}

    function retornarDadosNome(){
        $comandoSql = "select * from usuario where nome = ?";
        $valores = array($this->nome);
        $exec = $this->con->prepare($comandoSql);
        $exec->execute($valores);

        $value  = $exec->fetch();

        $usu = new Usuario;

        $usu->nome 		= $value["nome"];
        $usu->cpf  	= $value["cpf"];
        $usu->senha	= $value["senha"];
        $usu->codigo		= $value["idUser"];
        return $usu;
    }


    function retornarLogin(){   

        $comandoSql = "SELECT * FROM usuario WHERE nome = :nome AND senha = :senha";
        $exec = $this->con->prepare($comandoSql);
        $exec->bindParam(":nome", $this->nome);
        $exec->bindParam(":senha", $this->senha);
        $exec->execute();
        $usuario = $exec->fetch(PDO::FETCH_OBJ);
    
        return $usuario;
    }



    function verCpf() {
        $comandoSql = "SELECT * FROM usuario WHERE cpf = :cpf";
        $exec = $this->con->prepare($comandoSql);
        $exec->bindParam(":cpf", $this->cpf);
        $exec->execute();
        $verCad = $exec->fetch();
    
        if ($verCad) {
            echo 'CPF Existente';
        } else {
            echo 'CPF Inexistente';
        }
    }








    

    }




?>
