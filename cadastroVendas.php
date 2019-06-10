<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Produtos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="publico/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="publico/css/estilo.css">
</head>

<?php
    include "header.php";
    include_once("conexao.php");/* Estabelece a conexão */

    function getNomeUsrLogado(){
        if(isset($_SESSION['nome'])){
            return $_SESSION['nome'];
        }
        return "";
    }
    function getIdUsrLogado(){
        if(isset($_SESSION['id'])){
            return $_SESSION['id'];
        }
        return "";
    }
    $idCliente = "";
    $nomeCliente = "";
    $idFuncionario = "";
    $valorTotal = "";
    $produtos = [];
    $data = date("Y-m-d H:i:s");

    if(isset($_POST['idCliente'])){
        $idCliente = $_POST['idCliente'];
    }
    if(isset($_POST['nomeCliente'])){
        $nomeCliente = $_POST['nomeCliente'];
    }
    if(isset($_POST['idFuncionario'])){
        $idFuncionario = $_POST['idFuncionario'];
    }
    if(isset($_POST['valorTotal'])){
        $valorTotal = str_replace("R$", "", $_POST['valorTotal']);
        $valorTotal = str_replace(",", ".", $valorTotal);
        
        //echo "valorTotal: '" . $valorTotal . "'<br>";
        $valorTotal = limpaNumero($valorTotal);
        //echo "valorTotal: '" . $valorTotal . "'<br>";
        $valorTotal = floatval($valorTotal);
    }
    if(isset($_POST['listaProdutos'])){
        $produtos = json_decode($_POST['listaProdutos'], true);
    }
    //var_dump($_POST);
    if(isset($_POST["idCliente"])){
        $sql = "insert into vendas (id_cliente, id_funcionario, data_venda, valor_total) values ('$idCliente','$idFuncionario','$data','$valorTotal')";
        //echo $sql . "<br>";
        $salvar = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

        if($salvar)
        {
            $last_id = mysqli_insert_id($conexao) or die(mysqli_error($conexao));

            //com o id da venda, cadastra os produtos
            for($i=0; $i<count($produtos);$i++){
                $produto = $produtos[$i];

                $idProduto = $produto["id"];
                $quantidade = $produto["quantidade"];
                $preco = $produto["preco"];

                $sql = "insert into item_venda (id_produto, id_pedido, quantidade, valor_vendido) values ('$idProduto','$last_id','$quantidade','$preco')";
                //echo $sql . "<br>";
                mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

            }
        }
        else
        {
            die(mysqli_error($conexao));
        }
    }
    function limpaNumero($strNum){
        $strret = "";
        $numArr = ['', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.', ',', '-'];
        for($i=0; $i < strlen($strNum);$i++){
            $chr = $strNum[$i];
            if(array_search($chr, $numArr)){
                $strret .= $chr;
            }
        }
        return $strret ;
    }
    mysqli_close($conexao);
    $_POST = array();
?>

<script>

/*********** DADOS USUARIOS ***********/

function onChangeTexto(){
    var txtNomeCliente = document.getElementById("nomeCliente");
    var divAutocomplete = $("#autocompleteDiv");

    var termo = "";
    if(txtNomeCliente != null){
        termo = txtNomeCliente.value;
    }

    //$('#formGroupCNPJ').hide();
    //console.log(txtNomeCliente.value);

    if(txtNomeCliente.value.length >= 2){
        $.get('autocompleteVendas.php?termo=' + termo, function(contents) {
            divAutocomplete.html(contents);
            if(contents != ""){
                divAutocomplete.show();
            }
        },'text');
        
    } else {
        divAutocomplete.hide();
    }

    $("#alertErro").hide();
}
function clickAutoComp(nome, id){
    $("#nomeCliente").val(nome);
    $("#idCliente").val(id+"");
    $("#showIDClienteDiv").html("#"+id);
    $("#autocompleteDiv").hide();
}

/*********** DADOS PRODUTOS ***********/

var listaProdutos = [];
var templateVazio = '<tr><td colspan="4" class="text-center">Nenhum produto encontrado</td><tr>';

function onChangeTextoProduto(){
    var txtBuscaProduto = document.getElementById("buscaProduto");
    var termo = "";
    if(txtBuscaProduto != null){
        termo = txtBuscaProduto.value;
    }
    //console.log(termo);

    //if(txtBuscaProduto.value.length >= 2){
        $.get('autocompleteProdutos.php?termo=' + termo, function(contents) {
            if(contents == ""){
                $("#tableProdutosDisponiveis").html(templateVazio);
            } else {
                $("#tableProdutosDisponiveis").html(contents);
            }
            
        },'text');
    //} 

    $("#alertErro").hide();
}

function clickAdicionaProduto(nome, id, preco){
    var quantidadeElement = document.getElementById("quantidade");
    var quantidade = 0;
    if(quantidadeElement != null){
        quantidade = quantidadeElement.value;
    }
    if(quantidade > 0){
        listaProdutos.push({
            id : id,
            nome: nome,
            quantidade: quantidade,
            preco: preco
        });
        console.log(listaProdutos);
        updateCarrinho();
        quantidadeElement.value = 1;
    }
}
function clickRemoveProduto(indice){
    listaProdutos.splice(indice, 1); 
    updateCarrinho();
}
function updateCarrinho(){
    var template = '<tr><th scope="row">{indice}</th><td>{nome}</td><td>{qtd}</td><td>{preco}</td><td class="td-acao-produto"><a class="btn-acao-produto" onclick="clickRemoveProduto({indice})"><i class="fas fa-times"></i></a></td></tr>'
    var templateVazio = '<tr><td colspan="5" class="text-center">Adicione produtos ao carrinho</td><tr>';
    var conteudo = "";
    var valorTotal = 0;
    var jsonData = [];

    for(i=0; i<listaProdutos.length; i++){
        var produto = listaProdutos[i];
        var ind = i + "";
        conteudo += template.replace('{indice}', ind)
        .replace('{indice}', ind)
        .replace('{nome}', produto.nome)
        .replace('{preco}', formataMoeda(produto.preco))
        .replace('{qtd}', produto.quantidade);

        valorTotal += produto.preco * produto.quantidade;

        jsonData.push({
            id: produto.id,
            quantidade: produto.quantidade,
            preco : produto.preco
        })
    }
    if(conteudo == ""){
        $("#tableProdutosCarrinho").html(templateVazio);
    } else {
        $("#tableProdutosCarrinho").html(conteudo);
    }

    $("#listaProdutos").val(JSON.stringify(jsonData));
    $("#valorTotal").val(formataMoeda(valorTotal));
}

function formataMoeda(valor){
    return parseFloat(valor).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
}

function validarForm(){
    var form = document.forms["formVenda"];
    var idClienteElement = $("#idCliente");
    var alertErro = $("#alertErro");

    //console.log(nomeClienteElement.val());

    if (form.checkValidity() === false || listaProdutos.length == 0 || idClienteElement.val() == "") {
        //alert("Form inválido");
        var erroStr = "";
        if(idClienteElement != null && idClienteElement.val() == ""){
            erroStr += "Digite o nome do cliente e escolha na lista abaixo.<br>";
        }
        if(listaProdutos.length == 0){
            erroStr += "Adicione produtos ao carrinho.";
        }
        alertErro.html(erroStr);
        alertErro.show();
        form.reportValidity();
    } else {
        form.submit();
    }

}

</script>

<body>
    <form name="formVenda" action="" method="POST" target="_self" autocomplete="off">
        <?php //echo $_POST;?>
        <input type="hidden" name="listaProdutos" id="listaProdutos">
        <fieldset>
            <legend>Cadastro de Vendas</legend>
            <div id="alertErro" class="alert alert-danger" style="display:none" role="alert"></div>
            <div class="form-row">
                <div class="form-group col">
                    <label>Cliente</label>
                    <div class="input-group no-padding col">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><div id="showIDClienteDiv">#<?php echo $idCliente?></div></span>
                        </div>
                        <input type="name" name="nomeCliente" class="form-control" id="nomeCliente" placeholder="Nome do Cliente" oninput="onChangeTexto()" value="<?php echo $nomeCliente?>" required>
                        <input type="hidden" name="idCliente" id="idCliente" value="<?php echo $idCliente?>">
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2" id="autocompleteDiv">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col">
                    <label for="inputEmail">Funcionário Responsável</label>
                    <input type="hidden" name="idFuncionario" id="idFuncionario" value="<?PHP echo getIdUsrLogado();?>">
                    <input type="text" name="funcionario" class="form-control" id="inputNome" value="<?PHP echo getNomeUsrLogado();?>" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <!-- lista de produtos disponiveis -->
                    <div class="form-row">
                        <div class="col-9">
                            <label for="buscaProduto">Busca de Produto</label>
                            <input type="text" name="buscaProduto" id="buscaProduto" class="form-control" placeholder="Digite o nome do produto" oninput="onChangeTextoProduto()">
                        </div>
                        <div class="col">
                            <label for="quantidade">Quantidade</label>
                            <input type="number" class="form-control" name="quantidade" id="quantidade" value="1" min="0" max="99">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="scroll-container produtos-disp-cont">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col" class="largura-preco">Preço</th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="tableProdutosDisponiveis">
                                    <!--
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Sabão em pó Omo</td>
                                        <td>R$ 5,99</td>
                                        <td class="td-acao-produto"><a class="btn-acao-produto" onclick="clickAdicionaProduto('teste', 0, 1)"><i class="fas fa-times"></i></a></td>
                                    </tr>
                                    -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col">
                   <!-- lista de produtos no carrinho -->
                   <div class="form-row">
                        <div class="col-7">
                            <label for="valorTotal">Valor Total</label>
                            <input type="text" name="valorTotal" id="valorTotal" class="form-control" oninput="onChangeTextoProduto()" readonly>
                        </div>
                        <div class="col">
                            <button type="button" id="btnFinalizar" onclick="validarForm()" class="form-control btn btn-success btn-finalizar-compra">Finalizar Venda</button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="scroll-container produtos-disp-cont">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col" class="largura-preco">Preço</th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="tableProdutosCarrinho">
                                    <tr>
                                        <td colspan="5" class="text-center">Adicione produtos ao carrinho</td>
                                    <tr>
                                    <!--
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Sabão em pó Omo</td>
                                        <td>1</td>
                                        <td class="td-acao-produto"><a class="btn-acao-produto" onclick="clickRemoveProduto(0)"><i class="fas fa-times"></i></a></td>
                                    </tr>
                                    -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </fieldset>
  
    </form>
</body>
<script>
    //atualiza interface depois de tudo carregado
    onChangeTextoProduto();
    updateCarrinho();
</script>
<?php
    include "footer.php";
?>

</html>