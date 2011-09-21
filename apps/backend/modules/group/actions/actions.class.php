<?php

require_once dirname(__FILE__).'/../lib/groupGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/groupGeneratorHelper.class.php';

/**
 * group actions.
 *
 * @package    gescorreo
 * @subpackage group
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class groupActions extends autoGroupActions
{
  public function executeListEnviarCorreo(sfWebRequest $request)
  {


    $group = $this->getRoute()->getObject();
    //$mboxs = $domain->getActiveMailboxs();
    $this->getUser()->setAttribute('domain',$group) ;

    $this->forward('mail4all','index');


  }
}
