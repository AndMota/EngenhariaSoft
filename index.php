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

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="publico/imagens/prateleira1.jpg" class="d-block w-100" alt="Primeiro slide">
        </div>
        <div class="carousel-item">
        <img src="publico/imagens/prateleira2.jpg" class="d-block w-100" alt="Segundo slide">
        </div>
        <div class="carousel-item">
        <img src="publico/imagens/prateleira3.jpg" class="d-block w-100" alt="Terceiro slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>

    <!-- Fim do Carrossel -->
    <hr>
    <!-- Texto descritivo do Lojão do Zé -->
    <h2>Produtos em promoção:</h2>
    <table class="table table-striped table-bordered" id="tabela">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Fabricante</th>
                <th scope="col">Preço Promocional</th>
                <th scope="col">Estoque</th>
                <th scope="col">Setor</th>
                </tr>
        </thead>
        <tbody>
            <?php
            include_once('conexao.php');
            $sql =  "SELECT produtos.id, produtos.quantidade_estoque, produtos.nome, produtos.fabricante, produtos.preco, produtos.desconto, setores.nome as nomeSetor FROM produtos INNER JOIN setores ON produtos.id_setor=setores.num_identificacao AND produtos.desconto>0";
            $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
            while ($row = mysqli_fetch_array($resultado)) {
                echo '<tr>';
                echo '<td id="name">' . $row["nome"] . '</td>';
                echo '<td>' . $row["fabricante"] . '</td>';
                $preco=$row["preco"]-$row["desconto"];
                echo '<td>R$ ' . number_format($preco,2,".","") . '</td>';
                echo '<td>' . $row["quantidade_estoque"] . '</td>';
                echo '<td>' . $row["nomeSetor"] . '</td>';
                echo '</tr>';
            }
            mysqli_close($conexao);

            ?>
        <tbody>
    </table>
    <!-- Fim do Texto descritivo do Lojão do Zé -->
</body>

<hr>


<?php
    include "footer.php";
?>

</html>