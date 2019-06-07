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

      <?php if($tipo_usuario == 'administrador' || $tipo_usuario == 'vendedor'):?>
      <li class="nav-item dropdown">
        <a class="custom-nav-link dropdown-toggle <?php echo checarAtivo(['listarProdutos', 'detalheProdutos', 'cadastroProdutos', 'editarProdutos', 'produtos']);?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Produtos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="custom-dropdown-item <?php echo checarAtivo(['cadastroProdutos']);?>" href="cadastroProdutos.php">Cadastrar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['listarProdutos', 'detalheProdutos']);?>" href="listarProdutos.php">Listar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['produtos']);?>" href="produtos.php">Listar como cliente</a>        
        </div>
      </li>

      
      <?php else: ?>
      <li class="nav-item">
        <a class="custom-nav-link <?php echo checarAtivo(['produtos']); ?>" href="produtos.php">Produtos</a>
      </li>
      <?php endif; ?>

      <?php if($tipo_usuario == 'administrador' || $tipo_usuario == 'vendedor'):?>
        <li class="nav-item dropdown">
          <a class="custom-nav-link dropdown-toggle <?php echo checarAtivo(['listarVendas', 'cadastroVendas','editarVenda']);?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Vendas
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="custom-dropdown-item <?php echo checarAtivo(['cadastroVendas'], true);?>" href="cadastroVendas.php">Cadastrar</a>
            <a class="custom-dropdown-item <?php echo checarAtivo(['listarVendas', 'editarVenda'], true);?>" href="listarVendas.php">Listar</a>
          </div>
        </li>
      <?php endif; ?>

      <?php if($tipo_usuario == 'administrador'):?>
      <li class="nav-item dropdown">
        <a class="custom-nav-link dropdown-toggle <?php echo checarAtivo(['listarUsuario', 'detalheUsuario', 'cadastroUsuario','editarUsuario']);?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuários
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="custom-dropdown-item <?php echo checarAtivo(['cadastroUsuario'], true);?>" href="cadastroUsuario.php">Cadastrar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['listarUsuario','detalheUsuario'], true);?>" href="listarUsuario.php">Listar</a>
        </div>
      </li>
      <?php else: ?>
      <li class="nav-item">
        <a class="custom-nav-link <?php echo checarAtivo('cadastroUsuario'); ?>" href="cadastroUsuario.php">Cadastro</a>
      </li>
      <?php endif; ?>

      <?php if($tipo_usuario == 'administrador'):?>
      <li class="nav-item dropdown">
        <a class="custom-nav-link dropdown-toggle <?php echo checarAtivo(['listarProdutos', 'detalheProdutos', 'cadastroProdutos', 'editarProdutos']);?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Setores
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="custom-dropdown-item <?php echo checarAtivo(['cadastroSetores']);?>" href="cadastroSetores.php">Cadastrar</a>
          <a class="custom-dropdown-item <?php echo checarAtivo(['listarSetores', 'detalheSetores']);?>" href="listarSetores.php">Listar</a>
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