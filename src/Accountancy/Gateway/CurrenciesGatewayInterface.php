<?php
/**
 *
 */

namespace Accountancy\Gateway;

use Accountancy\Entity\Currency;

/**
 * Interface CurrenciesGatewayInterface
 *
 * @package Accountancy\Gateway
 */
interface CurrenciesGatewayInterface
{
    /**
     * @param Currency $currency
     *
     * @return $this
     */
    public function addCurrency(Currency $currency);

    /**
     * @param int $id
     *
     * @return bool
     */
    public function hasCurrency($id);
}
