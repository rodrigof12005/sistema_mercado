<?php
include("../layout/layout.php");
require_once "../Controller/VendaController.php";
require_once "../Controller/ProdutoController.php";

$controller = new \VendaController();
$vendas = $controller->getAllVendas(); // Altere conforme necessário

// Agrupar vendas pelo número do pedido
$pedidosAgrupados = [];
foreach ($vendas as $venda) {
    $pedido = $venda['pedido'];
    if (!isset($pedidosAgrupados[$pedido])) {
        $pedidosAgrupados[$pedido] = $venda;
    }
}

$vendasAgrupadas = array_values($pedidosAgrupados);

$perPage = 6; // Número de registros por página
$totalPages = ceil(count($vendasAgrupadas) / $perPage); // Número total de páginas
$currentPage = isset($_GET['page']) ? max(1, min($totalPages, intval($_GET['page']))) : 1; // Página atual

$start = ($currentPage - 1) * $perPage; // Índice inicial dos registros
$end = $start + $perPage; // Índice final dos registros
$pagedVendasAgrupadas = array_slice($vendasAgrupadas, $start, $perPage); // Registros para a página atual
?>
<html lang="pt-br">
<div class="container mt-3" style="background-color: white; max-width:97%; height: 95%">
    <!-- Seu código HTML anterior permanece inalterado até a tabela -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php"><b>Home</b> </a>
        <a class="navbar-brand" href="../views/listagem_produto.php"><b>Produtos </b></a>
        <a class="navbar-brand" href="../views/listagem_tipos_produto.php"><b>Tipos de Produtos</b> </a>
        <a class="navbar-brand" href="../views/listagem_vendas.php"><b>Vendas Unitárias</b> </a>
        <a class="navbar-brand" href="../views/vendas_pedidos.php"><b>Carrinho de Compras</b> </a>
    </nav>

    <div class="container mt-4 d-flex justify-content-center">
        <h1>Listagem de Carrinho de Compras</h1>
    </div>
    <div class="container mt-5 d-flex justify-content-between align-items-center">
        <div class="input-group mb-3" style="max-width: 30%">
            <input class="form-control w-25" type="search" aria-label="Search" id="myInput" onkeyup="busca()" placeholder="Digite o número do pedido" />
            <div class="input-group-append"></div>
        </div>

    </div>

    <div class="container mt-4">
        <?php if (empty($pagedVendasAgrupadas)): ?>
            <p>Nenhum registro de pedido encontrado.</p>
        <?php else: ?>
            <table class="table table-striped text-center" id="table">
                <thead class="thead-dark">
                <tr>
                    <th>Pedido</th>
                    <th>Cliente</th>
                    <th>Total de Impostos</th>
                    <th>Valor Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pagedVendasAgrupadas as $venda): ?>
                    <tr>
                        <td><?php echo $venda['pedido']; ?></td>
                        <td><?php echo $venda['cliente']; ?></td>
                        <td><?php echo $venda['totalimpostos']; ?></td>
                        <td><?php echo $venda['totalvenda']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Botões de navegação de página -->
    <div class="container mt-4 d-flex justify-content-center">
        <?php if ($totalPages > 1): ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
</html>
<script>
    function busca() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("table");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
