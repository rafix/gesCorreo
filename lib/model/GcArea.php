<?php

class GcArea extends BaseGcArea
{
    public function __toString() {
        return $this->getArea();
    }

    public function setArea($name)
  {
  parent::setArea($name);

  $this->setSlug(GesCorreo::slugify($name));
  }

  public function getSlug()
  {
    return GesCorreo::slugify($this->getArea());
  }

  public function getActiveMailboxs($max = 10)
  {
    $criteria = $this->getActiveMailboxsCriteria();
    $criteria->setLimit($max);

    return GcMailboxPeer::doSelect($criteria);
  }

  public function countActiveMailboxs()
  {
    $criteria = $this->getActiveMailboxsCriteria();

    return GcMailboxPeer::doCount($criteria);
  }

  public function getActiveMailboxsCriteria()
  {
    $criteria = new Criteria();
    $criteria->add(GcMailboxPeer::AREA_ID, $this->getId());

    return GcMailboxPeer::addActiveMailboxsCriteria($criteria);
  }

}
