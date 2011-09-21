<?php

/**
 * GcTransport form.
 *
 * @package    gescorreo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class GcTransportForm extends BaseGcTransportForm
{
  public function configure()
  {
      $this->widgetSchema['deliver'] = new sfWidgetFormChoice(array(
          'choices' => GcTransportPeer::$delivers,
          'expanded' => true,
      ));
  $this->validatorSchema['deliver'] = new sfValidatorChoice(array(
  'choices' => array_keys(GcTransportPeer::$delivers),
  ));

    $this->widgetSchema['sort_order'] = new sfWidgetFormChoice(array(
          'choices' => GcTransportPeer::$priority,
          'expanded' => true,
      ));
  $this->validatorSchema['sort_order'] = new sfValidatorChoice(array(
  'choices' => array_keys(GcTransportPeer::$priority),
  ));

  $this->widgetSchema->setLabels(array(
      'domain'  => 'Dominio',
      'deliver' => 'Entrega',
      'is_active' => 'Está activo?',
      'sort_order' => 'Prioridad',
  ));
    $this->validatorSchema['domain'] = new sfValidatorAnd(array(
        new sfValidatorString(),
        new sfValidatorRegex(array('pattern' => '/^([[:lower:]]+(\.upr\.edu\.cu))$/i')),
));
  }
}
