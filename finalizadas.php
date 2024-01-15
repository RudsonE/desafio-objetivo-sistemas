<?php
//aqui solicita a importação do arquivo contendo as classes
require_once './controllers/produto.php';
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
    <div class="lista">
      <button type="button" onclick="abreLink('./index.php')" class="btn-action">Voltar</button>
        <?php
        //instancia a classe venda
            $venda = new Venda;
            //obtem e exibe as vendas registradas, organizando a partir da ultima realizada
             $venda->getVenda();
        ?>
          
    </div>
    <div>
        
    </div>
</body>
<script src="./script.js"></script>
</html>
