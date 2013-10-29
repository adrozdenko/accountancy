<?php

/**
 *
 */

namespace Accountancy\Features\FundsFlow;

/**
 * Class for register expense scenario
 */
class RegisterExpense
{
    protected $user;

    /**
    * Sets the User for which expense will be registered
    * @param \Accountancy\Entity\User $user
    *
    * @return RegisterExpense
    */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Registers income for account
     *
     * @param string $accountFromId
     * @param string $accountToId
     * @param double $value
     */
    public function registerExpense($accountFromId, $accountToId, $value)
    {
        $this->user->accounts[$accountToId]->credit += $value;
        $this->user->accounts[$accountFromId]->debit += $value;
        $this->user->accounts[$accountFromId]->credit -= $value;
    }
}
