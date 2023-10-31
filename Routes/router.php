<?php

require_once "../Controller/TipoProdutoController.php";
require_once "../Controller/ProdutoController.php";
require_once "../Controller/VendaController.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller = new \TipoProdutoController();
    $controller_produto = new \ProdutoController();
    $controller_vendas = new \VendaController();


//Router tipos de produtos
    if (isset($_POST["action"]) && $_POST["action"] === "create") {
        $nome = $_POST["nome"];
        $imposto = $_POST["imposto"];
        $controller->createTipoProduto($nome, $imposto);

    }


    elseif (isset($_POST["action"]) && $_POST["action"] === "update") {
        if (isset($_POST["id"]) && isset($_POST["nome"]) && isset($_POST["imposto"])) {
            $id = $_POST["id"];
            $nome = $_POST["nome"];
            $imposto = $_POST["imposto"];
            $controller->updateTipoProduto($id, $nome, $imposto);
        }

        else {
            echo "Por favor, forneça todos os campos necessários para a atualização.";
        }

    }

//Router produtos
    elseif (isset($_POST["action"]) && $_POST["action"] === "createproduto") {
        $descricao = $_POST["descricao"];
        $valor = $_POST["valor"];
        $id_tipo_produto = $_POST["id_tipo_produto"];
        $controller_produto->createProduto($descricao, $valor, $id_tipo_produto);

    }

    elseif (isset($_POST["action"]) && $_POST["action"] === "updateproduto") {
        if (isset($_POST["id"]) && isset($_POST["descricao"]) && isset($_POST["valor"]) && isset($_POST["id_tipo_produto"])) {
            $id = $_POST["id"];
            $descricao = $_POST["descricao"];
            $valor = $_POST["valor"];
            $id_tipo_produto = $_POST["id_tipo_produto"];
            $controller_produto->updateProduto($id, $descricao, $valor , $id_tipo_produto,);
        }

        else {
            echo "Por favor, forneça todos os campos necessários para a atualização.";
        }

    }

    //Router venda
    if (isset($_POST["action"]) && $_POST["action"] === "create_venda") {
        // Verifica se a chave 'descricao' está definida e é um array
        if (isset($_POST["descricao"]) && is_array($_POST["descricao"])) {
            $descricoes = $_POST["descricao"];
            $quantidades = $_POST["quantidade"];

            foreach ($descricoes as $key => $descricao) {
                $id_produto = $descricao;

                // Verifica se as chaves esperadas estão definidas no array $_POST
                if (isset($_POST["valor_unitario"][$key], $_POST["imposto"][$key], $_POST["cliente"], $quantidades[$key], $_POST["valorTotal"][$key])) {
                    $valor_unitario = $_POST["valor_unitario"][$key];
                    $imposto = $_POST["imposto"][$key];
                    $cliente = $_POST["cliente"];
                    $quantidade = $quantidades[$key];
                    $pedido = $_POST["pedido"];
                    $totalImpostos= $_POST["totalImpostos"];
                    $totalVenda = $_POST["totalVenda"];
                    $valor_total = $_POST["valorTotal"][$key];

                    $controller_vendas->createVenda($id_produto, $valor_unitario, $imposto, $cliente, $descricao, $quantidade, $valor_total, $pedido,$totalImpostos,$totalVenda);
                } else {
                    echo "Algum dos campos necessários não está definido.";
                }
            }
        } else {
            echo "A chave 'descricao' não está definida ou não é um array em \$_POST.";
        }
    }





    else {
        echo "Action do formulário não encontrada.";
    }
}

else {
    echo "Método inválido.";

}
?>