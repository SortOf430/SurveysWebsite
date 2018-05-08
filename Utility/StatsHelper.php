<?php
class Istogramma
{
    protected $values;
    protected $width;
    protected $numero;
    
    public function __construct($width = 1)
    {
        $this->values = array();
        $this->numero = array();
        $this->width = $width;
    }
 
    public function aggiungi($key, $value)
    {
        
        if (!isset($this->values[$key])) $this->values[$key] = 0;
        $this->values[$key] = $value;
    }
 
    public function aggiungiArray(array $array, $key = false)
    {
        if ($key) $array = array_filter(array_map(function($i)use($key){return isset($i[$key])?$i[$key]:false;},$array));
        array_walk($array,array($this,'add'));
    }
 
    public function getValori()
    {
        return $this->values;
    }
 
    public function ordina($inverse = false)
    {
        if ($inverse) arsort($this->values);
        else asort($this->values);
    }
    
    public function generaSerieDati()
    {
        /**
         * Esempio di serie di dati da dare in pasto a flotcharts.
         * {
         *   "label": "Europe (EU27)",
         *   "data": [[1999, 3.0], [2000, 3.9], [2001, 2.0], [2002, 1.2], [2003, 1.3], [2004, 2.5], [2005, 2.0], [2006, 3.1], [2007, 2.9], [2008, 0.9]]
         *   }
         **/
         $stringa .= "[";
         $valori = $this->values;
         $keys = array_keys($valori);
         $c = 0;
         while($c < sizeof($valori))
         {
             //[x, y],
            // $stringa.= "[\"".$keys[$c]."\", ".$valori[$keys[$c]]."]";
            $stringa.= "[\"".$keys[$c]."\", ".$valori[$keys[$c]]."]";
             if($c != sizeof($valori) - 1)
             {
                 $stringa .= ", ";
             }
             $c++;
         }
         $stringa .= "];\n";
        // $stringa .= "}";
         return $stringa;
         
    }
    
    
    
}

?>