<?php
/**
 *
 */

namespace Accountancy;

use Accountancy\Entity\Account;
use Accountancy\Features\AccountManagement\CreateAccount;
use Accountancy\Features\AccountManagement\DeleteAccount;
use Accountancy\Features\AccountManagement\EditAccount;
use Accountancy\Gateway\AccountsGatewayInterface;
use Accountancy\Gateway\InMemory\AccountsGateway;
use Behat\Gherkin\Node\TableNode;

trait AccountTrait
{
    /**
     * @var AccountsGatewayInterface
     */
    protected $accounts;

    /**
     * @return \Accountancy\Gateway\AccountsGatewayInterface
     */
    public function getAccountsGateway()
    {
        if ($this->accounts === null) {
            $this->accounts = new AccountsGateway();
        }

        return $this->accounts;
    }

    /**
     * @param TableNode $accountsTable
     *
     * @Given /^there are Accounts:$/
     */
    public function thereAreAccounts(TableNode $accountsTable)
    {
        foreach ($accountsTable->getHash() as $row) {
            foreach ($row as $key => $value) {
                $row[$key] = substr($value, 1, -1);
            }

            $user = $this->getUsersGateway()->findUserById($row['user_id']);
            assertInstanceOf('\\Accountancy\\Entity\\User', $user, sprintf("Accounts should match to registered users, user '%s' not found", $row['user_id']));

            $account = new Account();

            if (isset($row['id'])) {
                $account->setId($row['id']);
            }

            if (isset($row['user_id'])) {
                $account->setUserId($row['user_id']);
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

            $this->getAccountsGateway()->addAccount($account);
        }
    }

    /**
     * @param TableNode $accountsTable
     *
     * @Then /^Accounts should be:$/
     */
    public function accountsShouldBe(TableNode $accountsTable)
    {
        foreach ($accountsTable->getHash() as $row) {
            foreach ($row as $key => $value) {
                $row[$key] = substr($value, 1, -1);
            }

            assertArrayHasKey("name", $row, "'name' field must be present in 'Accounts should be' table");
            assertArrayHasKey("user_id", $row, "'user_id' field must be present in 'Accounts should be' table");
            $account = $this->getAccountsGateway()->findAccountByUserIdAndName($row['user_id'], $row['name']);
            assertInstanceOf("\\Accountancy\\Entity\\Account", $account, sprintf("Account with name '%s' doesn't exist", $row['name']));

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


    /**
     * @param string $name
     * @param int    $currencyId
     *
     * @When /^I create Account with Name "([^"]*)" and Currency "([^"]*)"$/
     */
    public function iCreateAccountWithNameAndCurrency($name, $currencyId)
    {
        $feature = new CreateAccount();
        $feature->setAccounts($this->getAccountsGateway())
            ->setCurrencies($this->getCurrenciesGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'account_name' => $name,
                'currency_id' => $currencyId,
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @param int $accountId
     *
     * @When /^I delete Account "([^"]*)"$/
     */
    public function iDeleteAccount($accountId)
    {
        $feature = new DeleteAccount();
        $feature->setAccounts($this->getAccountsGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'id' => $accountId
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @param int    $accountId
     * @param string $name
     *
     * @When /^I edit Account "([^"]*)", set name to "([^"]*)"$/
     */
    public function iEditAccountSetNameTo($accountId, $name)
    {
        $feature = new EditAccount();
        $feature->setAccounts($this->getAccountsGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'id' => $accountId,
                'new_name' => $name
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }
}
