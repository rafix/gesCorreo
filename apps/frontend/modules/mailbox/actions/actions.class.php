<?php

/**
 * mailbox actions.
 *
 * @package    gescorreo
 * @subpackage mailbox
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class mailboxActions extends sfActions
{
  public function executeSearch(sfWebRequest $request)
  {
    if(!$query = $request->getParameter('query'))
    {
        return $this->forward('mailbox', 'index');
    }
        
    $this->gc_mailbox_list = GcMailboxPeer::getForLuceneQuery($query);

    if ($request->isXmlHttpRequest())
    {
      if('*' == $query || !$this->gc_mailbox_list)
      {
        return $this->renderText('No hay resultados.');
      }
      else
      {
        return $this->renderPartial('mailbox/list', array('gc_mailbox_list' => $this->gc_mailbox_list));
      }
      
    }

  }

  public function executeIndex(sfWebRequest $request)
  {
      $this->gc_mailbox_list = GcMailboxPeer::getActiveMailboxs();

      $this->pager = new sfPropelPager(
    'GcMailbox',
    10
    );
    $this->pager->setCriteria(GcMailboxPeer::addActiveMailboxsCriteria());
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();


  }

  public function executeShow(sfWebRequest $request)
  {
    $this->gc_mailbox = $this->getRoute()->getObject();
  }

}
