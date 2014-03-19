<?php
/**
 *
 */

namespace Accountancy\Features\AccountManagement;


use Accountancy\Features\FeatureException;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\AccountsGatewayInterface;

/**
 * Class DeleteAccount
 *
 * @package Accountancy\Features\AccountManagement
 */
class DeleteAccount implements FeatureInterface
{
    /**
     * @var AccountsGatewayInterface
     */
    protected $accounts;

    /**
     * @param \Accountancy\Gateway\AccountsGatewayInterface $accounts
     */
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * @param Array $input
     *
     * @throws \Accountancy\Features\FeatureExceptions
     *
     * @return Array
     */
    public function run(Array $input)
    {
        $account = $this->accounts->findAccountById($input['id']);

        if (empty($account)) {
            throw new FeatureException("Account doesn't exist");
        }

        if ($account->getUserId() !== (int) $input['user_id']) {
            throw new FeatureException("Account doesn't exist");
        }

        $this->accounts->deleteAccount($input['id']);

        return array();
    }
}
