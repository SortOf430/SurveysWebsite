<?php
session_start();
include("connect.php");

$username = mysql_real_escape_string($_REQUEST['username']);
$password = $_REQUEST['password'];

$sql = "SELECT * FROM utenti WHERE utenti.username = '".$username."';";
$query = mysql_query($sql);

if(!$query)
{
    $_SESSION['errore'] = true;
    header("location: login.php");
}

$utente = mysql_fetch_array($query);

if(!$utente)
{
    header("location: login.php");
}
$salt = $utente['salt'];

$constructed_password = md5($salt.md5($password));

if($utente['password'] == $constructed_password)
{
    $_SESSION['loggato'] = true;
    $_SESSION['username'] = $username;
    $ref2 = $_SESSION['ref'];
    $_SESSION['ref'] = "";
    header("location: index.php");
}else{
     $_SESSION['errore'] = true;
    header("location: login.php");
}
?>