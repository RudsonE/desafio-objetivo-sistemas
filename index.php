<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Mercadinho JWT</title>
</head>
<body>
    <div class="menu-inicio">
        <h3 class="title">Mercadinho JWT</h3>
        <button class="btn-action" onclick="abreLink('./cadastros.php')">Cadastro de Produtos</button>
        <button class="btn-action" onclick="abreLink('./vendas.php')">Vendas</button>
    </div>
</body>
<script>
    function abreLink(link){
        window.location.href = link
    }
</script>
</html>