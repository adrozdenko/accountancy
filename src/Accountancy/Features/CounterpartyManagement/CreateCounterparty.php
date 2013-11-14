<?php

/**
 *
 */


namespace Accountancy\Features\CounterpartyManagement;

use Accountancy\Entity\User;
use Accountancy\Entity\Counterparty;
use Accountancy\Features\FeatureException;

/**
 * Class CreateCounterparty
 *
 * @package Accountancy\Features\AccountManagement
 */
class CreateCounterparty
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var String
     */
    protected $counterpartyName;

     /**
     * @param \Accountancy\Entity\User $user
     *
     * @return CreateCounterparty
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @param string $counterpartyName
     *
     * @return $this
     */
    public function setCounterpartyName($counterpartyName)
    {
        $this->counterpartyName = $counterpartyName;

        return $this;
    }

    /**
     * @throws \Accountancy\Features\FeatureException
     */
    public function run()
    {
        if (trim($this->counterpartyName) === "") {
            throw new FeatureException("Name of Counterparty can not be empty");
        }

        if ($this->user->findCounterpartyByName($this->counterpartyName) instanceof Counterparty) {
            throw new FeatureException(sprintf("Counterparty '%s' already exists", $this->counterpartyName));
        }

        $counterparty = new Counterparty;
        $counterparty->setName($this->counterpartyName);

        $this->user->addCounterparty($counterparty);
    }
}
