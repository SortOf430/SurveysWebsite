<?php
    session_start();
    include "connect.php";
    include "Utility/PHPHelper.php";

    $creatore = $_SESSION['username'];
    $nome=$_POST['titolo']; 
    $descrizione=$_POST['descrizione'];
    $numero_domande = $_SESSION['n_domande'];
    $nome_sondaggio = $_SESSION['nome_sondaggio'];
    $sql = "SELECT * FROM questionario WHERE nome = '".$nome_sondaggio."'";
    echo $nome_sondaggio;

    $query = mysql_query($sql);
    if($query)
    {
        //Abbiamo trovato un sondaggio corrispondente. Svuotiamo la sessione.
        $_SESSION['nome_sondaggio'] = "";
        $id_sondaggio = mysql_fetch_array($query)['id_questionario'];
        
        //Determiniamo il numero di risposte per ogni domanda.
        
        $ni = 1;
        $domande = array();
        while($ni - 1 < $numero_domande)
        {
            //Determiniamo le risposte per ciascuna domanda e costruiamo un array contenente wrappers con le risposte.
            if($_REQUEST['domanda_'.$ni])
            {
                $Domanda = new Domanda();
                $Domanda->testo_domanda = $_REQUEST['domanda_'.$ni];
                $Domanda->tipo_risposte = $_REQUEST['select'.$ni];
                
                $sub_2 = $ni;
                $sub_3 = 1;
                if( $_REQUEST['select'.$ni] != "S/N")
                {
                     while(isset($_REQUEST['risposta_'.$sub_3.'_'.$ni]))
                    {
                        array_push($Domanda->risposte, $_REQUEST['risposta_'.$sub_3.'_'.$ni]); 
                        $sub_3++;
                    }
                }

                array_push($domande, $Domanda); 
            }else{
                echo 'Non esiste: '.$_REQUEST['domanda_'.$ni];
            }
            
            $ni++;
        }
        
        $nii=1;
        foreach($domande as $d)
        {
            $insert=mysql_query(sprintf("INSERT INTO domande (testo_domanda,modalita,questionario) VALUES('%s','%s','%d')",
                                        mysql_real_escape_string($d->testo_domanda),
                                        mysql_real_escape_string($d->tipo_risposte),
                                        $id_sondaggio));
            if(!$insert){
                die("errore nella query 1: ".mysql_error());
            }
            $query_domanda=mysql_query("SELECT * FROM domande WHERE testo_domanda='".$d->testo_domanda."'");
            $domandona = mysql_fetch_array($query_domanda);
            $id_domanda=$domandona['id_domanda'];
            if ($_POST["piu_risposte_".$nii]=="TRUE"){
                $update=mysql_query("UPDATE domande SET piu_risposte = '1' WHERE id_domanda='".$id_domanda."'");
                if (!$update){
                    die("errore nella query: ".mysql_error());
                }
            }
            
            if($d->tipo_risposte == "S/N")
            {
                $insertansw = mysql_query(sprintf("INSERT INTO risposte_possibili (testo_risposta,domanda) VALUES('SI','%d')",$id_domanda));
                $insertansw_ex = mysql_query(sprintf("INSERT INTO risposte_possibili (testo_risposta,domanda) VALUES('NO','%d')",$id_domanda));
                
                if(!$insertansw || !$insertansw_ex)
                {
                     die("errore nella query 2/3: ".mysql_error());
                }
            }
            else{
                foreach($d->risposte as $r){
                    $insertansw=mysql_query(sprintf("INSERT INTO risposte_possibili (testo_risposta,domanda) VALUES('%s','%d')",
                                                mysql_real_escape_string($r),$id_domanda));
                    if(!$insertansw){
                        die("errore nella query 2: ".mysql_error());
                    }
                }
            }
            /**
            echo "Testo Domanda: <br>";
            echo $d->testo_domanda."<br><br>";
            echo "Tipo Risposte: <br>";
            echo $d->tipo_risposte."<br><br>";
            echo "Risposte possibili: <br><br>";
            foreach($d->risposte as $r)
            {
                echo $r."<br>";
            }
            echo "<br>";**/
        }
        $_SESSION['success_creation']=TRUE;
        header("Location: index.php");
    }
    
    class Domanda
    {
        public $testo_domanda = "";
        public $tipo_risposte = "";
        public $risposte = array();
    }

?>