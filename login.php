<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible">
    <title>Lojão do Zé</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="publico/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="publico/css/estilo.css">

</head>
<body>

<?php
include "header.php";
$aux=0;
?>
<legend>Login:</legend>
<?php
if(isset($_POST["email"])){
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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['tipo'] = $row['tipo'];

        //encaminha pra pagina inicial
        header('Location: index.php');
    } else{
        $aux=1;
        //session_destroy();//se der errado o login apaga dados anteriores
    }
}
?>


<form action="login.php" method="POST">
    <div class="form-row">
        <div class="form-group col-md-2">
        <label for="inputEmail4">Email</label>
        <input type="name" name="email" class="form-control" id="inputEmail4" placeholder="E-mail" required>
        </div>
        <div class="form-group col-md-2">
        <label for="inputPassword4">Senha</label>
        <input type="password" name="senha" class="form-control" id="inputPassword4" placeholder="Senha" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" value="Submit" name="submit">Confirmar</button>
</form>

</body>

<hr>

<?php
    if($aux==1){
        ?>
        <div class="alert alert-warning">
            <center>Email e/ou senha incorretos!</center>
        </div>
    <?php
    }
    include "footer.php";
?>

</html>
