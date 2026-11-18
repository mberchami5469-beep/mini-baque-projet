<?php 
require_once "Compt.php";
class ComptPayant extends Compt{
    
   
    public function deposer($mantant)
    {
         parent::deposer($mantant);
         $this->solde -=5 ;
         return $this->solde;

    }
    
     public function retirer($mantant)
   
    {
         parent::retirer($mantant);
         $this->solde -= 5 ;
         return $this->solde;

    }

}






?>