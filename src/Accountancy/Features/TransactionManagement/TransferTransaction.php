<?php
/**
 *
 */

namespace Accountancy\Features\TransactionManagement;

use Accountancy\Features\FeatureException;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\AccountsGatewayInterface;

/**
 * Class TransferTransaction
 *
 * @package Accountancy\Features\TransactionManagement
 */
class TransferTransaction implements FeatureInterface
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
        $toAccount = $this->accounts->findAccountById($input['to_account_id']);

        if (is_null($toAccount) || $toAccount->getUserId() !== (int) $input['user_id']) {
            throw new FeatureException("Target account doesn't exist");
        }

        $fromAccount = $this->accounts->findAccountById($input['from_account_id']);

        if (is_null($fromAccount) || $fromAccount->getUserId() !== (int) $input['user_id']) {
            throw new FeatureException("Source account doesn't exist");
        }

        if ($toAccount->getCurrencyId() != $fromAccount->getCurrencyId()) {
            throw new FeatureException("Currency isn't supported by target account");
        }

        if ((float) $input['amount'] <= 0.0) {
            throw new FeatureException("Amount of money should be greater than zero");
        }

        $fromAccount->decreaseBalance((float) $input['amount']);
        $this->accounts->updateAccount($fromAccount);

        $toAccount->increaseBalance((float) $input['amount']);
        $this->accounts->updateAccount($toAccount);

        return array();
    }
}
