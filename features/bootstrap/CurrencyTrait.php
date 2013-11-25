<?php
/**
 *
 */

namespace Accountancy;

use Accountancy\Entity\Currency;
use Accountancy\Gateway\CurrenciesGatewayInterface;
use Accountancy\Gateway\InMemory\CurrenciesGateway;
use Behat\Gherkin\Node\TableNode;

trait CurrencyTrait
{
    /**
     * @var CurrenciesGatewayInterface
     */
    protected $currencies;

    /**
     * @return CurrenciesGatewayInterface|CurrenciesGateway
     */
    public function getCurrenciesGateway()
    {
        if ($this->currencies === null) {
            $this->currencies = new CurrenciesGateway();
        }

        return $this->currencies;
    }

    /**
     * @param TableNode $currenciesTable
     *
     * @Given /^There are Currencies:$/
     */
    public function thereAreCurrencies(TableNode $currenciesTable)
    {
        foreach ($currenciesTable->getHash() as $row) {
            foreach ($row as $key => $value) {
                $row[$key] = substr($value, 1, -1);
            }

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

            $this->getCurrenciesGateway()->addCurrency($currency);
        }
    }
}
