<html lang="pt-br">
<?php include("../layout/layout.php") ?>

<!-- O Modal -->
<div class="modal" id="myModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Cabeçalho do Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Módulos Administrativos</h4>
            </div>

            <!-- Corpo do Modal -->
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="selectPaginas">Selecione o módulo que deseja acessar:</label>
                        <select class="form-control" id="selectPaginas" name="selectPaginas">
                            <option value="">Selecione...</option>
                            <option value="listagem_tipos_produto.php">Gerenciamento e Listagem de Tipos de Produtos</option>
                            <option value="listagem_produto.php">Gerenciamento e Listagem de Produtos</option>
                            <option value="listagem_vendas.php">Listagem de Vendas Unitárias  de Produtos</option>
                            <option value="vendas_pedidos.php">Listagem de Carrinho de Compras</option>
                        </select>
                    </div>
                    <div class="form-group mt-5">
                    <button type="button" class="btn btn-primary" onclick="redirecionarPagina()">Acessar</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='/../index.php';">Voltar</button>
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

    function redirecionarPagina() {
        var select = document.getElementById('selectPaginas');
        var valorSelecionado = select.options[select.selectedIndex].value;

        if (valorSelecionado) {
            window.location.href = valorSelecionado;
        }
    }
</script>



</html>
