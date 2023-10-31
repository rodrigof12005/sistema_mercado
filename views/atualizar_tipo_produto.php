<html lang="pt-br">
<?php include("../layout/layout.php");

require_once "../Controller/TipoProdutoController.php";

// Verifica se há um ID na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtém os dados do tipo de produto com base no ID
    $controller = new \TipoProdutoController();
    $tipoProduto = $controller->getTipoProdutoById($id);

    // Verifica se o tipo de produto foi encontrado
    if ($tipoProduto) {
        $id = $tipoProduto['id_tipo_produto'];
        $nome = $tipoProduto['nome'];
        $imposto = $tipoProduto['imposto'];
    } else {
        // Redireciona ou exibe uma mensagem de erro, conforme necessário
        header("Location: listagem_tipos_produto.php");
        exit();
    }
} else {
    // Redireciona se não houver ID na URL
    header("Location: listagem_tipos_produto.php");
    exit();
}

?>

<div class="modal" id="myModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Editar Tipo de Produto</h3>
            </div>

            <div class="modal-body">
                <form  action="../Routes/router.php" method="POST">
                    <input type="hidden" name="action" value="update">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="form-group mt-3">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" value="<?php echo $nome; ?>" id="nome" name="nome" placeholder="Digite o tipo do produto" required>
                    </div>

                    <div class="form-group">
                        <label for="imposto">Valor do Imposto %</label>
                        <input type="text" class="form-control" value="<?php echo $imposto*100; ?>" id="imposto" name="imposto" placeholder="Digite o valor do imposto" pattern="[0-9]+(\.[0-9]+)?" title="Digite apenas números inteiros ou números separados por ponto (ex: 10 ou 10.5)" required>
                    </div>

                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='listagem_tipos_produto.php';">Voltar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        $('#myModal').modal('show');
    });
</script>



</html>
