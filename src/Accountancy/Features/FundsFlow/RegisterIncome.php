<?php

/**
 *
 */

namespace Accountancy\Features\FundsFlow;

/**
 * Class for register income scenario
 */
class RegisterIncome
{
    protected $user;

    /**
     * Sets the User for which income will be registered
     * @param \Accountancy\Entity\User $user
     *
     * @return RegisterIncome
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Registers income for account
     *
     * @param string $accountId
     * @param double $value
     */
    public function registerIncome($accountId, $value)
    {
        $this->user->accounts[$accountId]->credit += $value;
    }
}
