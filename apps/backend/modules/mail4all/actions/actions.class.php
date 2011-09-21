<?php

/**
 * mail4all actions.
 *
 * @package    symfony
 * @subpackage mail4all
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mail4allActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    
    $this->form = new Mail4allForm();

    
  }

  public function executeSubmit(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
//    $this->forward404Unless($request->isMethod('post'));
//
    $mboxs = $this->getUser()->getAttribute('domain')->getActiveMailboxs();
    
    foreach ( $mboxs as $mbox) 
    {

      $to[] = $mbox->getEmail();
    
    }

    //$this->getMailer()->composeAndSend('correo@upr.edu.cu', $to, $request->getParameter('asunto'), $request->getParameter('cuerpo'));
    
    $mensaje = Swift_Message::newInstance()
	->setFrom('no-reply@upr.edu.cu')
	->setBcc($to)
	->setSubject($request->getParameter('asunto'))
	->setBody($request->getParameter('cuerpo'));

    $this->getMailer()->send($mensaje);
    //
    $this->getUser()->getAttributeHolder()->remove('domain');
    $this->getUser()->setFlash('notice', 'El correo fue enviado satisfactoriamente');
    $this->redirect('@gc_mailbox');
  }
}
