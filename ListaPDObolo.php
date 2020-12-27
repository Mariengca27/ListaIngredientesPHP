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

//Inserindo dados no banco, editando e atualizando, no momento o importante é focar nas TRATATIVAS COM OS DADOS. 

$query = 'INSERT INTO ingredientes( nomeIngrediente, quantidadeIngrediente) VALUES ("Carne de panela enlatada marca jorge", "2")';  


$retorno = $conexaoBancoRel ->exec($query);
echo $retorno;

//Se algum dado estiver errado basta executar a novaquery para apagar a linha que está errada:

$queryDelete= 'delete from ingredientes where id = 4' ;
$retorno = $conexaoBancoRel->exec($queryDelete); 

echo $retorno; 




}

catch(PDOException $erroBanco){


echo '<pre>';
print_r($erroBanco);
echo '</pre>';


}











?>