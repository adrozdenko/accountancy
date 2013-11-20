<?php
/**
 *
 */

namespace Accountancy\Features\UserRegistration;

use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;

/**
 * Class ChangePassword
 *
 * @package Accountancy\Features\UserRegistration
 */
class ChangePassword
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected $newPassword;

    /**
     * @param string $newPassword
     *
     * @return $this
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;

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
     * Changes user's password
     */
    public function run()
    {
        if (trim($this->newPassword) === "") {
            throw new FeatureException("Password can not be empty");
        }

        if (strlen(trim($this->newPassword)) < 6) {
            throw new FeatureException("Password should be at least 6 characters long");
        }

        $this->user->setPassword($this->newPassword);
    }
}
