<?php
class Mail4allForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      //'para'    => new sfWidgetFormSelect(array('choices' => GcTransportPeer::getActiveDomains())),
      'asunto'  => new sfWidgetFormInput(),
      'cuerpo'  => new sfWidgetFormTextArea(),
      ));
  }
}