<?php

namespace Application\Model;

class ReadFile
{
    protected $servicelocator;
    protected $em;
    protected $_aAllowedIds = array('ruche1', 'rucheBas');


    public function setServiceLocator(\Zend\ServiceManager\ServiceManager $serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->servicelocator;
    }

    public function getEntityManager()
    {
        if (null === $this->em)
        {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function getApiary($apiaryname)
    {
        $apiaryRepository = $this->getEntityManager()
                                ->getRepository('Application\Entity\Apiary');
        $apiary = $apiaryRepository->findOneByName($apiaryname);
        return $apiary;
    }

    public function getHive($hivename)
    {
        $hiveRepository = $this->getEntityManager()
                                ->getRepository('Application\Entity\Hive');
        $hive = $hiveRepository->findOneByName($hivename);
        return $hive;
    }

    public function addHive($hivename)
    {
        $hive = $this->getHive($hivename);
        if(!$hive)
        {
            $hive = new \Application\Entity\Hive;
            $hive->setName($hivename);
            $this->getEntityManager()->persist($hive);
            $this->getEntityManager()->flush();
        }
        return $hive;
    }

    public function addApiary($apiaryname)
    {
        $apiary = $this->getApiary($apiaryname);
        if(!$apiary)
        {
            $apiary = new \Application\Entity\Apiary;
            $apiary->setName($apiaryname);
            $this->getEntityManager()->persist($apiary);
            $this->getEntityManager()->flush();
        }
        return $apiary;
    }

    public function getSensor($sensorname)
    {
        $sensorRepository = $this->getEntityManager()
                                ->getRepository('Application\Entity\Sensor');
        $sensor = $sensorRepository->findOneByName($sensorname);
        if(!$sensor)
        {
            $sensor = new \Application\Entity\Sensor;
            $sensor->setName($sensorname);
            $this->getEntityManager()->persist($sensor);
            $this->getEntityManager()->flush();
        }
        return $sensor;
    }

    public function getTopBarTemperatureSensor()
    {
        return $this->getSensor('topbartemperature');
    }

    public function getVoltageInByteSensor()
    {
        return $this->getSensor('byteVoltage');
    }

    public function addTopBarTemperature($hive, $temperature, $recordTime)
    {
        $sensor = $this->getTopBarTemperatureSensor();
        $value = new \Application\Entity\SensorValue;
        $value->setHive($hive);
        $value->setSensor($sensor);
        $value->setValue($temperature);
        $value->setRecordedAt($recordTime);
        $this->getEntityManager()->persist($value);
        $this->getEntityManager()->flush();
        return $value;
    }

    public function addVoltageInByte($hive, $voltage, $recordTime)
    {
        $sensor = $this->getVoltageInByteSensor();
        $value = new \Application\Entity\SensorValue;
        $value->setHive($hive);
        $value->setSensor($sensor);
        $value->setValue($voltage);
        $value->setRecordedAt($recordTime);
        $this->getEntityManager()->persist($value);
        $this->getEntityManager()->flush();
        return $value;
    }

    public function getDateTime($date, $hour)
    {
        $format = 'Y-m-d H:i:s';
        $datetime = \DateTime::createFromFormat($format, "$date $hour");
        return $datetime;
    }

    public function parseLog($filename, $directory = null)
    {
        $apiaryname = 'LyceeDesAndaines';
        $this->addApiary($apiaryname);
        $apiary = $this->getApiary('LyceeDesAndaines');

        $aDatas = array();
        $iNb = 0;
        $file = fopen($filename, 'r');

        if($file)
        {
            while(($row = fgetcsv($file,0,' ')) !== false)
            {
                $date    = $row[0];
                $hour    = $row[1];
                $id_hive = $row[2];
                $recordTime = $this->getDateTime($date, $hour);

                if(($iNb % 10) == 0)
                {
                    $this->getEntityManager()->flush();
                    $this->getEntityManager()->clear();
                }


                if(in_array($id_hive, $this->_aAllowedIds))
                {
                    $hive = $this->addHive($id_hive);

                    $temperature = $this->_getTopBarTemperature($id_hive , $row);
                    $this->addTopBarTemperature($hive, $temperature, $recordTime);
                    $voltage     = $this->_getVoltage($id_hive , $row);
                    if($voltage)
                    {
                        $this->addVoltageInByte($hive, $voltage, $recordTime);
                    }
                    echo "$date  $hour $id_hive $temperature $voltage\n";
                }
                else
                {
                    echo "SKIPPING $date  $hour $id_hive\n";
                }

                $iNb++;
            }
        }
        return $aDatas;
    }

    private function _getVoltage($id_hive , $row)
    {
        $voltage = null;
        if($id_hive == 'rucheBas')
        {
            $voltage = $row[9];
            // $voltage = (55U * 1023U) / (ADC + 1) - 50;
            // $voltage + 50 = (55U * 1023U) / (ADC + 1);
            //var_dump($row);die("  $id_hive $voltage");
        }
        return $voltage;
    }

    private function _getTopBarTemperature($id_hive , $row)
    {
        $temperature = null;
        if($id_hive == 'ruche1')
        {
            $temperature = $row[4];
        }
        if($id_hive == 'rucheBas')
        {
            $temperature = $row[4];
            //var_dump($row);die("  $id_hive $temperature");
        }
        return $temperature;
    }

}
