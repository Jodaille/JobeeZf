<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class SensorValueRepository extends EntityRepository
{

    public function getHiveVoltage($hivename)
    {
        $offset = 20000;
        $limit = 20000;
        $hiveRepository = $this->getEntityManager()
                                ->getRepository('Application\Entity\Hive');
        $sensorRepository = $this->getEntityManager()
                                ->getRepository('Application\Entity\Sensor');
        $hive = $hiveRepository->findOneByName($hivename);
        $sensor = $sensorRepository->findOneByName('byteVoltage');

        // byteVoltage
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select(array('sv'))
        ->from('Application\Entity\SensorValue', 'sv')
        ->Where('sv.hive = :hive')
        ->andWhere('sv.sensor = :sensor')
        ->setParameters(array(':hive' => $hive, ':sensor' => $sensor));

        $qb->setFirstResult( $offset );
        $qb->setMaxResults( $limit );

        $query = $qb->getQuery();
        $r = $query->getResult();
        //echo '<pre>';\Doctrine\Common\Util\Debug::dump($r);die();
        return $r ;
    }

    public function getHiveSensorValues($hivename)
    {
        $offset = 10000;
        $limit = 2000;
        $hiveRepository = $this->getEntityManager()
                                ->getRepository('Application\Entity\Hive');
        $sensorRepository = $this->getEntityManager()
                                ->getRepository('Application\Entity\Sensor');
        $hive = $hiveRepository->findOneByName($hivename);
        $sensor = $sensorRepository->findOneByName('byteVoltage');

        // byteVoltage
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select(array('sv'))
        ->from('Application\Entity\SensorValue', 'sv')
        ->Where('sv.hive = :hive')
        ->setParameters(array(':hive' => $hive));

        $qb->setFirstResult( $offset );
        $qb->setMaxResults( $limit );

        $query = $qb->getQuery();
        $r = $query->getResult();
        //echo '<pre>';\Doctrine\Common\Util\Debug::dump($r);die();
        return $r ;
    }

}
