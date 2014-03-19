<?php
/**
 *
 */

namespace Accountancy\Gateway;

use Accountancy\Entity\Account;

/**
 * Interface AccountsGatewayInterface
 *
 * @package Accountancy\Gateway
 */
interface AccountsGatewayInterface
{
    /**
     * @param int    $userId
     * @param string $name
     *
     * @return Account
     */
    public function findAccountByUserIdAndName($userId, $name);

    /**
     * @param int $id
     *
     * @return Account
     */
    public function findAccountById($id);

    /**
     * @param Account $account
     *
     * @return mixed
     */
    public function addAccount(Account $account);

    /**
     * @param Account $account
     *
     * @return mixed
     */
    public function updateAccount(Account $account);

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function deleteAccount($id);
}
