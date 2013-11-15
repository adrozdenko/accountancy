<?php
/**
 * Created by PhpStorm.
 * User: Petro_Svintsitskyi
 * Date: 11/6/13
 * Time: 11:11 PM
 */

namespace Accountancy\Features\AccountManagement;

use Accountancy\Entity\User;
use Accountancy\Entity\Account;
use Accountancy\Features\FeatureException;

/**
 * Class EditAccount
 *
 * @package Accountancy\Features\AccountManagement
 */
class EditAccount
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var int
     */
    protected $accountId;

    /**
     * @var string
     */
    protected $newName;

    /**
     * @param int $accountId
     *
     * @return $this
     */
    public function setAccountId($accountId)
    {
        $this->accountId = (int) $accountId;

        return $this;
    }

    /**
     * @param string $newName
     *
     * @return $this
     */
    public function setNewName($newName)
    {
        $this->newName = (string) $newName;

        return $this;
    }

    /**
     * @param \Accountancy\Entity\User $user
     *
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @throws \Accountancy\Features\FeatureException
     */
    public function run()
    {
        $account = $this->user->findAccountById($this->accountId);

        if (is_null($account)) {
            throw new FeatureException("Account doesn't exist");
        }

        if (trim($this->newName) == '') {
            throw new FeatureException("Name of Account can not be empty");
        }

        if ($this->user->findAccountByName($this->newName) instanceof Account) {
            throw new FeatureException(sprintf("Account '%s' already exists", $this->newName));
        }

        $account->setName($this->newName);

        $accounts = $this->user->getAccounts();

        foreach ($accounts as $key => $value) {

            if ($value->getId() === $this->accountId) {
                $accounts[$key] = $account;
            }
        }

        $this->user->setAccounts = $accounts;
    }
}
