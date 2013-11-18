<?php
/**
 *
 */

namespace Accountancy;

use Accountancy\Entity\Currency;
use Behat\Gherkin\Node\TableNode;

trait CurrencyTrait
{
    /**
     * @param TableNode $currenciesTable
     *
     * @Given /^There are Currencies:$/
     */
    public function thereAreCurrencies(TableNode $currenciesTable)
    {
        foreach ($currenciesTable->getHash() as $row) {
            $currency = new Currency();

            if (isset($row['id'])) {
                $currency->setId($row['id']);
            }

            if (isset($row['name'])) {
                $currency->setName($row['name']);
            }

            if (isset($row['code'])) {
                $currency->setCode($row['code']);
            }

            $this->currencyCollection->addCurrency($currency);
        }
    }
}
