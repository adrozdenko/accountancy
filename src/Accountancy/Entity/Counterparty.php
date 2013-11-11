<?php
/**
 *
 */

namespace Accountancy\Entity;

/**
 * Class Counterparty
 *
 * @package Accountancy\Entity
 */
class Counterparty
{
    protected $id;

    protected $name;

    /**
     * @param int $id
     *
     * @return Counterparty
     */
    public function setId($id)
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     *
     * @throws \InvalidArgumentException
     * @return Counterparty
     */
    public function setName($name)
    {
        if (trim($name) === '') {
            throw new \InvalidArgumentException('$name cant be empty');
        }

        $this->name = (string) $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
