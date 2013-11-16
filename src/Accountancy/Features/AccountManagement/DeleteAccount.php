<?php
/**
 *
 */

namespace Accountancy\Features\AccountManagement;


use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;

/**
 * Class DeleteAccount
 *
 * @package Accountancy\Features\AccountManagement
 */
class DeleteAccount
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
     * @param int $accountId
     *
     * @return $this
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * @param \Accountancy\Entity\User $user
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @throws \Accountancy\Features\FeatureExceptions
     */
    public function run()
    {
        try {
            $this->user->getAccounts()->deleteAccount($this->accountId);
        } catch (\LogicException $e) {
            throw new FeatureException($e->getMessage());
        }
    }
}
