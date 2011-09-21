<?php

require_once dirname(__FILE__).'/../lib/transportGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/transportGeneratorHelper.class.php';

/**
 * transport actions.
 *
 * @package    gescorreo
 * @subpackage transport
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class transportActions extends autoTransportActions
{
	/*public function executeBatchEnviarCorreo($sfWebRequest $request)
	{
	  $ids = $request->getParameter('ids');
	  $domains = GcTransportPeer::retriveByPks('$ids');
  	foreach ($domains as $domain)
  	{
  	  $domain->enviarCorreo();
  	}
	}*/
  public function executeListEnviarCorreo(sfWebRequest $request)
  {


    $domain = $this->getRoute()->getObject();
    //$mboxs = $domain->getActiveMailboxs();
    $this->getUser()->setAttribute('domain',$domain) ;
    
    $this->forward('mail4all','index');
    
    
  }

//  public function executeSend(sfWebRequest $request)
//  {
//    //$this->getMailer()->composeAndSend('correo@upr.edu.cu', $email, $request->getParameter('asunto'), $request->getParameter('cuerpo'));
//
//  }
}
