<?php
include("cambia.php");
include("Utility/PHPHelper.php");
include("Utility/StatsHelper.php");
$_SESSION['pagina']="statistiche.php";

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
        <script src="https://ss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        #placeholder { width: 80%; height: 500px; }
    </style>
    <!-- Inclusione delle librerie flot  -->
    <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="flot/jquery.flot.js"></script>
    
    <?php
    echo "<script type='text/javascript'>";
    
                        $id_sondaggio = mysql_real_escape_string($_REQUEST['idsondaggio']);
                        
                        if(isset($_GET['idsondaggio']))
                        {
                            //Mostra le statistiche per quel sondaggio
                            $sondaggio = $helper->OttieniSondaggioByID($id_sondaggio);
                            if($sondaggio != null)
                            {
                                $array_sondaggio = mysql_fetch_array($sondaggio);
                                $idSondaggio = $array_sondaggio['id_questionario'];
                                $domande = $helper->OttieniDomandeQuestionario($idSondaggio);
                                $istogramma = "";
                                
                                foreach($domande as $domanda)
                                {
                                    $risp_possibili =  $helper->OttieniRispostePossibiliByID($domanda->id);
                                    $istogramma = new Istogramma(1);
                                    
                                    foreach($risp_possibili as $risposta)
                                    {
                                          $risposte_date = $helper->OttieniRisposteDateByIDRisposta($risposta->id);
                                         
                                          $istogramma->aggiungi($risposta->testo_risposta, sizeof($risposte_date));
                                    }
                                    
                                    echo $istogramma->generaSerieDati();
                                    echo "
   
                                    var data_".$domanda->id." = "; 
                                    echo $istogramma->generaSerieDati();
                                    echo "
                                    $(document).ready(function () {
                                    $.plot(\"#".$domanda->id."\", [ data_".$domanda->id." ], {
		                            	    series: {
				                            bars: {
					                            show: true,
					                            barWidth: 0.3,
					                            align: \"center\"
				                                }
			                                },
			                                xaxis: {
				                                mode: \"categories\",
				                                tickLength: 0
			                                }
		                                });
                                    });
                                    ";
                                }
                                
                                
                                
                                
                            }
                        }
                        echo "</script>";
                    ?>
      
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
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="glyphicon glyphicon-hand-right"></i>      <strong>Benvenuto Amministratore</strong><a href="#" class="alert-link"></a></a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                
                <!-- /.row -->

                <div class="row">
                    <!-- Codice qui -->
                    <?php
                        $id_sondaggio = mysql_real_escape_string($_REQUEST['idsondaggio']);
                        
                        if(isset($_GET['idsondaggio']))
                        {
                            //Mostra le statistiche per quel sondaggio
                            $sondaggio = $helper->OttieniSondaggioByID($id_sondaggio);
                            if($sondaggio != null)
                            {
                                $array_sondaggio = mysql_fetch_array($sondaggio);
                                $idSondaggio = $array_sondaggio['id_questionario'];
                                $domande = $helper->OttieniDomandeQuestionario($idSondaggio);
                                foreach($domande as $domanda)
                                {
                                    echo
                                    '<div class="row">
                                        <div class="col-lg-12">
                                            <div class="alert alert-info">
                                                <i class="glyphicon glyphicon-pencil"></i>      <strong>'.$domanda->testo_domanda.'</strong><a href="#" class="alert-link"></a></a>
                                            ';

                                    
                                    echo '<br>';
                                    echo '<ul>';
                                    $risposte = $helper->OttieniRispostePossibiliByID($domanda->id);
                                    
                                    $istogramma->aggiungi($domanda->testo_domanda, sizeof($risposte));
                                    foreach($risposte as $possibile)
                                    {
                                        $risposte_date = $helper->OttieniRisposteDateByIDRisposta($possibile->id);
                                        echo '<li>'.$possibile->testo_risposta.' - '. sizeof($risposte_date) . '</li>';
                                    }
                                    echo '</ul>';
                                    echo '
                                    </div>
                                    </div>
                                    </div>';
                                    echo '<div id='.$domanda->id.' style="width: 80%; height: 500px;"></div>';
                                }
                                
                                //echo (var_dump($istogramma->getValori()));
                            }
                        }else{
                            
                            //Genera un form per quel sondaggio
                            
                            echo 'Nessun sondaggio trovato!';
                        }
                    ?>
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
    <script src="flot/jquery.flot.js"></script>
    <script language="javascript" type="text/javascript" src="flot/jquery.flot.categories.js"></script>

</body>

</html>
