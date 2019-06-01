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
    <!-- Aqui está o código que trata um POST para a página, neste caso, excluir um usuário -->
    <?php
        if (isset($_POST["submit_id"])) {
            include_once('conexao.php');
            $id = $_POST['submit_id'];
            $sql = "DELETE FROM `usuarios` WHERE `usuarios`.`id` ='$id'";
            $excluir = mysqli_query($conexao,$sql);/* Exclui os dados no banco */
            $qtd= mysqli_affected_rows($conexao);
            if($excluir && $qtd==1){ //Se excluiu, mostra mensagem positiva
                ?>
                <script>
                    alert("Usuário com ID = <?php echo $id ?> excluido com sucesso!");
                </script>
                <?php
            }else{  //Se não, mostra mensagem negativa
                ?>
                <script>
                    alert("Falha ao tentar excluir o usuário com ID= <?php echo $id ?>!");
                </script>
                <?php
            }
        }
    ?>
    <!-- Aqui está o código que lista os usuários na página -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Tipo</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once('conexao.php');
            $sql =  "SELECT id, nome, email, tipo ";
            $sql .= "FROM usuarios ";
            $sql .= "ORDER BY usuarios.nome ASC";
            $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
            while ($row = mysqli_fetch_array($resultado)) {
                echo '<tr>';
                echo '<td scope="row">' . $row["id"] . '</td>';
                echo ' <td> ' . $row["nome"] . '</td>';
                echo ' <td> ' . $row["email"] . '</td>';
                if ($row["tipo"] == '0') {
                    $t = "Cliente";
                } else if ($row["tipo"] == '2') {
                    $t = "Administrador";
                } else {
                    $t = "Funcionário";
                }
                echo ' <td> ' . $t . '</td>';
                echo ' <td>
                <center><form action="detalheUsuario.php" method="POST"><INPUT TYPE="hidden" NAME="submit_id" VALUE="' . $row["id"] . '"/><INPUT TYPE="hidden" NAME="tipo" VALUE="' . $row["tipo"] . '"/><input type="submit" class="btn btn-info" value="Info"></form></center></td>';
                echo ' <td>
                <center><form action="editarUsuario.php" method="POST"><INPUT TYPE="hidden" NAME="submit_id" VALUE="' . $row["id"] . '"/><input type="submit" class="btn btn-warning" value="Editar"></form></center></td>';
                echo ' <td>
                <center><form action="listarUsuario.php" method="POST"><INPUT TYPE="hidden" NAME="submit_id" VALUE="' . $row["id"] . '"/><input type="submit" class="btn btn-danger" value="Excluir"></form></center></td>';
                echo '</tr>';
            }
            mysqli_close($conexao);

            ?>
        <tbody>
    </table>
    <hr>

</body>

<hr>


<?php
include "footer.php";
?>

</html>