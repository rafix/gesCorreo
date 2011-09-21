<?php

class GcTransportPeer extends BaseGcTransportPeer
{
     static public $delivers = array(
        'virtual:' => 'virtual',
        'local:'   => 'local',
        'smtp:'    => 'smtp',
    );

    static public $priority = array(
        '9'   => 'Alta',
        '5'   => 'Media',
        '1'   => 'Baja',
    );

    static public function getActiveDomains() {
        $criteria = new Criteria();
        $criteria->add(self::IS_ACTIVE, true, Criteria::EQUAL);

        return self::doSelect($criteria);
    }
}
