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
    public function iHaveAccounts(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I have Categories:$/
     */
    public function iHaveCategories(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I have Counterparties:$/
     */
    public function iHaveCounterparties(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When /^I register "([^"]*)" Expense for Account (\d+) and Category (\d+) and Counterparty (\d+)$/
     */
    public function iRegisterExpenseForAccountAndCategoryAndCounterparty($arg1, $arg2, $arg3, $arg4)
    {
        throw new PendingException();
    }

    /**
     * @Then /^My Accounts should be:$/
     */
    public function myAccountsShouldBe(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should receive \((\d+)\) error$/
     */
    public function iShouldReceiveError($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When /^I add "([^"]*)" funds to Account (\d+)$/
     */
    public function iAddFundsToAccount($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When /^I add "([^"]*)" funds to Account "([^"]*)"$/
     */
    public function iAddFundsToAccount2($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When /^I register "([^"]*)" Income for Account (\d+) and Category (\d+) and Counterparty (\d+)$/
     */
    public function iRegisterIncomeForAccountAndCategoryAndCounterparty($arg1, $arg2, $arg3, $arg4)
    {
        throw new PendingException();
    }

    /**
     * @When /^I register Transfer from Account “(\d+)” to Account “(\d+)” and Category “(\d+)” and Counterparty “(\d+)”$/
     */
    public function iRegisterTransferFromAccountToAccountAndCategoryAndCounterparty($arg1, $arg2, $arg3, $arg4)
    {
        throw new PendingException();
    }

    /**
     * @When /^I register (\d+)\.(\d+) Transfer from Account (\d+) to Account (\d+) and Category (\d+) and Counterparty (\d+)$/
     */
    public function iRegisterTransferFromAccountToAccountAndCategoryAndCounterparty2($arg1, $arg2, $arg3, $arg4, $arg5, $arg6)
    {
        throw new PendingException();
    }

    /**
     * @When /^I register -(\d+)\.(\d+) Transfer from Account (\d+) to Account (\d+) and Category (\d+) and Counterparty (\d+)$/
     */
    public function iRegisterTransferFromAccountToAccountAndCategoryAndCounterparty3($arg1, $arg2, $arg3, $arg4, $arg5, $arg6)
    {
        throw new PendingException();
    }
}
