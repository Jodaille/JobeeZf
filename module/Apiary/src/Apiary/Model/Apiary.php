<?php

namespace Apiary\Model;

class Apiary
{
    protected $servicelocator;
    protected $em;

    public function setServiceLocator(\Zend\ServiceManager\ServiceManager $serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->servicelocator;
    }

    public function getHiveTemperatures($hivename)
    {
        $valuesRepository = $this->getEntityManager()
                                ->getRepository('Apiary\Entity\SensorValue');
        $values = $valuesRepository->getHiveSensorValues($hivename);
        $aDatas = [];
        foreach($values as $v)
        {
            if($v->getSensor()->getName() == 'topbartemperature')
                $sensorName = 't1';
            if($v->getSensor()->getName() == 'entrytemperature')
                $sensorName = 't2';

            $t = $v->getRecordedAt()->getTimestamp();
            $aDatas[$t][$sensorName] = $v->getValue();
            $aDatas[$t]['h']         = $v->getRecordedAt()->format('Y-m-d H:i:s');
        }
        //echo '<pre>';\Doctrine\Common\Util\Debug::dump($aDatas);die();
        return $aDatas;
    }

    public function getHiveSensorsValues($hivename)
    {
        $voltages          = [];
        $topbartemperature = [];
        $topbarhumidity    = [];
        $valuesRepository = $this->getEntityManager()
                                ->getRepository('Apiary\Entity\SensorValue');
        $values = $valuesRepository->getHiveSensorValues($hivename);
        foreach($values as $v)
        {
            $data = ['v'  => $v->getValue(),
                            't' => $v->getRecordedAt()->getTimestamp(),
                            'h' => $v->getRecordedAt()->format('Y-m-d H:i:s'),
                            'sensor' => $v->getSensor()->getName()
                            ];
            if($v->getSensor()->getName() == 'byteVoltage')
            {
                $voltages[] = $data;
            }
            if($v->getSensor()->getName() == 'topbartemperature')
            {
                $topbartemperature[] = $data;
            }
            if($v->getSensor()->getName() == 'topbarhumidity')
            {
                $topbarhumidity[] = $data;
            }
        }
        //echo '<pre>';\Doctrine\Common\Util\Debug::dump($voltages);die();
        return ['voltages' => $voltages,
                'topbartemperature' => $topbartemperature,
                'topbarhumidity' => $topbarhumidity];
    }

    public function getHiveVoltage($hivename)
    {
        $voltages = [];
        $valuesRepository = $this->getEntityManager()
                                ->getRepository('Apiary\Entity\SensorValue');
        $values = $valuesRepository->getHiveVoltage($hivename);
        foreach($values as $v)
        {
            $voltages[] = ['v'  => $v->getValue(),
                            't' => $v->getRecordedAt()->getTimestamp(),
                            'h' => $v->getRecordedAt()->format('Y-m-d H:i:s')
                            ];
        }
        //echo '<pre>';\Doctrine\Common\Util\Debug::dump($voltages);die();
        return $voltages;
    }

    public function getTitle()
    {
        $config = $this->getServiceLocator()->get('Config');

        return 'Hello world !';
    }

    public function getEntityManager()
    {
        if (null === $this->em)
        {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

}
