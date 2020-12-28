<?php
    //Projeto de ingredientes e suas respectivas quantidades no banco de dados.



    /*     Subi o servidor do XAMPP;
           Criar o banco de dados no phpMyAdmin - server XAMPP; 
           Fazer a conexão com o banco para começar a inserir dados;
           Os focos do projeto : 
                  1º Visualizar as informações que estão salvas no DB; 
                  2º Inserir dados de maneira 'segura' evitando os problemas com SQL Injection; 
     */
   

$hostBanco = 'mysql: host=localhost; dbname=banco_ing';
$usuario = 'root';
$senha = '';



try{


$conexaoBancoRel = new PDO($hostBanco, $usuario, $senha);

echo '<pre>';
echo "Conexão com banco de dados FEITA"; 
echo '</pre>';
echo '<hr>';

//Inserindo dados no banco, editando e atualizando, no momento o importante é focar nas TRATATIVAS COM OS DADOS. 

$query = 'INSERT INTO ingredientes( nomeIngrediente, quantidadeIngrediente) VALUES ("Carne de panela enlatada marca jorge", "2")';  


$retorno = $conexaoBancoRel ->exec($query);
echo $retorno;

//Se algum dado estiver errado basta executar a novaquery para apagar a linha que está errada:

$queryDelete= 'delete from ingredientes where id = 4' ;
$retorno = $conexaoBancoRel->exec($queryDelete); 

echo $retorno; 


//Um cliente  pediu para verificar os itens 3 5 e 2, ele quer detalhes listados dos dados daqueles enlatados:

$queryCliente1 = 'select * from ingredientes where id = 3';
$queryCliente2 = 'select * from ingredientes where id = 5';
$queryCliente3 = 'select * from ingredientes where id = 2';

$stmt = $conexaoBancoRel-> query($queryCliente1);
$listaCliente = $stmt->fetchAll(PDO::FETCH_OBJ);


echo'<pre>';
print_r($listaCliente);     
echo '</pre>';
echo '<hr>';


$stmt = $conexaoBancoRel-> query($queryCliente2);
$listaCliente = $stmt->fetchAll(PDO::FETCH_OBJ);


echo'<pre>';
print_r($listaCliente);     
echo '</pre>';
echo '<hr>';


$stmt = $conexaoBancoRel-> query($queryCliente3);
$listaCliente = $stmt->fetchAll(PDO::FETCH_OBJ);


echo'<pre>';
print_r($listaCliente);     
echo '</pre>';
echo '<hr>';

// Um outro cliente queria ver apenas o nome do produto, pois ele não se importa com a quantidade, seu foco é verificar a marca do produto:

$queryTotal = 'select * from ingredientes ';

$listaTotal = $stmt->fetchAll(PDO::FETCH_OBJ);
echo'<pre>';
print_r($listaTotal);       
echo '</pre>';



echo $listaTotal[0]->nomeIngrediente;
echo'<pre>'; echo '<hr>';
echo $listaTotal[1]->nomeIngrediente;
echo'<pre>'; echo '<hr>';
echo $listaTotal[2]->nomeIngrediente;
echo'<pre>'; echo '<hr>';
echo $listaTotal[3]->nomeIngrediente;
echo'<pre>'; echo '<hr>';
}


}

catch(PDOException $erroBanco){


echo '<pre>';
print_r($erroBanco);
echo '</pre>';


}


//Outro cliente muito influente pediu para ele mesmo inserir os dados, ele não quer que um de nossos funcionários preencha o insert de dados, como podemos ajuda-lo:

//A tratativa só vai ocorrer quando o IF for uma condição verdadeira, forma de evitar o SQL Injection:

//Dando erro, verificar depois

if(!empty($_POST['nomeIngrediente']) && !empty($_POST['quantidadeIngrediente'])) {

$hostBanco = 'mysql: host=localhost; dbname=banco_ing';
$usuario = 'root';
$senha = '';



try{
$conexaoBancoRel = new PDO($hostBanco, $usuario, $senha);

echo '<pre>';
echo "Conexão com banco de dados FEITA"; 
echo '</pre>';
echo '<hr>';





        $queryClienteExterno = "select * from ingredientes where ";
        $queryClienteExterno .= " nomeIngrediente = :Nome Ingrediente ";
        $queryClienteExterno .= " AND quantidadeIngrediente = :Quantidade Ingrediente ";

        $stmt = $conexaoBancoRel->prepare($queryClienteExterno); 

        $stmt->bindValue(':Nome Ingrediente', $_POST['nomeIngrediente']);
        $stmt->bindValue(':Quantidade Ingrediente', $_POST['quantidadeIngrediente']);

        $stmt->execute();

        $usuarioCliente = $stmt->fetch();

        print_r($usuarioCliente);

}

catch(PDOException $erroBanco){


echo '<pre>';
print_r($erroBanco);
echo '</pre>';


}
}




?>



