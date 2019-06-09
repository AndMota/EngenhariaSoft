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
<?php
    include "header.php";
?>

<body>
<?php
    include_once('conexao.php');

    $sql =  "SELECT setores.nome as n, setores.num_identificacao, setores.id_administrador, usuarios.nome, usuarios.id FROM setores INNER JOIN usuarios ON usuarios.tipo=2 AND usuarios.id=setores.id_administrador  WHERE num_identificacao= " . $_POST["submit_numero"];
    $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
    $row = mysqli_fetch_array($resultado);

    mysqli_close($conexao);
    ?>
    
	<table class ="table table-striped table-bordered">
        <thead>
                <tr><th colspan="2" scope="col">Dados do setor de número <?php echo $row['num_identificacao'];?></th></tr>
        </thead>
        <tbody>
            <tr>
                <td class="td-userlist">Nome:</td><td><?php echo $row['n'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">Número de indentificação:</td><td><?php echo $row['num_identificacao'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">Administrador responsável:</td><td><?php echo $row['nome'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">ID do administrador:</td><td><?php echo $row['id_administrador'];?></td>
            </tr>
        </tbody>
	</table>

</body>

<?php
    include "footer.php";
?>

</html>