<?php

/**
 *
 */

namespace Accountancy\Entity;

use Accountancy\Entity\Account;

/**
 * User Entity
 */
class User
{
    protected $accounts = array();

    /**
     * @param array $accounts
     *
     * @return User
     */
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * @return array
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param mixed $account
     *
     * @return Account|bool
     */
    public function findAccount($account)
    {
        foreach ($this->accounts as &$existingAccount) {
            if (is_int($account) && $account === $existingAccount->getId()) {
                return $existingAccount;
            }

            if (is_string($account) && $account === $existingAccount->getName()) {
                return $existingAccount;
            }

            if ($account instanceof Account && $account->getName() === $existingAccount->getName()) {
                return $existingAccount;
            }
        }

        return false;
    }

    /**
     * @param Account $account
     *
     * @throws \LogicException
     * @return $this
     */
    public function addAccount(Account $account)
    {
        if ($this->findAccount($account)) {
            throw new \LogicException('Name of Account should be unique');
        }

        $this->accounts[] = $account;

        return $this;
    }

    /**
     * @param int $accountId
     *
     * @throws \LogicException
     * @return $this
     */
    public function deleteAccount($accountId)
    {
        $deleted = false;

        foreach ($this->accounts as $index => $account) {
            if ($account->getId() === (int) $accountId) {
                unset($this->accounts[$index]);
                $deleted = true;
                break;
            }
        }

        if (!$deleted) {
            throw new \LogicException("Account doesn't exist");
        }

        return $this;
    }
}
