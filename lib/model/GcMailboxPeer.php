<?php

class GcMailboxPeer extends BaseGcMailboxPeer
{
    static public function getActiveMailboxs(Criteria $criteria = null)
    {
      return self::doSelect(self::addActiveMailboxsCriteria($criteria));
    }

    static public function countActiveMailboxs(Criteria $criteria = null)
    {
      return self::doCount(self::addActiveMailboxsCriteria($criteria));
    }


    static public function getExpiredMailboxs() {
        $criteria = new Criteria();
        $criteria->add(self::EXPIRES_AT, time(), Criteria::LESS_THAN);

        return self::doSelect($criteria);
    }

    static public function getPendingMailboxs() {
        $criteria = new Criteria();
        $criteria->add(self::IS_ACTIVE, false, Criteria::EQUAL);

        return self::doSelect($criteria);
    }

    static public function getLuceneIndex() {
        ProjectConfiguration::registerZend();

        if (file_exists($index = self::getLuceneIndexFile())) {
            return Zend_Search_Lucene::open($index);
        }
        else {
            return Zend_Search_Lucene::create($index);
        }
    }

    static public function getLuceneIndexFile() {
        return sfConfig::get('sf_data_dir').'/mailbox.'.sfConfig::get('sf_environment').'index';
    }

    static public function doDeleteAll(PropelPDO $con = null) {
        if(file_exists($index = self::getLuceneIndexFile())) {
            sfToolkit::clearDirectory($index);
            rmdir($index);
        }

        return parent::doDeleteAll($con);
    }

    static public function getForLuceneQuery($query)
    {
      $hits = self::getLuceneIndex()->find($query);

      $pks = array();
      foreach ($hits as $hit) {
        $pks[] = $hit->pk;
      }

      $criteria = new Criteria();
      $criteria->add(self::ID, $pks, Criteria::IN);
      $criteria->setLimit(20);
      
      return self::doSelect(self::addActiveMailboxsCriteria($criteria));
    }

    static public function cleanup($days)
    {
      $criteria = new Criteria();
      $criteria->add(self::IS_ACTIVE, false);
      $criteria->add(self::CREATED_AT, time() - 86400 * $days, Criteria::LESS_THAN);

      return self::doDelete($criteria);
    }

    static public function doSelectActive(Criteria $criteria)
    {
      return self::doSelectOne(self::addActiveMailboxsCriteria($criteria));
    }

    static public function addActiveMailboxsCriteria(Criteria $criteria = null)
    {
      if (is_null($criteria))
      {
        $criteria = new Criteria();
      }

    //Los q no han expirado
    $criteria->add(self::EXPIRES_AT, time(), Criteria::GREATER_THAN);
    //Solo los que estén activos
    $criteria->add(self::IS_ACTIVE, true, Criteria::EQUAL);
    $criteria->addDescendingOrderByColumn(self::CREATED_AT);

    return $criteria;
  }

//  static public function sendMail(Criteria $criteria = null)
//  {
//
//
//  }


}
