<?php

/**
 * GcMailbox form.
 *
 * @package    gescorreo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class GcMailboxForm extends BaseGcMailboxForm
{
  public function configure()
  {

      $this->widgetSchema->setLabels(array(
          'area_id'  => 'Área',
          'group_id' => 'Grupo',
          'transport_id' => 'Dominio',
          'email'    => 'Cuenta de correo',
          'username' => 'Usuario',
          'passwd'   => 'Clave',
          'name'     => 'Nombre',
          'quota'    => 'Cuota',
          'custom_mailfilter' => 'Filtros de correo',
          'postfix'  => 'Postfix',
          'access'   => 'Acceso',
          'disableimap' => 'Desactivar IMAP',
          'disablepop'  => 'Desactivar POP',
          'expires_at'  => 'Fecha de expiración',
          'is_active'   => 'Activo',
          'sfilter'     => 'Nacional',
      ));
  $this->validatorSchema['username'] = new sfValidatorAnd(array(
          new sfValidatorString(array('min_length' => 2)),
          new sfValidatorRegex(array('pattern' => '/^([a-z0-9_]+)$/i')),
      ));

  //Personalizacion de widgets
       $this->widgetSchema['passwd'] = new sfWidgetFormInputPassword();
       $this->validatorSchema['passwd']->setOption('required', false);
       $this->widgetSchema['passwd_again'] = new sfWidgetFormInputPassword();
       $this->validatorSchema['passwd_again'] = clone $this->validatorSchema['passwd'];

       $this->widgetSchema->moveField('passwd_again', 'after', 'passwd');


      //Personalizacion de validadores
        $this->mergePostValidator(new sfValidatorSchemaCompare(
           'passwd', sfValidatorSchemaCompare::EQUAL,'passwd_again',
    array(), array(
                'invalid' => 'Las dos contraseñas deben ser iguales.'
            )
         ));


       unset (
           $this['created_at'], $this['email'], $this['autoreply'], 
           $this['autoreply_text'], $this['uid'], $this['gid'], $this['custom_mailfilter'],
           $this['homedir'], $this['maildir'], $this['postfix'], $this['access'],
           $this['disableimap'], $this['disablepop3'], $this['quota']
       );

  }
}
