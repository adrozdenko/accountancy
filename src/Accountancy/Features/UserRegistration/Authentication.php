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
 * Class Authentication
 *
 * @package Accountancy\Features\UserRegistration
 */
class Authentication implements FeatureInterface
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
     * @param string $authenticationPayload
     */
    public function setAuthenticationPayload($authenticationPayload)
    {
        $this->authenticationPayload = $authenticationPayload;
    }

    /**
     * Performs authentication by email/password or authentication payload
     *
     * @param Array $input
     *
     * @throws \LogicException
     * @throws \Accountancy\Features\FeatureException
     * @return Array
     */
    public function run(Array $input)
    {
        if (isset($input['email']) && isset($input['password'])) {
            $user = $this->users->findUserByEmailAndPassword($input['email'], $input['password']);

            if (!$user instanceof User) {
                throw new FeatureException("Invalid email or password");
            }

            if (!$user->isEmailVerified()) {
                $user = null;
                throw new FeatureException("Your email address has not yet been verified. Please check your email and follow the URL provided in it.");
            }

            return array(
                'signed_in_user_id' => $user->getId(),
            );
        }

        if (isset($input['authentication_payload'])) {
            if (trim($input['authentication_payload']) === "") {
                throw new FeatureException("Verification code is not valid");
            }

            $user = $this->users->findUserByAuthenticationPayload($input['authentication_payload']);

            if (!$user instanceof User) {
                throw new FeatureException("Verification code is not valid");
            }

            $user->setAuthenticationPayload("");
            $user->setEmailVerified(true);

            $this->users->updateUser($user);

            return array(
                'signed_in_user_id' => $user->getId(),
            );
        }

        throw new \LogicException("Either authentication payload or email and password should be set");
    }
}
