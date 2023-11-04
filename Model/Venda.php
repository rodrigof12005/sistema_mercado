<?php

class Venda
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createVenda($id_produto, $valor_unitario, $imposto, $cliente, $descricao, $quantidade, $valor_total, $pedido, $totalImpostos, $totalVenda, $totalImpostoUnitario)
    {
        try {
            $sql = "INSERT INTO venda (id_produto, valor_unitario, imposto, valor_total, cliente, descricao, quantidade, pedido, totalimpostos, totalvenda , totalimpostounitario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id_produto, $valor_unitario, $imposto, $valor_total, $cliente, $descricao, $quantidade, $pedido, $totalImpostos, $totalVenda, $totalImpostoUnitario]);

            echo "<script>alert('Venda realizada com sucesso!');window.location.href='/../views/venda.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao realizar a venda.');</script>";
        }
    }

    public function getAllVendas()
    {
        try {
            $sql = "SELECT * FROM venda ORDER BY data DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao obter vendas.');</script>";
            return array(); // Retorna uma matriz vazia em caso de erro
        }
    }
}
