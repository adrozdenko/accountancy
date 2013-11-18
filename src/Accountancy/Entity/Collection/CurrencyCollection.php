<?php
/**
 * Created by PhpStorm.
 * User: Petro_Svintsitskyi
 * Date: 11/6/13
 * Time: 4:55 PM
 */

namespace Accountancy\Entity\Collection;

use Accountancy\Entity\Currency;

/**
 * Class CurrencyCollection
 *
 * @package Accountancy\Entity\Collection
 */
class CurrencyCollection
{
    /**
     * @var Array
     */
    protected $currencies = array();

    /**
     * @param array $currencies
     *
     * @return $this
     */
    public function setCurrencies($currencies)
    {
        $this->currencies = $currencies;

        return $this;
    }

    /**
     * @return array
     */
    public function getCurrencies()
    {
        return $this->currencies;
    }

    /**
     * @param Currency $currency
     *
     * @return $this
     */
    public function addCurrency(Currency $currency)
    {
        $this->currencies[] = $currency;

        return $this;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function hasCurrency($id)
    {
        foreach ($this->currencies as $currency) {
            if ($currency->getId() === $id) {
                return true;
            }
        }

        return false;
    }
}
