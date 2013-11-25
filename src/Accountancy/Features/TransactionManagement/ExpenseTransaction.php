<?php
/**
 *
 */

namespace Accountancy\Features\TransactionManagement;

use Accountancy\Features\FeatureException;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\AccountsGatewayInterface;
use Accountancy\Gateway\CategoriesGatewayInterface;
use Accountancy\Gateway\CounterpartiesGatewayInterface;

/**
 * Class ExpenseTransaction
 *
 * @package Accountancy\Features\TransactionManagement
 */
class ExpenseTransaction implements FeatureInterface
{
    /**
     * @var AccountsGatewayInterface
     */
    protected $accounts;

    /**
     * @var CounterpartiesGatewayInterface
     */
    protected $counterparties;

    /**
     * @var CategoriesGatewayInterface
     */
    protected $categories;

    /**
     * @param AccountsGatewayInterface $accounts
     *
     * @return $this
     */
    public function setAccounts(AccountsGatewayInterface $accounts)
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * @param CategoriesGatewayInterface $categories
     *
     * @return $this
     */
    public function setCategories(CategoriesGatewayInterface $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @param CounterpartiesGatewayInterface $counterparties
     *
     * @return $this
     */
    public function setCounterparties(CounterpartiesGatewayInterface $counterparties)
    {
        $this->counterparties = $counterparties;

        return $this;
    }

    /**
     * @param Array $input
     *
     * @return Array
     * @throws \Accountancy\Features\FeatureException
     */
    public function run(Array $input)
    {
        $account = $this->accounts->findAccountById($input['account_id']);

        if (is_null($account) || $account->getUserId() !== (int) $input['user_id']) {
            throw new FeatureException("Account doesn't exist");
        }

        if ($account->getCurrencyId() != $input['currency_id']) {
            throw new FeatureException("Currency isn't supported by account");
        }

        $category = $this->categories->findCategoryById($input['category_id']);

        if (is_null($category) || $category->getUserId() !== (int) $input['user_id']) {
            throw new FeatureException("Category doesn’t exist");
        }

        $counterparty = $this->counterparties->findCounterpartyById($input['counterparty_id']);

        if (is_null($counterparty) || $counterparty->getUserId() !== (int) $input['user_id']) {
            throw new FeatureException("Counterparty doesn’t exist");
        }

        if ((float) $input['amount'] <= 0.0) {
            throw new FeatureException("Amount of money should be greater than zero");
        }

        $account->decreaseBalance((float) $input['amount']);

        $this->accounts->updateAccount($account);

        return array();
    }
}
