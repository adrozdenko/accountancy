<?php

use Accountancy\Entity\Account;
use Accountancy\Entity\Category;
use Accountancy\Entity\Currency;
use Accountancy\Entity\CurrencyCollection;
use Accountancy\Entity\User;
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
require_once 'AccountTrait.php';
require_once 'CurrencyTrait.php';
require_once 'CategoryTrait.php';
require_once 'CounterpartyTrait.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    use AccountTrait, CurrencyTrait, CategoryTrait, CounterpartyTrait;

    /**
     * @var Accountancy\Entity\User
     */
    protected $user;

    /**
     * @var \Accountancy\Features\FeatureException
     */
    protected $lastException;

    /**
     * @var CurrencyCollection
     */
    protected $currencyCollection;

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
     * @Then /^I should receive "([^"]*)" error$/
     */
    public function iShouldReceiveError($errorMessage)
    {
        if (!$this->lastException instanceof \Accountancy\Features\FeatureException) {
            echo (string) $this->lastException;
        }
        
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
     * @When /^I register "([^"]*)" Expense for Account (\d+) and Category (\d+) and Counterparty (\d+)$/
     */
    public function iRegisterExpenseForAccountAndCategoryAndCounterparty($amount, $accountId, $categoryId, $counterpartyId)
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
