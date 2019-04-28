<!--Menu-->
<?php
function checarAtivo($pagina){
  if(strpos($_SERVER["PHP_SELF"], $pagina) !== false){
    return "active";
  }
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
      <li class="nav-item <?php echo checarAtivo('cadastroUsuario'); ?>">
        <a class="nav-link" href="cadastroUsuario.php">Cadastro de Usuário</a>
      </li>
      <li class="nav-item <?php echo checarAtivo('listarUsuario'); echo checarAtivo('detalheUsuario'); ?>">
        <a class="nav-link" href="listarUsuario.php">Lista de Usuários</a>
      </li>
      <li class="nav-item <?php echo checarAtivo('excluirUsuario'); ?>">
        <a class="nav-link" href="excluirUsuario.php">Excluir Usuários</a>
      </li>
    </ul>
  </div>
  <!--Links do Menu-->
</nav>
<!--Menu-->