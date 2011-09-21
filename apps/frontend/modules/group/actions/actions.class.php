<?php

/**
 * group actions.
 *
 * @package    gescorreo
 * @subpackage group
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class groupActions extends sfActions
{

  public function executeShow(sfWebRequest $request)
  {
    $this->group = $this->getRoute()->getObject();

    $this->pager = new sfPropelPager(
    'GcMailbox',
    10
    );
    $this->pager->setCriteria($this->group->getActiveMailboxsCriteria());
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();

  }

}
