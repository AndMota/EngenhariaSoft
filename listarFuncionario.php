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

    if(isset($_GET['orderar'])){
        $ordenar = $_GET['orderar'];
    } else {
        $ordenar = "";
    }

    $ordemAlfabetica = false;
    $ordemNumId = false;
    $ordemCargo = false;

    if($ordenar != ""){
        $ordenar = explode(',', $ordenar);

        $ordemAlfabetica = in_array('ordem-alfabetica', $ordenar);
        $ordemNumId = in_array('ordem-num-id', $ordenar);
        $ordemCargo = in_array('ordem-cargo', $ordenar);
    }

    if(!$ordemAlfabetica && !$ordemNumId && !$ordemCargo){
        $ordemAlfabetica = true;
    }
?>
<script>
    function handleClick(){
        var checkOA = false; checkN = false; checkC = false;
        var url = "listarFuncionario.php?orderar=";

        //checa se as checkboxes foram marcadas
        checkOA = $('#chkOrdemAlfabetica').is(":checked");
        checkN = $('#chkNumId').is(":checked");
        checkC = $('#chkCargo').is(":checked");
        
        //preenche querystring com parametros
        if(checkOA){
            url += $('#chkOrdemAlfabetica').val() + ",";
        }
        if(checkN){
            url += $('#chkNumId').val() + ",";
        }
        if(checkC){
            url += $('#chkCargo').val() + ",";
        }

        //console.log("checkOA: " + checkOA);
        //console.log("checkN: " + checkN);
        //console.log("checkC: " + checkC);

        //se nenhuma for marcada, por padrão ordena por ordem alfabetica
        if(!checkOA && !checkN && !checkC){
            $("#chkOrdemAlfabetica").prop('checked', true);
            checkOA = true;
            url += $('#chkOrdemAlfabetica').val(); + ",";
        }

        //console.log(url);

        location.href = url;
    }
    function detalheFuncionario(id){
        location.href = "detalheFuncionario.php?id=" + id;
    }
</script>
<body>
    <div class="row">
        <div class="col">
            <div class="col-filtro">
                <label class="form-check-label label-filtro" for="chkOrdemAlfabetica">Ordenar por: </label>
                <div class="form-check form-check-inline">
                    <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="chkOrdemAlfabetica" 
                    value="ordem-alfabetica" 
                    <?php if($ordemAlfabetica){echo 'checked="checked"';}?>
                    onclick="handleClick();">
                    <label class="form-check-label" for="inlineCheckbox1">Ordem Alfabética</label>
                </div>
                <div class="form-check form-check-inline">
                    <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="chkNumId" 
                    value="ordem-num-id" 
                    <?php if($ordemNumId){echo 'checked="checked"';}?>
                    onclick="handleClick();">
                    <label class="form-check-label" for="inlineCheckbox2">Número de Identificação</label>
                </div>
                <div class="form-check form-check-inline">
                    <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="chkCargo" 
                    value="ordem-cargo"
                    <?php if($ordemCargo){echo 'checked="checked"';}?>
                    onclick="handleClick();">
                    <label class="form-check-label" for="inlineCheckbox3">Cargo</label>
                </div>
            </div>
        </div>
    </div>
	<table class ="table table-striped table-bordered">
	<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Nome</th>
    <th scope="col">CPF</th>
    <th scope="col">Cargo</th>
    <th scope="col">E-Mail</th>
    <th scope="col">Cidade</th>
    <th scope="col">Estado</th>
    <th scope="col">Número de Identificação</th>
    </tr>
	</thead>
    <tbody>
  <?php

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
    
    include_once('conexao.php');
    $sql =  "SELECT id, nome, cpf, email, cargo_funcionario, cidade, estado, num_identificacao_funcionario FROM usuarios WHERE tipo=1 OR tipo=2 ";
    $order = "";

    if($ordemAlfabetica){
        $order .= "ORDER BY nome ASC";
    }
    if($ordemNumId){
        if($order == ""){
            //se não tiver ordem definida
            $order .= "ORDER BY num_identificacao_funcionario ASC";   
        } else {
            //se já tiver uma ordem definida
            $order .= ", num_identificacao_funcionario ASC";
        }
    }
    if($ordemCargo){
        if($order == ""){
            //se não tiver ordem definida
            $order .= "ORDER BY cargo_funcionario ASC";   
        } else {
            //se já tiver uma ordem definida
            $order .= ", cargo_funcionario ASC";
        }
    }

    $sql .= $order;

    //echo $sql;
  
    $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
	while($row = mysqli_fetch_array($resultado)) {
		echo '<tr class="tr-click" onclick="detalheFuncionario('.$row["id"].')">';
        echo '<th scope="row">'.$row["id"].'</th>';
        echo ' <td> '.$row["nome"].'</td>';
        echo ' <td> '.aplicaMascara($row['cpf'],'###.###.###-##').'</td>';
        echo ' <td> '.$row["cargo_funcionario"].'</td>';
        echo ' <td> '.$row["email"].'</td>';
        echo ' <td> '.$row["cidade"].'</td>';
        echo ' <td> '.$row["estado"].'</td>';
        echo ' <td> '.$row["num_identificacao_funcionario"].'</td>';
        echo '</tr>';
	}
	mysqli_close($conexao);
		
	?>
	<tbody>
	</table>
    <hr>

</body>

<hr>


<?php
    include "footer.php";
?>

</html>