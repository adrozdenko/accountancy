<?php
/**
 *
 */

namespace Accountancy\Features\UserRegistration;

use Accountancy\Entity\User;

/**
 * Class UpdateProfile
 *
 * @package Accountancy\Features\UserRegistration
 */
class UpdateProfile
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected $newName;

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
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Updates personal information
     */
    public function run()
    {
        $this->user->setName($this->newName);
    }
}
