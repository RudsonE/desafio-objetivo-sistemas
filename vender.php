<?php
//aqui solicita a importação do arquivo contendo as classes
require_once './controllers/produto.php';
?>
<!--Interface de venda-->
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
        <?php
        //verifica se os paramentros para realizar a venda foram recebidos
            if(isset($_POST['id_produto'], $_POST['quantidade'], $_POST['valor'])){
                //se sim, instancia a classe venda e insere a venda através do metodo setVenda()
                $vnd = new Venda;
                $vnd->setVenda($_POST['id_produto'], $_POST['quantidade'], $_POST['valor']);
            }
        ?>
    </div>
    <div>
        <form action="" method="post" class="cadastro">
            <h3 class="title">Venda de Produtos</h3>
            <table style="color: white;">
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
                            //esse trecho verifica se o produto_id foi recebido e renderiza as informações
                            if(isset($_POST['produto_id'])){
                                //instancia da classe produto
                                $prd = new Produto;
                                //o metodo getProduto() busca o produto com o id recebido e renderiza as informações
                                $prd->getProduto($_POST['produto_id']);
                            }
                            ?>
                        </tr>
                </tbody>
        </table>
            <input name="quantidade" type="number" placeholder="Quantidade" class="text-box" min="1" id="qua" value="1">
            <input type="number" class="text-box" placeholder="Desconto em %" id="desc" min="0" max="100">
            <input type="hidden" id="total" name="valor" value='00.00'/>
            <div>
                <span style="color: white;">Total: R$ <span id="second-value">00.00</span></span>
            </div>
            <button type="submit" class="btn-action">Finalizar</button>
            <button type="button" class="btn-action btn-secondary" onclick="abreLink('./vendas.php')">Cancelar</button>
        </form>
    </div>
</body>
<script src="script.js"></script>
</html>