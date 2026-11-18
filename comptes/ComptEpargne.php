<?php 
require_once "Compt.php";
class ComptEpargne extends Compt{
public static $tauxInteret = 6;
public function calcul(){
return $this->solde = $this->solde + ($this->solde * self::$tauxInteret / 100) ;
}


}






?>