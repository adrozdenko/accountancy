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
 * Class DeleteCounterparty
 *
 * @package Accountancy\Features\CounterpartyManagement
 */
class DeleteCounterparty implements FeatureInterface
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
     * @throws \Accountancy\Features\FeatureException
     * @return Array
     */
    public function run(Array $input)
    {
        $counterparty = $this->counterparties->findCounterpartyById($input['id']);

        if (!$counterparty instanceof Counterparty) {
            throw new FeatureException("Counterparty doesn't exit");
        }

        if ($counterparty->getUserId() !== (int) $input['user_id']) {
            throw new FeatureException("Counterparty doesn't exit");
        }

        $this->counterparties->deleteCounterparty($input['id']);

        return array();
    }
}
