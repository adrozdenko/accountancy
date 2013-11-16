<?php
/**
 *
 */

namespace Accountancy\Entity\Collection;

use Accountancy\Entity\Account;

/**
 * Class AccountCollection
 *
 * @package Accountancy\Entity\Collection
 */
class AccountCollection
{

    /**
     * @var Array
     */
    protected $accounts = array();

    /**
     * @param Array $accounts
     *
     * @return $this
     */
    public function setAccounts(Array $accounts)
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * @return Array
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param integer $accountId
     *
     * @return Account|null
     */
    public function findAccountById($accountId)
    {
        foreach ($this->accounts as $account) {

            if ($account->getId() === $accountId) {
                return $account;
            }
        }

        return null;
    }

    /**
     * @param Account $account
     */
    public function updateAccounts(Account $account)
    {

        foreach ($this->accounts as $key => $value) {

            if ($value->getId() === $account->getId()) {
                $this->accounts[$key] = $account;
            }
        }
    }

    /**
     * @param string $accountName
     *
     * @return Account|null
     */
    public function findAccountByName($accountName)
    {
        foreach ($this->accounts as $account) {

            if ($account->getName() === $accountName) {
                return $account;
            }
        }

        return null;
    }

    /**
     * @param Account $account
     *
     * @throws \LogicException
     * @return $this
     */
    public function addAccount(Account $account)
    {
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
