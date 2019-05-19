<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editar Cliente</title>
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
    <!-- Script para exibir clientes e clicar no que for ser editado-->
    <table class ="table table-striped table-bordered">
	<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Nome</th>
    <th scope="col">E-mail</th>
    <th scope="col">Tipo</th>
    <th scope="col"></th>
    </tr>
	</thead>
    <tbody>
    <form action="editarCliente.php" method="post">
    <?php
        include_once('conexao.php');
        $sql =  "SELECT id, nome, email, telefone, cpf, endereco, complemento, cidade, estado FROM usuarios WHERE usuarios.tipo=0 ORDER BY usuarios.nome ASC";
        $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
        $t="administrador";
            while($row = mysqli_fetch_array($resultado)) {
                echo '<tr class="tr-click">';
                echo '<th scope="row">'.$row["id"].'</th>';
                echo ' <td> '.$row["nome"].'</td>';
                echo ' <td> '.$row["email"].'</td>';
                echo ' <td> '."Cliente".'</td>';
                echo '<td><input type="submit" name="id" value="'.$row["id"].'"</td>';
                echo '</tr>';
            }
            //mysqli_close($conexao);
		
	?>
    </form>
	<tbody>
	</table>
    <hr>

    <script>
        function editar(id){
            
        }
    </script>

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
    <!-- Formulário de Editar Cliente -->
    <?php
    $nome = '';
    $email = '';
    $telefone = '';
    $cpf = '';
    $cnpj='';
    $endereco = '';
    $complemento = '';
    $cidade = '';
    $estado = '';
    $cep = '';
    $tipo = 0;
    if(!empty($_POST)){
        if(isset($_POST['id'])){
            if(!empty($_POST['id'])){
                include_once('conexao.php');
                $sql = "SELECT * FROM `usuarios` WHERE `id` = ".$_POST['id'];
                $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
                $t="administrador";
                while($row = mysqli_fetch_array($resultado)) {
                    $nome = $row['nome'];
                    $email = $row['email'];
                    $telefone = $row['telefone'];
                    $cpf = $row['cpf'];
                    $cnpj = $row['cnpj'];
                    $endereco = $row['endereco'];
                    $complemento = $row['complemento'];
                    $cidade = $row['cidade'];
                    $estado = $row['estado'];
                    $cep = $row['cep'];
                    $tipo = $row['tipo'];
                }
                //mysqli_close($conexao);
            }
        }
    }
    echo '<form action="" method="POST" target="_self">
    <fieldset>
        <legend>Informações Pessoais:</legend>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="name" name="email" class="form-control" id="inputEmail4" placeholder="Email" value="'.$email.'" required>
            </div>
            <div class="form-group col-md-4">
            <label for="inputType">Tipo</label>
            <select id="inputType" name="tipo" class="form-control" required>;
                 <option selected>Cliente</option>;
                 <option>Administrador</option>;
                 <option>Funcionário</option>;
            </select>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
            <label for="inputEmail4">Nome</label>
            <input type="name" name="nome" class="form-control" id="inputNome4" placeholder="Nome" value="'.$nome.'" required>
            </div>
            <div class="form-group col-md-2">
            <label for="inputPassword4">Telefone</label>
            <input type="text" name="telefone" class="form-control" id="inputTelefone4" placeholder="(11)1111-1111" onkeypress="mascara(this, "## ####-####")"  maxlength="12" value="'.$telefone.'" required>
            </div>
            <div class="form-group col-md-4s">
            <label for="inputPassword4">CPF</label>
            <input type="text" name="cpf" class="form-control" id="inputCPF4" placeholder="111.111.111-11" onkeypress="mascara(this, "###.###.###-##")"  maxlength="14" value="'.$cpf.'" required>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Informações Residenciais:</legend>
        <div class="form-group">
            <label for="inputAddress">Endereço</label>
            <input type="text" name="endereco" class="form-control" id="inputAddress" placeholder="Av. Rio Branco" value="'.$endereco.'" required>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Complemento</label>
            <input type="text" name="complemento" class="form-control" id="inputAddress2" placeholder="Apartamento, estudio, ou andar" value="'.$complemento.'">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputCity">Cidade</label>
            <input type="text" name="cidade" class="form-control" id="inputCity" placeholder="Cidade" value="'.$cidade.'" required>
            </div>
            <div class="form-group col-md-4">
            <label for="inputState">Estado</label>
            <select id="inputState" name="estado" class="form-control" required>
		<option>'.$estado.'</option>                
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
            <label for="inputZip">CEP</label>
            <input type="text" name="cep" class="form-control" id="cep" onkeypress="mascara(this, "##.###-###")" placeholder="11.111-111" maxlength="10" value="'.$cep.'" required>
            </div>
        </div>
    </fieldset>
    <fieldset>
    <legend>Informações Cliente:</legend>
    <div class="form-group">
    <div class="form-group col-md-4">
        <label for="inputAddress">CNPJ</label>
        <input type="text" name="cnpj" class="form-control" id="inputCNPJ4" placeholder="11.111.111/1111-11" onkeypress="mascara(this, "##.###.###/####-##")"  maxlength="18" value="'.$cnpj.'" required>
    </div>
    </div>
</fieldset>
    <button type="submit" class="btn btn-primary" value="Submit" name="submit">Confirmar</button>
    </form>';
    ?>
    <!-- Fim do Formulário de Edição Cliente  -->
    <?php
    /* Ligação com Banco de Dados */
    if(isset($_POST["submit"]))
    {
        include_once("conexao.php");/* Estabelece a conexão */

        $email = $_POST['email'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $cpf = $_POST['cpf'];
        $cnpj = $_POST['cnpj'];
        $endereco = $_POST['endereco'];
        $complemento = $_POST['complemento'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $cep = $_POST['cep'];
        $tipo = 0;
        if(!strcmp($_POST['tipo'], "Administrador")) {
            $tipo = 1;
        }

        $sql = "UPDATE `usuarios` SET `email`='$email', `nome`='$nome',`telefone`='$telefone',`endereco`='$endereco',`complemento`='$complemento',`cidade`='$cidade',`estado`='$estado',`cep`='$cep',`cnpj`='$cnpj'`tipo`='$tipo' WHERE `cpf`='$cpf'";
        $salvar = mysqli_query($conexao,$sql);/* Escreve os dados no banco */

        if($salvar)
        {
            ?>
            <div class="alert alert-success">Cliente editado com sucesso!</div>
            <?php
        }
        else
        {
            die(mysqli_error($conexao));
            ?>
            <div class="alert alert-warning">Falha ao editar cliente!</div>
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
