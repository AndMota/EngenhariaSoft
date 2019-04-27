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
    <th scope="col">Tipo</th>
    <th scope="col">Nome</th>
    <th scope="col">CPF</th>
    <th scope="col">E-mail</th>
    <th scope="col">Telefone</th>
    <th scope="col">Endereço</th>
    <th scope="col">Complemento</th>
    <th scope="col">Cidade</th>
    <th scope="col">Estado</th>
    <th scope="col">CEP</th>
    </tr>
	</thead>
    <tbody>
  <?php
  include_once('conexao.php');
  $sql =  "SELECT nome, cpf, email, telefone, endereco, complemento, cidade, estado, cep, tipo ";
  $sql .= "FROM usuarios ";
  $sql .= "ORDER BY usuarios.nome ASC";
  $resultado = mysqli_query($conexao, $sql) or die($conexao->error);
  $i=1;
  $t="administrador";
	while($row = mysqli_fetch_array($resultado)) {
		echo '<tr>';
        echo '<th scope="row">'.$i.'</th>';
        if(!$row["tipo"]) {
			$t="Cliente" ;
        } else { 
            $t="Administrador";
        }
		echo ' <td> '.$t.'</td>';
		echo ' <td> '.$row["nome"].'</td>';
        echo ' <td> '.$row["cpf"].'</td>';
        echo ' <td> '.$row["email"].'</td>';
        echo ' <td> '.$row["telefone"].'</td>';
        echo ' <td> '.$row["endereco"].'</td>';
        echo ' <td> '.$row["complemento"].'</td>';
        echo ' <td> '.$row["cidade"].'</td>';
        echo ' <td> '.$row["estado"].'</td>';
        echo ' <td> '.$row["cep"].'</td>';
        echo '</tr>';

		$i=$i+1;
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