<?php
include("cambia.php");
include("Utility/PHPHelper.php");
$helper = new PHPHelper();
$_SESSION['pagina']="inboxMessages.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Messaggi Ricevuti</title>

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
                            Elenco <small>Messaggi Ricevuti</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-inbox"></i> Messaggi ricevuti
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="msg">
                            <a href="new_message.php" ><button type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-envelope"></i> Scrivi messaggio</button></a>
                            <a href="#" ><button type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-inbox"></i> Messaggi ricevuti</button></a>
                            <a href="sentMessages.php" ><button type="button" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-share-alt"></i> Messaggi inviati</button></a>
                            </div>
                            <br>
                    </div>
                </div>
                <!-- /.row -->
<?php


if(!empty($_GET['delete'])){
                $sql2="DELETE FROM pm WHERE id = ".intval($_GET['delete'])." ;";
                $query =mysql_query($sql2) or die (mysql_error());
                  
            }

$user=$helper->GetUser()['username'];
$query="SELECT * FROM pm WHERE user2='".$user."' ORDER BY timestamp ASC";
		


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
                                <h3 class='panel-title'><i class='glyphicon glyphicon-inbox'></i> Messaggi Ricevuti</h3>
                            </div>
                            <div class='panel-body'>
                                <div class='list-group'>
                                    <table class='table table-bordered table-hover table-striped' >
                                        <thead style='width:100%' >
                                            <tr >
                                                <th style='width:10%' class='alert alert-info'>Mittente</th>
                                                <th class='alert alert-info'>Titolo</th>
                                                <th style='width:70%' class='alert alert-info'>Messaggio</th>
                                                <th style='width:15%' class='alert alert-info'>Ora</th>
                                                <th class='alert alert-info'>Letto</th>
                                                <th class='alert alert-info'>Elimina</th>
                                            </tr>
                                        </thead>");
                                        while($riga){
                                            echo("
                                        <tbody style='width:100%'>
                                        <a name=".$i."></a>
                                            <tr>
                                                <td><a href='new_message.php'><i class='glyphicon glyphicon-share-alt'></i></a> ".$riga['user1']."</td>
                                                <td><b>".$riga['title']."</b></td>
                                                <td>".$riga['message']."</td>
                                                <td>".$riga['timestamp']."</td>
                                                <td>");
                                                if($riga['user2read']=='0'){$read='alert-info'; $alt='Nuova';}
                                                if($riga['user2read']=='1'){$read=''; $alt='Letta';}
                                            
                                                echo("<i class='glyphicon glyphicon-envelope ".$read."'> </i>".$alt."</td>
                                                <td><a href='inboxMessages.php?delete=".$riga['id']."' ><i class='glyphicon glyphicon-remove' ></i></a></td>
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
set_time_limit(20);
$query="UPDATE pm SET user2read = '1' WHERE user2read = '0'";
$ris = mysql_query($query);
if (!$ris) {
	die("Errore nella query $query: " . mysql_error());
}                
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