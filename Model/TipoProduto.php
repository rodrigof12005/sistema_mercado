<?php

class TipoProduto
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function create($nome, $imposto)
    {
        try {
            if ($this->isNomeUnique($nome)) {
                $sql = "INSERT INTO tipo_produto (nome, imposto) VALUES (?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$nome, $imposto / 100]);
                echo "<script>alert('Cadastro realizado com sucesso!');window.location.href='/../views/listagem_tipos_produto.php';</script>";
            } else {
                echo "<script>alert('Já existe um cadastro com o mesmo nome. Escolha outro nome.');window.location.href='/../views/listagem_tipos_produto.php';</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao criar tipo de produto.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erro ao criar tipo de produto.');</script>";
        }
    }

    public function update($id, $nome, $imposto)
    {
        try {
            $sql = "UPDATE tipo_produto SET nome = ?, imposto = ? WHERE id_tipo_produto = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$nome, $imposto / 100, $id]);
            echo "<script>alert('Registro atualizado com sucesso!');window.location.href='/../views/listagem_tipos_produto.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao atualizar tipo de produto.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erro ao atualizar tipo de produto.');</script>";
        }
    }

    private function isNomeUnique($nome)
    {
        try {
            $sql = "SELECT COUNT(*) FROM tipo_produto WHERE nome = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$nome]);
            $count = $stmt->fetchColumn();
            return $count === 0;
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao verificar unicidade do nome.');</script>";
            return false;
        } catch (Exception $e) {
            echo "<script>alert('Erro ao verificar unicidade do nome.');</script>";
            return false;
        }
    }

    public function getAllTiposProdutos()
    {
        try {
            $sql = "SELECT * FROM tipo_produto ORDER BY id_tipo_produto DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao obter tipos de produtos.');</script>";
            return array();
        } catch (Exception $e) {
            echo "<script>alert('Erro ao obter tipos de produtos.');</script>";
            return array();
        }
    }

    public function getTipoProdutoById($id)
    {
        try {
            $sql = "SELECT * FROM tipo_produto WHERE id_tipo_produto = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao obter tipo de produto por ID.');</script>";
            return array();
        } catch (Exception $e) {
            echo "<script>alert('Erro ao obter tipo de produto por ID.');</script>";
            return array();
        }
    }

    public function deleteTipoProduto($id)
    {
        try {
            if ($this->hasProdutosRelacionados($id)) {
                echo '<script>alert(\'Erro na exclusão, existem produtos relacionados a esse tipo de produto!\');window.location.href=\'/../views/listagem_tipos_produto.php\';</script>';
                return false;
            }

            $sql = "DELETE FROM tipo_produto WHERE id_tipo_produto = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            echo '<script>window.location.href=\'/../views/listagem_tipos_produto.php\';</script>';
            return true;
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao excluir tipo de produto.');</script>";
            return false;
        } catch (Exception $e) {
            echo "<script>alert('Erro ao excluir tipo de produto.');</script>";
            return false;
        }
    }

    private function hasProdutosRelacionados($id)
    {
        try {
            $sql = "SELECT COUNT(*) FROM produto WHERE id_tipo_produto = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao verificar produtos relacionados.');</script>";
            return false;
        } catch (Exception $e) {
            echo "<script>alert('Erro ao verificar produtos relacionados.');</script>";
            return false;
        }
    }
}
