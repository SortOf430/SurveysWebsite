<?php
    include('connect.php');
    include('cambia.php');
    
    $codice = mysql_real_escape_string($_REQUEST['codice']);
    
    foreach($_REQUEST as $key=>$value)
    {
        $nomeChiave = $key;
        $esplosa = explode("_",$nomeChiave);

        if(startsWith($nomeChiave, "risposta_"))
        {
            //Checkbox
            $sql = "INSERT INTO risposte_date (`codice`, `risposta`) VALUES ('".$codice."', '".$esplosa[1]."');";
            $query = mysql_query($sql);
            //Non prevediamo un controllo sulla query di proposito.
            if(!$query)
            {
                echo $sql.'<br>';
                die(mysql_error());
            }
        }else if(startsWith($nomeChiave, "radio_risposta_"))
        {
            //Usare 2
            $esplosa_ex =  explode("_",$value);

            $sql = "INSERT INTO risposte_date (`codice`, `risposta`) VALUES ('".$codice."', '".$esplosa_ex[1]."');";
            $query = mysql_query($sql);
            //Non prevediamo un controllo sulla query di proposito.
            if(!$query)
            {
                echo $sql.'<br>';
                die(mysql_error());
            }
        }else if(startsWith($nomeChiave, "SNrisposta_"))
        {
            $esplosa_ex =  explode("_",$value);
            $sql = "INSERT INTO risposte_date (`codice`, `risposta`) VALUES ('".$codice."', '".$esplosa_ex[1]."');";
            $query = mysql_query($sql);
            //Non prevediamo un controllo sulla query di proposito.
            if(!$query)
            {
                echo $sql.'<br>';
                die(mysql_error());
            }
        }
    }
    //Cancellamento del codice dalla tabella
    $sql = "UPDATE codici SET fatto='1' WHERE codice= '".$codice."'";
    $query = mysql_query($sql);
    if(!$query)
    {
        die(mysql_error());
    }
            
    header("Location: questionario_finito.html");
    
function startsWith($haystack, $needle) {
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

?>