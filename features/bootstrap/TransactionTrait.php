<?php

use Behat\Gherkin\Node\TableNode;
use Accountancy\Features\TransactionManagement\FullfillTransaction;
use Accountancy\Features\TransactionManagement\ExpenseTransaction;
use Accountancy\Features\TransactionManagement\IncomeTransaction;
use Accountancy\Features\TransactionManagement\TransferTransaction;

trait TransactionTrait
{
    /**
     * @When /^I add "([^"]*)" funds of currency "([^"]*)" to Account "([^"]*)"$/
     */
    public function iAddFundsToAccount($amount, $currencyId, $accountId)
    {
        $feature = new FullfillTransaction();
        $feature->setUser($this->user)
            ->setCurrencyId($currencyId)
            ->setAccountId($accountId)
            ->setAmount($amount);

        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @When /^I register "([^"]*)" Expense of currency "([^"]*)" for Account "([^"]*)" and Category "([^"]*)" and Counterparty "([^"]*)"$/
     */
    public function iRegisterExpenseForAccountAndCategoryAndCounterparty($amount, $currencyId, $accountId, $categoryId, $counterpartyId)
    {
        $feature = new ExpenseTransaction();
        $feature->setUser($this->user)
            ->setCurrencyId($currencyId)
            ->setAccountId($accountId)
            ->setCategoryId($categoryId)
            ->setCounterpartyId($counterpartyId)
            ->setAmount($amount);
        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @When /^I register "([^"]*)" Income of currency "([^"]*)" for Account "([^"]*)" and Category "([^"]*)" and Counterparty "([^"]*)"$/
     */
    public function iRegisterIncomeForAccountAndCategoryAndCounterparty($amount, $currencyId, $accountId, $categoryId, $counterpartyId)
    {
        $feature = new IncomeTransaction();
        $feature->setUser($this->user)
            ->setCurrencyId($currencyId)
            ->setAccountId($accountId)
            ->setCategoryId($categoryId)
            ->setCounterpartyId($counterpartyId)
            ->setAmount($amount);
        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @When /^I register "([^"]*)" Transfer from Account "([^"]*)" to Account "([^"]*)"$/
     */
    public function iRegisterTransferFromAccountToAccountAndCategoryAndCounterparty($amount, $fromAccountId, $toAccountId)
    {
        $feature = new TransferTransaction();
        $feature->setUser($this->user)
            ->setFromAccountId($fromAccountId)
            ->setToAccountId($toAccountId)
            ->setAmount($amount);
        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }
}
