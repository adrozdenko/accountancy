<?php

use Accountancy\Entity\Account;
use Accountancy\Entity\User;
use Accountancy\Features\AccountManagement\CreateAccount;
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /**
     * @var Accountancy\Entity\User
     */
    protected $user;

    /**
     * @var \Accountancy\Features\FeatureException
     */
    protected $lastException;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->user = new User();
    }

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
     * @Given /^I have Categories:$/
     */
    public function iHaveCategories(TableNode $categoriesTable)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I have Counterparties:$/
     */
    public function iHaveCounterparties(TableNode $counterpartiesTable)
    {
        throw new PendingException();
    }

    /**
     * @When /^I register "([^"]*)" Expense for Account (\d+) and Category (\d+) and Counterparty (\d+)$/
     */
    public function iRegisterExpenseForAccountAndCategoryAndCounterparty($amount, $accountId, $categoryId, $counterpartyId)
    {
        throw new PendingException();
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

    /**
     * @Then /^I should receive "([^"]*)" error$/
     */
    public function iShouldReceiveError($errorMessage)
    {
        assertInstanceOf('\Accountancy\Features\FeatureException', $this->lastException, 'I should Receive an Error');
        assertEquals($errorMessage, $this->lastException->getMessage());
        $this->lastException = null;
    }

    /**
     * @When /^I add "([^"]*)" funds to Account (\d+)$/
     */
    public function iAddFundsToAccount($amount,  $accountId)
    {
        throw new PendingException();
    }

    /**
     * @When /^I register "([^"]*)" Income for Account (\d+) and Category (\d+) and Counterparty (\d+)$/
     */
    public function iRegisterIncomeForAccountAndCategoryAndCounterparty($amount, $accountId, $categoryId, $counterpartyId)
    {
        throw new PendingException();
    }

    /**
     * @When /^I register "([^"]*)" Transfer from Account (\d+) to Account (\d+) and Category (\d+) and Counterparty (\d+)$/
     */
    public function iRegisterTransferFromAccountToAccountAndCategoryAndCounterparty($amount, $accountFromId, $accountToId, $categoryId, $counterpartyId)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I have Currencies:$/
     */
    public function iHaveCurrencies(TableNode $currenciesTable)
    {
        throw new PendingException();
    }

    /**
     * @When /^I create Account with Name "([^"]*)" and Currency (\d+)$/
     */
    public function iCreateAccountWithNameAndCurrency($name, $currencyId)
    {
        $feature = new CreateAccount();
        $feature->setUser($this->user)
            ->setAccountName($name)
            ->setCurrencyId($currencyId);

        try {
            $feature->run();
        } catch(\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @When /^I delete Account (\d+)$/
     */
    public function iDeleteAccount($accountId)
    {
        throw new PendingException();
    }

    /**
     * @When /^I edit Account (\d+), set name to "([^"]*)"$/
     */
    public function iEditAccountSetNameTo($accountId, $name)
    {
        throw new PendingException();
    }

    /**
     * @When /^I create Category with name "([^"]*)"$/
     */
    public function iCreateCategoryWithName($name)
    {
        throw new PendingException();
    }

    /**
     * @Then /^my Categories should be:$/
     */
    public function myCategoriesShouldBe(TableNode $categoriesTable)
    {
        throw new PendingException();
    }

    /**
     * @When /^I delete Category (\d+)$/
     */
    public function iDeleteCategory($categoryId)
    {
        throw new PendingException();
    }

    /**
     * @When /^I edit Category (\d+), set name to "([^"]*)"$/
     */
    public function iEditCategorySetNameTo($categoryId, $name)
    {
        throw new PendingException();
    }

    /**
     * @When /^I create Counterparty with Name "([^"]*)"$/
     */
    public function iCreateCounterpartyWithName($name)
    {
        throw new PendingException();
    }

    /**
     * @Then /^my Counterparties should be:$/
     */
    public function myCounterpartiesShouldBe(TableNode $counterpartiesTable)
    {
        throw new PendingException();
    }

    /**
     * @When /^I delete Counterparty (\d+)$/
     */
    public function iDeleteCounterparty($counterpartyId)
    {
        throw new PendingException();
    }

    /**
     * @When /^I edit Counterparty (\d+), set name "([^"]*)"$/
     */
    public function iEditCounterpartySetName($counterpartyId, $name)
    {
        throw new PendingException();
    }
}
