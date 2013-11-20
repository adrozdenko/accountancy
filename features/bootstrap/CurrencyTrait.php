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
                $currency->setId(substr($row['id'], 1, -1));
            }

            if (isset($row['name'])) {
                $currency->setName(substr($row['name'], 1, -1));
            }

            if (isset($row['code'])) {
                $currency->setCode(substr($row['code'], 1, -1));
            }

            $this->currencyCollection->addCurrency($currency);
        }
    }
}
