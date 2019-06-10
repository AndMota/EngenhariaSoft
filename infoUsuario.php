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
<?php
    include_once('conexao.php');

    $sql =  "SELECT * ";
    $sql .= "FROM usuarios ";
    $sql .= "WHERE id=" . $_POST["submit_id"];
    $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
    $row = mysqli_fetch_array($resultado);
    $t = $row['tipo'];
    if($row['tipo']==0 || $row['tipo']==3) {
        $t="Cliente" ;
    } else if($row['tipo']==1){ 
        $t="Funcionário";
    }else if($row['tipo']==2){
        $t="Administrador";
    }

    mysqli_close($conexao);
     
    //aplica a mascara fornecida no campo $formato
    function aplicaMascara($texto, $formato)
    {
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
    
	<table class ="table table-striped table-bordered">
        <thead>
                <tr><th colspan="2" scope="col">Dados do(a) usuário(a) #<?php echo $row['id'];?></th></tr>
        </thead>
        <tbody>
            <tr>
                <td class="td-userlist">Nome:</td><td><?php echo $row['nome'];?></td>
            </tr>
            <?php
                if($row['tipo'] != 3){ ?>
            <tr>
                <td class="td-userlist">CPF:</td><td><?php echo aplicaMascara($row['cpf'],'###.###.###-##');?></td>
            </tr>
            <?php
                }
                else{

                }
            ?>
            <?php
                if($row['tipo'] == 3){ ?>
            <tr>
                <td class="td-userlist">CNPJ:</td><td id="cnpj"><?php echo aplicaMascara($row['cnpj'],'##.###.###/####-##');?></td>
            </tr>
            <?php
                }
                else{

                }
            ?>
            <tr>
                <td class="td-userlist">E-mail:</td><td><?php echo $row['email'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">Telefone:</td><td><?php echo aplicaMascaraTelefone($row['telefone']);?></td>
            </tr>
            <tr>
                <td class="td-userlist">Endereço:</td><td><?php echo $row['endereco'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">Complemento:</td><td><?php echo $row['complemento'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">Cidade:</td><td><?php echo $row['cidade'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">Estado:</td><td><?php echo $row['estado'];?></td>
            </tr>
            <tr>
                <td class="td-userlist">CEP:</td><td><?php echo aplicaMascara($row['cep'],'##.###-###');?></td>
            </tr>
            <tr>
                <td class="td-userlist">Tipo:</td><td id="tipo"><?php echo $t;?></td>
            </tr>
                <tr id="func_cargo">
                    <td class="td-userlist">Cargo:</td><td><?php echo $row['cargo_funcionario'];?></td>
                </tr>
                <tr id="func_salario">
                    <td class="td-userlist">Salário:</td><td>R$ <?php echo $row['salario_funcionario'];?></td>
                </tr>
                <tr id="func_entrada">
                    <td class="td-userlist">Data entrada:</td><td><?php echo $row['data_entrada_funcionario'];?></td>
                </tr>
                <tr id="func_numero">
                    <td class="td-userlist">Número de Identificação:</td><td><?php echo $row['num_identificacao_funcionario'];?></td>
                </tr>
        </tbody>
	</table>

    <script>
        //Esconde informações de funcionário se não é um funcionário
        if(document.getElementById("tipo").innerText.search("Funcionário") == -1){
            document.getElementById("func_cargo").hidden = true;
            document.getElementById("func_salario").hidden = true;
            document.getElementById("func_entrada").hidden = true;
            document.getElementById("func_numero").hidden = true;
        }
    </script>

</body>

<?php
    include "footer.php";
?>

</html>