<?php

/**
 * GcArea form.
 *
 * @package    gescorreo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class GcAreaForm extends BaseGcAreaForm
{
  public function configure()
  {
      $this->widgetSchema->setLabels(array(
          'area' => 'Área',
      ));
      unset (
          $this['slug']
      );
  }
}
