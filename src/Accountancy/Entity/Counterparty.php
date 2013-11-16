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
     * @return Counterparty
     */
    public function setName($name)
    {
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
