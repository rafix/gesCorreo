<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GcCleanupTask
 *
 * @author rafix
 */
class GcExtendMailboxTask extends sfBaseTask {
    protected function configure() {
        $this->addOptions(array(new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environement', 'prod'),
                new sfCommandOption('days', null, sfCommandOption::PARAMETER_REQUIRED, '', 365),));

        $this->namespace = 'gcorreo';
        $this->name      = 'extend';
        $this->briefDescription = 'Extiende el tiempo de expiración de los buzones de correo';

        $this->detailedDescription = <<<EOF
La Tarea [gcorreo:extend|INFO] extiende el tiempo de expiración de los correos:

[./symfony gcorreo:extend --env=prod --days=365|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
      $databaseManager = new sfDatabaseManager($this->configuration);

      $criteria = new Criteria();
      $criteria->add(GcMailboxPeer::EXPIRES_AT, time(), Criteria::LESS_THAN);
      $mailboxs = GcMailboxPeer::doSelect($criteria);
      foreach ($mailboxs as $gc_mailbox) {
        $gc_mailbox->setExpiresAt(time() + 86400 * $options['days']);
        
      }

      $this->logSection('propel', sprintf('Buzones extendidos correctamente'));
    }
}
?>
