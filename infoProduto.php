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

    $sql =  "SELECT produtos.id, produtos.nome, produtos.fabricante, produtos.preco, produtos.desconto, produtos.quantidade_estoque, setores.nome as nomeSetor FROM produtos INNER JOIN setores ON produtos.id_setor=setores.num_identificacao WHERE produtos.id=".$_POST['submit_numero'];
    $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
    $row = mysqli_fetch_array($resultado);

    mysqli_close($conexao);
    ?>
    
	<table class ="table table-striped table-bordered">
        <thead>
                <tr><th colspan="2" scope="col">Dados do produto de ID <?php echo $_POST['submit_numero'];?></th></tr>
        </thead>
        <tbody>
            <tr>
                <td class="td-userlist">Nome:</td><td><?php echo $row['nome'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">Fabricante:</td><td><?php echo $row['fabricante'];?></td>
            </tr>
            <tr>    
                <td class="td-userlist">Preço Cheio:</td><td><?php echo $row['preco'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">Desconto:</td><td><?php echo $row['desconto'];?></td>
            </tr>
            <tr>    
                <td class="td-userlist">Preço atual:</td><td><?php $preco = $row['preco']-$row['desconto']; echo number_format($preco,2,".","");?></td>
            </tr>
            <tr>
                <td class="td-userlist">Quantidade em estoque:</td><td><?php echo $row['quantidade_estoque'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">Setor:</td><td><?php echo $row['nomeSetor'];?></td>
            </tr>
            
        </tbody>
	</table>

</body>

<?php
    include "footer.php";
?>

</html>