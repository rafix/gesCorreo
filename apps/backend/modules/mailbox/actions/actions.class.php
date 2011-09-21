<?php

require_once dirname(__FILE__).'/../lib/mailboxGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/mailboxGeneratorHelper.class.php';

/**
 * mailbox actions.
 *
 * @package    gescorreo
 * @subpackage mailbox
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class mailboxActions extends autoMailboxActions
{
  public function executeBatchExtend(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $criteria = new Criteria();
    $criteria->add('gc_mailbox.ID', $ids, Criteria::IN);

      foreach (GcMailboxPeer::doSelect($criteria) as $mailbox)
    {
      $mailbox->extend(true);
      $mailbox->save();
    }

    $this->getUser()->setFlash('notice', 'Los buzones seleccionados fueron extendidos exitosamente.');

    $this->redirect('@gc_mailbox');
  }

  public function executeBatchDisable(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $criteria = new Criteria();
    $criteria->add('gc_mailbox.ID', $ids, Criteria::IN);

      foreach (GcMailboxPeer::doSelect($criteria) as $mailbox)
    {
      $mailbox->setIsActive(false);
      $mailbox->save();
    }

    $this->getUser()->setFlash('notice', 'Los buzones seleccionados fueron desactivados exitosamente.');

    $this->redirect('@gc_mailbox');
  }

  public function executeBatchActivar(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $criteria = new Criteria();
    $criteria->add('gc_mailbox.ID', $ids, Criteria::IN);

      foreach (GcMailboxPeer::doSelect($criteria) as $mailbox)
    {
      $mailbox->setIsActive(true);
      $mailbox->save();
    }

    $this->getUser()->setFlash('notice', 'Los buzones seleccionados fueron activados exitosamente.');

    $this->redirect('@gc_mailbox');
  }

  public function executeListExtend(sfWebRequest $request)
  {
    $mailbox = $this->getRoute()->getObject();
    $mailbox->extend(true);
    $mailbox->save();

    $this->getUser()->setFlash('notice', 'El buzón seleccionado fue extendido con éxito.');

    $this->redirect('@gc_mailbox');
  }

  public function executeListDeleteNeverActivated(sfWebRequest $request)
  {
      $nb = GcMailboxPeer::cleanup(60);

    if ($nb)
    {
      $this->getUser()->setFlash('notice', sprintf('%d buzones inactivos fueron eliminados.', $nb));
    }
    else
    {
      $this->getUser()->setFlash('notice', 'No hay buzones expirados por eliminar.');
    }

    $this->redirect('@gc_mailbox');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $gc_mailbox = $form->save();

      $form->isNew() ? $this->getMailer()->send(new ProjectConfirmationMessage($gc_mailbox->getName(), $gc_mailbox->getEmail())):

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $gc_mailbox)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@gc_mailbox_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'gc_mailbox_edit', 'sf_subject' => $gc_mailbox));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
}
