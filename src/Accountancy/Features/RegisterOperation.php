<?php

/**
 *
 */

namespace Accountancy\Features;

use Accountancy\Entity\User;
use Accountancy\Entity\Operation;

/**
 * Class for Operation Registration feature
 */
class RegisterOperation
{
    protected $user;
    protected $operation;

    /**
     * Sets User entity
     *
     * @param \Accountancy\Entity\User $user
     *
     * @return \Accountancy\Features\RegisterOperation
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Sets Operation entity
     *
     * @param \Accountancy\Entity\Operation $operation
     *
     * @return \Accountancy\Features\RegisterOperation
     */
    public function setOperation(Operation $operation)
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * Registers operation for given user
     *
     * @return void
     */
    public function register()
    {
        $this->user->registerOperation($this->operation);
    }
}
