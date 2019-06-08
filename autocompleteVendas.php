<?php
    include_once("conexao.php");/* Estabelece a conexão */

    if(isset($_GET['termo'])){
        $termo = $_GET['termo'];
    } else {
        $termo = "";
    }

    //Carrega informações do usuário
    $sql2 = "SELECT id, nome FROM usuarios WHERE (tipo=3 OR tipo=0) AND nome LIKE '%".$termo."%'";
    //echo $sql2;
    $resultado = mysqli_query($conexao, $sql2) or die($conexao->error);

    $strRetorno = "";
    while ($row = mysqli_fetch_array($resultado)) {
        $strRetorno .= '<button class="dropdown-item" type="button" onclick="clickAutoComp(\''.$row['nome'].'\', '.$row['id'].')">'.$row['nome'].'</button>';
    }

    echo $strRetorno;
?>