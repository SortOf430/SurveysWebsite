<?php
    session_start();
    include "connect.php";
    include "Utility/PHPHelper.php";
    include "cambia.php";
    
    $creatore = $_SESSION['username'];
    $nome=$_POST['titolo']; 
    $descrizione=$_POST['descrizione'];
    $ora=time();
    $data_creazione=date("Y-m-d",$ora);
    $data_fine=$_POST['data'];
    //$data_fine = str_replace("/", "-", $_POST['data']);
    //$_SESSION['prova_data']=$_POST['data']; //prova formato data yyyy-mm-dd

    $array_stringa = explode("-", $data_fine);
    
    /*if(sizeof($array_stringa) < 2)
    {
        $_SESSION['formato_data'] = true;
        header("Location: creazione_sondaggio.php");
    }*/
    
    $data_fine = $array_stringa[2] . "-" . $array_stringa[1] . "-" . $array_stringa[0];
    /**
    echo $data_creazione;
    echo "  ";
    echo $data_fine;
    die();**/
    if(is_numeric($_POST['n_domande'])){
        $_SESSION['n_domande']=intval($_POST['n_domande']);
    }
    else{
        $_SESSION['n_domande']=false;
        header("Location: creazione_sondaggio.php");
    }

    if (isDate($data_fine) && strtotime($data_creazione) < strtotime($data_fine)){
        $data_scadenza= $data_fine;
        $nome_escaped = mysql_real_escape_string($nome);
        $desc_escaped = mysql_real_escape_string($descrizione);
        $data_escaped = date("Y-m-d", strtotime($data_creazione));
        $scadenza_escaped = date("Y-m-d", strtotime($data_scadenza));
        
        
        $query = mysql_query("INSERT INTO questionario 
        (nome, descrizione, data_creazione, data_scadenza, creatore) 
        VALUES ('".$nome_escaped."', '".$desc_escaped."', '".$data_escaped."', '".$scadenza_escaped."', '".$creatore."')");
        if ($query){
            $_SESSION['nome_sondaggio'] = $nome;
            
          
            
            //metto qui la parte per gli alert
            $data_alert=date('r');
            
                                    //query per riceventi alert
            $query1= mysql_query("SELECT * FROM utenti"); 
            if (!$query1) {
	                        die("Errore nella query $query1: " . mysql_error()); }
	       
            $riga1=mysql_fetch_array($query1);
            $ricalert="";
            while($riga1){
                $ricalert=$ricalert.",".$riga1['username'];
                $riga1 = mysql_fetch_array($query1); }
            # in questa maniera la stringa $ricalert inizia con una virgola ma poi la splittiamo 
            # in corrispondenza della virgola
            $query2 = mysql_query("INSERT INTO alert 
            (idal, tipo, alerter, ricalert, timestamp) 
            VALUES ('', 'sondaggio', '".$creatore."', '".$ricalert."','".$data_alert."')");
            
            //fine parte alert
            
            
            header("Location: creazione_domande.php");
        }
        else {
            //die("Errore nella query : ".mysql_error());
            $_SESSION['creazione_sondaggio'] = true;
            header("Location: creazione_sondaggio.php");
        }
    }
    //differenziazione tra i due tipi di errore: data non valida e data antecedente a quella attuale
    else{
        if (!isDate($_POST['data'])){
            $_SESSION['formato_data'] = true;
            //echo $data_fine;
            header("Location: creazione_sondaggio.php");
        }
        if (strtotime($data_creazione) < strtotime($data_fine)) {
            $_SESSION['validita_data'] = true;
            //echo"Errore Data: Formato o scadenza";
            header("Location: creazione_sondaggio.php");
        }
        else{
            echo "Altro";
        }
    }
    
    function isDate($data){
        if(preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/',$data)){
            $chek = explode("-",$data);
            if(checkdate($chek[1],$chek[2],$chek[0])){
               return true;
            }
        }
        return false;
    }

?>