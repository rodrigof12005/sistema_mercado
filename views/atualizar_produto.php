<html lang="pt-br">
<?php include("../layout/layout.php");

require_once "../Controller/TipoProdutoController.php";
require_once "../Controller/ProdutoController.php";

// Verifica se há um ID na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtém os dados de tipos de produtos e produtos com base no ID
    $controller_tipo_produto = new \TipoProdutoController();
    $tipoProdutos = $controller_tipo_produto->getAllTiposProdutos();

    $controller_produto = new \ProdutoController();
    $produto = $controller_produto->getProdutoById($id);

    // Verifica se o produto foi encontrado
    if ($produto) {
        $id = $produto['id_produto'];
        $descricao = $produto['descricao'];
        $valor = $produto['valor'];
        $id_tipo_produto = $produto['id_tipo_produto'];
    } else {
        // Redireciona ou exibe uma mensagem de erro, conforme necessário
        header("Location: listagem_produto.php");
        exit();
    }
} else {
    // Redireciona se não houver ID na URL
    header("Location: listagem_produto.php");
    exit();
}

?>

<div class="modal" id="myModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Editar Produto</h3>
            </div>

            <div class="modal-body">
                <form action="../Routes/router.php" method="POST">
                    <input type="hidden" name="action" value="updateproduto">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="form-group mt-3">
                        <label for="descricao">Nome</label>
                        <input type="text" class="form-control" value="<?php echo $descricao; ?>" id="descricao" name="descricao" placeholder="Digite o nome do produto" required>
                    </div>

                    <div class="form-group">
                        <label for="valor">Preço R$</label>
                        <input type="text" class="form-control" value="<?php echo $valor; ?>" id="valor" name="valor" placeholder="Digite o preço" pattern="[0-9]+(\.[0-9]+)?" title="Digite apenas números inteiros ou números separados por ponto (ex: 10 ou 10.5)" required>
                    </div>

                    <div class="form-group">
                        <label for="id_tipo_produto">Selecione o tipo do produto:</label>
                        <select class="form-control" id="id_tipo_produto" name="id_tipo_produto" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($tipoProdutos as $tipoProduto) {
                                $selected = ($tipoProduto['id_tipo_produto'] == $id_tipo_produto) ? 'selected' : '';
                                echo "<option value='{$tipoProduto['id_tipo_produto']}'  {$selected}>{$tipoProduto['nome']}</option>";
                            } ?>
                        </select>
                    </div>


                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='listagem_produto.php';">Voltar</button>
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
