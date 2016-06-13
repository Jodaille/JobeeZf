<?php
namespace Apiary\Repository;

use Doctrine\ORM\EntityRepository;

class SensorValueRepository extends EntityRepository
{

    public function getHiveVoltage($hivename)
    {
        $offset = 0;
        $limit = 200;
        $hiveRepository = $this->getEntityManager()
                                ->getRepository('Apiary\Entity\Hive');
        $sensorRepository = $this->getEntityManager()
                                ->getRepository('Apiary\Entity\Sensor');
        $hive = $hiveRepository->findOneByName($hivename);
        $sensor = $sensorRepository->findOneByName('byteVoltage');

        // byteVoltage
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select(array('sv'))
        ->from('Apiary\Entity\SensorValue', 'sv')
        ->Where('sv.hive = :hive')
        ->andWhere('sv.sensor = :sensor')
        ->setParameters(array(':hive' => $hive, ':sensor' => $sensor));


        //$qb->setFirstResult( $offset );
        //$qb->setMaxResults( $limit );

        $query = $qb->getQuery();
        $r = $query->getResult();
        //echo '<pre>';\Doctrine\Common\Util\Debug::dump($r);die();
        return $r ;
    }

    public function getHiveSensorValues($hivename)
    {
        $offset = 140;
        $limit = 200;
        $hiveRepository = $this->getEntityManager()
                                ->getRepository('Apiary\Entity\Hive');
        $sensorRepository = $this->getEntityManager()
                                ->getRepository('Apiary\Entity\Sensor');
        $hive = $hiveRepository->findOneByName($hivename);
        $sensor = $sensorRepository->findOneByName('byteVoltage');

        // byteVoltage
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select(array('sv'))
        ->from('Apiary\Entity\SensorValue', 'sv')
        ->Where('sv.hive = :hive')
        ->setParameters(array(':hive' => $hive));

        $qb->setFirstResult( $offset );
        //$qb->setMaxResults( $limit );

        $query = $qb->getQuery();
        $r = $query->getResult();
        //echo '<pre>';\Doctrine\Common\Util\Debug::dump($r);die();
        return $r ;
    }

}
