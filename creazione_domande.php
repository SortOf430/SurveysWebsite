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

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- jQuery ui -->
    <script src="js/plugin/jquery-ui-1.7.2.custom.min.js"></script>
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
    <script>
        $(document).ready(function(){
           var i=0;
           for(i=0;i<1000;i++){
               $('#div_risposte_'+i).hide();
           } 
        });
    </script>
    
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
                            Form di aggiunta domande
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Aggiungi Domande
                            </li>
                        </ol>
                        <div class="alert alert-info">
                                    <h3 class="panel-title">Inserisci qui le domande e le risposte che vuoi annettere al tuo sondaggio.</h3>
                                </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6" >
                    
                        <form role="form" action="inserimento_domande.php" method="post">
                        <div id="domande">
                        <?php 
                            $i=0;
                            $n=$_SESSION['n_domande'];
                            $ni=1;
                            $s=1;
                            while($ni - 1< $n){?>
                            <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Domanda n° <?php echo $ni;?></h3>
                            </div>
                            <div class="panel-body" >
                          <?php echo "<input class='form-control' name='domanda_".$ni."'><br>"; 
                                echo "<select class=\"form-control\" id='select".$ni."' name='select".$ni."'>
                                            <option value=''>Seleziona modalità di risposta</option>
                                            <option value='S/N'>Risposta sì o no</option>
                                            <option value='M'>Risposta multipla</option>
                                          </select><br>";
                                
                                echo "<div class=\"panel panel-info\" id=\"div_risposte_".$ni."\" >"?>
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Risposte</h3>
                                      </div>
                                <?php
                                     
                                    echo "<div class=\"panel-body\" id=\"Risp_".$ni."\">";
                                    echo ("<div class=\"input-group\"  id=\"piu_risposte_".$ni."\">
                                              <span class=\"input-group-addon\">
                                                <input type=\"checkbox\" name=\"piu_risposte_".$ni."\" value=\"TRUE\" aria-label=\"...\">
                                              </span>
                                              <input type=\"text\" disabled class=\"form-control\" value=\"Consenti più risposte\" aria-label=\"...\">
                                             
                                            </div><br>");
                                    echo "<input class='form-control' id='risposta_".$s."_".$ni."' name='risposta_".$s."_".$ni."' > <br>"; 
                                    echo "<script>
                                            $('#select".$ni."').change(function(){
                                              val=$(this).val();
                                              if (val=='S/N'){
                                                  $('#div_risposte_".$ni."').hide();
                                                  
                                                  var i = 1;
                                                  while($(\"#risposta_\"+ (i) + \"_".$ni."\").length)
                                                  {
                                                      $(\"#div_risposta_\"+ (i) + \"_".$ni."\").remove();
                                                      i++;
                                                  }
                                              }
                                              if (val=='M'){
                                                  $('#div_risposte_".$ni."').show();
                                              }
                                            });
                                          </script>";
                                           ?>
                                    </div>
                                    <?php
                                    echo "<center>";
                                    echo "<button type=\"button\" class=\"btn btn-sm btn-primary\" id=\"agg_risp_".$ni."\" >Nuova risposta</button>";
                                       echo "<script>";
                                           echo("$(\"#agg_risp_".$ni."\").click(function() {
                                                  var i = 1;
                                                  while($(\"#risposta_\"+ (i) + \"_".$ni."\").length)
                                                  {
                                                      i++;
                                                  }
                                                  $(\"#Risp_".$ni."\").append(\"<div id='div_risposta_\"+(i)+\"_".$ni."'><input class='form-control' id='risposta_\"+(i)+\"_".$ni."' name='risposta_\"+(i)+\"_".$ni."'><br id='risposta_\"+(i)+\"_".$ni."'></div>\");

                                               });");
                                        echo "</script>";
                                    echo "</center>";
                                    echo "<br>";
                                    ?>
                                </div>
                            
                            </div>
                            
                        </div>
                        <?php 
                                $ni++;
                            }
                        ?>
                        </div>
                            <center><button class="btn btn-default" id="aggiungi">Aggiungi domanda</button></center><br>
                            <button type="submit" class="btn btn-default" id="submit">Crea Sondaggio</button><br>
                        </form>
                        <script>
                            $('#aggiungi').click(function(event){
                                event.preventDefault();
                                $.ajax({
                                    url : 'aggiungi_domanda.php',
                                    success: function(data){
                                        $('#domande').append(data);}
                                    });
                            });
                        </script>
                         <script>
                                $('#submit').click(function(event){
                                  //event.preventDefault();
                                  alert("entra submit");
                                  
                                });
                            </script>
                        

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


</body>

</html>
