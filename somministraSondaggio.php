<?php
include("cambia.php");
include("Utility/PHPHelper.php");
$helper = new PHPHelper();
$_SESSION['pagina']="somministraSondaggio.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sondaggi - Area Amministrazione</title>

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
        

        <?php include "header.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard / <small>Somministra Sondaggio</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-share"></i> Somministra sondaggio
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="glyphicon glyphicon-hand-right"></i>      <strong>Benvenuto <u><?php echo ($helper->GetUser()['Nome'] . "</u> <u>" . $helper->GetUser()['Cognome']); ?></u></strong><a href="#" class="alert-link"></a></a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                
                <!-- /.row -->
                <div class="panel panel-green">
                            <div class="panel-heading">
                                <h3 class="panel-title">Form di Somministrazione sondaggio</h3>
                            </div>
                            <div class="panel-body">
                                <?php
                                    if($_SESSION['errore_somminstrazione_sondaggio'])
                                    {
                                        echo '<div class="alert alert-danger">
                                                    <strong>Errore:</strong> Errore nella somministrazione sondaggio!
                                              </div>';
                                        $_SESSION['errore_somminstrazione_sondaggio'] = false;
                                    }
                                ?>
                                <div class="alert alert-info">
                                    <strong>Sondaggio:</strong> Introduci le E-Mail a cui somministrare il sondaggio e quale sondaggio somministrare.
                                </div>
                                
                                <form action="mail.php" method="post">
                                    <a class="glyphicon glyphicon-user"></a> E-Mail del sondaggio (Separate da ",")
                                    <br>
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1">E-Mails (Separate da ",")</span>
                                      
                                        <textarea class="form-control custom-control" name="emails" rows="10" style="resize:none"></textarea>     
                                      
                                    </div>
                                    <br>
                                    <a class="glyphicon glyphicon-user"></a> Sondaggio                                    
                                    <br><br>
                                      <span class="input-group-addon" id="basic-addon1">Sondaggio da somministrare</span><br>
                                          <div class="form-group">
                                              <select class="form-control" id="selezioneSondaggio" name="sondaggio">
                                                  <?php
                                                    $sondaggi = $helper->OttieniSondaggi();
                                                    $riga = mysql_fetch_array($sondaggi);
                                                    while($riga)
                                                    {
                                                        $nomeSondaggio = $riga['nome'];
                                                        echo '<option value="'.$riga['id_questionario'].'">'.$nomeSondaggio.'</option>';
                                                        $riga = mysql_fetch_array($sondaggi);
                                                    }
                                                  ?>
                                              </select>
                                          </div>
                                    <br>
                                    <center>
                                        <input type="submit" class="btn btn-sm btn-primary">
                                    </center>
                                </form>
                            </div>
                        </div>
                        <center>Made with ♥</center>
        </div>
                <!-- /.row -->

                
                    
                    
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
