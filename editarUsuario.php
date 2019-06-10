<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editar Usuários</title>
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
        /* limpa campos com mascara */
        function limparCampos($campo){
            $campo = str_replace(".", "", $campo);
            $campo = str_replace("-", "", $campo);
            $campo = str_replace("/", "", $campo);
            $campo = str_replace(" ", "", $campo);
            return $campo;
        }
        /* Ligação com Banco de Dados */
        include_once("conexao.php");/* Estabelece a conexão */
        if(isset($_POST["submit"])){
            $id = $_POST['submit_id'];
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
            $tipo = $_POST['tipo'];

            $salario = $_POST['salario'];
            $identificacao = $_POST['n_identificacao'];
            $cargo = $_POST['cargo'];

            //limpa campos que vem com mascara
            $cpf = limparCampos($cpf);
            $cnpj = limparCampos($cnpj);
            $cep = limparCampos($cep);
            $telefone = limparCampos($telefone);
            $sql = "UPDATE usuarios SET email='$email', cpf='$cpf', cnpj='$cnpj', nome='$nome',telefone='$telefone', endereco='$endereco',complemento='$complemento', cidade='$cidade', estado='$estado', cep='$cep', tipo='$tipo', cargo_funcionario='$cargo', salario_funcionario='$salario', num_identificacao_funcionario='$identificacao'  WHERE id='$id'";
            $salvar = mysqli_query($conexao, $sql);/* Escreve os dados no banco */
            if($salvar){
                ?>
                <div class="alert alert-success">Usuário editado com sucesso!</div>
                <?php
            }
            else{
                die(mysqli_error($conexao));
                ?>
                <div class="alert alert-warning">Falha ao editar usuário!</div>
                <?php
            }
            //mysqli_close($conexao);
        }
    ?>

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
    <?php
    //aplica a mascara fornecida no campo $formato
    function aplicaMascara($texto, $formato)
    {
        if($texto == ""){
            return "";
        }
        $len = strlen($formato);
        $ret = "";
        $pos = 0;
        for($i=0; $i<$len; $i++)
        {
            $chr = substr($formato, $i, 1);
            if($chr == '#')
            {
                if($pos <= strlen($texto)){
                    $ret .= substr($texto, $pos, 1);
                } else {
                    $ret .= " ";
                }
                $pos++;
            } else {
                $ret .= $chr;
            }
            
        }
        return $ret;
    }

    //diferencia os dois tipos de numero de telefone, se é celular ou fixo
    function aplicaMascaraTelefone($telefone)
    {
        $len = strlen($telefone);
        if($len <= 10)
        {
            return aplicaMascara($telefone,'## ####-####');
        } else {
            return aplicaMascara($telefone,'## #.####-####');
        }
    }
	?>
    <!-- Formulário de Editar Usuário -->
    <?php
        //Carrega informações do usuário
        $sql2 = "SELECT * FROM usuarios WHERE usuarios.id = ".$_POST['submit_id'];
        $resultado = mysqli_query($conexao, $sql2) or die($conexao->error);
        $row = mysqli_fetch_array($resultado);
    ?>
    <form action="" method="POST" target="_self">
    <input type="text" name="submit_id" class="form-control" id="submit_id" placeholder="ID" value="<?php echo $row['id'] ?>" hidden>
        <fieldset>
            <legend>Tipo de Usuário:</legend>
            <div class="form-group col-md-4">
                <?php if($tipo_usuario == 'administrador'):?>
                    <select id="inputType" name="tipo" class="form-control" onchange="changeType()" required>
                        <option value="0" <?php if($row['tipo'] == 0) echo 'selected' ?>>Cliente (Pessoa Física)</option>
                        <option value="3" <?php if($row['tipo'] == 3) echo 'selected' ?>>Cliente (Pessoa Jurídica)</option>
                        <option value="1" <?php if($row['tipo'] == 1) echo 'selected' ?>>Funcionário</option>
                        <option value="2" <?php if($row['tipo'] == 2) echo 'selected' ?>>Administrador</option>                
                    </select>
                <?php else: ?>
                    <select id="inputType" name="tipo" class="form-control" onchange="changeType()" required>
                        <option value="0" selected="selected">Cliente (Pessoa Física)</option>
                        <option value="3">Cliente (Pessoa Jurídica)</option>
                    </select>
                <?php endif; ?>

            </div>
        </fieldset>
        <fieldset>
            <legend>Informações Pessoais:</legend>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNome">Nome</label>
                    <input type="name" name="nome" class="form-control" id="inputNome" placeholder="Nome" value="<?php echo $row['nome'] ?>" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputTelefone">Telefone</label>
                    <input type="text" name="telefone" class="form-control" id="inputTelefone" placeholder="xx xxxx-xxx" onkeypress="mascara(this, '## ####-####')"  maxlength="12" value="<?php echo aplicaMascaraTelefone($row['telefone']) ?>" required>
                </div>
                <div class="form-group col-md-2" id="formGroupCPF">
                    <label for="inputCPF">CPF</label>
                    <input type="text" name="cpf" class="form-control" id="inputCPF" placeholder="xxx.xxx.xxx-xx" onkeypress="mascara(this, '###.###.###-##')"  maxlength="14" value="<?php echo aplicaMascara($row['cpf'], '###.###.###-##') ?>" required>
                </div>
                <div class="form-group col-md-2" id="formGroupCNPJ">
                    <label for="inputCNPJ">CNPJ</label>
                    <input type="text" name="cnpj" class="form-control" id="inputCNPJ" placeholder="xx.xxx.xxx/xxxx-xx" onkeypress="mascara(this, '##.###.###/####-##')"  maxlength="18" value="<?php echo aplicaMascara($row['cnpj'], '###.###.###-##') ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
                    <input type="name" name="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $row['email'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword">Senha</label>
                    <input type="password" name="senha" class="form-control" id="inputPassword" placeholder="Senha" value="<?php echo $row['senha'] ?>" readonly>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Informações Residenciais:</legend>
            <div class="form-group">
                <label for="inputAddress">Endereço</label>
                <input type="text" name="endereco" class="form-control" id="inputAddress" placeholder="Av. Rio Branco" value="<?php echo $row['endereco'] ?>" required>
            </div>
            <div class="form-group">
                <label for="inputComplemento">Complemento</label>
                <input type="text" name="complemento" class="form-control" id="inputComplemento" placeholder="Apartamento, estudio, ou andar" value="<?php echo $row['complemento'] ?>">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputCity">Cidade</label>
                <input type="text" name="cidade" class="form-control" id="inputCity" placeholder="Cidade"  value="<?php echo $row['cidade'] ?>" required>
                </div>
                <div class="form-group col-md-2">
                <label for="inputState">Estado</label>
                <select id="inputState" name="estado" class="form-control" required>
                    <option <?php if(!strcmp($row['estado'], "AC")) echo 'selected' ?>>AC</option>
                    <option <?php if(!strcmp($row['estado'], "AL")) echo 'selected' ?>>AL</option>
                    <option <?php if(!strcmp($row['estado'], "AP")) echo 'selected' ?>>AP</option>
                    <option <?php if(!strcmp($row['estado'], "AM")) echo 'selected' ?>>AM</option>
                    <option <?php if(!strcmp($row['estado'], "BA")) echo 'selected' ?>>BA</option>
                    <option <?php if(!strcmp($row['estado'], "CE")) echo 'selected' ?>>CE</option>
                    <option <?php if(!strcmp($row['estado'], "DF")) echo 'selected' ?>>DF</option>
                    <option <?php if(!strcmp($row['estado'], "ES")) echo 'selected' ?>>ES</option>
                    <option <?php if(!strcmp($row['estado'], "GO")) echo 'selected' ?>>GO</option>
                    <option <?php if(!strcmp($row['estado'], "MA")) echo 'selected' ?>>MA</option>
                    <option <?php if(!strcmp($row['estado'], "MT")) echo 'selected' ?>>MT</option>
                    <option <?php if(!strcmp($row['estado'], "MS")) echo 'selected' ?>>MS</option>
                    <option <?php if(!strcmp($row['estado'], "MG")) echo 'selected' ?>>MG</option>
                    <option <?php if(!strcmp($row['estado'], "PA")) echo 'selected' ?>>PA</option>
                    <option <?php if(!strcmp($row['estado'], "PB")) echo 'selected' ?>>PB</option>
                    <option <?php if(!strcmp($row['estado'], "PR")) echo 'selected' ?>>PR</option>
                    <option <?php if(!strcmp($row['estado'], "PE")) echo 'selected' ?>>PE</option>
                    <option <?php if(!strcmp($row['estado'], "PI")) echo 'selected' ?>>PI</option>
                    <option <?php if(!strcmp($row['estado'], "RJ")) echo 'selected' ?>>RJ</option>
                    <option <?php if(!strcmp($row['estado'], "RN")) echo 'selected' ?>>RN</option>
                    <option <?php if(!strcmp($row['estado'], "RS")) echo 'selected' ?>>RS</option>
                    <option <?php if(!strcmp($row['estado'], "RO")) echo 'selected' ?>>RO</option>
                    <option <?php if(!strcmp($row['estado'], "RR")) echo 'selected' ?>>RR</option>
                    <option <?php if(!strcmp($row['estado'], "SC")) echo 'selected' ?>>SC</option>
                    <option <?php if(!strcmp($row['estado'], "SP")) echo 'selected' ?>>SP</option>
                    <option <?php if(!strcmp($row['estado'], "SE")) echo 'selected' ?>>SE</option>
                    <option <?php if(!strcmp($row['estado'], "TO")) echo 'selected' ?>>TO</option>
                </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputCEP">CEP</label>
                    <input type="text" name="cep" class="form-control" id="inputCEP" onkeypress="mascara(this, '##.###-###')" placeholder="xx.xxx-xxx" maxlength="10"  value="<?php echo aplicaMascara($row['cep'], '##.###-###') ?>" required>
                </div>
            </div>
        </fieldset>

        <!-- Informações Extras do cadastro de Funcionários -->
        <fieldset id="fieldsetFuncionario" hidden>
            <legend>Informações Funcionário:</legend>
            <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputIdentifier">Número de Indentificação</label>
                <input type="number" name="n_identificacao" class="form-control" id="inputIdentifier" placeholder="111" onkeypress="mascara(this, '###')"  min="100" max="999" maxlength="3" value="<?php echo aplicaMascara($row['num_identificacao_funcionario'], '###') ?>" >
            </div>
            <div class="form-group col-md-4">
                <label for="inputSalario">Salário (R$)</label>
                <input type="text" onkeydown="FormataMoeda(this,10,event)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="salario" class="form-control" id="inputSalario" placeholder="00.00"  maxlength="11" value="<?php echo $row['salario_funcionario'] ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputCargo">Cargo</label>
                <input type="text" name="cargo" class="form-control" id="inputCargo" placeholder="Vendedor" maxlength="18" value="<?php echo $row['cargo_funcionario'] ?>">
            </div>
            </div>
        </fieldset>
        <div class="btn-submit-row">
            <button type="submit" class="btn btn-primary" value="Submit" name="submit">Confirmar</button>
        </div>

        <!-- Mostrar Campo Funcionario e Esconder Cliente -->
        <script>
            function changeType(){
                var tipo = document.getElementById("inputType");
                if(tipo.value == 0){    //Cliente (pessoa física)
                    //document.getElementById("fieldsetCliente").hidden = false;
                    document.getElementById("fieldsetFuncionario").hidden = true;
                    $('#formGroupCNPJ').hide();
                    $('#formGroupCPF').show();

                    document.getElementById("inputCPF").required = true;
                    document.getElementById("inputCNPJ").required = false;
                    document.getElementById("inputIdentifier").required = false;
                    document.getElementById("inputSalario").required = false;
                    document.getElementById("inputCargo").required = false;
                } else if(tipo.value == 3){  //Cliente (pessoa juridica)
                    //document.getElementById("fieldsetCliente").hidden = false;
                    document.getElementById("fieldsetFuncionario").hidden = true;
                    $('#formGroupCNPJ').show();
                    $('#formGroupCPF').hide();

                    document.getElementById("inputCNPJ").required = true;
                    document.getElementById("inputCPF").required = false;
                    document.getElementById("inputIdentifier").required = false;
                    document.getElementById("inputSalario").required = false;
                    document.getElementById("inputCargo").required = false;
                } else if(tipo.value == 1){  //Funcionário
                    //document.getElementById("fieldsetCliente").hidden = true;
                    document.getElementById("fieldsetFuncionario").hidden = false;
                    $('#formGroupCNPJ').hide();
                    $('#formGroupCPF').show();

                    document.getElementById("inputCPF").required = true;
                    document.getElementById("inputCNPJ").required = false;
                    document.getElementById("inputIdentifier").required = true;
                    document.getElementById("inputSalario").required = true;
                    document.getElementById("inputCargo").required = true;
                }else if(tipo.value == 2){  //Administrador
                    //document.getElementById("fieldsetCliente").hidden = true;
                    document.getElementById("fieldsetFuncionario").hidden = true;
                    $('#formGroupCNPJ').hide();
                    $('#formGroupCPF').show();

                    document.getElementById("inputCPF").required = true;
                    document.getElementById("inputCNPJ").required = false;
                    document.getElementById("inputIdentifier").required = false;
                    document.getElementById("inputSalario").required = false;
                    document.getElementById("inputCargo").required = false;
                }
            }
            changeType();
        </script>
        
    </form>
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
                    campo.value = vr.substr(0, tam - 2) + '.' + vr.substr(tam - 2, tam);
                }
            }
        }
    </script>

</body>

<?php
    include "footer.php";
?>

</html>
