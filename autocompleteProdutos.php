<?php
    include_once("conexao.php");/* Estabelece a conexão */

    if(isset($_GET['termo'])){
        $termo = $_GET['termo'];
    } else {
        $termo = "";
    }

    function formataMoeda($valor){
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    //Carrega informações do usuário
    $sql2 = "SELECT id, nome, preco FROM produtos WHERE quantidade_estoque>0 AND nome LIKE '%".$termo."%'";
    //echo $sql2;
    $resultado = mysqli_query($conexao, $sql2) or die($conexao->error);

    $strRetorno = "";
    while ($row = mysqli_fetch_array($resultado)) {
        $strRetorno .= '<tr>
            <th scope="row">'.$row['id'].'</th>
            <td>'.$row['nome'].'</td>
            <td>'.formataMoeda($row['preco']).'</td>
            <td class="td-acao-produto"><a class="btn-acao-produto" onclick="clickAdicionaProduto(\''.$row['nome'].'\', '.$row['id'].', '.$row['preco'].')"><i class="fas fa-plus"></i></a></td>
        </tr>';
    }

    echo $strRetorno;
?>