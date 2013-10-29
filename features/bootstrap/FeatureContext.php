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
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->user = new Entity\User;
    }

    /**
     * @Given /^User has an Account called "([^"]*)"$/
     */
    public function userHasAnAccountCalled($name)
    {
        $account = new Entity\Account;
        $account->id = $name;
        $account->name = $name;
        $this->user->accounts[$name] = $account;
    }

    /**
     * @Given /^Debit of the "([^"]*)" Account is "([^"]*)"$/
     */
    public function debitOfTheAccountIs($name, $value)
    {
        list($value, $currency) = explode(" ", $value);
        $this->user->accounts[$name]->debit = $value;
    }

    /**
     * @Given /^Credit of the "([^"]*)" Account is "([^"]*)"$/
     */
    public function creditOfTheAccountIs($name, $value)
    {
        list($value, $currency) = explode(" ", $value);
        $this->user->accounts[$name]->credit = $value;
    }

    /**
     * @When /^User adds "([^"]*)" funds to "([^"]*)" Account$/
     */
    public function userAddsFundsToAccount($value, $accountId)
    {
        list($value, $currency) = explode(" ", $value);
        
        $useCase = new RegisterIncome();
        $useCase->setUser($this->user)
            ->registerIncome($accountId, $value);
    }

    /**
     * @Then /^Debit of the "([^"]*)" Account should be equal to "([^"]*)"$/
     */
    public function debitOfTheAccountShouldBeEqualTo($name, $value)
    {
        list($value, $currency) = explode(" ", $value);
        assertEquals($value, $this->user->accounts[$name]->debit);
    }

    /**
     * @Given /^Credit of the "([^"]*)" Account should be equal to "([^"]*)"$/
     */
    public function creditOfTheAccountShouldBeEqualTo($name, $value)
    {
        list($value, $currency) = explode(" ", $value);
        assertEquals($value, $this->user->accounts[$name]->credit);
    }

    /**
     * @When /^user registers "([^"]*)" of expense from "([^"]*)" Account to "([^"]*)"$/
     */
    public function userRegistersOfExpenseFromAccountTo($value, $accountFromId, $accountToId)
    {
        list($value, $currency) = explode(" ", $value);
        $useCase = new RegisterExpense();
        $useCase->setUser($this->user)
            ->registerExpense($accountFromId, $accountToId, $value );
    }


}
