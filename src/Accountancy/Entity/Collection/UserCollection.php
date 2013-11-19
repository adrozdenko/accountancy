<?php
/**
 *
 */

namespace Accountancy\Entity\Collection;

use Accountancy\Entity\User;

/**
 * Class UserCollection
 *
 * @package Accountancy\Entity\Collection
 */
class UserCollection
{
    /**
     * @var Array
     */
    protected $users = array();

    /**
     * @param Array $users
     *
     * @return $this
     */
    public function setUsers($users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Array
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

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
                return $user;
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
                return $user;
            }
        }
    }
}
