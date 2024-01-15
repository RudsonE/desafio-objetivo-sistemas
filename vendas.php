<?php
//aqui solicita a importação do arquivo contendo as classes
require_once './controllers/produto.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadinho JWT</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="vendas">
   
    </div>
    <div>
        <form action="vender.php" method="post" class="cadastro">
            <h3 class="title">Selecione um produto para iniciar a venda</h3>
            <select name="produto_id" id="" class="text-box">
                <?php
                //esse trecho instancia a classe produto e usa seu metodo para obter os produtos cadastrados
                    $prd = new Produto;
                    $prd->getProdutos();
                ?>
            </select>
            <button type="submit" class="btn-action">Vender</button>
            <button type="button" onclick="abreLink('./index.php')" class="btn-action btn-secondary">Voltar</button>
        </form>
    </div>
</body>
<script src="./script.js"></script>
</html>