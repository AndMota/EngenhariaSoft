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
        $id = $_POST['submit_numero'];
        $nome = $_POST['nome'];
        $fabricante = $_POST['fabricante'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];
        $setor = $_POST['setor'];
        $desconto = $_POST['desconto'];

        $sql = "UPDATE produtos SET nome='$nome', fabricante='$fabricante', preco='$preco', quantidade_estoque='$quantidade', id_setor='$setor', desconto='$desconto' WHERE produtos.id='$id'";
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
    <!-- Formulário de Edição de Produto -->
    <form action="" method="POST" target="_self">
    <input type="text" name="submit_numero" class="form-control" id="submit_numero" placeholder="ID" value="<?php echo $row['id'] ?>" hidden>
        <fieldset>
            <legend>Dados do Produto:</legend>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNome">Nome</label>
                    <input type="name" name="nome" class="form-control" id="inputNome" placeholder="Nome" value="<?php echo $row['nome'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputFabricante">Fabricante</label>
                    <input type="text" name="fabricante" class="form-control" id="inputFabricante" placeholder="Fabricante" value="<?php echo $row['fabricante'] ?>" required>
                </div>
                <!--
                <div class="form-group col-md-6">
                    <label for="inputCodigoBarras">Código de Barras</label>
                    <input type="barCode" name="codigoBarras" class="form-control" id="inputCodigoBarras" placeholder="Código de Barras" required>
                </div>
                -->
                <div class="form-group col-md-4">
                    <label for="inputPreco">Preço</label>
                    <input type="text" onkeydown="FormataMoeda(this,10,event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="preco" class="form-control" id="inputPreco" placeholder="00.00" maxlength="11" value="<?php echo $row['preco'] ?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputDesconto">Desconto</label>
                    <input type="text" onkeydown="FormataMoeda(this,10,event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="desconto" class="form-control" id="inputDesconto" placeholder="00.00" maxlength="11" value="<?php echo $row['desconto'] ?>" required>
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
    <script>
        /* Faz o dinheiro ficar com cara de dinheiro */
        function troca(str,strsai,strentra)
        {
            while(str.indexOf(strsai)>-1)
            {
                str = str.replace(strsai,strentra);
            }
            return str;
        }

        function FormataMoeda(campo,tammax,teclapres,caracter)
        {
            if(teclapres == null || teclapres == "undefined")
            {
                var tecla = -1;
            }
            else
            {
                var tecla = teclapres.keyCode;
            }

            if(caracter == null || caracter == "undefined")
            {
                caracter = ".";
            }

            vr = campo.value;
            if(caracter != "")
            {
                vr = troca(vr,caracter,"");
            }
            vr = troca(vr,"/","");
            vr = troca(vr,",","");
            vr = troca(vr,".","");

            tam = vr.length;
            if(tecla > 0)
            {
                if(tam < tammax && tecla != 8)
                {
                    tam = vr.length + 1;
                }

                if(tecla == 8)
                {
                    tam = tam - 1;
                }
            }
            if(tecla == -1 || tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105)
            {
                if(tam <= 2)
                {
                    campo.value = vr;
                }
                else //((tam > 2) && (tam <= 5))
                {
                    campo.value = vr.substr(0, tam - 2) + ',' + vr.substr(tam - 2, tam);
                }
            }
        }
    </script>

</body>

<?php
    include "footer.php";
?>

</html>
