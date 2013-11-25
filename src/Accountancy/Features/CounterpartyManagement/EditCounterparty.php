<?php
/**
 *
 */

namespace Accountancy\Features\CounterpartyManagement;

use Accountancy\Features\FeatureException;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\CounterpartiesGatewayInterface;

/**
 * Class EditCategory
 *
 * @package Accountancy\Features\CounterpartyManagement
 */
class EditCounterparty implements FeatureInterface
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
        $counterparty = $this->counterparties->findCounterpartyById($input['id']);

        if (is_null($counterparty)) {
            throw new FeatureException("Counterparty doesn't exist");
        }

        if ($counterparty->getUserId() !== (int) $input['user_id']) {
            throw new FeatureException("Counterparty doesn't exist");
        }

        if (trim($input['name']) == '') {
            throw new FeatureException("Name of Counterparty can not be empty");
        }

        $counterparty->setName($input['name']);

        $this->counterparties->updateCounterparty($counterparty);

        return array();
    }
}
