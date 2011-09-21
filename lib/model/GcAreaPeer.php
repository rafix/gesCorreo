<?php

class GcAreaPeer extends BaseGcAreaPeer
{
    static public function getWithMailboxs()
    {
      $criteria = new Criteria();
      $criteria->addJoin(self::ID, GcMailboxPeer::AREA_ID);
      $criteria->add(GcMailboxPeer::EXPIRES_AT, time(), Criteria::GREATER_THAN);
      $criteria->setDistinct();

      return self::doSelect($criteria);
    }

}
