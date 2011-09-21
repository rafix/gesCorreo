<?php
class ProjectBaseMessage extends Swift_Message
{
  public function __construct($asunto, $cuerpo, $emailTo)
  {
    $cuerpo .= <<<EOF
--

Email enviado por el Robot de gesCorreo
EOF
    ;
    parent::__construct($asunto, $cuerpo);

    // añadir todas las cabeceras comunes
    $this->setFrom(array('correo@upr.edu.cu' => 'Robot de gesCorreo'));
    $this->setTo($emailTo);
  }
}