<?php

class Produto
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function create($descricao, $valor, $id_tipo_produto)
    {
        try {
            if ($this->isDescricaoUnique($descricao)) {
                $sql = "INSERT INTO produto (descricao, valor, id_tipo_produto) VALUES (?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$descricao, $valor, $id_tipo_produto]);
                echo "<script>alert('Cadastro realizado com sucesso!');window.location.href='/../views/listagem_produto.php';</script>";
            } else {
                echo "<script>alert('Já existe um cadastro com o mesmo nome. Escolha outro nome.');window.location.href='/../views/listagem_produto.php';</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao criar produto.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erro ao criar produto.');</script>";
        }
    }

    private function isDescricaoUnique($descricao)
    {
        try {
            $sql = "SELECT COUNT(*) FROM produto WHERE descricao = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$descricao]);
            $count = $stmt->fetchColumn();
            return $count === 0;
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao verificar unicidade da descrição.');</script>";
            return false;
        } catch (Exception $e) {
            echo "<script>alert('Erro ao verificar unicidade da descrição.');</script>";
            return false;
        }
    }

    public function getAllProdutos()
    {
        try {
            $sql = "SELECT * FROM produto ORDER BY id_produto DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao obter produtos.');</script>";
            return array();
        } catch (Exception $e) {
            echo "<script>alert('Erro ao obter produtos.');</script>";
            return array();
        }
    }

    public function updateProduto($id, $descricao, $valor, $id_tipo_produto)
    {
        try {
            $sql = "UPDATE produto SET descricao = ?, valor = ?, id_tipo_produto = ?  WHERE id_produto = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$descricao, $valor, $id_tipo_produto, $id]);
            echo "<script>alert('Registro atualizado com sucesso!');window.location.href='/../views/listagem_produto.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao atualizar produto.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erro ao atualizar produto.');</script>";
        }
    }

    public function getProdutoById($id)
    {
        try {
            $sql = "SELECT * FROM produto WHERE id_produto = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao obter produto por ID.');</script>";
            return array();
        } catch (Exception $e) {
            echo "<script>alert('Erro ao obter produto por ID.');</script>";
            return array();
        }
    }

    public function deleteProduto($id)
    {
        try {
            if ($this->hasVendasRelacionados($id)) {
                echo '<script>alert(\'Erro na exclusão, existem vendas relacionadas a esse produto!\');window.location.href=\'/../views/listagem_produto.php\';</script>';
                return false;
            }

            $sql = "DELETE FROM produto WHERE id_produto = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            echo '<script>window.location.href=\'/../views/listagem_produto.php\';</script>';
            return true;
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao excluir produto.');</script>";
            return false;
        } catch (Exception $e) {
            echo "<script>alert('Erro ao excluir produto.');</script>";
            return false;
        }
    }

    private function hasVendasRelacionados($id)
    {
        try {
            $sql = "SELECT COUNT(*) FROM venda WHERE id_produto = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao verificar vendas relacionadas.');</script>";
            return false;
        } catch (Exception $e) {
            echo "<script>alert('Erro ao verificar vendas relacionadas.');</script>";
            return false;
        }
    }
}
