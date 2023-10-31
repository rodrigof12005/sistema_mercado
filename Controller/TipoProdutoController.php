<?php

require_once "../Model/Connection.php";
require_once "../Model/TipoProduto.php";

class TipoProdutoController {
    private $tipoProduto;

    public function __construct() {
        $connection = new Connection();
        $this->tipoProduto = new TipoProduto($connection->connect());
    }

    public function createTipoProduto($nome, $imposto) {
        $this->tipoProduto->create($nome, $imposto);
    }

    public function updateTipoProduto($id, $nome, $imposto) {
        $this->tipoProduto->update($id, $nome, $imposto);
    }

    public function getAllTiposProdutos() {
        return $this->tipoProduto->getAllTiposProdutos();
    }

    public function getTipoProdutoById($id) {
        return $this->tipoProduto->getTipoProdutoById($id);
    }

    public function deleteTipoProduto($id){
        $this->tipoProduto->deleteTipoProduto($id);
    }
}
?>
