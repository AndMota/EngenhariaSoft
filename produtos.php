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
    
    <!-- Aqui temos alguns filtros -->
    <form name="formBusca" action="./produtos.php" method="POST">
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
    <table class="table table-striped table-bordered" id="tabela">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Fabricante</th>
                <th scope="col">Preço</th>
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
                echo '<td id="name">' . $row["nome"] . '</td>';
                echo '<td>' . $row["fabricante"] . '</td>';
                $preco=$row["preco"]-$row["desconto"];
                echo '<td> R$ ' . number_format($preco,2,",","") . '</td>';
                echo '<td>' . $row["quantidade_estoque"] . '</td>';
                echo '<td>' . $row["nomeSetor"] . '</td>';
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