<?php

include_once("../model/usuario.php");

$usu = new Usuario;

if (isset($_REQUEST["acao"])){

	switch ($_REQUEST["acao"]) {

		case 'cadastrar':
		$usu->nome = $_POST['nom'];
		$usu->cpf = $_POST['cpf'];
		$usu->senha = $_POST['sen'];
		$usu->cadastrar();
		echo "ok";
		break;
		
		case 'atualizar':
		$usu->nome = $_POST['nom'];
		$usu->cpf = $_POST['cpf'];
		$usu->senha = $_POST['sen'];
		$usu->codigo = $_POST['codigo'];
		$usu->atualizar();
		echo "ok";
		break;
		
		case 'excluir':
		$usu->codigo = $_POST['codigo'];
		$usu->excluir();
		echo "ok";
		break;

		case 'retorna_nome':
		$usu->nome = $_POST['nom'];
		echo json_encode($usu->retornarDadosNome());
		break;
			
		case 'retorna_cod':
		$usu->codigo = $_POST['codigo'];
		echo json_encode($usu->retornarDados());
		break;

        case 'login':
        $usu->nome = $_POST['nom'];
        $usu->senha = $_POST['sen'];
        $dados = $usu->retornarLogin();
		if($dados) echo $dados->idUser;
		else echo "false";
        break;

		case 'vCpf':
		$usu->cpf = $_POST['cpf'];
		echo ($usu->verCpf());
		break;

		
	
		case 'consultar_json':
		echo json_encode($usu->consultar());
		break;

	
	}
}
?>
