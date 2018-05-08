<?php 
include("cambia.php");
include("Utility/PHPHelper.php");
$helper = new PHPHelper();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sondaggi - Inserimento Riuscito</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <?php include("header.php"); ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Inserimento
                            <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Inserimento
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
<?php


require('connect.php');


// attività specifica sul database

// dati da form
$username=$_POST["username"];
$pw=$_POST["password"];
$nome=$_POST["nome"];
$cognome=$_POST["cognome"];
$email=$_POST["email"];

//random string for salt
function RandomString()
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randstring = '';
    for ($i = 0; $i < 6; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}


$ris = mysql_query("SELECT * FROM utenti");
$riga = mysql_fetch_array($ris); 
    while ($riga){
        if($riga['username']==$username)
        header("Location: newadmin.php");
        $_SESSION['newadmininsert']= true;
        $riga = mysql_fetch_array($ris); }


$stringa = RandomString();

$pw_finale = md5($stringa.md5($pw));

// preparo la query
$query = "INSERT INTO `utenti` (`username`, `Nome`, `Cognome`, `email`, `password`, `salt`)
	
VALUES (
	'".$username."',
	'".$nome."',
	'".$cognome."',
	'".$email."',
	'".$pw_finale."',
	'".$stringa."'
	);";

$ris = mysql_query($query);

if (!$ris) {
    echo ("<div class='panel panel-danger'><div class='panel-heading'><h3 class='panel-title'><b>Errore!</b></h3></p></div><br><p>");
	echo("Errore nella query ". $query. " <br><br> ". mysql_error() . "</p>");
	//exit();
	
	echo("<p>Sarei reindirizzato all' <a href='newadmin.php'>inserimento nuovo admin</a></p>");
	echo ("</div></div>");
	header( "refresh:5; url=login.php" );

}

if ($ris) {
//metto qui la parte per gli alert
            $data_alert=date('r');
            
                                    //query per riceventi alert
            $query1= mysql_query("SELECT * FROM utenti"); 
            if (!$query1) {
	                        die("Errore nella query $query1: " . mysql_error()); }
	                        
            $riga1=mysql_fetch_array($query1);
            $ricalert="";
            //user=$helper->GetUser()['username'];
            $creatore = $_SESSION['username'];
            while($riga1){
                $ricalert=$ricalert.",".$riga1['username'];
                $riga1 = mysql_fetch_array($query1); }
            # in questa maniera la stringa $ricalert inizia con una virgola ma poi la splittiamo 
            # in corrispondenza della virgola
            $query2 = mysql_query("INSERT INTO alert 
            (idal, tipo, alerter, ricalert, timestamp) 
            VALUES ('', 'admin', '".$creatore."', '".$ricalert."','".$data_alert."')");
            
            //fine parte alert 
            }
            
echo ("<div class='panel panel-green'><div class='panel-heading'><h3 class='panel-title'>Registrato con successo</p><p>Sarai reindirizzato all' <a href='newadmin.php'>Inserimento</a></p></div></div></div>");

echo ("<script>
// Redirect dopo 5 secondi
setTimeout(function() {
  window.location.href = 'login.php';
}, 3000);
</script>");

mysql_close($conn);
?>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
