<?php

/**
 * GcFiltroSender form.
 *
 * @package    gescorreo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class GcFiltroSenderForm extends BaseGcFiltroSenderForm
{
  public function configure()
  {
      $this->widgetSchema['rule'] = new sfWidgetFormChoice(array(
          'choices' => GcFiltroSenderPeer::$sfilters,
          'expanded' => false,
      ));

      $this->validatorSchema['rule'] = new sfValidatorChoice(array(
      'choices' => array_keys(GcFiltroSenderPeer::$sfilters),
      ));
  }
}
