<?php
//arquivo contendo as classes necessárias

//Classe Produto
class Produto {
    //atributos privados
    private $nome;
    private $preco;
    private $quantidade;
    
    //define e insere um novo produto
    public function setProduto($data){
        //instancia a classe Database
        $conn = new Database;
        $this->nome = $data[0];
        $this->preco = $data[1];
        $this->quantidade = $data[2];
        //chama o metodo insertData e insere os dados do produto
        $conn->insertData($this->nome, $this->preco, $this->quantidade);
        
    }

    public function getProdutos(){
        //instancia a classe Database
        $conn = new Database;
        //query para selecionar todos os  produtos
        $query = "SELECT * FROM produtos";

        //faz a tentativa de obter
        try{
            //$results armazena os resultados de busca da query
            $results = $conn->getConnection()->query($query);
            //se a consulta obtiver resultados, insere as opções de venda na interface
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
        //instancia a classe Database
        $conn = new Database;
        //query para selecionar todos os  produtos cujo o id é identico ao recebido
        $query = "SELECT * FROM produtos WHERE id = $produto_id";

        //faz a tentativa de obter
        try{
            //$results armazena os resultados de busca da query
            $results = $conn->getConnection()->query($query);
            if($results->num_rows > 0){
                //renderiza as informações do produto selecionado
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
        //instancia a classe Database
        $conn = new Database;
        //query para selecionar todos os  produtos cujo o id é identico ao recebido
        $stock = "SELECT * FROM produtos WHERE id = $produto_id";
        //query para registrar a venda
        $query = "INSERT INTO vendas (produto, quantidade_venda, valor_venda, data_venda) VALUES ($produto_id, $quantidade, $valor, NOW())";
        $getStock = $conn->getConnection()->query($stock);
        //verificação de estoque do produto selecionado
        if($getStock->num_rows > 0){
            $row = $getStock->fetch_object();
            //te tiver em estoque tenta resgitrar a venda
            if($row->quantidade >= $quantidade){
                try{
                    //atualiza a quantidade do produto em estoque e renderiza um aviso
                    $conn->getConnection()->query("UPDATE produtos  SET quantidade = quantidade - $quantidade WHERE id = $produto_id");
                    $conn->getConnection()->query($query);
                    echo "<div class='sucesso'>";
                    echo "<h4 style='color: white;'>Venda inserida com sucesso.</h4>";
                    echo '</div>';
                //em caso de erro renderiza um aviso
                } catch (Exception $e){

                    echo "<div class='erro'>";
                    echo "<h4 style='color: white;'>Erro ao inserir venda</h4>";
                    echo '</div>';
                   
                }
            }else{
                //renderiza um aviso de fora de estoque caso esteja zerado
                    echo "<div class='erro'>";
                    echo "<h4 style='color: white;'>Produto fora de estoque.</h4>";
                    echo '</div>';
            }
        }
    }
    

    public function getVenda(){
         //instancia a classe Database
        $conn = new Database;
        //query para selecionar todas as vendas realizada e ordenar da ultima a primeira
        $query = 'SELECT vendas.id, produtos.nome, vendas.quantidade_venda, vendas.valor_venda, vendas.data_venda
        FROM vendas
        INNER JOIN produtos ON vendas.produto = produtos.id
        ORDER BY vendas.data_venda DESC';
        
        try {
            //solicita as informações e renderiza
            $results = $conn->getConnection()->query($query);
    
            echo "<table style='color: white;'>";
            echo "<thead>
                    <tr>
                        <th>Nome do Produto</th>
                        <th>Quantidade</th>
                        <th>Valor da venda (R$)</th>
                        <th>Data da Venda</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
    
            while($row = $results->fetch_object()){
                echo "<tr>";
                echo "<td>{$row->nome}</td>";
                echo "<td>{$row->quantidade_venda}</td>";
                echo "<td>R$ {$row->valor_venda}</td>";
                echo "<td>{$row->data_venda}</td>";
                echo "</tr>";
    
            }
    
            echo "</tbody>";
            echo "</table>";
        } catch (Exception $e){
            echo 'Erro: ' . $e->getMessage();
        }
    }
    
       
    
}

//Classe database
class Database {
    //Atributos privados
    private $connection;
    //dados de conexão com o banco
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db = "jwt_pdv";

    //Executa o bloco a seguir quando a classe for instanciada
    public function __construct(){
        try{
            //cria conexão com o banco
            $this->connection = new mysqli($this->host, $this->user, $this->password, $this->db);
        } catch (Exception $e){
            die("Erro ao conectar ao banco de dados: " . $e);

        }

    }
    //função para verificar os dados e inserir no banco
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
    //torna acessivel a conexão com o banco
    public function getConnection(){
        return $this->connection;
    }
}
?>