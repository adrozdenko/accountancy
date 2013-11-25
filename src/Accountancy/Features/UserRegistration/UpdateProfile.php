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
 * Class UpdateProfile
 *
 * @package Accountancy\Features\UserRegistration
 */
class UpdateProfile implements FeatureInterface
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
     * Updates personal information
     * @param Array $input
     *
     * @throws \Accountancy\Features\FeatureException
     * @return Array
     */
    public function run(Array $input)
    {
        $user = $this->users->findUserById($input['user_id']);

        if (!$user instanceof User) {
            throw new FeatureException('User was not found');
        }

        $user->setName($input['name']);

        $this->users->updateUser($user);

        return array();
    }
}
