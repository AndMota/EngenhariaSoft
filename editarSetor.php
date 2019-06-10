<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editar de Setor</title>
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
    <!-- Trata se o setor foi editado corretamente -->
    <?php
    /* Ligação com Banco de Dados */
    if (isset($_POST["submit"])) {
        $nome = $_POST['nome'];
        $numero = $_POST['numero'];
        $administrador = $_POST['administrador'];

        $sql = "UPDATE setores WHERE num_identificacao=".$numero." SET (nome, id_administrador) VALUES ('$nome', '$administrador')";
        $salvar = mysqli_query($conexao, $sql); /* Escreve os dados no banco */

        if ($salvar) {
            ?>
            <div class="alert alert-success">Setor editado com sucesso!</div>
            <?php
        } else {
            die(mysqli_error($conexao));
            ?>
                <div class="alert alert-warning">Falha ao editar setor!</div>
            <?php
        }
    }
    ?>
    <!-- Aqui está o código que trata um POST para a página, neste caso, editar um setor -->
    <?php
        include_once('conexao.php');
        $sql =  "SELECT * FROM setores WHERE num_identificacao=" . $_POST['submit_numero'];
        $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
        $row = mysqli_fetch_array($resultado);
        $name = $row['nome'];
        $id_adm = $row['id_administrador'];
        $num = $row['num_identificacao'];
    ?>
    <!-- Formulário de Editação de Setor -->
    <form action="" method="POST" target="_self">
        <fieldset>
            <legend>Dados do Setor:</legend>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNome">Nome</label>
                    <input type="name" name="nome" class="form-control" id="inputNome" placeholder="Nome" value="<?php echo $name ?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputNumero">Número de Identificação</label>
                    <input type="number" name="numero" pattern=" 0+\.[0-9]*[1-9][0-9]*$" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="inputNumero" placeholder="Numero"  value="<?php echo $num ?>" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="adm">Administrador responsável </label>
                    <select id="adm" name="administrador" class="form-control" onchange="enviar()">
                        <?php
                        include_once('conexao.php');
                        $sql =  "SELECT nome, id FROM usuarios WHERE tipo=2 ";
                        $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
                        while ($row = mysqli_fetch_array($resultado)) {
                            if($id_adm == $row["id"])
                                echo '<option value= ' . $row["id"] . ' selected>' . $row["nome"] . '</option>';
                            else
                                echo '<option value= ' . $row["id"] . '>' . $row["nome"] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </fieldset>


        </fieldset>
        <div class="btn-submit-row">
            <button type="submit" class="btn btn-primary" value="Submit" name="submit">Confirmar</button>
        </div>


    </form>
    <!-- Fim do Formulário de Edição de Setor  -->
    <?php
        mysqli_close($conexao);
    ?>
</body>

<?php
include "footer.php";
?>

</html>