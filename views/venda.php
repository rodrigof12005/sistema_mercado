<html lang="pt-br">
<?php include("../layout/layout.php"); ?>
<?php require_once "../Controller/VendaController.php"; ?>
<?php require_once "../Controller/ProdutoController.php"; ?>
<?php require_once "../Controller/TipoProdutoController.php"; ?>

<?php
$controller_produto = new \ProdutoController();
$produtos = $controller_produto->getAllProdutos();
$controller_tipo_produto = new \TipoProdutoController();
$tipo_produto = $controller_tipo_produto->getAllTiposProdutos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new \VendaController();
    $controller->createVenda($_POST);
}
?>

<div class="container" style="background-color: white; margin-top: 60px;">
    <form action="../Routes/router.php" method="POST">
        <input type="hidden" name="action" value="create_venda">
        <h2>Venda de Produtos</h2>

        <div class="form-group" style="margin-top: 40px">
            <label for="cliente">Cliente:</label>
            <input type="text" class="form-control col-sm-4" id="cliente" name="cliente" placeholder="Digite o nome do cliente" required>
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="pedido" name="pedido" value="<?=rand(10000000, 99999999); ?>">
        </div>

        <div class="table-responsive">
            <table class="table" id="vendasTable">
                <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Imposto (*100)</th>
                    <th>Valor Total Unitário</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                <tr class="produtoRow">
                    <td>
                        <select class="form-control descricaoSelect" name="descricao[]">
                            <option value="">Selecione</option>
                            <?php foreach ($produtos as $produto): ?>
                                <option value="<?php echo $produto['id_produto']; ?>"
                                        data-valor="<?php echo $produto['valor']; ?>"
                                        data-imposto="<?php
                                        $imposto = '';
                                        foreach ($tipo_produto as $tipo_produtos) {
                                            if($tipo_produtos['id_tipo_produto']==$produto['id_tipo_produto'] ){
                                                $imposto = $tipo_produtos['imposto'];
                                                break;
                                            }
                                        }
                                        echo $imposto;
                                        ?>"
                                        data-id-tipo="<?php echo $produto['id_tipo_produto']; ?>">
                                    <?php echo $produto['descricao']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input type="number" class="form-control quantidadeInput" name="quantidade[]" min="1" required></td>
                    <td><input type="text" class="form-control valorUnitarioInput" name="valor_unitario[]" readonly></td>
                    <td><input type="text" class="form-control impostoInput" name="imposto[]" readonly></td>
                    <td><input type="text" class="form-control valorTotalInput" name="valorTotal[]" readonly></td>
                    <td>
                        <?php if(count($produtos) >= 1): ?>
                            <button type="button" class="btn btn-danger" onclick="removerLinha(this)">Remover</button>
                        <?php endif; ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label for="totalImpostos">Total de Impostos:</label>
                <input type="text" class="form-control" id="totalImpostos" name="totalImpostos" readonly>
            </div>
            <div class="col-sm-6">
                <label for="totalVenda">Total da Venda:</label>
                <input type="text" class="form-control" id="totalVenda" name="totalVenda" readonly>
            </div>
        </div>

        <div style="margin-top: 40px">
            <button type="button" class="btn btn-primary" onclick="adicionarLinha()">Adicionar Produto</button>
            <button type="submit" class="btn btn-success">Finalizar Venda</button>
            <button type="submit" class="btn btn-danger" onclick="window.location.href='../index.php';">Sair do Sistema</button>
        </div>
    </form>

    <script>
        $(document).ready(function () {
            adicionarLinha();

            $(document).on('change', '.descricaoSelect', function () {
                var selectedOption = $(this).find(':selected');
                var valorUnitario = selectedOption.data('valor');
                var imposto = selectedOption.data('imposto');
                var row = $(this).closest('.produtoRow');

                row.find('.valorUnitarioInput').val(valorUnitario);
                row.find('.impostoInput').val(imposto);
                calcularValorTotal(row);
                calcularTotais();
            });

            $(document).on('input', '.quantidadeInput', function () {
                var row = $(this).closest('.produtoRow');
                calcularValorTotal(row);
                calcularTotais();
            });
        });

        function adicionarLinha() {
            var newRow = $('.produtoRow:first').clone();
            newRow.find('.quantidadeInput').val('');
            newRow.find('.valorUnitarioInput').val('');
            newRow.find('.impostoInput').val('');
            newRow.find('.valorTotalInput').val('');
            $('#vendasTable tbody').append(newRow);
        }

        function removerLinha(button) {
            // Verifica se há mais de uma linha antes de remover
            if ($('#vendasTable tbody tr').length > 1) {
                $(button).closest('tr').remove();
                calcularTotais();
            } else {
                alert("Deve haver pelo menos um produto na venda.");
            }
        }

        function calcularValorTotal(row) {
            var quantidade = parseFloat(row.find('.quantidadeInput').val()) || 0;
            var valorUnitario = parseFloat(row.find('.valorUnitarioInput').val()) || 0;
            var imposto = parseFloat(row.find('.impostoInput').val()) || 0;

            var valorTotal = quantidade * valorUnitario * (1 + imposto);
            row.find('.valorTotalInput').val(valorTotal.toFixed(2));
        }

        function calcularTotais() {
            var totalImpostos = 0;
            var totalVenda = 0;

            $('.produtoRow').each(function () {
                var quantidade = parseFloat($(this).find('.quantidadeInput').val()) || 0;
                var valorUnitario = parseFloat($(this).find('.valorUnitarioInput').val()) || 0;
                var imposto = parseFloat($(this).find('.impostoInput').val()) || 0;

                var valorTotal = quantidade * valorUnitario * (1 + imposto);
                totalImpostos += quantidade * (valorUnitario * imposto);
                totalVenda += valorTotal;
            });

            $('#totalImpostos').val(totalImpostos.toFixed(2));
            $('#totalVenda').val(totalVenda.toFixed(2));
        }
    </script>
</div>
</html>
