<?php
require_once "../Model/Connection.php";
require_once "../Model/Venda.php";

class VendaController
{
    private $Venda;

    public function __construct()
    {
        $connection = new Connection();
        $this->Venda = new Venda($connection->connect());
    }

    public function createVenda($id_produto, $valor_unitario, $imposto, $cliente , $descricao, $quantidade , $valor_total,$pedido,$totalImpostos,$totalVenda)
    {
        $this->Venda->createVenda($id_produto, $valor_unitario, $imposto, $cliente, $descricao, $quantidade , $valor_total,$pedido,$totalImpostos,$totalVenda);
    }

    public function getAllVendas()
    {
        return $this->Venda->getAllVendas();
    }


}
