<?php

/**
 *
 */

namespace Accountancy\Features;

use Accountancy\Entity\User;

/**
 * Class for Income Registration feature
 */
class RegisterIncome
{
    protected $user;

    /**
     * Sets User entity
     *
     * @param \Accountancy\Entity\User $user
     *
     * @return \Accountancy\Features\RegisterIncome
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Registers income for given User
     *
     * @param float $value
     * @param int   $categoryId
     */
    public function registerIncome($value, $categoryId)
    {
        $this->user->balance += $value;
    }
}
