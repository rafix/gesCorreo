<?php

class GcGroup extends BaseGcGroup
{
    public function __toString() {
        return $this->getGroup();
    }

    public function setGroup($name)
    {
        parent::setGroup($name);

        $this->setSlug(GesCorreo::slugify($name));
    }

    public function getActiveMailboxs()
    {
      $criteria = $this->getActiveMailboxsCriteria();
      //$criteria->setLimit($max);

      return GcMailboxPeer::doSelect($criteria);
    }

    public function getSlug()
    {
      return GesCorreo::slugify($this->getGroup());
    }

    public function countActiveMailboxs()
  {
    $criteria = $this->getActiveMailboxsCriteria();
    
      return GcMailboxPeer::doCount($criteria);
  }

  public function getActiveMailboxsCriteria()
  {
    $criteria = new Criteria();
    $criteria->add(GcMailboxPeer::GROUP_ID, $this->getId());

    return GcMailboxPeer::addActiveMailboxsCriteria($criteria);
  }

}
