<?php
    session_start();
    $_SESSION['aggiunta_domande']=TRUE;
    $_SESSION['nuovo_numero_domande'];
    $ni=$_SESSION['nuovo_numero_domande'];
    $s=1;
    
?>
    
    <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Domanda n° <?php echo $ni;?></h3>
                            </div>
                            <div class="panel-body" >
                                <?php echo "<input class='form-control' name='domanda_".$ni."'>"; ?><br>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Risposte</h3>
                                    </div><?php
                                    echo "<div class=\"panel-body\" id=\"Risp_".$ni."\">";
                                    echo "<select class=\"form-control\" id='select".$ni."' name='select".$ni."'>
                                            <option value=''>Seleziona modalità di risposta</option>
                                            <option value='S/N'>Risposta sì o no</option>
                                            <option value='M'>Risposta multipla</option>
                                          </select> <br>
                                          <script>
                                            $('#select".$ni."').change(function(){
                                              val=$(this).val();
                                              if (val=='S/N'){
                                                  $('#risposta_".$s."_".$ni."').attr('disabled','disabled');
                                                  $('#agg_risp_".$ni."').attr('disabled','disabled');
                                                  
                                                  var i = 1;
                                                  while($(\"#risposta_\"+ (i) + \"_".$ni."\").length)
                                                  {
                                                      $(\"#div_risposta_\"+ (i) + \"_".$ni."\").remove();
                                                      i++;
                                                  }
                                              }
                                              if (val=='M'){
                                                  $('#risposta_".$s."_".$ni."').removeAttr('disabled');
                                                  $('#agg_risp_".$ni."').removeAttr('disabled');
                                              }
                                            });
                                          </script>";
                                    echo "<input class='form-control' id='risposta_".$s."_".$ni."' name='risposta_".$s."_".$ni."' disabled> <br>"; 
                                           ?>
                                    </div>
                                    <?php
                                    echo "<center>";
                                    echo "<button type=\"button\" class=\"btn btn-sm btn-primary\" id=\"agg_risp_".$ni."\" disabled>Nuova risposta</button>";
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
                        <?php $_SESSION['nuovo_numero_domande']++;?>

