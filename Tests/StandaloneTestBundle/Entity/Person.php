<?php

namespace Ibrows\XeditableBundle\Tests\StandaloneTestBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Person
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $firstname;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $lastname;

    /**
     * @var \Numbers
     * @Assert\NotBlank()
     */
    private $numbers;

    /**
     * Set id
     *
     * @param string $id
     * @return Person
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set lastname
     *
     * @param string $lastname
     * @return Person
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Person
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

}