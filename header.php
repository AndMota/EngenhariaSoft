<!--Menu-->
<?php
session_start();

function checarAtivo($pagina, $is_dropdown=false){
  if(is_array($pagina)){
    for($i=0; $i < count($pagina); $i++){
      if(strpos($_SERVER["PHP_SELF"], $pagina[$i]) !== false){
        if($is_dropdown){
          return "custom-dropdown-active";
        } else {
          return "custom-active";
        }
      }
    }
  }
  return "";
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
      <li class="nav-item">
        <a class="custom-nav-link <?php echo checarAtivo(['index']); ?>" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item">
        <a class="custom-nav-link <?php echo checarAtivo(['produto']); ?>" href="produto.php">Produtos</a>
      </li>

      <?php if($tipo_usuario == 'administrador'):?>
      <li class="nav-item dropdown">
        <a class="custom-nav-link dropdown-toggle <?php echo checarAtivo(['listarUsuario', 'detalheUsuario', 'cadastroUsuario','editarUsuario', 'excluirUsuario']);?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Gerenciar Usuários
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="custom-dropdown-item <?php echo checarAtivo(['cadastroUsuario'], true);?>" href="cadastroUsuario.php">Cadastrar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['listarUsuario'], true); echo checarAtivo('detalheUsuario');?>" href="listarUsuario.php">Listar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['editarUsuario'], true);?>" href="editarUsuario.php">Editar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['excluirUsuario'], true);?>" href="excluirUsuario.php">Excluir</a>
        </div>
      </li>
      <?php else: ?>
      <li class="nav-item">
        <a class="custom-nav-link <?php echo checarAtivo('cadastroUsuario'); ?>" href="cadastroUsuario.php">Cadastro</a>
      </li>
      <?php endif; ?>

      <?php if($tipo_usuario == 'administrador'):?>
      <li class="nav-item dropdown">
        <a class="custom-nav-link dropdown-toggle <?php echo checarAtivo(['listarCliente', 'detalheCliente', 'cadastroCliente', 'editarCliente', 'excluirCliente']);?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Gerenciar Clientes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="custom-dropdown-item <?php echo checarAtivo(['listarCliente']); echo checarAtivo('detalheCliente');?>" href="listarCliente.php">Listar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['editarCliente']);?>" href="editarCliente.php">Editar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['excluirCliente']);?>" href="excluirCliente.php">Excluir</a>
        </div>
      </li>
      <?php endif; ?>

      <?php if($tipo_usuario == 'administrador'):?>
      <li class="nav-item dropdown">
        <a class="custom-nav-link dropdown-toggle <?php echo checarAtivo(['listarFuncionario', 'detalheFuncionario', 'cadastroFuncionario', 'editarFuncionario', 'excluirFuncionario']);?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Gerenciar Funcionários
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="custom-dropdown-item <?php echo checarAtivo(['listarFuncionario']); echo checarAtivo('detalheFuncionario');?>" href="listarFuncionario.php">Listar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['editarFuncionario']);?>" href="editarFuncionario.php">Editar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['excluirFuncionario']);?>" href="excluirFuncionario.php">Excluir</a>
        </div>
      </li>
      <?php endif; ?>

      <?php if($tipo_usuario == 'administrador' || $tipo_usuario == 'vendedor'):?>
      <li class="nav-item dropdown">
        <a class="custom-nav-link dropdown-toggle <?php echo checarAtivo(['listarProdutos', 'detalheProdutos', 'cadastroProdutos', 'editarProdutos', 'excluirUsuario']);?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Gerenciar Produtos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="custom-dropdown-item <?php echo checarAtivo(['cadastroProdutos']);?>" href="cadastroProdutos.php">Cadastrar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['listarProdutos']); echo checarAtivo('detalheProdutos');?>" href="listarProdutos.php">Listar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['editarProdutos']);?>" href="editarProdutos.php">Editar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['excluirProdutos']);?>" href="excluirProdutos.php">Excluir</a>
        </div>
      </li>
      <?php endif; ?>

      <li class="nav-item">
        <?php if(isset($_SESSION['tipo'])): ?>
        <a class="custom-nav-link <?php echo checarAtivo(['login']); ?>" href="logOut.php">LogOut</a>
        <?php else: ?>
        <a class="custom-nav-link <?php echo checarAtivo(['login']); ?>" href="login.php">Login</a>
        <?php endif; ?>
      </li>

    </ul>
  </div>
  <!--Links do Menu-->
</nav>
<!--Menu-->