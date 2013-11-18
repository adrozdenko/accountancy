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
class Account
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $balance = 0.0;

    /**
     * @var string
     */
    protected $currencyId;

    /**
     * @param mixed $balance
     *
     * @return $this
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param int $currencyId
     *
     * @return Account
     */
    public function setCurrencyId($currencyId)
    {
        $this->currencyId = (int) $currencyId;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrencyId()
    {
        return $this->currencyId;
    }

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

    /**
     * @param float $amount
     *
     * @return Account
     */
    public function increaseBalance($amount)
    {
        $this->balance += $amount;

        return $this;
    }

    /**
     * @param float $amount
     *
     * @return $this
     */
    public function decreaseBalance($amount)
    {
        $this->balance -= $amount;

        return $this;
    }
}
