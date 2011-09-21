<?php

class GcGroupPeer extends BaseGcGroupPeer
{
    static public $quotas = array(
        '20480'   => '20 Mb',
        '40960'   => '40 Mb',
        '81920'   => '80 Mb',
        '102400'  => '100 Mb',
    );

    static public function getWithMailboxs()
    {
      $criteria = new Criteria();
      $criteria->addJoin(self::ID, GcMailboxPeer::GROUP_ID);
      $criteria->add(GcMailboxPeer::EXPIRES_AT, time(), Criteria::GREATER_THAN);
      $criteria->setDistinct();

      return self::doSelect($criteria);
    }
}
