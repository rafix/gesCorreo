<?php
class ProjectConfirmationMessage extends ProjectBaseMessage
{
  public function __construct($usuario, $email)
  {
    parent::__construct('Confirmación para '.$usuario, 'Cuerpo', $email);

    // cabeceras específicas, adjuntos, ...
    //$this->attach('...');
    
    
  }
}
