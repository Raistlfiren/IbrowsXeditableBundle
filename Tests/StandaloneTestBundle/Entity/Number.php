<?php

namespace Ibrows\XeditableBundle\Tests\StandaloneTestBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Number
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $number;

    /**
     * @var \Person
     * @Assert\NotBlank()
     */
    private $person;

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
     * Set number
     *
     * @param string $number
     * @return Number
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

}