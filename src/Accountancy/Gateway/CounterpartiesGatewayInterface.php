<?php
/**
 *
 */

namespace Accountancy\Gateway;

use Accountancy\Entity\Counterparty;

/**
 * Interface CounterpartiesGatewayInterface
 *
 * @package Accountancy\Gateway
 */
interface CounterpartiesGatewayInterface
{
    /**
     * @param Counterparty $counterparty
     *
     * @return mixed
     */
    public function addCounterparty(Counterparty $counterparty);

    /**
     * @param integer $userId
     * @param string  $name
     *
     * @return Counterparty
     */
    public function findCounterpartyByUserIdAndName($userId, $name);

    /**
     * @param integer $id
     *
     * @return Counterparty
     */
    public function findCounterpartyById($id);

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function deleteCounterparty($id);

    /**
     * @param Counterparty $counterparty
     *
     * @return mixed
     */
    public function updateCounterparty(Counterparty $counterparty);
}
