<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastro de Produto</title>
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
    <!-- Formulário de Cadastro de Produto -->
    <form action="" method="POST" target="_self">
        <fieldset>
            <legend>Dados do Produto:</legend>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNome">Nome</label>
                    <input type="name" name="nome" class="form-control" id="inputNome" placeholder="Nome" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputFabricante">Fabricante</label>
                    <input type="text" name="fabricante" class="form-control" id="inputFabricante" placeholder="Fabricante" required>
                </div>
                <!--
                <div class="form-group col-md-6">
                    <label for="inputCodigoBarras">Código de Barras</label>
                    <input type="barCode" name="codigoBarras" class="form-control" id="inputCodigoBarras" placeholder="Código de Barras" required>
                </div>
                -->
                <div class="form-group col-md-4">
                    <label for="inputPreco">Preço</label>
                    <input type="text" onkeydown="FormataMoeda(this,10,event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="preco" class="form-control" id="inputPreco" placeholder="00.00" maxlength="11" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputDesconto">Desconto</label>
                    <input type="text" onkeydown="FormataMoeda(this,10,event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="desconto" class="form-control" id="inputDesconto" placeholder="00.00" maxlength="11" required>
                </div>
                
                <div class="form-group col-md-4">
                    <label for="pickSetor">Setor </label>
                     <select id="department" name="setor" class="form-control" onchange="enviar()">
                        <?php
                        include_once('conexao.php');
                        $sql =  "SELECT nome, num_identificacao FROM setores";
                        $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
                        while($row = mysqli_fetch_array($resultado)) {
                            echo '<option value= ' .$row["num_identificacao"].'>'.$row["nome"]. '</option>';    
                        }
                        ?>
                     </select>
                </div>
                
                <div class="form-group col-md-4">
                    <label for="inputQuantidade">Quantidade</label>
                    <input type="number" pattern=" 0+\.[0-9]*[1-9][0-9]*$"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="quantidade" class="form-control" id="inputQuantidade" placeholder="Quantidade" required>
                </div>
            
            </div>
        </fieldset>
        

        </fieldset>
        <div class="btn-submit-row">
            <button type="submit" class="btn btn-primary" value="Submit" name="submit">Confirmar</button>
        </div>

        
    </form>
    <!-- Fim do Formulário de Cadastro de Produto  -->
    <?php
    /* Ligação com Banco de Dados */
    if(isset($_POST["submit"]))
    {
        if($_POST['desconto']<=$_POST['preco'])
        {
            if($_POST['quantidade']>=0)
            {
                $nome = $_POST['nome'];
                $fabricante = $_POST['fabricante'];
                $preco = $_POST['preco'];
                $quantidade = $_POST['quantidade'];
                $setor = $_POST['setor'];
                $desconto = $_POST['desconto'];

                $sql = "insert into produtos (nome, fabricante, preco, quantidade_estoque, id_setor, desconto) values ('$nome','$fabricante', '$preco', '$quantidade', '$setor', '$desconto')";
                $salvar = mysqli_query($conexao,$sql);/* Escreve os dados no banco */

                if($salvar)
                {
                    ?>
                    <div class="alert alert-success">Produto cadastrado com sucesso!</div>
                    <?php
                }
                else
                {
                    die(mysqli_error($conexao));
                    ?>
                    <div class="alert alert-warning">Falha ao cadastrar produto!</div>
                    <?php
                }
            }
        }
        
    }
    ?>
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
    mysqli_close($conexao);
    include "footer.php";
?>

</html>
