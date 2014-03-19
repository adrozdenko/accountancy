<?php
/**
 *
 */

namespace Accountancy\Gateway\InMemory;

use Accountancy\Entity\Currency;
use Accountancy\Gateway\CurrenciesGatewayInterface;

/**
 * Class CurrenciesGateway
 *
 * @package Accountancy\Gateway\InMemory
 */
class CurrenciesGateway implements CurrenciesGatewayInterface
{
    protected $currencies = array();

    /**
     * @param Currency $currency
     *
     * @return $this
     */
    public function addCurrency(Currency $currency)
    {
        $id = (int) $currency->getId();
        if ($id === 0) {
            $id = count($this->currencies) + 1;
        }

        $currency->setId($id);
        $this->currencies[$id] = $currency;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function hasCurrency($id)
    {
        if (isset($this->currencies[(int) $id])) {
            return true;
        }

        return false;
    }
}
