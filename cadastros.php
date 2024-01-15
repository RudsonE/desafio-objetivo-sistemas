<?php
//aqui solicita a importação do arquivo contendo as classes
require_once "./controllers/produto.php";

//verifica se a pagina foi chamada via post para registrar um produto
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //instancia a classe produto
    $conn = new Produto;
    //variaveis com valores recebidos via post
    $nome = $_POST["nome"];
    $valor = $_POST["valor"];
    $quantidade = $_POST["quantidade"];
    // executa o metodo de inserir um produto com os parametros recebidos
    $conn->setProduto([$nome, $valor, $quantidade]);
}

?>
<!--Interface de cadastro-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Mercadinho JWT</title>
</head>
<body>
    <div class="">
        <form method="post" action="" class="cadastro">
            <h3 class="title">Cadastro de Produtos</h3>
            <input type="text" name="nome" id="" placeholder="Nome do produto" autocomplete="off" class="text-box">
<input type="text" name="valor" placeholder="Valor, ex: 10.99" autocomplete="off" class="text-box">
<input type="number" name="quantidade" placeholder="Quantidade" class="text-box">
            <button type="submit" class="btn-action">Cadastrar</button>
            <button type="button" onclick="abreLink('./index.php')" class="btn-action btn-secondary">Voltar</button>
        </form>
    </div>
</body>
<script src="./script.js"></script>
</html>

