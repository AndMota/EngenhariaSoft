<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastro de Setor</title>
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

<hr>

<body>
    <!-- Formulário de Cadastro de Setor -->
    <form action="" method="POST" target="_self">
        <fieldset>
            <legend>Dados do Setor:</legend>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNome">Nome</label>
                    <input type="name" name="nome" class="form-control" id="inputNome" placeholder="Nome" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputNumero">Número de Identificação</label>
                    <input type="number" name="numero" pattern=" 0+\.[0-9]*[1-9][0-9]*$"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="inputNumero" placeholder="Numero" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="adm">Administrador responsável </label>
                     <select id="adm" name="administrador" class="form-control" onchange="enviar()">
                        <?php 
                        include_once('conexao.php');
                        $sql =  "SELECT nome, id FROM usuarios WHERE tipo=2 ";
                        $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
                        while($row = mysqli_fetch_array($resultado)) {
                            echo '<option value= ' .$row["id"].'>' .$row["nome"]. '</option>';    
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
    <!-- Fim do Formulário de Cadastro de Setor  -->
    <?php
    /* Ligação com Banco de Dados */
    if(isset($_POST["submit"]))
    {

        $nome = $_POST['nome'];
        $numero = $_POST['numero'];
        $administrador = $_POST['administrador'];
        $verifica =  "SELECT num_identificacao FROM setores WHERE num_identificacao= " .$_POST['numero'];
        $num = mysqli_query($conexao, $verifica);
        $col = mysqli_num_rows($num);
        if($col!=0){
            ?>
            <div class="alert alert-warning">Falha ao cadastrar, setor já existente com o número de identificação <?php echo $numero?>!</div>
            <?php
        }
        else{
        $sql = "insert into setores (nome,num_identificacao, id_administrador) values ('$nome','$numero', '$administrador')";
        $salvar = mysqli_query($conexao,$sql);/* Escreve os dados no banco */

        if($salvar)
        {
            ?>
            <div class="alert alert-success">Setor cadastrado com sucesso!</div>
            <?php
        }
        else
        {
            die(mysqli_error($conexao));
            ?>
            <div class="alert alert-warning">Falha ao cadastrar setor!</div>
            <?php
        }
    
        mysqli_close($conexao);
    
    }
}
    ?>

</body>

<hr>

<?php
    include "footer.php";
?>

</html>
