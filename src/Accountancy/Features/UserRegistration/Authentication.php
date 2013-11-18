<?php
/**
 *
 */

namespace Accountancy\Features\UserRegistration;


use Accountancy\Entity\Collection\UserCollection;
use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;

/**
 * Class Authentication
 *
 * @package Accountancy\Features\UserRegistration
 */
class Authentication
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var UserCollection
     */
    protected $userCollection;

    /**
     * @var User
     */
    protected $user;

    /**
     * @return \Accountancy\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \Accountancy\Entity\Collection\UserCollection $userCollection
     *
     * @return $this
     */
    public function setUserCollection($userCollection)
    {
        $this->userCollection = $userCollection;

        return $this;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Performs authentication by email/password or authentication payload
     */
    public function run()
    {
        $this->user = $this->userCollection->findUserByEmailAndPassword($this->email, $this->password);

        if (!$this->user instanceof User) {
            throw new FeatureException("Invalid email or password");
        }

        if (!$this->user->isEmailVerified()) {
            $this->user = null;
            throw new FeatureException("Your email address has not yet been verified. Please check your email and follow the URL provided in it.");
        }

        $this->user->setAuthenticated(true);

    }
}
