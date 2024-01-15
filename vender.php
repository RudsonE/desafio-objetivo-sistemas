<?php
session_start();
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
        <form action="" method="post" class="cadastro">
            <h3 class="title">Venda de Produtos</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nome do Produto</th>
                        <th>Preço (R$)</th>
                        <th>Quantidade em Estoque</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <?php
                                $prd = new Produto;
                                $prd->getProduto($_POST['produto_id']);
                            ?>
                        </tr>
                </tbody>
        </table>
            <input type="number" placeholder="Quantidade" class="text-box">
            <input type="number" class="text-box" placeholder="Desconto em %" id="desc">
            <div>
                <span>Total: <span id="total">00.00</span></span>
            </div>
        </form>
    </div>
</body>
<script src="script.js"></script>
</html>