<?php
/**
 *
 */

namespace Accountancy\Features\AccountManagement;

use Accountancy\Entity\Account;
use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;

/**
 * Class CreateAccount
 *
 * @package Accountancy\Features\AccountManagement
 */
class CreateAccount
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected $accountName;

    /**
     * @var int
     */
    protected $currencyId;

    /**
     * @param string $accountName
     *
     * @return CreateAccount
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * @param int $currencyId
     *
     * @return CreateAccount
     */
    public function setCurrencyId($currencyId)
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    /**
     * @param \Accountancy\Entity\User $user
     *
     * @return CreateAccount
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \Accountancy\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @throws \Accountancy\Features\FeatureException
     */
    public function run()
    {
        $account = new Account();

        try {
            $account->setName($this->accountName);
        } catch (\InvalidArgumentException $e) {
            throw new FeatureException("Name of Account can not be empty");
        }

        $account->setCurrencyId($this->currencyId);

        try {
            $this->user->addAccount($account);
        } catch (\LogicException $e) {
            throw new FeatureException(sprintf("Account '%s' already exists", $this->accountName));
        }
    }
}
