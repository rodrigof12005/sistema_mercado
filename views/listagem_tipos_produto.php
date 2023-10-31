<?php
include("../layout/layout.php");
require_once "../Controller/TipoProdutoController.php";

$controller = new \TipoProdutoController();
$tiposProdutos = $controller->getAllTiposProdutos();

// Deletar registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $controller->deleteTipoProduto($id);
        exit();
    }
}

$perPage = 6; // Número de registros por página
$totalPages = ceil(count($tiposProdutos) / $perPage); // Número total de páginas
$currentPage = isset($_GET['page']) ? max(1, min($totalPages, intval($_GET['page']))) : 1; // Página atual

$start = ($currentPage - 1) * $perPage; // Índice inicial dos registros
$end = $start + $perPage; // Índice final dos registros
$pagedTiposProdutos = array_slice($tiposProdutos, $start, $perPage); // Registros para a página atual
?>

<div class="container mt-3" style="background-color: white; max-width: 97%; height: 95%">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php"><b>Home</b> </a>
        <a class="navbar-brand" href="../views/listagem_produto.php"><b>Produtos</b> </a>
        <a class="navbar-brand" href="../views/listagem_tipos_produto.php"><b>Tipos de Produtos </b></a>
        <a class="navbar-brand" href="../views/listagem_vendas.php"><b>Vendas Unitárias</b> </a>
        <a class="navbar-brand" href="../views/vendas_pedidos.php"><b>Carrinho de Compras</b> </a>
    </nav>

    <div class="container mt-4 d-flex justify-content-center">
        <h1>Listagem de Tipos de Produtos</h1>
    </div>

    <div class="container mt-5 d-flex justify-content-between align-items-center">
        <div class="input-group mb-3" style="max-width: 30%">
            <input class="form-control w-25" type="search" aria-label="Search" id="myInput" onkeyup="busca()" placeholder="Digite o Tipo de Produto" />
            <div class="input-group-append"></div>
        </div>

        <button type="button" class="btn btn-primary" onclick="window.location.href='cadastro_tipo_produto.php';">Novo Registro</button>
    </div>

    <div class="container mt-4">
        <?php if (empty($pagedTiposProdutos)): ?>
            <p>Nenhum registro de tipo de produto encontrado.</p>
        <?php else: ?>
            <table class="table table-striped text-center" id="table">
                <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Tipo de Produto</th>
                    <th>Imposto %</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pagedTiposProdutos as $tipoProduto): ?>
                    <tr>
                        <td><?php echo $tipoProduto['id_tipo_produto']; ?></td>
                        <td><?php echo $tipoProduto['nome']; ?></td>
                        <td><?php echo $tipoProduto['imposto'] * 100; ?></td>
                        <td>
                            <a href="atualizar_tipo_produto.php?id=<?php echo $tipoProduto['id_tipo_produto']; ?>" class="btn btn-info btn-sm">Editar</a>
                            <form method="post" style="display: inline;">
                                <button type="submit" onclick="return confirm('O registro será excluído!');" class="btn btn-danger btn-sm" name="delete" value="<?php echo $tipoProduto['id_tipo_produto']; ?>">Excluir</button>
                            </form>
                        </td>
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

<script>
    function busca() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("table");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
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
