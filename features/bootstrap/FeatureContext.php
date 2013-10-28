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
     * @Given /^User has an Account called "([^"]*)"$/
     */
    public function userHasAnAccountCalled($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^Debit of the "([^"]*)" Account is "([^"]*)"$/
     */
    public function debitOfTheAccountIs($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given /^Credit of the "([^"]*)" Account is "([^"]*)"$/
     */
    public function creditOfTheAccountIs($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When /^User adds "([^"]*)" funds to "([^"]*)" Account$/
     */
    public function userAddsFundsToAccount($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then /^Debit of the "([^"]*)" Account should be equal to "([^"]*)"$/
     */
    public function debitOfTheAccountShouldBeEqualTo($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given /^Credit of the "([^"]*)" Account should be equal to "([^"]*)"$/
     */
    public function creditOfTheAccountShouldBeEqualTo($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When /^user registers "([^"]*)" of expense from "([^"]*)" Account to "([^"]*)"$/
     */
    public function userRegistersOfExpenseFromAccountTo($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }


}
