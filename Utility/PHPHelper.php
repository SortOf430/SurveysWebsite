<?php
session_start();

class PHPHelper
{
    //Il costruttore della nostra classe php.
    public function PHPHelper()
    {
        include ("connect.php");
    }
    //Il distruttore della classe
    function __destruct() {
        if($conn)
        {
            mysql_close($conn);
        }
    }
    
    //Ritorna un array associativo contenente le proprietà dell'utente.
    function GetUser()
    {
        $sql = "SELECT * FROM utenti WHERE utenti.username = '".$_SESSION['username']."';";
        $query = mysql_query($sql);
        if(!$query)
        {
            throw new Exception('Utente non esistente.');
        }
        
        $utente = mysql_fetch_array($query);
        return $utente;
    }
    
    function OttieniSondaggi()
    {
        $sql = "SELECT * FROM questionario WHERE data_scadenza > ".date("Y-m-d").";";
        $query = mysql_query($sql);
        if(!$query)
        {
            throw new Exception('Errore nel retrieval dei questionari.');
        }
        
        return $query;
    }
    
    function GetIDQuestionarioFromCodice($id)
    {
        $sql = "SELECT codici.questionario FROM codici WHERE codici.codice = '".$id."' AND NOT codici.fatto;";
        $query = mysql_query($sql);
        if(!$query)
        {
            throw new Exception('Errore nel retrieval dell id.');
        }
        
        if(mysql_num_rows($query) > 0)
        {
            return $query;
        }
        
        return null;
    }
    
    function OttieniSondaggioByID($id)
    {
        $sql = "SELECT * FROM questionario WHERE data_scadenza > ".date("Y-m-d")." AND id_questionario = '".$id."';";
        $query = mysql_query($sql);
        if(!$query)
        {
            throw new Exception('Errore nel retrieval del questionaro.');
        }
        
        if(mysql_num_rows($query) > 0)
        {
            return $query;
        }
        
        return null;
    }
    
    function OttieniDomandeQuestionario($idQuestionario)
    {
        $sql = "SELECT * FROM domande WHERE questionario = '".$idQuestionario."';";
        $query = mysql_query($sql);
        if(!$query)
        {
            throw new Exception('Errore nel retrieval delle domande.');
        }
        
        $array_ritorno = array();
        $riga = mysql_fetch_array($query);
        while($riga)
        {
            $domanda = new Domanda_Questionario();
            $domanda->testo_domanda = $riga['testo_domanda'];
            $domanda->tipo_risposte = $riga['modalita'];
            $domanda->id = $riga['id_domanda'];
            $domanda->questRif = $riga['questionario'];
            $domanda->risp_multipla = $riga['piu_risposte'];
            array_push($array_ritorno, $domanda);
            $riga = mysql_fetch_array($query);
        }
        
        return $array_ritorno;
    }
    
    function OttieniDomandaById($idDomanda){
        $sql = "SELECT * FROM domande WHERE id_domanda = '".$idDomanda."';";
        $query = mysql_query($sql);
        if(!$query)
        {
            throw new Exception('Errore nel retrieval della domanda.');
        }
        
        $riga = mysql_fetch_array($query);

        $domanda = new Domanda_Questionario();
        $domanda->testo_domanda = $riga['testo_domanda'];
        $domanda->tipo_risposte = $riga['modalita'];
        $domanda->id = $riga['id_domanda'];
        $domanda->risp_multipla = $riga['piu_risposte'];
        $domanda->questRif = $riga['questionario'];
        //echo $riga['piu_risposte'];
        
        if ($domanda->tipo_risposte=="M"){
            $query2 = mysql_query("SELECT * FROM risposte_possibili WHERE domanda = '".$domanda->id."';");
            $domanda->numero_risposte_possibili = mysql_num_rows($query2);
        } 
        return $domanda;
    }
    
    function OttieniRispostePossibiliByID($idDomanda)
    {
        $sql = "SELECT * FROM risposte_possibili WHERE domanda = '".$idDomanda."';";
        $query = mysql_query($sql);
        if(!$query)
        {
            throw new Exception('Errore nel retrieval delle risposte possibili.');
        }
        
        $array_ritorno = array();
        $riga = mysql_fetch_array($query);
        while($riga)
        {
            $risposta = new Risposta_Possibile();
            $risposta->id = $riga['id_risposta'];
            $risposta->testo_risposta = $riga['testo_risposta'];
            $risposta->IDDomanda = $riga['domanda'];
            
            array_push($array_ritorno, $risposta);
            $riga = mysql_fetch_array($query);
        }
        
        return $array_ritorno;
    }
    
    function OttieniRisposteByID($idRisposta){
        $sql = "SELECT * FROM risposte_possibili WHERE id_risposta = '".$idRisposta."';";
        $query = mysql_query($sql);
        if(!$query)
        {
            throw new Exception('Errore nel retrieval delle risposte.');
        }
        
        $array_ritorno = array();
        $riga = mysql_fetch_array($query);
        
        $risposta = new Risposta_Possibile();
        $risposta->id = $riga['id_risposta'];
        $risposta->testo_risposta = $riga['testo_risposta'];
        $risposta->IDDomanda = $riga['domanda'];

        
        return $risposta;
    }
    
    function OttieniRisposteDateByID($idDomanda)
    {
        $sql = "SELECT * FROM risposte_date, risposte_possibili WHERE risposte_possibili.domanda = '".$idDomanda."' AND risposte_date.risposta = risposte_possibili.id_risposta;";

        $query = mysql_query($sql);
        if(!$query)
        {
            throw new Exception('Errore nel retrieval delle risposte date.');
        }
        
        $array_ritorno = array();
        $riga = mysql_fetch_array($query);
        while($riga)
        {
            $risposta = new Risposta_Data();
            $risposta->codice = $riga['codice'];
            $risposta->testo_risposta = $riga['testo_risposta'];
            $risposta->RefRispostaPossibile = $riga['risposta'];

            array_push($array_ritorno, $risposta);
            $riga = mysql_fetch_array($query);
        }
        
        return $array_ritorno;
    }
    
    function OttieniRisposteDateByIDRisposta($idRisposta){
        $sql = "SELECT * FROM risposte_date WHERE risposta = '".$idRisposta."';";
        $query = mysql_query($sql);
        if(!$query)
        {
            throw new Exception('Errore nel retrieval delle risposte.');
        }
        
        $array_ritorno = array();
        $riga = mysql_fetch_array($query);
        while($riga != null)
        {
            $risposta = new Risposta_Data();
            $risposta->codice = $riga['codice'];
            $risposta->RefRispostaPossibile = $riga['risposta'];
            array_push($array_ritorno, $risposta);
            $riga = mysql_fetch_array($query);
        }
        
        return $array_ritorno;
    }
    
    function matchesEmail($stringa)
    {
        if(preg_match("/[a-zA-Z0-9_.+-]{1,}\@[a-zA-Z0-9-]{1,}\.[a-zA-Z0-9-.]{1,}/",$stringa))
        {
            return true;
        }
        return false;
    }
}

class Domanda_Questionario
{
    public $id = "";
    public $testo_domanda = "";
    public $tipo_risposte = "";
    public $questRif = "";
    public $risp_multipla = "";
}

class Risposta_Possibile
{
    public $id = "";
    public $testo_risposta = "";
    public $IDDomanda = "";
}

class Risposta_Data
{
    public $codice = "";
    public $RefRispostaPossibile = "";
}

?>