<?php

/**
 * GcGroup form.
 *
 * @package    gescorreo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class GcGroupForm extends BaseGcGroupForm
{
  public function configure()
  {
      $this->widgetSchema['quota'] = new sfWidgetFormChoice(array(
          'choices' => GcGroupPeer::$quotas,
          'expanded' => false,
      ));
  $this->validatorSchema['quota'] = new sfValidatorChoice(array(
  'choices' => array_keys(GcGroupPeer::$quotas),
  ));
     unset (
          $this['slug']
      );
  }
}
