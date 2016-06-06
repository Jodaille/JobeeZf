<?php

namespace Application\Model;

class ReadFile
{
    protected $servicelocator;
    protected $_aAllowedIds = array('ruche1', 'rucheBas');


    public function setServiceLocator(\Zend\ServiceManager\ServiceManager $serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->servicelocator;
    }

    public function parseLog($filename, $directory = null)
    {
        $aDatas = array();
        $iNb = 0;
        $file = fopen($filename, 'r');
        //$toremove = array('brands/', '.svg');

        if($file)
        {
            while(($row = fgetcsv($file,0,' ')) !== false)
            {
                $date    = $row[0];
                $hour    = $row[1];
                $id_hive = $row[2];
                if(in_array($id_hive, $this->_aAllowedIds))
                {
                    $temperature = $this->_getTopBarTemperature($id_hive , $row);
                    $voltage     = $this->_getVoltage($id_hive , $row);
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
