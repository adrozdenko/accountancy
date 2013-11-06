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

trait AccountTrait
{
    /**
     * @Given /^I have Accounts:$/
     */
    public function iHaveAccounts(TableNode $accountsTable)
    {
        foreach ($accountsTable->getHash() as $row) {
            $account = new Account();

            if (isset($row['id'])) {
                $account->setId($row['id']);
            }

            if (isset($row['name'])) {
                $account->setName($row['name']);
            }

            if (isset($row['balance'])) {
                $account->setBalance((float)$row['balance']);
            }

            if (isset($row['currency_id'])) {
                $account->setCurrencyId($row['currency_id']);
            }

            $this->user->addAccount($account);
        }
    }

    /**
     * @Then /^My Accounts should be:$/
     */
    public function myAccountsShouldBe(TableNode $accountsTable)
    {
        $accountsByName = array();
        foreach($this->user->getAccounts() as $account) {
            $accountsByName[$account->getName()] = $account;
        }

        foreach ($accountsTable->getHash() as $row) {
            assertArrayHasKey("name", $row, "'name' field must be present in 'My Accounts should be' table");
            assertArrayHasKey($row['name'], $accountsByName, sprintf("Account with name '%s' doesn't exist", $row['name']));
            $account = $accountsByName[$row['name']];


            if (isset($row['id'])) {
                assertEquals($row['id'], $account->getId(), sprintf("Id does not match for account '%s'", $row['name']));
            }

            if (isset($row['balance'])) {
                assertEquals($row['balance'], $account->getBalance(), sprintf("Balance does not match for account '%s'", $row['name']));
            }

            if (isset($row['name'])) {
                assertEquals($row['name'], $account->getName(), sprintf("Name does not match for account '%s'", $row['name']));
            }

            if (isset($row['currency_id'])) {
                assertEquals($row['currency_id'], $account->getCurrencyId(), sprintf("Currency does not match for account '%s'", $row['name']));
            }
        }
    }
}