<?php

/**
 *
 */


namespace Accountancy\Features\CounterpartyManagement;

use Accountancy\Entity\Counterparty;
use Accountancy\Features\FeatureException;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\CounterpartiesGatewayInterface;

/**
 * Class CreateCounterparty
 *
 * @package Accountancy\Features\AccountManagement
 */
class CreateCounterparty implements FeatureInterface
{
    /**
     * @var CounterpartiesGatewayInterface
     */
    protected $counterparties;

    /**
     * @param \Accountancy\Gateway\CounterpartiesGatewayInterface $counterparties
     *
     * @return $this
     */
    public function setCounterparties(CounterpartiesGatewayInterface $counterparties)
    {
        $this->counterparties = $counterparties;

        return $this;
    }

    /**
     * @param Array $input
     *
     * @return Array
     * @throws \Accountancy\Features\FeatureException
     */
    public function run(Array $input)
    {
        if (trim($input['name']) === "") {
            throw new FeatureException("Name of Counterparty can not be empty");
        }

        if ($this->counterparties->findCounterpartyByUserIdAndName($input['user_id'], $input['name']) instanceof Counterparty) {
            throw new FeatureException(sprintf("Counterparty '%s' already exists", $input['name']));
        }

        $counterparty = new Counterparty;
        $counterparty->setName($input['name']);
        $counterparty->setUserId($input['user_id']);

        $this->counterparties->addCounterparty($counterparty);

        return array();
    }
}
