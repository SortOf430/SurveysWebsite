<?php
include("cambia.php");
include("Utility/PHPHelper.php");
$helper = new PHPHelper();
$_SESSION['pagina']="new_message.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sondaggi - Invia messaggio</title>

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
                            Invia Messaggio<small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-envelope"></i> Invia messaggio
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="msg">
                            <a href="#" ><button type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-envelope"></i> Scrivi messaggio</button></a>
                            <a href="inboxMessages.php" ><button type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-inbox"></i> Messaggi ricevuti</button></a>
                            <a href="sentMessages.php" ><button type="button" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-share-alt"></i> Messaggi inviati</button></a>
                            </div>
                            <br>
                    </div>
                </div>
                <!-- /.row -->
            <!-- /.container-fluid -->
            <!-- Login form -->
             <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <h3 class="panel-title">Invia Messaggio!</h3>
                            </div>
                            
                            <div class="panel-body">
                                
                                <?php
                                //controllo ormai inutile - tenuto come BU
                                    if($_SESSION['errore'])
                                    {
                                        echo '<div class="alert alert-danger">
                                                    <strong>Errore:</strong> Username e/o password errati!
                                              </div>';
                                        $_SESSION['errore'] = false;
                                    }
                                ?>
                                
                                <div class="alert alert-warning">
                                    <strong>Messaggio:</strong> Inserisci qui lo username dell'admin a cui inviare il messaggio
                                </div>
                                
                                <form action="send_message.php" method="post">
                                    <?php 
                                    if ($_SESSION['err']!="")
                                    echo("<div class='alert alert-danger'>
                                    <strong>".$_SESSION['err']."</strong>
                                    </div>");
                                    ?>
                                    <a class="glyphicon glyphicon-user"></a> Username
                                    <br>
                                    <div class="input-group" style='width:50%'>
                                      <span class="input-group-addon" id="basic-addon1">ID</span>
                                      <?php 
                                            $query="SELECT username FROM `utenti`";
                                            $ris = mysql_query($query);
                                            $riga = mysql_fetch_array($ris);
                                            
                                            echo ("<select name='username' class='form-control'>");
                                            while($riga)
                                            	{
                                            	// utilizzo l'array associativo ottenuto
                                            
                                            	echo("<option value='".$riga['username']."' class='form-control' placeholder='Username' aria-describedby='basic-addon1'>".$riga['username']."</option>");
                                            	$i++;	
                                            	
                                            	$riga = mysql_fetch_array($ris);
                                            }
                                            echo ("</select>")
                                            
                                            ?>
                                    </div>
                                    <br>
                                    <a class="glyphicon glyphicon-bookmark"></a> Titolo                                    
                                    
                                    <div class="input-group" style='width:50%'>
                                      <input type="text" name="titolo" class="form-control" required placeholder="Titolo" aria-describedby="basic-addon1"/>
                                      </div>
                                    <p></p>
                                    <textarea name="messaggio" rows="12" cols="100"></textarea><br>
                                    <center>
                                        <input type="submit" class="btn btn-primary">
                                    </center>
                                </form>
                            </div>
                        </div>
                        <center>Made with ♥</center>
        </div>
        <!-- /#page-wrapper -->

    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
