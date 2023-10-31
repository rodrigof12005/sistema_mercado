<!DOCTYPE html>
<html lang="pt-br">
<?php include("layout/home.php");
?>
<div class="container">
    <div class="row">
        <div class="col-12 text-center ">
            <img src="/../public/logo.png" style="width: 15%"/>
            <h1 style="color: white">Sistema de Vendas</h1>
            <p style="color: white">Versão 1.0</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="block" onclick="window.location.href='views/venda.php';">
                <h2>Acesso ao Módulo de Vendas</h2>

            </div>
        </div>
        <div class="col-md-5">
            <div class="block" onclick="window.location.href='views/painel_adm.php';">
                <h2>Acesso ao Gerenciamento do Sistema</h2>
            </div>
        </div>
    </div>
</div>

</html>