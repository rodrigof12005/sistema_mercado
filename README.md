# Sistema de Mercado

Esse projeto é um sistema de vendas de mercado desenvolvido utilizando PHP MVC, Bootstrap e Javascript,
 no sistema existe um módulo de Gerenciamento  CRUD de Tipos de Produtos, Produtos, listagem de Vendas Unitárias e 
 Carrinho de Compras e outro módulo de Vendas de produtos, ambos acessíveis na página inicial do sistema.
O operador do Sistema pode realizar a venda de vários produtos ao mesmo tempo e a venda será relacionada
a um pedido. No gerenciamento de Módulos, cada produto é relacionado a um tipo de produto e uma venda relacionada
a um produto ou mais, com isso não há a possibilidade de excluir um registro de tipo de produto ou produto
se houver algum registro relacionado a ele no sistema.


# Requisitos:
 PHP 8.1 com lib do postgres , POSTGRES

Após baixar o projeto executar essas etapas

1. Checar suas configurações de banco na Model "Connection.php" <br><br>
2. Criar um banco com o nome "mercado" e fazer o restore do sql das tabelas encontrado na raiz do projeto no 
  schema do seu banco. <br>
3. Acessar o Sistema ir em Gerenciamento de Módulos, cadastrar nessa ordem (Tipos de Produtos , Produtos), após isso
já poderá realizar sua venda. <br>

OBS : O sistema está separando o preço dos produtos por . (ponto), será ajustado para
vírgula em breve. Exemplo: 2,50 => 2.50 .





Rodrigo Duarte https://www.linkedin.com/in/rodrigo-duarte-461a99165/
