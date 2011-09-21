<?php

class GcMailbox extends BaseGcMailbox
{
    public function getAreaName()
    {
        $this->getGcArea();
    }

    public function getDomainName() {
        $this->getGcTransport();
    }

    public function save(PropelPDO $con = null)
    {
        $this->setEmail($this->getUsername().'@'.$this->getGcTransport());
        if($this->isNew())
        {
            $this->setCreatedAt(time());
            if (!$this->getExpiresAt()) {
                $now = $this->getCreatedAt() ? $this->getCreatedAt('U') : time();
                $this->setExpiresAt($now + 86400 * sfConfig::get('app_active_days'));
            }

            //Asignando la kuota por defecto del grupo
            $this->setQuota($this->getGcGroup()->getQuota());

        
            //Si el correo es nacional agregarlo a la tabla postfixdb
            if($this->sfilter)
            {
                $aux = new GcFiltroSender();
                $aux->setEmail($this->getEmail());
                $aux->setRule('solo_cuba');
                $aux->save();
            }

            $this->setMaildir($this->getGcTransport().'/'.$this->getUsername().'/');
        }
               
        if(is_null($con))
        {
            $con = Propel::getConnection(GcMailboxPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $con->beginTransaction();
        try
        {
            $ret = parent::save($con);
            $this->updateLuceneIndex();
            $con->commit();
            return $ret;
        }
        catch (Exception $e)
        {
            $con->rollBack();
            throw $e;
        }
    }
    //Actualizar el indice del buscador
    public function updateLuceneIndex()
    {
        $index = GcMailboxPeer::getLuceneIndex();

        //borrar las entradas existentes
        if($hit = $index->find('pk:'.$this->getId())) {
            $index->delete($hit->id);
        }

        //no indexar buzones expirados


        $doc = new Zend_Search_Lucene_Document();

        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('pk', $this->getId()));

        $doc->addField(Zend_Search_Lucene_Field::unStored('username', $this->getUsername(), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::unStored('name', $this->getName(), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::unStored('email', $this->getEmail(), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::unStored('domain', $this->getDomainName(), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::unStored('area', $this->getGcArea(), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::unStored('group', $this->getGcGroup(), 'utf-8'));

        $index->addDocument($doc);
        $index->commit();

    }

    public function delete(PropelPDO $con = null) {
        $index = GcMailboxPeer::getLuceneIndex();

        if($hit = $index->find('pk:'.$this->getId())) {
            $index->delete($hit->id);
        }
        return parent::delete($con);
    }

  public function extend($force = false)
  {
    if (!$force && !$this->expiresSoon())
    {
      return false;
    }

    $this->setExpiresAt(time() + 86400 * sfConfig::get('app_active_days'));
    $this->save();

    return true;
  }

  public function isExpired()
  {
    return $this->getDaysBeforeExpires() < 0;
  }

  public function expiresSoon()
  {
    return $this->getDaysBeforeExpires() < 5;
  }

  public function getDaysBeforeExpires()
  {
    return floor(($this->getExpiresAt('U') - time()) / 86400);
  }

  public function getAreaSlug()
  {
      //return GesCorreo::slugify($this->getGcArea());
      return $this->getGcArea()->getSlug();
  }

  public function getGroupSlug()
  {
      //return GesCorreo::slugify($this->getGcGroup());
      return $this->getGcGroup()->getSlug();
  }

  public function setPasswd($passwd)
  {
    if (!$passwd && 0 == strlen($passwd))
    {
      return;
    }
    $passwd = crypt($passwd);

    parent::setPasswd($passwd);
  }


}
