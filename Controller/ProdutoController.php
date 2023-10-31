<?php
require_once "../Model/Connection.php";
require_once "../Model/Produto.php";

class ProdutoController {

    private $Produto;

    public function __construct() {
        $connection = new Connection();
        $this->Produto = new Produto($connection->connect());
    }

    public function createProduto($descricao, $valor, $id_tipo_produto ) {
        $this->Produto->create($descricao, $valor, $id_tipo_produto );
    }

    public function getAllProdutos() {
        return $this->Produto->getAllProdutos();
    }

    public function updateProduto($id,$descricao, $valor, $id_tipo_produto) {
        $this->Produto->updateProduto($id, $descricao, $valor, $id_tipo_produto);
    }

    public function getProdutoById($id) {
        return $this->Produto->getProdutoById($id);
    }

    public function deleteProduto($id){
        $this->Produto->deleteProduto($id);
    }

}