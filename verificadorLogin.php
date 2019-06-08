<?php
session_start();
include('conexao.php');

$usuario = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select id, nome, tipo from usuarios where email = '".$usuario."' and senha = '".$senha."'";
$result = mysqli_query($conexao, $query);
$row = mysqli_fetch_array($result);
$num_rows = mysqli_num_rows($result);

//var_dump($_POST);
//var_dump($row);
//exit();

if($num_rows == 1){
    //armazena o nome e o tipo de usuario na sessão
    $_SESSION['nome'] = $row['nome'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['tipo'] = $row['tipo'];

    //encaminha pra pagina inicial
    header('Location: index.php');
} else{
    header('Location: login.php');
    //session_destroy();//se der errado o login apaga dados anteriores
}

?>