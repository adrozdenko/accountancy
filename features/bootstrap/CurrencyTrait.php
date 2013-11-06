<?php
/**
 *
 */

use Accountancy\Entity\Account;
use Accountancy\Entity\Currency;
use Accountancy\Entity\CurrencyCollection;
use Accountancy\Entity\User;
use Accountancy\Features\AccountManagement\CreateAccount;
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

trait CurrencyTrait
{
    /**
     * @Given /^There are Currencies:$/
     */
    public function thereAreCurrencies(TableNode $currenciesTable)
    {
        $this->currencyCollection = new CurrencyCollection();

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