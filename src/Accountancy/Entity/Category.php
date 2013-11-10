<?php
/**
 *
 */

namespace Accountancy\Entity;

/**
 * Class Account
 *
 * @package Accountancy\Entity
 */
class Category
{
    protected $id;

    protected $name;

    /**
     * @param int $id
     *
     * @return Account
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
     * @return Account
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
