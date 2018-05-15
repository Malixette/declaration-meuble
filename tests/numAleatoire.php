<?php>
//Numéro de cerfa

public function numeroCerfa() 
{
  $date = new \DateTime;
  $debutNum = $date->format('Ym');
  $insee = $this->getVilleAmdi();
  $id = $this->getId();
  $numCerfa= $insee . "/" . $date . "/" . $id;
  return $numCerfa;
}


public function generateCerfa()
{
  $numeroCerfa
}