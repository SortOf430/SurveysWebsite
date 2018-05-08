<?php
/**
 * Questa pagina fa in modo di reindirizzare l'utente su login.php se non è loggato.
 * **/
session_start();
if(!$_SESSION['loggato'] && curPageName() != "login.php")
{
    header("Location: login.php");
}

function curPageName() {
    return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
?>