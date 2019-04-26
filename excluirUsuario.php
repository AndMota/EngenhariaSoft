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
    include_once("conexao.php");/* Estabelece a conexão */
    if(isset($_POST["cpf"]))
    {
        $cpf = $_POST['cpf'];
        $sql = "DELETE FROM `usuarios` WHERE `usuarios`.`cpf` ='$cpf'";
        $excluir = mysqli_query($conexao,$sql);/* Exclui os dados no banco */
        $qtd= mysqli_affected_rows($conexao);
    }
    $sql = "SELECT `email`, `nome`, `cpf` FROM `usuarios` ORDER BY `usuarios`.`nome` ASC";
    $resultado = mysqli_query($conexao, $sql);
    if(($row = mysqli_fetch_array($resultado))!=NULL){
        ?>
        <table class ="table">
	    <thead>
        <tr>
        <th scope="col"></th>
        <th scope="col">CPF</th>
        <th scope="col">Nome</th>
        <th scope="col">E-mail</th>
        </tr>
	    </thead>
        <tbody>
        <?php
        do {
            echo '<tr>';
            echo ' <td>
            <center><form action="excluirUsuario.php" method="POST"><INPUT TYPE="hidden" NAME="cpf" VALUE="'.$row["cpf"].'"><input type="submit" class="btn btn-danger" value="Excluir"></form></center></td>';
		    echo ' <td> '.$row["cpf"].'</td>';
            echo ' <td> '.$row["nome"].'</td>';
            echo ' <td> '.$row["email"].'</td>';
		    echo '</tr>';
        }while($row = mysqli_fetch_array($resultado));
    }else{
        echo '<div class="alert alert-success"><center>Não existem usuarios cadastrados</center></div>';
    }
    echo '</table >';
	if(isset($_POST["cpf"])){
        if(!$excluir){
            die(mysqli_error($conexao));
        }
        if($qtd==1){
            ?>
            <div class="alert alert-success"><center>Usuário com CPF = <?php echo $cpf ?> excluido com sucesso!</center></div>
            <?php
        }
        else{
            ?>
            <div class="alert alert-warning"><center>Falha ao tentar excluir o usuário com CPF= <?php echo $cpf ?>!</center></div>
            <?php
        } 
    }
    mysqli_close($conexao);
	?>
	</table>
    <hr>
    <tbody>

<hr>

<?php
    include "footer.php";
?>
</body>

</html>