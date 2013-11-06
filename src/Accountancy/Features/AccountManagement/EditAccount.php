<?php
/**
 * Created by PhpStorm.
 * User: Petro_Svintsitskyi
 * Date: 11/6/13
 * Time: 11:11 PM
 */

namespace Accountancy\Features\AccountManagement;

use Accountancy\Entity\User;
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
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * @param string $newName
     *
     * @return $this
     */
    public function setNewName($newName)
    {
        $this->newName = $newName;

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
        $account = $this->user->findAccount((int) $this->accountId);
        if ($account === false) {
            throw new FeatureException("Account doesn't exist");
        }

        if ($this->user->findAccount((string) $this->newName)) {
            throw new FeatureException(sprintf("Account '%s' already exists", (string) $this->newName));
        }

        try {
            $account->setName($this->newName);
        } catch (\InvalidArgumentException $e) {
            throw new FeatureException("Name of Account can not be empty");
        }
    }
}
