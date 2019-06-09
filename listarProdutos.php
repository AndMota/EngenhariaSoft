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
    <!-- Título da página -->
    <h1>Produtos</h1>
    <!-- Aqui está o código que trata um POST para a página, neste caso, excluir um setor -->
    <?php
    if (isset($_POST["submit_numero"])) {
        include_once('conexao.php');
        $numero = $_POST['submit_numero'];
        $sql = "DELETE FROM `produtos` WHERE `produtos`.`id` ='$numero'";
        $excluir = mysqli_query($conexao, $sql); /* Exclui os dados no banco */
        $qtd = mysqli_affected_rows($conexao);
        if ($excluir && $qtd == 1) { //Se excluiu, mostra mensagem positiva
            ?>
            <div class="alert alert-success">
                <center>Produto com id = <?php echo $numero ?> excluido com sucesso!</center>
            </div>
            <?php
        } else {  //Se não, mostra mensagem negativa
            ?>
                <div class="alert alert-warning">
                    <center>Falha ao tentar excluir o produto com id= <?php echo $numero ?>!</center>
                </div>
            <?php
        }
    }
    ?>
    
    <!-- Aqui temos alguns filtros -->
    <form name="formBusca" action="./listarProdutos.php" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputBusca">Buscar: </label>
                <input type="text" name="busca" class="form-control" id="inputBusca" placeholder="Digite aqui um nome para buscar" />
            </div>
            <div class="form-group col-md-4">
                <label for="ordenarPor">Ordenar Por: </label>
                    <select id="orderby" name="orderby" class="form-control" onchange="enviar()">
                    <option value="0" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==0) echo 'selected'; }?>>Nome &uarr;</option>
                    <option value="1" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==1) echo 'selected'; }?>>Nome &darr;</option>
                    <option value="2" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==2) echo 'selected'; }?>>Preço &uarr;</option>
                    <option value="3" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==3) echo 'selected'; }?>>Preço &darr;</option>                
                    <option value="4" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==4) echo 'selected'; }?>>Quantidade &uarr;</option>
                    <option value="5" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==5) echo 'selected'; }?>>Quantidade &darr;</option>
                    <option value="6" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==6) echo 'selected'; }?>>Setor &uarr;</option>
                    <option value="7" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==7) echo 'selected'; }?>>Setor &darr;</option>
                    </select>
            </div>
        </div>
    </form>
    <!-- Aqui está o código que lista os setores na página -->
    <table class="table table-striped table-bordered" id="tabela">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Fabricante</th>
                <th scope="col">Preço</th>
                <th scope="col">Desconto</th>
                <th scope="col">Preço Promocional</th>
                <th scope="col">Estoque</th>
                <th scope="col">Setor</th>
                <th scope="col"></th> <!-- Info -->
                <th scope="col"></th> <!-- Editar -->
                <th scope="col"></th> <!-- Excluir -->
            </tr>
        </thead>
        <tbody>
            <?php
            include_once('conexao.php');
            $sql =  "SELECT produtos.id, produtos.nome, produtos.fabricante, produtos.preco, produtos.desconto, produtos.quantidade_estoque, setores.nome as nomeSetor FROM produtos INNER JOIN setores ON produtos.id_setor=setores.num_identificacao ";
            if(isset($_POST["orderby"])){
                switch($_POST["orderby"]){
                    case 0:
                        $sql .= "ORDER BY produtos.nome ASC";
                        break;
                    case 1:
                        $sql .= "ORDER BY produtos.nome DESC";
                        break;
                    case 2:
                        $sql .= "ORDER BY produtos.preco ASC";
                        break;
                    case 3:
                        $sql .= "ORDER BY produtos.preco DESC";
                        break;
                    case 4:
                        $sql .= "ORDER BY produtos.quantidade_estoque ASC";
                        break;
                    case 5:
                        $sql .= "ORDER BY produtos.quantidade_estoque DESC";
                        break;
                    case 6:
                        $sql .= "ORDER BY setores.nome ASC";
                        break;
                    case 7:
                        $sql .= "ORDER BY setores.nome DESC";
                        break;
                }
            }else{
                $sql .= "ORDER BY produtos.nome ASC";
            }
            $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
            while ($row = mysqli_fetch_array($resultado)) {
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td id="name">' . $row["nome"] . '</td>';
                echo '<td>' . $row["fabricante"] . '</td>';
                echo '<td>' . $row["preco"] . '</td>';
                echo '<td>' . $row["desconto"] . '</td>';
                $preco=$row["preco"]-$row["desconto"];
                echo '<td>' . number_format($preco,2,".","") . '</td>';
                echo '<td>' . $row["quantidade_estoque"] . '</td>';
                echo '<td>' . $row["nomeSetor"] . '</td>';
                echo ' <td>
                <center><form action="infoProduto.php" method="POST"><INPUT TYPE="hidden" NAME="submit_numero" VALUE="' . $row["id"] . '"/><input type="submit" class="btn btn-info" value="Info"></form></center></td>';
                echo ' <td>
                <center><form action="editarProduto.php" method="POST"><INPUT TYPE="hidden" NAME="submit_numero" VALUE="' . $row["id"] . '"/><input type="submit" class="btn btn-warning" value="Editar"></form></center></td>';
                echo ' <td>
                <center><form action="listarProdutos.php" method="POST"><INPUT TYPE="hidden" NAME="submit_numero" VALUE="' . $row["id"] . '"/><input type="submit" class="btn btn-danger" value="Excluir"></form></center></td>';
                echo '</tr>';
            }
            mysqli_close($conexao);

            ?>
        <tbody>
    </table>
    <hr>

    <!-- Aqui, um script bara uma busca simple na tabela -->
    <script>
        document.forms.formBusca.addEventListener("submit", function (e){
            if(document.activeElement == document.getElementById("inputBusca")){
                e.preventDefault();     //Previne o envio da solicitação

                //Exibe apenas as linhas com a string de busca
                var texto = document.forms.formBusca.busca.value;
                
                for(i=0; i<document.getElementById("tabela").rows.length; i++){
                    var linha = document.getElementById("tabela").rows[i].cells.namedItem("name");
                    if(linha != null){
                        if(linha.innerText.toLowerCase().search(texto.toLowerCase()) == -1){  //Se não achou, some
                            document.getElementById("tabela").rows[i].hidden = true;
                        }else{
                            document.getElementById("tabela").rows[i].hidden = false;
                        }
                    }
                }
            }
        });

        //Envia formulário
        function enviar(){
            document.forms.formBusca.submit();
        }
    </script>

</body>

<hr>


<?php
include "footer.php";
?>

</html>