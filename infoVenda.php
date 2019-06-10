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

    $sql1 =  "SELECT vendas.id, vendas.data_venda, vendas.valor_total, usuarios.nome FROM vendas INNER JOIN usuarios ON usuarios.tipo=0 AND usuarios.id=id_cliente OR usuarios.tipo=3 AND usuarios.id=id_cliente ";
    $sql1 .= "WHERE vendas.id=" . $_POST["submit_id"];
    $sql2 = "SELECT vendas.id, vendas.data_venda, vendas.valor_total, usuarios.nome FROM vendas INNER JOIN usuarios ON usuarios.tipo=1 AND usuarios.id=id_funcionario OR usuarios.tipo=2 AND usuarios.id=id_funcionario ";
    $sql2 .= "WHERE vendas.id=" . $_POST["submit_id"];

    $resultado = mysqli_query($conexao, $sql1) or die($conexao->error);
    $resultado2 = mysqli_query($conexao, $sql2) or die($conexao->error);
    //$resultado3 = mysqli_query($conexao, $sql3) or die($conexao->error);
    $row1 = mysqli_fetch_array($resultado);
    $row2 = mysqli_fetch_array($resultado2);
    //$row3 = mysqli_fetch_array($resultado3);




     

?>
    
	<table class ="table table-striped table-bordered">
        <thead>
                <tr><th colspan="2" scope="col">Dados da Venda</th></tr>
        </thead>
        <tbody>
            <tr>
                <td class="td-userlist">ID:</td><td><?php echo $row1['id'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">Data:</td><td><?php echo $row1['data_venda'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">Valor Total:</td><td>R$ <?php echo number_format($row1['valor_total'],2,".","");?></td>
            </tr>
            <tr>
                <td class="td-userlist">Cliente:</td><td><?php echo $row1['nome'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">Funcionário:</td><td><?php echo $row2['nome'];?></td>
            </tr>
            

        </tbody>
	</table>
    <table class="table table-striped table-bordered" id="tabela">
        <thead>
            <tr>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade </th>
                <th scope="col">Valor Vendido</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once('conexao.php');
            $sql =  "SELECT produtos.nome, item_venda.quantidade, item_venda.valor_vendido FROM produtos INNER JOIN item_venda INNER JOIN vendas ON item_venda.id_produto=produtos.id AND item_venda.id_pedido=vendas.id ";
            $sql .= "WHERE vendas.id=" . $_POST["submit_id"];
            $sql .= " ORDER BY produtos.nome ASC";
            $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
            while ($row = mysqli_fetch_array($resultado)) {
                echo '<tr>';
                echo '<td scope="row">' . $row["nome"] . '</td>';
                echo ' <td> ' . $row["quantidade"] . '</td>';
                echo ' <td id="name">R$ ' . number_format($row["valor_vendido"],2,".","") . '</td>';
            }
            mysqli_close($conexao);

            ?>
        <tbody>
    </table>
    <hr>

</body>

<?php
    include "footer.php";
?>

</html>