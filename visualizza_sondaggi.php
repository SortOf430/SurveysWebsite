<?php
include "connect.php";
include("cambia.php");
include("Utility/PHPHelper.php");
$helper = new PHPHelper();
$_SESSION['pagina']="visualizza_sondaggi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Area Amministrazione</title>

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
                            Elenco Questionari
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-list-alt"></i> Elenco sondaggi
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                    <?php
                        if ($_SESSION['inesistenza_sondaggio']){
                            echo ("<div class=\"alert alert-danger\" role=\"alert\">
                          <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
                          <span class=\"sr-only\">Error:</span>
                          Il sondaggio che stai cercando di modificare non esiste, selezionane uno dall'elenco qui sotto!
                        </div>");
                            $_SESSION['inesistenza_sondaggio']=false;
                        }?>
                    </div>
                </div>
                <!-- /.row -->


                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><!--ciao-->
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Elenco dei sondaggi creati</h3>
                            </div>
                            <div class="panel-body">
                                 <?php
                                if ($_SESSION['modifica_sondaggio']){
                                    echo "<div class=\"alert alert-success\" role=\"alert\">Modifica del sondaggio avvenuta con successo!</div>";
                                }
                                $_SESSION['modifica_sondaggio']=false;
                                if ($_SESSION['eliminazione_sondaggio']){
                                    echo "<div class=\"alert alert-success\" role=\"alert\">Sondaggio eliminato correttamente!</div>";
                                }
                                $_SESSION['eliminazione_sondaggio']=FALSE;
                                ?>
                                <div class="list-group">
                                <?php
                                $query=mysql_query("SELECT * FROM questionario");
                                $questionario=mysql_fetch_array($query);
                                while ($questionario){
                                    echo "<li class=\"list-group-item\" style=\"width: 100%\">
                                    <h4 class=\"list-group-item-heading\">".$questionario['nome']."</h4>
                                    <p class=\"list-group-item-text\"><a href=\"modifica_sondaggio.php?sondaggio=".$questionario['id_questionario']."\"><i class='glyphicon glyphicon-edit'></i> Modifica </a></p>
                                    <p class=\"list-group-item-text\"><a href=\"statistiche.php?idsondaggio=".$questionario['id_questionario']."\"><i class=\"fa fa-fw fa-bar-chart-o\"></i> Visualizza statistiche</a></p>
                                    <p class=\"list-group-item-text\" ><a href=\"javascript:Popup('mioFile.htm')\" id='elimina".$questionario['id_questionario']."' ><i class=\"glyphicon glyphicon-remove\"></i> Elimina</a></p></li>";
                                    
                                echo("<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
                                <script>
                                $(document).ready(function(){
                                        $(\"#elimina".$questionario['id_questionario']."\").click(function(){
                                            var url=\"elimina_sondaggio.php?idsondaggio=".$questionario['id_questionario']."\";
                                           
                                            var r = confirm('Sei sicuro?');
                                            if (r == true) {
                                                 $(location).attr('href',url);
                                            }
                                             
                                        });
                                    });                    
                               
                                    </script>");
                                
                                                
                                $questionario=mysql_fetch_array($query);
                                
                                }
                                ?>

                                </div>
                            </div>
                        </div>
                    </div>
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
