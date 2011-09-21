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
class GcCleanupTask extends sfBaseTask {
    protected function configure() {
        $this->addOptions(array(new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environement', 'prod'),
                new sfCommandOption('days', null, sfCommandOption::PARAMETER_REQUIRED, '', 90),));

        $this->namespace = 'gcorreo';
        $this->name      = 'cleanup';
        $this->briefDescription = 'Limpia el indice de busqueda y base de datos de gesCorreo';

        $this->detailedDescription = <<<EOF
La Tarea [gcorreo:cleanup|INFO] limpia el indice y base de datos de gesCorreo:

[./symfony gcorreo:cleanup --env=prod --days=90|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
      $databaseManager = new sfDatabaseManager($this->configuration);

      //cleanup Lucene index
      $index = GcMailboxPeer::getLuceneIndex();

      $criteria = new Criteria();
      $criteria->add(GcMailboxPeer::EXPIRES_AT, time(), Criteria::LESS_THAN);
      $mailboxs = GcMailboxPeer::doSelect($criteria);
      foreach ($mailboxs as $gc_mailbox) {
        if ($hit = $index->find('pk:'.$gc_mailbox->getId())) {
          $hit->delete();
        }
      }

      $index->optimize();

      $this->logSection('lucene', 'Cleaned up and optimized the mailbox index');

      //Remove stale mailboxs
      $nb = GcMailboxPeer::cleanup($options['days']);

      $this->logSection('propel', sprintf('Removed %d stale mailboxs', $nb));
    }
}
?>
