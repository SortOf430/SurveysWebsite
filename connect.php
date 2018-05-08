<?php


$conn = mysql_connect("localhost", "dz191",""); 

if (!$conn) {
	exit();
	//die ('Non riesco a connettermi: ' . mysql_error());
}

$db = mysql_select_db('c9', $conn);
if (!$db) {
	exit();
	//die ("Errore nella selezione del database: " . mysql_error());
}

//echo ("Connesso con successo<br><br>");

?>