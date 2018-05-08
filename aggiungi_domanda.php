<?php
    session_start();
    $_SESSION['n_domande']++;
    $ni=$_SESSION['n_domande'];
    $s=1;
    
?>

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

