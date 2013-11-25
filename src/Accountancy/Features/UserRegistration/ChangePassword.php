<?php
/**
 *
 */

namespace Accountancy\Features\UserRegistration;

use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\UsersGatewayInterface;

/**
 * Class ChangePassword
 *
 * @package Accountancy\Features\UserRegistration
 */
class ChangePassword implements FeatureInterface
{
    /**
     * @var UsersGatewayInterface
     */
    protected $users;

    /**
     * @param \Accountancy\Gateway\UsersGatewayInterface $users
     *
     * @return $this
     */
    public function setUsers(UsersGatewayInterface $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Changes user's password
     *
     * @param Array $input
     *
     * @throws \Accountancy\Features\FeatureException
     * @return Array
     */
    public function run(Array $input)
    {
        $user = $this->users->findUserById($input['user_id']);

        if (!$user instanceof User) {
            throw new FeatureException("User was not found");
        }

        if (trim($input['password']) === "") {
            throw new FeatureException("Password can not be empty");
        }

        if (strlen(trim($input['password'])) < 6) {
            throw new FeatureException("Password should be at least 6 characters long");
        }

        $user->setPassword($input['password']);

        $this->users->updateUser($user);

        return array();
    }
}
