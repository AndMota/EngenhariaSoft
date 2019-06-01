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
    <h1>Usuários</h1>
    <!-- Aqui está o código que trata um POST para a página, neste caso, excluir um usuário -->
    <?php
    if (isset($_POST["submit_id"])) {
        include_once('conexao.php');
        $id = $_POST['submit_id'];
        $sql = "DELETE FROM `usuarios` WHERE `usuarios`.`id` ='$id'";
        $excluir = mysqli_query($conexao, $sql); /* Exclui os dados no banco */
        $qtd = mysqli_affected_rows($conexao);
        if ($excluir && $qtd == 1) { //Se excluiu, mostra mensagem positiva
            ?>
            <div class="alert alert-success">
                <center>Usuário com ID = <?php echo $id ?> excluido com sucesso!</center>
            </div>
            <?php
        } else {  //Se não, mostra mensagem negativa
            ?>
                <div class="alert alert-warning">
                    <center>Falha ao tentar excluir o usuário com ID= <?php echo $id ?>!</center>
                </div>
            <?php
        }
    }
    ?>
    <!-- Aqui temos alguns filtros -->
    <form name="formBusca" action="./listarUsuario.php" method="POST">
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
                    <option value="2" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==2) echo 'selected'; }?>>Id &uarr;</option>
                    <option value="3" <?php if(isset($_POST["orderby"])){ if($_POST["orderby"]==3) echo 'selected'; }?>>Id &darr;</option>                
                    </select>
            </div>
            <div class="form-group col-md-2">
                    <label for="inputType">Tipo: </label>
                    <select id="inputType" name="inputType" class="form-control" onchange="enviar()">
                        <option value="0" <?php if(isset($_POST["inputType"])){ if($_POST["inputType"]==0) echo 'selected'; }?>>Cliente</option>
                        <option value="1" <?php if(isset($_POST["inputType"])){ if($_POST["inputType"]==1) echo 'selected'; }?>>Funcionário</option>
                        <option value="2" <?php if(isset($_POST["inputType"])){ if($_POST["inputType"]==2) echo 'selected'; }?>>Administrador</option>    
                        <option value="3" <?php if(isset($_POST["inputType"])){ if($_POST["inputType"]==3) echo 'selected'; }else echo 'selected'?>>Todos</option>             
                    </select>
                </div>
        </div>
    </form>
    <!-- Aqui está o código que lista os usuários na página -->
    <table class="table table-striped table-bordered" id="tabela">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Tipo</th>
                <th scope="col"></th> <!-- Info -->
                <th scope="col"></th> <!-- Editar -->
                <th scope="col"></th> <!-- Excluir -->
            </tr>
        </thead>
        <tbody>
            <?php
            include_once('conexao.php');
            $sql =  "SELECT id, nome, email, tipo ";
            $sql .= "FROM usuarios ";
            if(isset($_POST["inputType"])){
                if($_POST["inputType"] != 3)
                    $sql .= "WHERE tipo = " . $_POST["inputType"] . " ";
            }
            if(isset($_POST["orderby"])){
                switch($_POST["orderby"]){
                    case 0:
                        $sql .= "ORDER BY usuarios.nome ASC";
                        break;
                    case 1:
                        $sql .= "ORDER BY usuarios.nome DESC";
                        break;
                    case 2:
                        $sql .= "ORDER BY usuarios.id ASC";
                        break;
                    case 3:
                        $sql .= "ORDER BY usuarios.id DESC";
                        break;
                }
            }else{
                $sql .= "ORDER BY usuarios.nome ASC";
            }
            $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
            while ($row = mysqli_fetch_array($resultado)) {
                echo '<tr>';
                echo '<td scope="row">' . $row["id"] . '</td>';
                echo ' <td id="name">' . $row["nome"] . '</td>';
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