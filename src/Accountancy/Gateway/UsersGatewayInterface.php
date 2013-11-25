<?php
/**
 *
 */

namespace Accountancy\Gateway;

use Accountancy\Entity\User;

/**
 * Interface UsersGatewayInterface
 *
 * @package Accountancy\Gateway
 */
interface UsersGatewayInterface
{
    /**
     * @param string $email
     *
     * @return User|null
     */
    public function findUserByEmail($email);

    /**
     * @param User $user
     *
     * @return $this
     */
    public function addUser(User $user);

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function updateUser(User $user);

    /**
     * @param string $email
     * @param string $password
     *
     * @return User|null
     */
    public function findUserByEmailAndPassword($email, $password);

    /**
     * @param string $authenticationPayload
     *
     * @return User|null
     */
    public function findUserByAuthenticationPayload($authenticationPayload);

    /**
     * @param int $id
     *
     * @return User|null
     */
    public function findUserById($id);
}
