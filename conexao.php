<?php

date_default_timezone_set('America/Sao_Paulo');

$hostname = "localhost";
$user = "seuze";
$password = "1234";
$database = "lojaze";
$conexao = mysqli_connect($hostname, $user, $password, $database);/* Estabelece a conexão */

if(!$conexao)
{
    echo "Falha na conexão com o BD!";/* Exibe uma mensagem de erro caso a conexão falhe */
}


?>