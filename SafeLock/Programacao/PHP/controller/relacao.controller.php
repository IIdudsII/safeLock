
<?php

include_once("../model/relacao.php");

$rel = new Relacao;

if (isset($_REQUEST["acao"])) {
    switch ($_REQUEST["acao"]) {
        
        case 'cadastrar':
            $rel->codUser = $_POST['cdUser'];
            $rel->codFecha = $_POST['cdFecha'];
            $rel->estado = $_POST['slEstado'];
            $rel->cadastrar();
            echo "ok";
            break;

        case 'atualizar':
            $rel->codUser = $_POST['cdUser'];
            $rel->codFecha = $_POST['cdFecha'];
            $rel->estado = $_POST['est'];
            $rel->codigo = $_POST['codigo'];
            $rel->atualizar();
            echo "ok";
            break;

        case 'excluir':
            $rel->codigo = $_POST['codigo'];
            $rel->excluir();
            echo "ok";
            break;

        case 'cadStatus':
            $rel->estado = $_POST['est'];
            $rel->codigo = $_POST['codigo'];
            echo ($rel->verCadStat());
            break;

        case 'retorna_cod':
            $rel->codigo = $_POST['codigo'];
            echo json_encode($rel->retornarDados());
            break;
 

        case 'consultar_Relacao':
            $rel->codFechadura = $_POST['cdFecha'];
            echo json_encode($rel->consultarRel());
            break;

        case 'consultar_json':
            echo json_encode($rel->consultar());
            break;

        case 'salvar_dados':
            $rel->codFecha = $_POST['CodFechadura'];
            $rel->codUser = $_POST['CodUser'];
            $rel->estado = $_POST['estado'];
            $rel->cadastrar();
            echo "Dados inseridos com sucesso";
            break;

        case 'retorna_ultimo_estado':
                $rel->codigo = $_POST['cdFecha'];
                $ultimo_estado = $rel->obterUltimoEstadoFechadura($rel->codigo);
                if($ultimo_estado == 0){
                    echo "Fechado";
                }
                else{
                    echo "Aberta";
                }
                
            break;
            

        case 'destravar':
            // Endereço IP do ESP32
            $esp32_ip = "192.168.0.100"; // Substitua pelo IP do seu ESP32
            $url = "http://$esp32_ip/destravar";

            // Inicializa uma sessão cURL
            $ch = curl_init($url);

            // Configurações cURL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "");

            // Executa a solicitação e obtém a resposta
            $response = curl_exec($ch);

            // Fecha a sessão cURL
            curl_close($ch);

            // Verifica se a solicitação foi bem-sucedida
            if ($response === "ok") {
                echo "ok";
            } else {
                echo "erro";
            }
            break;
    }
}
?>
