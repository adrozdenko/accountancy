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
	* Sets the User for which income will be registered
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
     * Registers expense for account
     *
     * @param string $accountId
     * @param double $value
     */
    public function registerExpense($accountId, $value)
    {
        $this->user->accounts[$accountId]->debit = $value;
    }
}
