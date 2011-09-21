<?php

class GcTransport extends BaseGcTransport
{
  public function __toString()
  {
    return $this->getDomain();
  }

  public function getActiveMailboxsCriteria()
  {
    $criteria = new Criteria();
    $criteria->add(GcMailboxPeer::TRANSPORT_ID, $this->getId());

    return GcMailboxPeer::addActiveMailboxsCriteria($criteria);

  }
  
  public function getActiveMailBoxs() 
  {
    $criteria = $this->getActiveMailboxsCriteria();
    
    return GcMailboxPeer::getActiveMailboxs($criteria);
    
  }

}
