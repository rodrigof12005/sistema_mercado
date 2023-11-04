<?php
include("../layout/layout.php");
require_once "../Controller/VendaController.php";
require_once "../Controller/ProdutoController.php";

$controller = new \VendaController();
$vendas = $controller->getAllVendas();
$controller_produtos = new \ProdutoController();
$Produtos = $controller_produtos->getAllProdutos();

$perPage = 6; // Número de registros por página
$totalPages = ceil(count($vendas) / $perPage); // Número total de páginas
$currentPage = isset($_GET['page']) ? max(1, min($totalPages, intval($_GET['page']))) : 1; // Página atual

$start = ($currentPage - 1) * $perPage; // Índice inicial dos registros
$end = $start + $perPage; // Índice final dos registros
$pagedVendas = array_slice($vendas, $start, $perPage); // Registros para a página atual
?>
<html lang="pt-br">
<div class="container mt-3" style="background-color: white; max-width: 97%; height: 95%">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php"><b>Home</b> </a>
        <a class="navbar-brand" href="../views/listagem_produto.php"><b>Produtos </b></a>
        <a class="navbar-brand" href="../views/listagem_tipos_produto.php"><b>Tipos de Produtos</b> </a>
        <a class="navbar-brand" href="../views/listagem_vendas.php"><b>Vendas Unitárias</b> </a>
        <a class="navbar-brand" href="../views/vendas_pedidos.php"><b>Carrinho de Compras</b> </a>
    </nav>

    <div class="container mt-4 d-flex justify-content-center">
        <h1>Listagem de Vendas Unitárias</h1>
    </div>
    <div class="container mt-5 d-flex justify-content-between align-items-center">
        <div class="input-group mb-3" style="max-width: 30%">
            <input class="form-control w-25" type="search" aria-label="Search" id="myInput" onkeyup="busca()" placeholder="Digite o nome do produto" />
            <div class="input-group-append"></div>
        </div>

    </div>

    <div class="container mt-4">
        <?php if (empty($pagedVendas)): ?>
            <p>Nenhuma venda encontrada.</p>
        <?php else: ?>
            <table class="table table-striped text-center" id="table">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Imposto</th>
                    <th>Imposto Unitário</th>
                    <th>Valor Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pagedVendas as $venda): ?>
                    <tr>
                        <td><?php echo $venda['id_venda']; ?></td>
                        <td><?php echo $venda['cliente']; ?></td>
                        <td> <?php
                            // compara o produto vendido com o id do produto e exibe o nome do produto
                            $tipoProdutoNome = '';
                            foreach ($Produtos as $Produto) {
                                if($venda['id_produto']==$Produto['id_produto'] ){
                                    $Produto['descricao']  ;
                                    break;
                                }
                            }
                            echo $tipoProdutoNome =   $Produto['descricao'] ;
                            ?></td>
                        <td><?php echo $venda['quantidade']; ?></td>
                        <td><?php echo $venda['valor_unitario']; ?></td>
                        <td><?php echo $venda['imposto']*100; ?>%</td>
                        <td><?php echo $venda['totalimpostounitario']?></td>
                        <td><?php echo $venda['valor_total']; ?></td>
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
            td = tr[i].getElementsByTagName("td")[2];
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