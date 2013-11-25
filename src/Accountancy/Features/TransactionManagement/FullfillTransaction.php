<?php
/**
 *
 */

namespace Accountancy\Features\TransactionManagement;

use Accountancy\Features\FeatureException;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\AccountsGatewayInterface;

/**
 * Class FullfillTransaction
 *
 * @package Accountancy\Features\TransactionManagement
 */
class FullfillTransaction implements FeatureInterface
{
    /**
     * @var AccountsGatewayInterface
     */
    protected $accounts;

    /**
     * @param \Accountancy\Gateway\AccountsGatewayInterface $accounts
     *
     * @return $this
     */
    public function setAccounts(AccountsGatewayInterface $accounts)
    {
        $this->accounts = $accounts;

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
            throw new FeatureException("Currency is't supported by account");
        }

        if ((float) $input['amount'] <= 0.0) {
            throw new FeatureException("Amount of money should be greater than zero");
        }

        $account->setBalance((float) $input['amount']);

        $this->accounts->updateAccount($account);

        return array();
    }
}
