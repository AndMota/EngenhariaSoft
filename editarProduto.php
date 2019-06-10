<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edição de Produto</title>
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
    /* Ligação com Banco de Dados */
    if(isset($_POST["submit"]))
    {
        $id = $_POST['submit_id'];
        $nome = $_POST['nome'];
        $fabricante = $_POST['fabricante'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];
        $setor = $_POST['setor'];
        $desconto = $_POST['desconto'];

        $sql = "UPDATE produtos (nome, fabricante, preco, quantidade_estoque, id_setor, desconto) WHERE id='$id' VALUES ('$nome','$fabricante', '$preco', '$quantidade', '$setor', '$desconto')";
        $salvar = mysqli_query($conexao,$sql);/* Escreve os dados no banco */

        if($salvar)
        {
            ?>
            <div class="alert alert-success">Produto editado com sucesso!</div>
            <?php
        }
        else
        {
            die(mysqli_error($conexao));
            ?>
            <div class="alert alert-warning">Falha ao editar produto!</div>
            <?php
        }
        //mysqli_close($conexao);
    }

    /* Busca das informações no BD */
    $sql2 = "SELECT * FROM produtos WHERE produtos.id = ".$_POST['submit_numero'];
    $resultado = mysqli_query($conexao, $sql2) or die($conexao->error);
    $row = mysqli_fetch_array($resultado);
    ?>
    <!-- Formulário de Cadastro de Produto -->
    <form action="" method="POST" target="_self">
    <input type="text" name="submit_id" class="form-control" id="submit_id" placeholder="ID" value="<?php echo $row['id'] ?>" hidden>
        <fieldset>
            <legend>Dados do Produto:</legend>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNome">Nome</label>
                    <input type="name" name="nome" class="form-control" id="inputNome" placeholder="Nome" value="<?php echo $row['nome'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputFabricante">Fabricante</label>
                    <input type="brand" name="fabricante" class="form-control" id="inputFabricante" placeholder="Fabricante" value="<?php echo $row['fabricante'] ?>" required>
                </div>
                <!--
                <div class="form-group col-md-6">
                    <label for="inputCodigoBarras">Código de Barras</label>
                    <input type="barCode" name="codigoBarras" class="form-control" id="inputCodigoBarras" placeholder="Código de Barras" required>
                </div>
                -->
                <div class="form-group col-md-4">
                    <label for="inputPreco">Preço</label>
                    <input type="price" name="preco" class="form-control" id="inputPreco" placeholder="R$00,00" maxlength="9" value="<?php echo $row['preco'] ?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputDesconto">Desconto</label>
                    <input type="desconto" name="desconto" class="form-control" id="inputDesconto" placeholder="R$00,00" maxlength="9" value="<?php echo $row['desconto'] ?>" required>
                </div>
                
                <div class="form-group col-md-4">
                    <label for="pickSetor">Setor </label>
                     <select id="department" name="setor" class="form-control" onchange="enviar()">
                        <?php
                        include_once('conexao.php');
                        $sql =  "SELECT * FROM setores";
                        $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
                        while($row2 = mysqli_fetch_array($resultado)) {
                            if($row2['num_identificacao'] == $row['id_setor'])
                            echo '<option value= ' .$row2["num_identificacao"].' selected>'.$row2["nome"]. '</option>';
                            else
                                echo '<option value= ' .$row2["num_identificacao"].'>'.$row2["nome"]. '</option>';    
                        }
                        ?>
                     </select>
                </div>
                
                <div class="form-group col-md-4">
                    <label for="inputQuantidade">Quantidade</label>
                    <input type="number" pattern=" 0+\.[0-9]*[1-9][0-9]*$"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="quantidade" class="form-control" id="inputQuantidade" placeholder="Quantidade" value="<?php echo $row['quantidade_estoque'] ?>" required>
                </div>
            
            </div>
        </fieldset>
        

        </fieldset>
        <div class="btn-submit-row">
            <button type="submit" class="btn btn-primary" value="Submit" name="submit">Confirmar</button>
        </div>

        
    </form>
    <!-- Fim do Formulário de Editar de Produto  -->

</body>

<?php
    include "footer.php";
?>

</html>
