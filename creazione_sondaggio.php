<?php session_start();
include("cambia.php");
include("Utility/PHPHelper.php");
$helper = new PHPHelper();
$_SESSION['pagina']="creazione_sondaggio.php";
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Creazione sondaggio</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Time library -->
    <script type="text/javascript" src="bootstrap-datepicker.de.js" charset="UTF-8"></script>

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
                            Form di creazione del sondaggio
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Crea Sondaggio
                            </li>
                        </ol>
                        <div class="alert alert-info">
                                    <h3 class="panel-title">Inserisci qui le informazioni principali che ti permetteranno di creare il tuo sondaggio.</h3>
                                </div>
                        <?php //controllo validità query
                        if ($_SESSION['creazione_sondaggio']){
                            echo ("<div class=\"alert alert-danger\" role=\"alert\">
                          <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
                          <span class=\"sr-only\">Error:</span>
                          Errore nella creazione del sondaggio
                        </div>");
                            $_SESSION['creazione_sondaggio']=false;
                        }
                        //controllo formato data
                        if($_SESSION['formato_data'])
                        {
                          echo ("<div class=\"alert alert-danger\" role=\"alert\">
                          <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
                          <span class=\"sr-only\">Errore:</span>
                          Formato della data errato! gg-mm-aaaa
                        </div>");
                        //echo ($_SESSION['prova_data']);
                        $_SESSION['formato_data'] = false;
                        }
                        //controllo valore data
                        if($_SESSION['validita_data'])
                        {
                            echo ("<div class=\"alert alert-danger\" role=\"alert\">
                          <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
                          <span class=\"sr-only\">Errore:</span>
                          Data di scadenza non valida! Immetti una data successiva a quella attuale
                        </div>");
                        $_SESSION['validita_data'] = false;
                        }
                        //controllo validità campo domanda
                        if(isset($_SESSION['n_domande'])&&($_SESSION['n_domande']==false))
                        {
                        echo ("<div class=\"alert alert-danger\" role=\"alert\">
                          <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
                          <span class=\"sr-only\">Errore:</span>
                          Il valore immesso nel campo \"N° domande\" non è un numero!
                          </div>");
                        $_SESSION['n_domande'] = true;
                        }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

                
                     <div class="panel panel-primary" style="width:80%">
                            <div class="panel-heading">
                                <h3 class="panel-title">Crea Sondaggio</h3>
                            </div>
                            
                            <div class="panel-body">
                        <form role="form" action="inserimento_sondaggio.php" method="post">

                            <div class="form-group" style="width:50%">
                                <label>Titolo del sondaggio</label>
                                <input class="form-control" name="titolo">
                                <p class="help-block">Inserisci qui il titolo del sondaggio</p>
                            </div>
                            <div class="form-group">
                                <label>Descrizione</label>
                                <textarea class="form-control" rows="4" name="descrizione"></textarea>
                                <p class="help-block">Inserisci qui la descrizione del sondaggio</p>
                            </div>
                            <div class="form-group" style="width:35%">
                                <label>N° domande</label>
                                <input class="form-control" name="n_domande">
                                <span class="help-block">Inserisci qui il numero di domande desiderato</span>
                            </div>
                            <div class="form-group" style="width:35%">
                                <label>Data scadenza</label>
                                <input type="text" class="form-control" name="data" placeholder="gg-mm-aaaa">
                                <p class="help-block">Inserisci qui la data di scadenza del questionario</p>
                            </div>
                            <button type="submit" class="btn btn-primary">Crea Sondaggio</button><br>
                        </form>
            
                        

                    </div>
                    </div>
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
    
    <!-- jQuery ui -->
    <script src="js/plugin/jquery-ui-1.7.2.custom.min.js"

</body>

</html>
