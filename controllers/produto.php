<?php

//Classe Produto
class Produto {
    //atributos privados
    private $nome;
    private $preco;
    private $quantidade;

    public function setProduto($data){
        $this->nome = $data[0];
        $this->preco = $data[1];
        $this->quantidade = $data[2];
    }

    public function getProduto(){
        return array($this->nome, $this->preco, $this->quantidade);
    }
}

//Classe Venda
class Venda extends Produto {
    public function setVenda(){
        echo "";
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
                echo $this->connection->host_info;
            }
        } catch (Exception $e){
            die("Erro ao conectar ao banco de dados: " . $e);

        }

    }

    public function insertData(){
        //para fazer ainda
        return "";
    }
}
?>