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
    <link rel="stylesheet" href="publico/css/estilo.css">

</head>
<body>

<?php
include "header.php";
?>


<form action="verificadorLogin.php" method="POST">
    <legend>Login:</legend>
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
    include "footer.php";
?>

</html>
