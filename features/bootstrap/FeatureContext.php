<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Accountancy\Entity;
use Accountancy\Features\RegisterIncome;


require_once __DIR__ . "/../../vendor/autoload.php";
require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';


/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    protected $user;

    public function __construct()
    {
        $this->user = new Entity\User;
    }

    /**
     * @Given /^User has categories of Expense:$/
     */
    public function userHasCategoriesOfExpense(TableNode $categoriesOfExpenseTable)
    {
        throw new PendingException();
    }

    /**
     * @Given /^User has categories of Income:$/
     */
    public function userHasCategoriesOfIncome(TableNode $categoriesOfIncomeTable)
    {
        foreach ($categoriesOfIncomeTable->getHash() as $categoryOfIncome) {
            $this->user->categoriesOfIncome[$categoryOfIncome['categoryId']] = $categoryOfIncome['categoryName'];
        }
    }

    /**
     * @Given /^amount of money on Users account is "([^"]*)"$/
     */
    public function amountOfMoneyOnUsersAccountIs($valueAndCurrency)
    {
        list($value, $currency) = explode(' ', $valueAndCurrency);
        $this->user->balance = $value;
    }

    /**
     * @When /^User registers "([^"]*)" Expense for Category "([^"]*)"$/
     */
    public function userRegistersExpenseForCategory($valueAndCurrency, $categoryId)
    {
        throw new PendingException();
    }

    /**
     * @Then /^amount of money on Users account should be "([^"]*)"$/
     */
    public function amountOfMoneyOnUsersAccountShouldBe($valueAndCurrency)
    {
        list($value, $currency) = explode(' ', $valueAndCurrency);
        assertEquals($value, $this->user->balance);
    }

    /**
     * @When /^User registers "([^"]*)" Income for Category "([^"]*)"$/
     */
    public function userRegistersIncomeForCategory($valueAndCurrency, $categoryId)
    {
        list($value, $currency) = explode(' ', $valueAndCurrency);

        $useCase = new RegisterIncome();
        $useCase->setUser($this->user);
        $useCase->registerIncome($value, $categoryId);
    }

}
