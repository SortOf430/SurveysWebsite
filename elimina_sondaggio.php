<?php
    session_start();
    include ("Utility/PHPHelper.php");
    $helper=new PHPHelper();
    $id_sondaggio=$_GET['idsondaggio'];
    
    $domande=$helper->OttieniDomandeQuestionario($id_sondaggio);
    foreach($domande as $domanda){
        
            $risposte=$helper->OttieniRispostePossibiliByID($domanda->id);
            foreach($risposte as $risposta){
                $delete_answers=mysql_query("DELETE FROM risposte_date WHERE risposta='".$risposta->id."'");
                if (!$delete_answers){
                    die("errore nell'eliminazione del sondaggio: 3".mysql_error());
                }
                $query=mysql_query("DELETE FROM risposte_possibili WHERE id_risposta='".$risposta->id."'");
                 if (!$query){
                    die("errore nell'eliminazione del sondaggio: 2".mysql_error());
                }
            }
            $delete_question=mysql_query("DELETE FROM domande WHERE id_domanda='".$domanda->id."'");
             if (!$delete_question){
                    die("errore nell'eliminazione del sondaggio: 1 ".mysql_error());
                }
        }
        
    echo ($id_sondaggio);
      
    $delete3=mysql_query("DELETE FROM codici WHERE questionario='".$id_sondaggio."'");
    echo "DELETE FROM codici WHERE questionario='".$id_sondaggio."'";
    if (!$delete3){
        die("errore nell'eliminazione del sondaggio 24: ".mysql_error());
    }
    
    $delete=mysql_query("DELETE FROM questionario WHERE id_questionario='".$id_sondaggio."'");
    if (!$delete){
        die("errore nell'eliminazione del sondaggio 22: ".mysql_error());
    }
    
    
    $_SESSION['eliminazione_sondaggio']=TRUE;
    header("Location: visualizza_sondaggi.php");
?>