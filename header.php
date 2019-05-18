<!--Menu-->
<?php
session_start();

function checarAtivo($pagina){
  if(strpos($_SERVER["PHP_SELF"], $pagina) !== false){
    return "active";
  }
}
if(isset($_SESSION['tipo'])){
  $tipo_int = $_SESSION['tipo'];
} else {
  $tipo_int = 0;
}
//echo "tipo_usuario: " . $tipo_int;
if($tipo_int == 2){
  $tipo_usuario = 'administrador';
}
else if($tipo_int == 1){
  $tipo_usuario = 'vendedor';
}
else {
  $tipo_usuario = 'cliente';
}


?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="index.php"><img src="publico/imagens/LogoLojaoZe.svg" class="logomarca"/></a>
  <!--Links do Menu-->
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item <?php echo checarAtivo('index'); ?>">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item <?php echo checarAtivo('produto'); ?>">
        <a class="nav-link" href="produto.php">Produtos</a>
      </li>

      <?php if($tipo_usuario == 'administrador'):?>
      <li class="nav-item dropdown <?php echo checarAtivo('listarUsuario'); echo checarAtivo('detalheUsuario'); echo checarAtivo('cadastroUsuario'); echo checarAtivo('editarUsuario'); ; echo checarAtivo('excluirUsuario');?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Gerenciar Usuários
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item <?php echo checarAtivo('cadastroUsuario');?>" href="cadastroUsuario.php">Cadastrar</a>
          <a class="dropdown-item <?php echo checarAtivo('listarUsuario'); echo checarAtivo('detalheUsuario');?>" href="listarUsuario.php">Listar</a>
          <a class="dropdown-item <?php echo checarAtivo('editarUsuario');?>" href="editarUsuario.php">Editar</a>
          <a class="dropdown-item <?php echo checarAtivo('excluirUsuario');?>" href="excluirUsuario.php">Excluir</a>
        </div>
      </li>
      <?php else: ?>
      <li class="nav-item <?php echo checarAtivo('cadastroUsuario'); ?>">
        <a class="nav-link" href="cadastroUsuario.php">Cadastro</a>
      </li>
      <?php endif; ?>

      <?php if($tipo_usuario == 'administrador'):?>
      <li class="nav-item dropdown <?php echo checarAtivo('listarCliente'); echo checarAtivo('detalheCliente'); echo checarAtivo('cadastroCliente'); echo checarAtivo('editarCliente'); ; echo checarAtivo('excluirCliente');?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Gerenciar Clientes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item <?php echo checarAtivo('listarCliente'); echo checarAtivo('detalheCliente');?>" href="listarCliente.php">Listar</a>
          <a class="dropdown-item <?php echo checarAtivo('editarCliente');?>" href="editarCliente.php">Editar</a>
          <a class="dropdown-item <?php echo checarAtivo('excluirCliente');?>" href="excluirCliente.php">Excluir</a>
        </div>
      </li>
      <?php endif; ?>

      <?php if($tipo_usuario == 'administrador'):?>
      <li class="nav-item dropdown <?php echo checarAtivo('listarFuncionario'); echo checarAtivo('detalheFuncionario'); echo checarAtivo('cadastroFuncionario'); echo checarAtivo('editarFuncionario'); ; echo checarAtivo('excluirFuncionario');?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Gerenciar Funcionários
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item <?php echo checarAtivo('listarFuncionario'); echo checarAtivo('detalheFuncionario');?>" href="listarFuncionario.php">Listar</a>
          <a class="dropdown-item <?php echo checarAtivo('editarFuncionario');?>" href="editarFuncionario.php">Editar</a>
          <a class="dropdown-item <?php echo checarAtivo('excluirFuncionario');?>" href="excluirFuncionario.php">Excluir</a>
        </div>
      </li>
      <?php endif; ?>

      <?php if($tipo_usuario == 'administrador' || $tipo_usuario == 'vendedor'):?>
      <li class="nav-item dropdown <?php echo checarAtivo('listarProdutos'); echo checarAtivo('detalheProdutos'); echo checarAtivo('cadastroProdutos'); echo checarAtivo('editarProdutos'); ; echo checarAtivo('excluirUsuario');?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Gerenciar Produtos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item <?php echo checarAtivo('cadastroProdutos');?>" href="cadastroProdutos.php">Cadastrar</a>
          <a class="dropdown-item <?php echo checarAtivo('listarProdutos'); echo checarAtivo('detalheProdutos');?>" href="listarProdutos.php">Listar</a>
          <a class="dropdown-item <?php echo checarAtivo('editarProdutos');?>" href="editarProdutos.php">Editar</a>
          <a class="dropdown-item <?php echo checarAtivo('excluirProdutos');?>" href="excluirProdutos.php">Excluir</a>
        </div>
      </li>
      <?php endif; ?>

      <li class="nav-item <?php echo checarAtivo('login'); ?>">
        <?php if(isset($_SESSION['tipo'])): ?>
        <a class="nav-link" href="logout.php">LogOut</a>
        <?php else: ?>
        <a class="nav-link" href="login.php">Login</a>
        <?php endif; ?>
      </li>

    </ul>
  </div>
  <!--Links do Menu-->
</nav>
<!--Menu-->