<?php
require_once "./controllers/produto.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $conn = new Produto;

    $nome = $_POST["nome"];
    $valor = $_POST["valor"];
    $quantidade = $_POST["quantidade"];

    $_SESSION["nome"] = $nome;
    $_SESSION["valor"] = $valor;
    $_SESSION["quantidade"] = $quantidade;

    $conn->setProduto([$nome, $valor, $quantidade]);
}

?>
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
            <input type="text" name="nome" id="" placeholder="Nome do produto" autocomplete="off" class="text-box" value="<?php echo isset($_SESSION["nome"]) ? $_SESSION["nome"] : '' ?>">
<input type="text" name="valor" placeholder="Valor" autocomplete="off" class="text-box" value="<?php echo isset($_SESSION["valor"]) ? $_SESSION["valor"] : '' ?>">
<input type="number" name="quantidade" placeholder="Quantidade" class="text-box" value="<?php echo isset($_SESSION["quantidade"]) ? $_SESSION["quantidade"] : '' ?>">
            <button type="submit" class="btn-action">Cadastrar</button>
            <button type="button" onclick="abreLink('./index.php')" class="btn-action btn-secondary">Voltar</button>
        </form>
    </div>
</body>
<script src="./script.js"></script>
</html>

