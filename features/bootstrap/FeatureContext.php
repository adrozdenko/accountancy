<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Accountancy\Entity;
use Accountancy\Features\RegisterOperation;


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
     * @Given /^User has categories:$/
     */
    public function userHasCategories(TableNode $categories)
    {
        foreach ($categories->getHash() as $category) {
            $this->user->categories[$category['categoryId']] = $category['categoryName'];
        }
    }

    /**
     * @Given /^User has payees:$/
     */
    public function userHasPayees(TableNode $payees)
    {
        foreach ($payees->getHash() as $payee) {
            $this->user->payees[$payee['payeeId']] = $payee['payeeName'];
        }
    }

    /**
     * @Given /^amount of money on Users balance is "([^"]*)"$/
     */
    public function amountOfMoneyOnUsersBalanceIs($value)
    {
        $this->user->balance = $value;
    }

    /**
     * @When /^User registers "([^"]*)" Expense for Category "([^"]*)" and Payee "([^"]*)"$/
     */
    public function userRegistersExpenseForCategory($value, $categoryId, $payeeId)
    {
        $operation = new Entity\Operation();
        $operation->type = Entity\Operation::OP_TYPE_EXPENSE;
        $operation->value = $value;

        $useCase = new RegisterOperation();
        $useCase->setUser($this->user)
                ->setOperation($operation)
                ->register();
    }

    /**
     * @Then /^amount of money on Users balance should be "([^"]*)"$/
     */
    public function amountOfMoneyOnUsersBalanceShouldBe($value)
    {
        assertEquals($value, $this->user->balance);
    }

    /**
     * @When /^User registers "([^"]*)" Income for Category "([^"]*)" and Payee "([^"]*)"$/
     */
    public function userRegistersIncomeForCategory($value, $categoryId, $payeeId)
    {
        $operation = new Entity\Operation();
        $operation->type = Entity\Operation::OP_TYPE_INCOME;
        $operation->value = $value;

        $useCase = new RegisterOperation();
        $useCase->setUser($this->user)
                ->setOperation($operation)
                ->register();
    }

}
