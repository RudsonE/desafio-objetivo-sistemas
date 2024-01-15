<?php

//Classe Produto
class Produto {
    //atributos privados
    private $nome;
    private $preco;
    private $quantidade;
    
    public function setProduto($data){
        $conn = new Database;
        $this->nome = $data[0];
        $this->preco = $data[1];
        $this->quantidade = $data[2];
        $conn->insertData($this->nome, $this->preco, $this->quantidade);
        
    }

    public function getProdutos(){
        $conn = new Database;
        $query = "SELECT * FROM produtos";

        try{
            $results = $conn->getConnection()->query($query);
            if($results->num_rows > 0){
                while ($row = $results->fetch_object()){
                    echo "<option value='$row->id'>$row->nome</option>";
                }
            }
        } catch (Exeption $e){
            echo "Erro: " . $e;
        }
    }
    public function getProduto($produto_id){
        $conn = new Database;
        $query = "SELECT * FROM produtos WHERE id = $produto_id";

        try{
            $results = $conn->getConnection()->query($query);
            if($results->num_rows > 0){
                while ($row = $results->fetch_object()){
                    echo "<input type='hidden' name='id_produto'value='$row->id'/>";
                    echo "<td>$row->nome</td>";
                    echo "<td id='val'>$row->preco</td>";
                    echo "<td id='quant'>$row->quantidade</td>";
                }
            }
        } catch (Exeption $e){
            echo "Erro: " . $e;
        }
    }
}

//Classe Venda
class Venda extends Produto {
    public function setVenda($produto_id, $quantidade, $valor){
        $conn = new Database;
        $stock = "SELECT * FROM produtos WHERE id = $produto_id";
        $query = "INSERT INTO vendas (produto, quantidade_venda, valor_venda, data_venda) VALUES ($produto_id, $quantidade, $valor, NOW())";
        $getStock = $conn->getConnection()->query($stock);
        if($getStock->num_rows > 0){
            $row = $getStock->fetch_object();
            if($row->quantidade >= $quantidade){
                try{
                    $conn->getConnection()->query('UPDATE produtos SET quantidade = ' . $row->quantidade - $quantidade );
                    $conn->getConnection()->query($query);
                } catch (Exception $e){
                    echo "Erro ao criar a venda: $e";
                }
            }
        }
    }
    

    public function getVenda(){
       echo ""; 
    }
}

//Classe database
class Database {
    //Atributos privados
    private $connection;

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db = "jwt_pdv";

    //Executa o bloco a seguir quando a classe for instanciada
    public function __construct(){
        try{
            $this->connection = new mysqli($this->host, $this->user, $this->password, $this->db);
            if($this->connection){
                //echo $this->connection->host_info;
            }
        } catch (Exception $e){
            die("Erro ao conectar ao banco de dados: " . $e);

        }

    }

    public function insertData($nome, $preco, $quantidade){
        $checkData = $this->connection->query("SELECT * FROM produtos WHERE nome = '$nome'");
        $query = "INSERT INTO produtos (nome, preco, quantidade, data_cadastro) VALUES ('$nome', $preco, $quantidade, NOW())";

        if($checkData->num_rows > 0){
            echo "O produto já está cadastrado no sistema. Não foi inserido.";
        } else {
            if($this->connection->query($query) === TRUE){
                echo "Produto inserido com sucesso.";
            }else{
                echo "Erro ao inserir o produto: " . $this->connection->error;
            }
        }

    }
    public function getConnection(){
        return $this->connection;
    }
    public function closeConnection(){
        
    }
}
?>