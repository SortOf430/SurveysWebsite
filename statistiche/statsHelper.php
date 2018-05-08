<?php
session_start();

class StatsHelper
{
    //Il costruttore della nostra classe php.
    public function StatsHelper()
    {
        include ("connect.php");
    }
    
    function __destruct() {
        if($conn)
        {
            mysql_close($conn);
        }
    }
    
    function FetchStat($sondaggio)
    {
        $sql = "SELECT * FROM questionari WHERE questionari.nome = '".$sondaggio."';";
        $query = mysql_query($sql);
        if(!$query)
        {
            throw new Exception('Non sono riuscito ad ottenere il questionario.');
        }
        
        $questionario = mysql_fetch_array($query);
        return $questionario;
    }
    
}


?>