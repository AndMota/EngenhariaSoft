<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Produtos</title>
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
    <h1>Vendas</h1>
    <!-- Aqui está o código que trata um POST para a página, neste caso, excluir uma venda -->
    <?php
    if (isset($_POST["submit_id"])) {
        include_once('conexao.php');
        $numero = $_POST['submit_id'];
        $sql = "DELETE FROM `item_venda` WHERE `item_venda`.`id_pedido` ='$numero'";
        $excluir = mysqli_query($conexao, $sql); /* Exclui os dados no banco */
        $sql = "DELETE FROM `vendas` WHERE `vendas`.`id` ='$numero'";
        $excluir = mysqli_query($conexao, $sql); /* Exclui os dados no banco */
        $qtd = mysqli_affected_rows($conexao);
        if ($excluir && $qtd == 1) { //Se excluiu, mostra mensagem positiva
            ?>
            <div class="alert alert-success">
                <center>Venda excluida com sucesso!</center>
            </div>
            <?php
        } else {  //Se não, mostra mensagem negativa
            ?>
                <div class="alert alert-warning">
                    <center>Falha ao tentar excluir a venda!</center>
                </div>
            <?php
        }
    }
    ?>
    <!-- Aqui temos alguns filtros -->
    <form name="formBusca" action="./listarVendas.php" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputBusca">Buscar: </label>
                <input type="text" name="busca" class="form-control" id="inputBusca" placeholder="Digite aqui um nome de vendedor para buscar" />
            </div>
            <div class="form-group col-md-4">
                <label for="ordenarPor">Ordenar Por: </label>
                    <select id="orderby" name="orderby" class="form-control" onchange="enviar()">
                    <option value="0" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==0) echo 'selected'; }?>>Data &darr;</option>
                    <option value="1" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==1) echo 'selected'; }?>>Data &uarr;</option>
                    <option value="2" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==2) echo 'selected'; }?>>Id &uarr;</option>
                    <option value="3" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==3) echo 'selected'; }?>>Id &darr;</option>     
                    <option value="4" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==4) echo 'selected'; }?>>Vendedor &uarr;</option>
                    <option value="5" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==5) echo 'selected'; }?>>Vendedor &darr;</option>     
                    <option value="6" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==6) echo 'selected'; }?>>Valor &uarr;</option>
                    <option value="7" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==7) echo 'selected'; }?>>Valor &darr;</option>  
                    </select>
            </div>
        </div>
    </form>
    <!-- Aqui está o código que lista as vendas na página -->
    <table class="table table-striped table-bordered" id="tabela">
        <thead>
            <tr>
                <th scope="col">ID Venda</th>
                <th scope="col">ID Cliente </th>
                <th scope="col">Vendedor</th>
                <th scope="col">Data</th>
                <th scope="col">Valor</th>
                <th scope="col"></th> <!-- Info -->
                <th scope="col"></th> <!-- Editar -->
                <th scope="col"></th> <!-- Excluir -->
            </tr>
        </thead>
        <tbody>
            <?php
            include_once('conexao.php');
            $sql =  "SELECT vendas.id as idVenda, vendas.id_cliente, vendas.id_funcionario, vendas.data_venda, vendas.valor_total, usuarios.nome, usuarios.id FROM vendas INNER JOIN usuarios ON usuarios.tipo=2 AND usuarios.id=vendas.id_funcionario OR usuarios.tipo=1 AND usuarios.id=vendas.id_funcionario ";
            if(isset($_POST["orderby"])){
                switch($_POST["orderby"]){
                    case 0:
                        $sql .= "ORDER BY vendas.data_venda DESC";
                        break;
                    case 1:
                        $sql .= "ORDER BY vendas.data_venda ASC";
                        break;
                    case 2:
                        $sql .= "ORDER BY vendas.id ASC";
                        break;
                    case 3:
                        $sql .= "ORDER BY vendas.id DESC";
                        break;
                    case 4:
                        $sql .= "ORDER BY usuarios.nome ASC";
                        break;
                    case 5:
                        $sql .= "ORDER BY usuarios.nome DESC";
                        break;
                    case 6:
                        $sql .= "ORDER BY vendas.valor_total DESC";
                        break;
                    case 7:
                        $sql .= "ORDER BY vendas.valor_total DESC";
                        break;
                }
            }else{
                $sql .= "ORDER BY vendas.id DESC";
            }
            $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
            while ($row = mysqli_fetch_array($resultado)) {
                echo '<tr>';
                echo '<td scope="row">' . $row["idVenda"] . '</td>';
                echo ' <td> ' . $row["id_cliente"] . '</td>';
                echo ' <td id="name"> ' . $row["nome"] . '</td>';
                echo ' <td> ' . $row["data_venda"] . '</td>';
                echo ' <td> ' . $row["valor_total"] . '</td>';
                echo ' <td>
                <center><form action="infoVenda.php" method="POST"><INPUT TYPE="hidden" NAME="submit_id" VALUE="' . $row["idVenda"] . '"/><input type="submit" class="btn btn-info" value="Info"></form></center></td>';
                echo ' <td>
                <center><form action="editarVenda.php" method="POST"><INPUT TYPE="hidden" NAME="submit_id" VALUE="' . $row["idVenda"] . '"/><input type="submit" class="btn btn-warning" value="Editar"></form></center></td>';
                echo ' <td>
                <center><form action="listarVendas.php" method="POST"><INPUT TYPE="hidden" NAME="submit_id" VALUE="' . $row["idVenda"] . '"/><input type="submit" class="btn btn-danger" value="Excluir"></form></center></td>';
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