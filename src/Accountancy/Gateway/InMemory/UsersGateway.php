<?php
/**
 *
 */

namespace Accountancy\Gateway\InMemory;

use Accountancy\Entity\User;
use Accountancy\Gateway\UsersGatewayInterface;

/**
 * In-Memory implementation of a gateway
 *
 * @package Accountancy\Gateway\InMemory
 */
class UsersGateway implements UsersGatewayInterface
{
    protected $users = array();

    /**
     * @param string $email
     *
     * @return User|null
     */
    public function findUserByEmail($email)
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return clone $user;
            }
        }
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function addUser(User $user)
    {
        $id = count($this->users) + 1;
        $user->setId($id);
        $this->users[$id] = $user;

        return $this;
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return User|null
     */
    public function findUserByEmailAndPassword($email, $password)
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email && $user->getPassword() === $password) {
                return clone $user;
            }
        }
    }

    /**
     * @param string $authenticationPayload
     *
     * @return User|null
     */
    public function findUserByAuthenticationPayload($authenticationPayload)
    {
        foreach ($this->users as $user) {
            if ($user->getAuthenticationPayload() === $authenticationPayload) {
                return clone $user;
            }
        }
    }

    /**
     * @param int $id
     *
     * @return User|null
     */
    public function findUserById($id)
    {
        foreach ($this->users as $user) {
            if ($user->getId() === (int) $id) {
                return clone $user;
            }
        }
    }

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function updateUser(User $user)
    {
        $id = (int) $user->getId();

        if ($id === 0) {
            throw new \LogicException("User doesn't exist");
        }

        $this->users[$id] = $user;
    }
}
