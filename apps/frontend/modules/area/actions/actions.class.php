<?php

/**
 * area actions.
 *
 * @package    gescorreo
 * @subpackage area
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class areaActions extends sfActions
{

  public function executeShow(sfWebRequest $request)
  {
    $this->area = $this->getRoute()->getObject();

    $this->pager = new sfPropelPager(
    'GcMailbox', 10 );
    $this->pager->setCriteria($this->area->getActiveMailboxsCriteria());
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }

}
