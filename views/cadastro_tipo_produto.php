<html lang="pt-br">
<?php include("../layout/layout.php");
?>

<div class="modal" id="myModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Novo Cadastro de Tipo de Produto</h3>
            </div>

            <div class="modal-body">
                <form  action="../Routes/router.php?=create" method="POST">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group mt-3">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do tipo do produto" required>
                    </div>

                    <div class="form-group">
                        <label for="imposto">Valor do Imposto %</label>
                        <input type="text" class="form-control" id="imposto" name="imposto" placeholder="Digite o valor do imposto" pattern="[0-9]+(\.[0-9]+)?" title="Digite apenas números inteiros ou números separados por ponto (ex: 10 ou 10.5)" required>
                    </div>

                    <div class="form-group mt-5">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='../views/listagem_tipos_produto.php';">Voltar</button>
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
