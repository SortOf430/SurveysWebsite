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

    <title>Sondaggi - Messaggio inviato con successo</title>

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
                            Inviato!
                            <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Messaggio inviato!
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            
<?php 
$_SESSION['err']="";
// dati da form
$username=$_POST["username"];
$titolo=$_POST["titolo"];
$pm=$_POST["messaggio"];

//controllo username non esistente
$usererrato=$username;
$query= "SELECT * FROM utenti WHERE username='".$usererrato."'";
$ris = mysql_query($query);
$riga=mysql_fetch_array($ris);

//data

$data=date('r');

//controllo con usererrato upgradato e inutile in pratica. Lo lascio come BU ;)
if (!$ris) {
    	die();
	
}

if ($riga['username']=="")
{
	$_SESSION['err']="Errore nel nome utente";
	header( "refresh:0; url=new_message.php" );
	die();
}


// preparo la query
$query = "INSERT INTO `pm` (`id`, `title`, `user1`, `user2`, `message`, `timestamp`, `user2read`)
	
VALUES (
	'',
	'".$titolo."',
	'".$helper->GetUser()['username']."',
	'".$username."',
	'".$pm."',
	'".$data."',
	'0'
	);";

$ris = mysql_query($query);

if (!$ris) {
    echo ("<div class='panel panel-danger'><div class='panel-heading'><h3 class='panel-title'><b>Errore!</b></h3></p></div><br><p>");
	echo("Errore nella query ". $query. " <br><br> ". mysql_error() . "</p>");
	//exit();
	echo("<p>Sarei reindirizzato alla tua <a href='index.php'>Dashboard</a></p>");
	echo ("</div></div>");
	header( "refresh:6; url=index.php" );
	die();
	
}

//echo ("<a class='glyphicon glyphicon-thumbs-up'></a> Messaggio inviato con successo! Sarai reindirizzato ai messaggi inviati!<br>");
//header("refresh:0; url=sentMessages.php" );
echo ("<script>
            window.location.href = 'sentMessages.php';
       </script>")


//mysql_close($conn);
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