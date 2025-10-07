<?php

include_once("../model/fechadura.php");

$usu = new Fechadura;

if (isset($_REQUEST["acao"])){

	switch ($_REQUEST["acao"]) {

		case 'cadastrar':
		$usu->nome = $_POST['nom'];
		$usu->pin = $_POST['pin'];
		$usu->cdUser = $_POST['cdUser'];
		$usu->cadastrar();

		echo "ok";
		break;
		
		case 'atualizar':
		$usu->nome = $_POST['nom'];
		$usu->pin = $_POST['pin'];
		$usu->cdUser = $_POST['cdUser'];
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

		case 'vPin':
		$usu->pin = $_POST['pin'];
		echo ($usu->verPin());
		break;
		
		case 'fechadura':
		$usu->nome = $_POST['nom'];
		$usu->pin = $_POST['pin'];
		$dados = $usu->retornarFechadura();
		if($dados) echo $dados->idFechadura;
		else echo "false";
		break;

		case 'consultar_Fechadura':
		$usu->cdUser = $_POST['cdUser'];
		echo json_encode($usu->consultarFecha());
		break;
	
		case 'consultar_json':
		echo json_encode($usu->consultar());
		break;


	
	}
}
?>
