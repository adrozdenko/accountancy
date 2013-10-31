<?php

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
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * @Given /^I have Accounts:$/
     */
    public function iHaveAccounts(TableNode $accountsTable)
    {
        throw new PendingException();
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
        throw new PendingException();
    }

    /**
     * @Then /^I should receive \((\d+)\) error$/
     */
    public function iShouldReceiveError($errorMessage)
    {
        throw new PendingException();
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
}
