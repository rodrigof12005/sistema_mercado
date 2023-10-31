<html lang="pt-br">
<?php include("../layout/layout.php");
require_once "../Controller/TipoProdutoController.php";
require_once "../Controller/ProdutoController.php";

$controller = new \TipoProdutoController();
$tipoProduto = $controller->getAllTiposProdutos();
$controller = new \ProdutoController();
$Produtos = $controller->getAllProdutos();

?>

<div class="modal" id="myModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Novo Cadastro de Produto</h3>
            </div>

            <div class="modal-body">
                <form  action="../Routes/router.php?createproduto" method="POST">
                    <input type="hidden" name="action" value="createproduto">
                    <div class="form-group mt-3">
                        <label for="descricao">Nome</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite o nome do produto" required>
                    </div>

                    <div class="form-group">
                        <label for="valor">Preço R$ </label>
                        <input type="text" class="form-control" id="valor" name="valor" placeholder="Digite o valor do produto" pattern="[0-9]+(\.[0-9]+)?" title="Digite apenas números inteiros ou números separados por ponto (ex: 10 ou 10.5)" required>
                    </div>

                    <div class="form-group">
                        <label for="id_tipo_produto">Selecione o tipo do produto:</label>
                        <select class="form-control" id="id_tipo_produto" name="id_tipo_produto" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($tipoProduto as $tipoProdutos) {
                                echo "<option value={$tipoProdutos['id_tipo_produto']}>{$tipoProdutos['nome']}</option>";
                            } ?>
                        </select>

                    </div>



                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='../views/listagem_produto.php';">Voltar</button>
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
