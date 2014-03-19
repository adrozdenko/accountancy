<?php
/**
 *
 */

namespace Accountancy\Gateway\InMemory;

use Accountancy\Entity\Counterparty;
use Accountancy\Gateway\CounterpartiesGatewayInterface;

/**
 * Class CounterpartiesGateway
 *
 * @package Accountancy\Gateway\InMemory
 */
class CounterpartiesGateway implements CounterpartiesGatewayInterface
{
    protected $counterparties = array();

    /**
     * @param Counterparty $counterparty
     *
     * @return mixed
     */
    public function addCounterparty(Counterparty $counterparty)
    {
        $id = count($this->counterparties) + 1;
        $counterparty->setId($id);
        $this->counterparties[$id] = $counterparty;
    }

    /**
     * @param integer $userId
     * @param string  $name
     *
     * @return Counterparty
     */
    public function findCounterpartyByUserIdAndName($userId, $name)
    {
        foreach ($this->counterparties as $counterparty) {
            if ($counterparty->getUserId() === (int) $userId && $counterparty->getName() === (string) $name) {
                return clone $counterparty;
            }
        }
    }

    /**
     * @param integer $id
     *
     * @return Counterparty
     */
    public function findCounterpartyById($id)
    {
        if (isset($this->counterparties[(int) $id])) {
            return clone $this->counterparties[(int) $id];
        }
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function deleteCounterparty($id)
    {
        if (isset($this->counterparties[(int) $id])) {
            unset($this->counterparties[(int) $id]);
        }
    }

    /**
     * @param Counterparty $counterparty
     *
     * @throws \LogicException
     * @return mixed
     */
    public function updateCounterparty(Counterparty $counterparty)
    {
        $id = (int) $counterparty->getId();
        if ($id === 0) {
            throw new \LogicException("Counterparty doesn't exist");
        }

        $this->counterparties[$id] = $counterparty;
    }
}
