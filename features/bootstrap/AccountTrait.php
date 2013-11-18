<?php
/**
 *
 */

use Accountancy\Entity\Account;
use Accountancy\Features\AccountManagement\CreateAccount;
use Accountancy\Features\AccountManagement\DeleteAccount;
use Accountancy\Features\AccountManagement\EditAccount;
use Behat\Gherkin\Node\TableNode;

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
                $account->setBalance($row['balance']);
            }

            if (isset($row['currency_id'])) {
                $account->setCurrencyId($row['currency_id']);
            }

            $this->user->getAccounts()->addAccount($account);
        }
    }

    /**
     * @Then /^My Accounts should be:$/
     */
    public function myAccountsShouldBe(TableNode $accountsTable)
    {
        $accountsByName = array();
        foreach ($this->user->getAccounts()->getAccounts() as $account) {
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

        $expected = count($accountsTable->getHash());
        $actual = count($accountsByName);
        assertEquals($expected, $actual, sprintf("Expected %s accounts, got %s", $expected, $actual));
    }

    /**
     * @When /^I create Account with Name "([^"]*)" and Currency "([^"]*)"$/
     */
    public function iCreateAccountWithNameAndCurrency($name, $currencyId)
    {
        $feature = new CreateAccount();
        $feature->setUser($this->user)
            ->setAccountName($name)
            ->setCurrencyId($currencyId)
            ->setCurrencies($this->currencyCollection);

        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @When /^I delete Account "([^"]*)"$/
     */
    public function iDeleteAccount($accountId)
    {
        $feature = new DeleteAccount();
        $feature->setUser($this->user)
            ->setAccountId($accountId);

        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @When /^I edit Account "([^"]*)", set name to "([^"]*)"$/
     */
    public function iEditAccountSetNameTo($accountId, $name)
    {
        $feature = new EditAccount();
        $feature->setUser($this->user)
            ->setAccountId($accountId)
            ->setNewName($name);

        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

}
