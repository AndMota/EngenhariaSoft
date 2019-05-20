<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastro de Usuário</title>
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

<hr>

<body>
    <!-- Script para fazer a máscara. Com ele, você pode definir qualquer tipo de máscara com o comando onkeypress="mascara(this, '###.###.###-##')". -->
    <script language="JavaScript">
        function mascara(t, mask)
        {
            var i = t.value.length;                
            var saida = mask.substring(1,0);
            var texto = mask.substring(i)
            if (texto.substring(0,1) != saida)
            {
                t.value += texto.substring(0,1);
            }
        }
    </script>
    <!-- Fim do script -->
    <!-- Formulário de Cadastro de Usuário -->
    <form action="" method="POST" target="_self">
    <fieldset>
        <legend>Informações Pessoais:</legend>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="name" name="email" class="form-control" id="inputEmail4" placeholder="Email" required>
            </div>
            <div class="form-group col-md-6">
            <label for="inputPassword4">Senha</label>
            <input type="password" name="senha" class="form-control" id="inputPassword4" placeholder="Senha" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
            <label for="inputEmail4">Nome</label>
            <input type="name" name="nome" class="form-control" id="inputNome4" placeholder="Nome" required>
            </div>
            <div class="form-group col-md-2">
            <label for="inputPassword4">Telefone</label>
            <input type="text" name="telefone" class="form-control" id="inputTelefone4" placeholder="(11)1111-1111" onkeypress="mascara(this, '## ####-####')"  maxlength="12" required>
            </div>
            <div class="form-group col-md-2">
            <label for="inputPassword4">CPF</label>
            <input type="text" name="cpf" class="form-control" id="inputCPF4" placeholder="111.111.111-11" onkeypress="mascara(this, '###.###.###-##')"  maxlength="14" required>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Informações Residenciais:</legend>
        <div class="form-group">
            <label for="inputAddress">Endereço</label>
            <input type="text" name="endereco" class="form-control" id="inputAddress" placeholder="Av. Rio Branco" required>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Complemento</label>
            <input type="text" name="complemento" class="form-control" id="inputAddress2" placeholder="Apartamento, estudio, ou andar">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputCity">Cidade</label>
            <input type="text" name="cidade" class="form-control" id="inputCity" placeholder="Cidade" required>
            </div>
            <div class="form-group col-md-2">
            <label for="inputState">Estado</label>
            <select id="inputState" name="estado" class="form-control" required>
		<option></option>                
		<option>AC</option>
                <option>AL</option>
                <option>AP</option>
                <option>AM</option>
                <option>BA</option>
                <option>CE</option>
                <option>DF</option>
                <option>ES</option>
                <option>GO</option>
                <option>MA</option>
                <option>MT</option>
                <option>MS</option>
                <option>MG</option>
                <option>PA</option>
                <option>PB</option>
                <option>PR</option>
                <option>PE</option>
                <option>PI</option>
                <option>RJ</option>
                <option>RN</option>
                <option>RS</option>
                <option>RO</option>
                <option>RR</option>
                <option>SC</option>
                <option>SP</option>
                <option>SE</option>
                <option>TO</option>
            </select>
            </div>
            <div class="form-group col-md-2">
            <label for="inputType">Tipo</label>

            <?php if($tipo_usuario == 'administrador'):?>
            <select id="inputType" name="tipo" class="form-control" onchange="changeType()" required>
		        <option value="0" selected="selected">Cliente</option>
                <option value="1">Funcionário</option>
                <option value="2">Administrador</option>                
            </select>
            <?php else: ?>
            <select id="inputType" name="tipo" class="form-control" required>
		        <option value="0" selected="selected">Cliente</option>
            </select>
            <?php endif; ?>

            </div>
            <div class="form-group col-md-2">
            <label for="inputZip">CEP</label>
            <input type="text" name="cep" class="form-control" id="cep" onkeypress="mascara(this, '##.###-###')" placeholder="11.111-111" maxlength="10" required>
            </div>
        </div>
    </fieldset>
    <fieldset id="fieldsetCliente">
        <legend>Informações Cliente:</legend>
        <div class="form-group">
        <div class="form-group col-md-4">

            <label for="inputAddress">CNPJ</label>
            <input type="text" name="cnpj" class="form-control" id="inputCNPJ4" placeholder="11.111.111/1111-11" onkeypress="mascara(this, '##.###.###/####-##')"  maxlength="18" required>
        </div>
        </div>
    </fieldset>
    <!-- Informações Extras do cadastro de Funcionários -->
    <fieldset id="fieldsetFuncionario" hidden>
        <legend>Informações Funcionário:</legend>
        <div class="form-row">
        <div class="form-group col-md-4">

            <label for="inputIdentifier">Número de Indentificação</label>
            <input type="number" name="n_identificacao" class="form-control" id="inputIdentifier" placeholder="111" onkeypress="mascara(this, '###')"  min="100" max="999" maxlength="3">
        </div>
        <div class="form-group col-md-4">
            <label for="inputSalario">Salário (R$)</label>
            <input type="text" name="salario" class="form-control" id="inputSalario" placeholder="111111,11" onkeypress="mascara(this, '######,##')"  maxlength="9">
        </div>
        <div class="form-group col-md-4">
            <label for="inputCargo">Cargo</label>
            <input type="text" name="cargo" class="form-control" id="inputCargo" placeholder="Vendedor" maxlength="18">
        </div>
        </div>
    </fieldset>
    <!-- Mostrar Campo Funcionario e Esconder Cliente -->
    <script>
        function changeType(){
            var tipo = document.getElementById("inputType");
            if(tipo.value == 0){    //Cliente
                document.getElementById("fieldsetCliente").hidden = false;
                document.getElementById("fieldsetFuncionario").hidden = true;

                document.getElementById("inputCNPJ4").required = true;
                document.getElementById("inputIdentifier").required = false;
                document.getElementById("inputSalario").required = false;
                document.getElementById("inputCargo").required = false;
            }else if(tipo.value == 1){  //Funcionário
                document.getElementById("fieldsetCliente").hidden = true;
                document.getElementById("fieldsetFuncionario").hidden = false;

                document.getElementById("inputCNPJ4").required = false;
                document.getElementById("inputIdentifier").required = true;
                document.getElementById("inputSalario").required = true;
                document.getElementById("inputCargo").required = true;
            }else if(tipo.value == 2){  //Administrador
                document.getElementById("fieldsetCliente").hidden = true;
                document.getElementById("fieldsetFuncionario").hidden = true;

                document.getElementById("inputCNPJ4").required = false;
                document.getElementById("inputIdentifier").required = false;
                document.getElementById("inputSalario").required = false;
                document.getElementById("inputCargo").required = false;
            }
        }
    </script>
    <button type="submit" class="btn btn-primary" value="Submit" name="submit">Confirmar</button>
    </form>
    <!-- Fim do Formulário de Cadastro de Usuário  -->
    <?php
    /* Ligação com Banco de Dados */
    if(isset($_POST["submit"]))
    {
        include_once("conexao.php");/* Estabelece a conexão */

        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $cpf = $_POST['cpf'];
        $cnpj = $_POST['cnpj'];
        $endereco = $_POST['endereco'];
        $complemento = $_POST['complemento'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $cep = $_POST['cep'];
        $tipo = $_POST['tipo'];
        $identificacao = $_POST['n_identificacao'];
        $salario = $_POST['salario'];
        $cargo = $_POST['cargo'];
        $data = date("Y-m-d");

        $sql = "insert into usuarios (email,senha,nome,telefone,cpf,cnpj,endereco,complemento,cidade,estado,cep,tipo,cargo_funcionario,salario_funcionario,num_identificacao_funcionario,data_entrada_funcionario) values ('$email','$senha','$nome','$telefone','$cpf','$cnpj','$endereco','$complemento','$cidade','$estado','$cep', '$tipo', '$cargo', '$salario', '$identificacao', '$data')";
        $salvar = mysqli_query($conexao,$sql);/* Escreve os dados no banco */

        if($salvar)
        {
            ?>
            <div class="alert alert-success">Usuário cadastrado com sucesso!</div>
            <?php
        }
        else
        {
            die(mysqli_error($conexao));
            ?>
            <div class="alert alert-warning">Falha ao cadastrar usuário!</div>
            <?php
        }
    
        mysqli_close($conexao);
    
    }

    ?>

</body>

<hr>

<?php
    include "footer.php";
?>

</html>
