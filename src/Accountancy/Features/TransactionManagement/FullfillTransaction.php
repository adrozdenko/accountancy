<?php
/**
 *
 */

namespace Accountancy\Features\TransactionManagement;

use Accountancy\Entity\Category;
use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;

/**
 * Class FullfillTransaction
 *
 * @package Accountancy\Features\TransactionManagement
 */
class FullfillTransaction
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var integer
     */
    protected $accountId;

    /**
     * @var integer
     */
    protected $currencyId;


    /**
     * @var double
     */
    protected $amount = 0.0;

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
     * @param integer $accountId
     *
     * @return $this
     */
    public function setAccountId($accountId)
    {
        $this->accountId = (int) $accountId;

        return $this;
    }

    /**
     * @param double $amount
     */
    public function setAmount($amount)
    {
        $this->amount = (double) $amount;
    }

    /**
     * @param integer $currencyId
     *
     * @return $this
     */
    public function setCurrencyId($currencyId)
    {
        $this->currencyId = (int) $currencyId;

        return $this;
    }

    /**
     * @throws \Accountancy\Features\FeatureException
     */
    public function run()
    {
        $account = $this->user->getAccounts()->findAccountById($this->accountId);

        if (is_null($account)) {
            throw new FeatureException("Account doesn't exist");
        }

        if ($account->getCurrencyId() != $this->currencyId) {
            throw new FeatureException("Currency is't supported by account");
        }

        if ($this->amount <= 0.0) {
            throw new FeatureException("Amount of money should be greater than zero");
        }

        $account->setBalance($this->amount);

        $this->user->getAccounts()->updateAccounts($account);
    }
}
