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

    <title>Lista Alerts</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

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
                            Lista <small>Alerts</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bell"></i> Lista Alerts
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        
                        
                    </div>
                </div>
                <!-- /.row -->
<?php

//delete "function"
if(!empty($_GET['delete'])){
                $sql2="DELETE FROM pm WHERE id = ".intval($_GET['delete'])." ;";
                $query =mysql_query($sql2) or die (mysql_error()); }


$user=$helper->GetUser()['username'];
$query="SELECT * FROM alert ORDER BY timestamp ASC";
$ris = mysql_query($query);

// controllo l'esito
if (!$ris) {
	die("Errore nella query $query: " . mysql_error());
}

$riga = mysql_fetch_array($ris);
$i=0;

                echo ("<div class='col-lg-4' style='width:100%'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>
                                <h3 class='panel-title'><i class='glyphicon glyphicon-inbox'></i> Notifiche</h3>
                            </div>
                            <div class='panel-body'>
                                <div class='list-group'>
                                    <table class='table table-bordered table-hover table-striped' >
                                        <thead style='width:100%' >
                                            <tr >
                                                <th style='width:20%' class='alert alert-info'>Tipo di notifica</th>
                                                <th style='width:15%' class='alert alert-info'>Autore</th>
                                                <th style='width:50%' class='alert alert-info'>Info</th>
                                                <th style='width:15%' class='alert alert-info'>Ora</th>
                                                <th class='alert alert-info'>Letto</th>
                                            </tr>
                                        </thead>");
                                        while($riga){
                                            echo("
                                        <tbody style='width:100%'>
                                        <a name=".$i."></a>
                                            <tr>
                                                <td><a href='#'><i class='glyphicon glyphicon-share-alt'></i></a> ".$riga['tipo']."</td>
                                                <td><b>".$riga['alerter']."</b></td>
                                                <td>L'Admin <b><u><i>".$riga['alerter']."</i></u></b> ha inserito un nuovo ".$riga['tipo']." <a href='visualizza_sondaggi.php'>Vedi sondaggio</a></td>
                                                <td>".$riga['timestamp']."</td>
                                                <td>");
                                                $ricalert=$riga['ricalert'];
                                                $ricalert2=explode("," ,$ricalert);
                                                $c=0; $bool=False;	
                                                while($c<=sizeof($ricalert2)){
                                                    if($ricalert2[$c]==$user)
                                                    {$bool=True;}
                                                $c++;
                                                }
                                                if($bool){$read='alert-info'; $alt='Nuova';}
                                                if(!$bool) {$read=''; $alt='Letta';}
                                                echo("<i class='glyphicon glyphicon-warning-sign ".$read."'> </i>".$alt."</td>
                                             </tr>
                                        </tbody>");
                                        $i++;
                                        $riga = mysql_fetch_array($ris);}
                                    echo ("</table>
                                </div>
                            </div>
                        </div>
                    </div>");
//notifica di lettura

?>
                

                
                    
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>