<?php
session_start();
session_destroy();//apaga dados anteriores

//encaminha pra pagina inicial
header('Location: index.php');
?>