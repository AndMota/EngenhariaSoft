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

	<table class ="table table-striped table-bordered">
	<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Nome</th>
    <th scope="col">E-mail</th>
    <th scope="col">Telefone</th>
    <th scope="col">CPF</th>
    <th scope="col">Endereço</th>
    <th scope="col">Complemento</th>
    <th scope="col">Cidade</th>
    <th scope="col">Estado</th>
    </tr>
	</thead>
    <tbody>
  <?php
    function formataTelefone($numero){
        if(strlen($numero) == 10){
            $novo = substr_replace($numero, '(', 0, 0);
            $novo = substr_replace($novo, '9', 3, 0);
            $novo = substr_replace($novo, ')', 3, 0);
        }else{
            $novo = substr_replace($numero, '(', 0, 0);
            $novo = substr_replace($novo, ')', 3, 0);
        }
        return $novo;
    }

    function formataCPF($cpf){
        $cpf = substr_replace($cpf,'.',3,0);
        $cpf = substr_replace($cpf,'.',7,0);
        $cpf = substr_replace($cpf,'-',11,0);
        return $cpf;
    }

  include_once('conexao.php');
  $sql =  "SELECT id, nome, email, telefone, cpf, endereco, complemento, cidade, estado FROM usuarios WHERE usuarios.tipo=0 ORDER BY usuarios.nome ASC";
  $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
	while($row = mysqli_fetch_array($resultado)) {
		echo '<tr>';
        echo '<th scope="row">'.$row["id"].'</th>';
        echo ' <td> '.$row["nome"].'</td>';
        echo ' <td> '.$row["email"].'</td>';
        echo ' <td> '.formataTelefone($row["telefone"]).'</td>';
        echo ' <td> '.formataCPF($row["cpf"]).'</td>';
        echo ' <td> '.$row["endereco"].'</td>';
        echo ' <td> '.$row["complemento"].'</td>';
        echo ' <td> '.$row["cidade"].'</td>';
        echo ' <td> '.$row["estado"].'</td>';
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