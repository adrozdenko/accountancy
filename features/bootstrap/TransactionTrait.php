<?php
/**
 *
 */

namespace Accountancy;

use Behat\Gherkin\Node\TableNode;
use Accountancy\Features\TransactionManagement\FullfillTransaction;
use Accountancy\Features\TransactionManagement\ExpenseTransaction;
use Accountancy\Features\TransactionManagement\IncomeTransaction;
use Accountancy\Features\TransactionManagement\TransferTransaction;

trait TransactionTrait
{
    /**
     * @param float $amount
     * @param int   $currencyId
     * @param float $accountId
     *
     * @When /^I add "([^"]*)" funds of currency "([^"]*)" to Account "([^"]*)"$/
     */
    public function iAddFundsToAccount($amount, $currencyId, $accountId)
    {
        $feature = new FullfillTransaction();
        $feature->setAccounts($this->getAccountsGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'amount' => $amount,
                'currency_id' => $currencyId,
                'account_id' => $accountId,
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @param float $amount
     * @param int   $currencyId
     * @param int   $accountId
     * @param int   $categoryId
     * @param int   $counterpartyId
     *
     * @When /^I register "([^"]*)" Expense of currency "([^"]*)" for Account "([^"]*)" and Category "([^"]*)" and Counterparty "([^"]*)"$/
     */
    public function iRegisterExpenseForAccountAndCategoryAndCounterparty($amount, $currencyId, $accountId, $categoryId, $counterpartyId)
    {
        $feature = new ExpenseTransaction();
        $feature->setAccounts($this->getAccountsGateway())
            ->setCounterparties($this->getCounterpartiesGateway())
            ->setCategories($this->getCategoriesGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'amount' => $amount,
                'currency_id' => $currencyId,
                'account_id' => $accountId,
                'category_id' => $categoryId,
                'counterparty_id' => $counterpartyId,
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @param float $amount
     * @param int   $currencyId
     * @param int   $accountId
     * @param int   $categoryId
     * @param int   $counterpartyId
     *
     * @When /^I register "([^"]*)" Income of currency "([^"]*)" for Account "([^"]*)" and Category "([^"]*)" and Counterparty "([^"]*)"$/
     */
    public function iRegisterIncomeForAccountAndCategoryAndCounterparty($amount, $currencyId, $accountId, $categoryId, $counterpartyId)
    {
        $feature = new IncomeTransaction();
        $feature->setAccounts($this->getAccountsGateway())
            ->setCategories($this->getCategoriesGateway())
            ->setCounterparties($this->getCounterPartiesGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'amount' => $amount,
                'currency_id' => $currencyId,
                'account_id' => $accountId,
                'category_id' => $categoryId,
                'counterparty_id' => $counterpartyId,
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @param float $amount
     * @param int   $fromAccountId
     * @param int   $toAccountId
     *
     * @When /^I register "([^"]*)" Transfer from Account "([^"]*)" to Account "([^"]*)"$/
     */
    public function iRegisterTransferFromAccountToAccountAndCategoryAndCounterparty($amount, $fromAccountId, $toAccountId)
    {
        $feature = new TransferTransaction();
        $feature->setAccounts($this->getAccountsGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'amount' => $amount,
                'from_account_id' => $fromAccountId,
                'to_account_id' => $toAccountId,
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }
}
