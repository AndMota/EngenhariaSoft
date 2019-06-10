<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_destroy();//apaga dados anteriores

//encaminha pra pagina inicial
header('Location: index.php');
?>