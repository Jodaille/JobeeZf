<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

/**
 * SensorValue
 *
 * @ORM\Table(name="sensors_values")
 * @ORM\Entity(repositoryClass="Application\Repository\SensorValueRepository")
 * @ORM\HasLifecycleCallbacks
 */
class SensorValue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float", nullable=true)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Sensor")
     */
    private $sensor;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Hive")
     */
    private $hive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="recorded_at", type="datetime", nullable=false)
     */
    private $recorded_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $created_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updated_at;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set value
     *
     * @param float $value
     * @return SensorValue
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set sensor
     *
     * @param \Application\Entity\Sensor $sensor
     *
     * @return SensorValue
     */
    public function setSensor(\Application\Entity\Sensor $sensor = null)
    {
        $this->sensor = $sensor;
        return $this;
    }
    /**
     * Get sensor
     *
     * @return \Application\Entity\Sensor
     */
    public function getSensor()
    {
        return $this->sensor;
    }

    /**
     * Set hive
     *
     * @param \Application\Entity\Hive $hive
     *
     * @return SensorValue
     */
    public function setHive(\Application\Entity\Hive $hive = null)
    {
        $this->hive = $hive;
        return $this;
    }
    /**
     * Get hive
     *
     * @return \Application\Entity\Hive
     */
    public function getHive()
    {
        return $this->hive;
    }

    public function setRecordedAt($recorded_at)
    {
        $this->recorded_at = $recorded_at;
        return $this;
    }

    public function getRecordedAt($recorded_at)
    {
        return $this->recorded_at;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->created_at = new \DateTime("now");
        $this->updated_at = new \DateTime("now");
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updated_at = new \DateTime("now");
    }
}
