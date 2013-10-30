<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Accountancy\Entity;
use Accountancy\Features\FundsFlow\RegisterIncome;
use Accountancy\Features\FundsFlow\RegisterExpense;

require_once __DIR__ . "/../../vendor/autoload.php";    
require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';


/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    protected $user;

    /**
     * @Given /^categories of Expense:$/
     */
    public function categoriesOfExpense(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given /^amount of money on Users account is "([^"]*)"$/
     */
    public function amountOfMoneyOnUsersAccountIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When /^User registers "([^"]*)" Expense for Category "([^"]*)"$/
     */
    public function userRegistersExpenseForCategory($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then /^amount of money on Users account should be "([^"]*)"$/
     */
    public function amountOfMoneyOnUsersAccountShouldBe($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^categories of Income:$/
     */
    public function categoriesOfIncome(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When /^User registers "([^"]*)" Income for Category "([^"]*)"$/
     */
    public function userRegistersIncomeForCategory($arg1, $arg2)
    {
        throw new PendingException();
    }

}
