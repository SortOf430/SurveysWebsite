<?php
//include "connect.php";
include("cambia.php");
include("Utility/PHPHelper.php");
$helper = new PHPHelper();
$id_questionario=$_REQUEST['sondaggio'];
$_SESSION['id_questionario_da_modificare']=$id_questionario;
$questionario=$helper->OttieniSondaggioByID($id_questionario);
if (!$questionario){
    $_SESSION['inesistenza_sondaggio']=true;
    header("Location: visualizza_sondaggi.php");
}
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
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!--<div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="glyphicon glyphicon-hand-right"></i>      <strong>Benvenuto <u><?php echo ($helper->GetUser()['Nome'] . "</u> <u>" . $helper->GetUser()['Cognome']); ?></u></strong><a href="#" class="alert-link"></a></a>
                        </div>
                    </div>
                </div>-->
                <!-- /.row -->

                
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Elenco dei sondaggi creati</h3>
                            </div>
                            <div class="panel-body">
                               <div class="col-lg-6">
                                <form action="effettua_modifica_sondaggio.php" method="post">
                                <!--<div id="domande">-->
                                <?php 
                                 
                                $i=1;
                                $domande=$helper->OttieniDomandeQuestionario($id_questionario);
                                foreach($domande as $domanda){
                                    $risposte=$helper->OttieniRispostePossibiliByID($domanda->id);
                                    $j=1;
                                   
                                    echo "<div class=\"panel panel-primary\">
                                              <div class=\"panel-heading\">Domanda n° ".$i."</div>
                                              <div class=\"panel-body\">
                                                <div class=\"input-group\" >
                                                  <span class=\"input-group-addon\" id=\"basic-addon1\">Domanda non modificata: </span>
                                                  <input type=\"text\" class=\"form-control\" aria-describedby=\"basic-addon1\" value=\"".$domanda->testo_domanda."\" disabled>
                                                </div><br>
                                                <div class=\"input-group\">
                                                  <span class=\"input-group-addon\" id=\"basic-addon1\">Domanda modificata: </span>
                                                  <input type=\"text\" class=\"form-control\" aria-describedby=\"basic-addon1\" name=\"domanda_".$i."_modificata\">
                                                </div><br>";
                                                
                                                $modalitaprec=$domanda->tipo_risposte;
                                                if($modalitaprec=="M"){$modalitaprec="Risposta multipla";}
                                                if($modalitaprec=="S/N"){$modalitaprec="Si/No";}
                                                
                                                echo ("<div class=\"panel-heading\"><b>Tipo risposta precedente:</b></div>
                                                <div class=\"input-group\">
                                                 <span class=\"input-group-addon\">
                                                    <input type=\"radio\" value=\"\" aria-label=\"...\" name=\"\" disabled checked=\"true\">
                                                  </span>
                                                  <input type=\"text\" class=\"form-control\" aria-label=\"...\" value=\"$modalitaprec\" disabled >
                                                <br></div><br>");
                                              
                                                $_SESSION['id_domanda_'.$i]=$domanda->id;
                                                if ($domanda->tipo_risposte=="S/N"){
                                                echo"<div class=\"panel panel-danger\">
                                                      <div class=\"panel-heading\">Modifica modalità di risposta</div>
                                                      <div class=\"panel-body\">
                                                        <div class=\"col-lg-6\">
                                                            <div class=\"input-group\">
                                                              <span class=\"input-group-addon\">
                                                                <label id='multi".$i."' ><input type=\"radio\" value=\"M\" aria-label=\"...\" name=\"mod_".$i."\"></label>
                                                              </span>
                                                              <input type=\"text\" class=\"form-control\" aria-label=\"...\" value=\"Risposta multipla\" disabled>
                                                            </div>
                                                        </div>  
                                                        <div class=\"col-lg-6\"> 
                                                            <div class=\"input-group\">
                                                              <span class=\"input-group-addon\" >
                                                                <label id='sino".$i."' ><input type=\"radio\" value=\"S/N\" aria-label=\"...\"  name=\"mod_".$i."\" checked=\"true\"></label>
                                                              </span>
                                                              <input type=\"text\" class=\"form-control\" aria-label=\"...\" value=\"Si/No\" disabled>
                                                            </div>
                                                        </div>
                                                        </div></div>
                                                        "; 
                                                echo "<center><div id='s".$i."' ></div><br><div id='button".$i."'></div></center>";                                   
                                    
                                                //jQuery prima
                                                echo ("<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
                                                <script>
                                                $(document).ready(function(){
                                                $('#sino".$i."').click(function(){ ");
                                                if($domanda->tipo_risposte=="S/N"){
                                                             for ($x=1; $x<10; $x++){
                                                              echo ("$('#button".$i."').fadeOut(); $('#s".$i."').fadeOut();"); 
                                                              } } #ini S/N click S/N --> hide show quest
                                                 echo ("});
                                                });
                                            
                                                $(document).ready(function(){
                                                    $('#multi".$i."').click(function(){ ");
                                                    if($domanda->tipo_risposte=="S/N"){
                                                    for ($x=1; $x<10; $x++){
                                                    echo ("$('#s".$i."').fadeIn(); $('#button".$i."').fadeIn();");
                                                    echo ("$( '#button".$i."' ).html( '<button type=\"button\" class=\"btn btn-sm btn-primary\" >Nuova risposta</button>'); ");
                                                    } } #ini S/N click M --> add quest
                                                    
                                                    echo ("});
                                                    });
                                                </script>
                                                ");
                                
                                                //add risp
                                                echo ("<script>
                                                       $(document).ready(function(){
                                                        var nrisp".$i."=1;
                                                        $('#button".$i."').click(function(){ 
                                                            $('#s".$i."').append(' <br><div id=\"div_risposta_\".$i.><input class=\"form-control\" id=\"risposta_".$i."_' + nrisp".$i." + '\" name=\"risposta_".$i."_' + nrisp".$i." + '\"></div> '); 
                                                            nrisp".$i."=nrisp".$i."+1;
                                                            });
                                                        });
                                                        </script>");
                                                // fine add risp
                                                }//FINE CASO MODALITA DOMANDA = SI NO
                                                if ($domanda->tipo_risposte=="M") {
                                                   echo"<div class=\"panel panel-danger\">
                                                      <div class=\"panel-heading\">Modifica modalità di risposta</div>
                                                      <div class=\"panel-body\">
                                                          <div class=\"col-lg-6\">
                                                            <div class=\"input-group\">
                                                              <span class=\"input-group-addon\">
                                                                <label id='multi".$i."' ><input type=\"radio\" value=\"M\" aria-label=\"...\" name=\"mod_".$i."\" checked=\"true\"></label>
                                                              </span>
                                                              <input type=\"text\" class=\"form-control\" aria-label=\"...\" value=\"Risposta multipla\" disabled>
                                                            </div>
                                                          </div>
                                                          <div class=\"col-lg-6\">
                                                            <div class=\"input-group\">
                                                              <span class=\"input-group-addon\">
                                                                <label id='sino".$i."' ><input type=\"radio\" value=\"S/N\" aria-label=\"...\" name=\"mod_".$i."\"></label>
                                                              </span>
                                                              <input type=\"text\" class=\"form-control\" aria-label=\"...\" value=\"Si/No\" disabled>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>";
                                                
                                                //inizio sezione inerente risposte possibili
                                                        foreach($risposte as $risposta){        
                                                        echo "<div id='p".$i."_".$j."'>
                                                              <div class=\"panel panel-info\">
                                                                <div class=\"panel-heading\">Risposta ".$j."</div>
                                                                <div class=\"panel-body\">
                                                                    <div class=\"input-group\" >
                                                                      <span class=\"input-group-addon\" id=\"basic-addon1\">Domanda non modificata: </span>
                                                                      <input type=\"text\" class=\"form-control\" aria-describedby=\"basic-addon1\" value=\"".$risposta->testo_risposta."\" disabled>
                                                                    </div><br>
                                                                    <div class=\"input-group\">
                                                                      <span class=\"input-group-addon\" id=\"basic-addon1\">Domanda modificata: </span>
                                                                      <input type=\"text\" class=\"form-control\" aria-describedby=\"basic-addon1\" name=\"risposta_".$i."_".$j."_modificata\">
                                                                    </div> 
                                                                </div>
                                                              </div>
                                                              </div>";
                                              
                                                        //jQuery seconda
                                            
                                                        echo ("<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
                                                            <script>
                                                            $(document).ready(function(){
                                                            $('#sino".$i."').click(function(){ ");
                                                            if($domanda->tipo_risposte=="M"){
                                                            for ($x=1; $x<10; $x++){
                                                                echo ("$('#p".$i."_".$x."').fadeOut(); 
                                                                $('#btnm".$i."').fadeOut(); 
                                                                $('#s2".$i."').fadeOut(); "); 
                                                            } } #ini M click S/N --> hide
                                                           
                                                            echo ("});
                                                            });
                                                    
                                                        $(document).ready(function(){
                                                            $('#multi".$i."').click(function(){ ");
                                                            if($domanda->tipo_risposte=="M"){
                                                            for ($x=1; $x<10; $x++){
                                                                echo ("$('#p".$i."_".$x."').fadeIn();
                                                                 $('#btnm".$i."').fadeIn(); 
                                                                 $('#s2".$i."').fadeIn(); ");
                                                            } } #ini M click M --> show
                                                            
                                                            echo ("});
                                                        });
                                                        </script>
                                                        "); 
                                                    
                                                        // jQuery
                                                        $_SESSION['id_risposta_'.$i.'_'.$j]=$risposta->id;
                                                        $j++;
                                                        }}
                                                //fine sessione inerente risposte possibili
                                
                                                    /*** Aggiungi risposte dopo multipla ***/
                                                $secondaria = $helper->OttieniDomandaById($domanda->id);
                                                $n_risposte_possibili = $secondaria->numero_risposte_possibili+1;
                                                echo ("<div id='s2".$i."'></div><br>");
                                                //add risp
                                                echo ("<script>
                                                    $(document).ready(function(){
                                                        var nrisp".$i."=".$n_risposte_possibili.";");
                                                    echo ("$('#button2".$i."').click(function(){ ");
                                                    echo ("$('#s2".$i."').append(' <br><div id=\"div_risposta_\".$i.><input class=\"form-control\" id=\"risposta_".$i."_' + nrisp".$i." + '\" name=\"risposta_".$i."_' + nrisp".$i." + '\"></div> '); 
                                                        nrisp".$i."=nrisp".$i."+1;
                                                    });");
                                                 echo ("});");
                                                echo ("</script>");
                                                // fine add risp
                                                // tasto btn dopo risposte mm    
                                                if ($domanda->tipo_risposte=="M"){ 
                                                    echo ("<div id='button2".$i."'><center><button type=\"button\" id=\"btnm".$i."\"class=\"btn btn-sm btn-primary\" >Nuova risposta</button></center></div><br>");
                                               }  
                                                    /*** Aggiungi risposte dopo multipla ***/      
                                                $_SESSION['n_risposte_'.$i]=$j;
                                                            
                                                echo "
                                                </div>
                                                </div>
                                                ";
                                                $i++;
                                            }
                                             $_SESSION['nuovo_numero_domande']=$i;
                                ?>
                                <div id="domande"></div>
                                <center><button type="button" id="aggiungi_domanda" class="btn btn-sm btn-primary" >Nuova domanda</button></center>
                                
                                <script>
                                    $("#aggiungi_domanda").click(function(event){
                                       event.preventDefault();
                                        $.ajax({
                                            url : 'aggiungi_domanda2.php',
                                            success: function(data){
                                                $('#domande').append(data);}
                                            });
                                    });
                                </script>
                                
                                
                                <!--<button type="button" class="btn btn-default" id="aggiungi_domanda">Aggiungi Domanda</button>-->
                                <input type="submit" class="btn btn-primary" value="Modifica">
                                </form>
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