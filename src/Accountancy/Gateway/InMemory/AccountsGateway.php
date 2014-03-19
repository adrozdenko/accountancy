<?php
/**
 *
 */

namespace Accountancy\Gateway\InMemory;

use Accountancy\Entity\Account;
use Accountancy\Gateway\AccountsGatewayInterface;

/**
 * Class AccountsGateway
 *
 * @package Accountancy\Gateway\InMemory
 */
class AccountsGateway implements AccountsGatewayInterface
{
    protected $accounts = array();

    /**
     * @param int    $userId
     * @param string $name
     *
     * @return Account
     */
    public function findAccountByUserIdAndName($userId, $name)
    {
        foreach ($this->accounts as $account) {
            if ($account->getUserId() === (int) $userId && $account->getName() === (string) $name) {
                return clone $account;
            }
        }
    }

    /**
     * @param int $id
     *
     * @return Account
     */
    public function findAccountById($id)
    {
        if (isset($this->accounts[(int) $id])) {
            return clone $this->accounts[(int) $id];
        }
    }

    /**
     * @param Account $account
     *
     * @return mixed
     */
    public function addAccount(Account $account)
    {
        $id = count($this->accounts) + 1;
        $account->setId($id);
        $this->accounts[$id] = $account;
    }

    /**
     * @param Account $account
     *
     * @throws \LogicException
     */
    public function updateAccount(Account $account)
    {
        $id = (int) $account->getId();

        if ($id === 0) {
            throw new \LogicException("Account doesn't exist");
        }

        $this->accounts[$id] = $account;
    }

    /**
     * @param int $id
     *
     * @return mixed|void
     */
    public function deleteAccount($id)
    {
        if (isset($this->accounts[(int) $id])) {
            unset($this->accounts[(int) $id]);
        }
    }
}
