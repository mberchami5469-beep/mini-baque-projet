<?php
class Compt{
    protected $code;
    protected $solde;
    public static $nb=0;

    public function __construct($solde=Null) {
        $this->solde = $solde;
        $this->code=++static::$nb;
    }
    
public function getSold(){
    return $this->solde;
}
public function getCode(){
    return $this->code;
}
public function __toString()
{
return  $this->solde ."DH";
}
public function deposer($mantant){
    
     $this->solde += $mantant;
     return $this->solde;

}
  public function retirer($mantant){
   $this->solde -= $mantant;
 return $this->solde;
}  
}



?>