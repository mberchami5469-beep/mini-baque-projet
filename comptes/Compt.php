<?php
class Compt{
    protected $code;
    protected $solde;
    public static $nb=0;

    public function __construct($solde=0) {
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
    
    if ($mantant <= 0) {
            return false;
        }
        $this->solde += $mantant;
        return true;

}
  public function retirer($mantant){
    if ($mantant <= 0 || $mantant > $this->solde) {
            return false;
        }
        $this->solde -= $mantant;
        return true;
}  
}



?>