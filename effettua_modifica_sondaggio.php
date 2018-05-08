<?php
include ("Utility/PHPHelper.php");
$helper= new PHPHelper();
$N=$_SESSION['nuovo_numero_domande'];
$idQuestionario=$_SESSION['id_questionario_da_modificare'];
$i=0;



for ($i=1; $i<=$N; $i++){
    $id_domanda=$_SESSION['id_domanda_'.$i];
    $domanda=$helper->OttieniDomandaById($id_domanda);
    
    //echo $_POST['mod_'.$i];
    //se il testo della domanda è cambiato, effettuo l'update sul db
    if ($_POST['domanda_'.$i.'_modificata']!=""){
        $update1=mysql_query("UPDATE domande SET testo_domanda='".mysql_real_escape_string($_POST['domanda_'.$i.'_modificata'])."' WHERE id_domanda='".$domanda->id."'");
        if (!$update1){
            die("errore nella query: ".mysql_error());
        }
    }
    //se la tipologia di domanda nuova e diversa da quella vecchia...
    if ($_POST['mod_'.$i]!=$domanda->tipo_risposte){
        //Se è cambiata da risposta multipla a si/no...
        if ($_POST['mod_'.$i]=="S/N"){
            //cancello tutte le risposte possibili che corrispondevano a quella domanda
            $update2_bis=mysql_query("DELETE FROM risposte_possibili WHERE domanda = '".$id_domanda."'");
            if (!$update2_bis){
                die("errore nella query: ".mysql_error());
            }
            //setto la nuova modalità della domanda
            $update2=mysql_query("UPDATE domande SET modalita='".mysql_real_escape_string($_POST['mod_'.$i])."' WHERE id_domanda='".$domanda->id."'");
            if (!$update2){
                die("errore nella query: ".mysql_error());
            }
        }
        //Se è cambiata da si no a risposta multipla...
        if ($_POST['mod_'.$i]=="M"){
            //setto la nuova modalità della domanda
            $update4=mysql_query("UPDATE domande SET modalita='".mysql_real_escape_string($_POST['mod_'.$i])."' WHERE id_domanda='".$domanda->id."'");
            if (!$update4){
                die("errore nella query: ".mysql_error());
            }
            //aggiungo nuove risposte possibili
            for ($x=1;$x<=10;$x++){
                if ((isset($_POST['risposta_'.$i.'_'.$x])) && ($_POST['risposta_'.$i.'_'.$x]!="")){
                    $update4_bis=mysql_query("INSERT INTO risposte_possibili (testo_risposta, domanda) VALUES ('".mysql_real_escape_string($_POST['risposta_'.$i.'_'.$x])."','".$domanda->id."')");
                    if (!$update4_bis){
                        die("errore nella query: ".mysql_error());
                    }
                }
            }
        }
        
    }
    
    $n_ris=$_SESSION['n_risposte_'.$i];
    
    //Se i vari testi delle varie risposte sono cambiati li cambio sul db
    for ($j=1;$j<=$n_ris;$j++){
        $risposta=$helper->OttieniRisposteByID($_SESSION['id_risposta_'.$i.'_'.$j]);
        if ($_POST['risposta_'.$i.'_'.$j.'_modificata']!=""){
        $update3=mysql_query("UPDATE risposte_possibili SET testo_risposta='".mysql_real_escape_string($_POST['risposta_'.$i.'_'.$j.'_modificata'])."' WHERE id_risposta='".$risposta->id."'");
            if (!$update3){
                die("errore nella query: ".mysql_error());
            }
        }    
    }
    
    /*aggiunta di nuove risposte dove la domanda prevedeva già inizialmente risposte multiple*/
    $secondaria = $helper->OttieniDomandaById($domanda->id);
    $n_risposte_possibili = $secondaria->numero_risposte_possibili+1;
    while(isset($_POST["risposta_".$i."_".$n_risposte_possibili])){
        if ($_POST["risposta_".$i."_".$n_risposte_possibili]!=""){
            $inserimento_nuove_risposte=mysql_query("INSERT INTO risposte_possibili (testo_risposta,domanda) VALUES ('".mysql_real_escape_string($_POST["risposta_".$i."_".$n_risposte_possibili])."','".$domanda->id."')");
            $n_risposte_possibili++;
        }
    }

}
//aggiunta eventuali nuove domande
$Nn=$N-1;
while (isset($_POST['domanda_'.$Nn])){
    if ($_POST['domanda_'.$Nn]!=""){
        $s=1;
        $insert=mysql_query(sprintf("INSERT INTO domande (testo_domanda,modalita,questionario) VALUES('%s','%s','%d')",
                                        mysql_real_escape_string($_POST['domanda_'.$Nn]),
                                        mysql_real_escape_string($_POST["select".$Nn]),
                                        $idQuestionario));
        if(!$insert){
            die("errore nella query : ".mysql_error());
        }
        $select=mysql_query(sprintf("SELECT * FROM domande WHERE testo_domanda='%s' AND modalita='%s' AND questionario='%d'",
                                        mysql_real_escape_string($_POST['domanda_'.$Nn]),
                                        mysql_real_escape_string($_POST["select".$Nn]),
                                        $idQuestionario));
        $question=mysql_fetch_array($select);
        if ($question['modalita']=="M"){
            while (isset($_POST["risposta_".$s."_".$Nn])){
                if($_POST["risposta_".$s."_".$Nn]!=""){
                    $insert_answ=mysql_query(sprintf("INSERT INTO risposte_possibili (testo_risposta,domanda) VALUES('%s','%d')",
                                                        mysql_real_escape_string($_POST["risposta_".$s."_".$Nn]),
                                                        $question['id_domanda']
                                                        ));
                    if (!$insert_answ){
                       die("errore nella query : ".mysql_error()); 
                    }
                }
                $s++;
            }
        }
    }
    $Nn++;
}


$_SESSION['modifica_sondaggio']=true;
header("Location: visualizza_sondaggi.php");

?>