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
    protected $id;

    protected $name;

    protected $balance = 0.0;

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
        $this->currencyId = $currencyId;

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
        $this->id = $id;

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
        $this->name = $name;

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
     * @throws \InvalidArgumentException
     * @return Account
     */
    public function increaseBalance($amount)
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('$amount should be greater than zero');
        }

        $this->balance += $amount;

        return $this;
    }

    /**
     * @param float $amount
     *
     * @throws \LogicException
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function decreaseBalance($amount)
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('$amount should be greater tan zero');
        }

        if ($this->balance - $amount < 0) {
            throw new \LogicException('$amount should not be greater than the current balance') ;
        }

        $this->balance -= $amount;

        return $this;
    }
}
