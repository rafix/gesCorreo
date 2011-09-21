<?php

/**
 * Mailbox filter form base class.
 *
 * @package    gescorreo
 * @subpackage filter
 * @author     Rafael Ernesto Ferro González <rafix@upr.edu.cu>
 */
abstract class BaseMailboxFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'crypt'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'quota'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'domain'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'expire'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'active'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'imapok'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'view'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_area'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'check'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'     => new sfValidatorPass(array('required' => false)),
      'crypt'    => new sfValidatorPass(array('required' => false)),
      'quota'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'domain'   => new sfValidatorPass(array('required' => false)),
      'expire'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'active'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'imapok'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'view'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_area'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'check'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('mailbox_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mailbox';
  }

  public function getFields()
  {
    return array(
      'username' => 'Text',
      'name'     => 'Text',
      'crypt'    => 'Text',
      'quota'    => 'Number',
      'domain'   => 'Text',
      'expire'   => 'Date',
      'active'   => 'Number',
      'imapok'   => 'Number',
      'view'     => 'Number',
      'id_area'  => 'Number',
      'check'    => 'Number',
    );
  }
}
