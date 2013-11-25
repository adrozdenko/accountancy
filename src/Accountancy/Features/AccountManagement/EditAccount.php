<?php
/**
 *
 */

namespace Accountancy\Features\AccountManagement;

use Accountancy\Features\FeatureException;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\AccountsGatewayInterface;

/**
 * Class EditAccount
 *
 * @package Accountancy\Features\AccountManagement
 */
class EditAccount implements FeatureInterface
{
    /**
     * @var AccountsGatewayInterface
     */
    protected $accounts;

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
     * @param Array $input
     *
     * @throws \Accountancy\Features\FeatureException
     *
     * @return Array
     */
    public function run(Array $input)
    {
        $account = $this->accounts->findAccountById($input['id']);

        if (is_null($account)) {
            throw new FeatureException("Account doesn't exist");
        }

        if ($account->getUserId() !== (int) $input['user_id']) {
            throw new FeatureException("Account doesn't exist");
        }

        if (trim($input['new_name']) == '') {
            throw new FeatureException("Name of Account can not be empty");
        }

        if ($this->accounts->findAccountByUserIdAndName($input['user_id'], $input['new_name'])) {
            throw new FeatureException(sprintf("Account '%s' already exists", $input['new_name']));
        }

        $account->setName($input['new_name']);

        $this->accounts->updateAccount($account);

        return array();
    }
}
