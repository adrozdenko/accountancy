<?php
/**
 *
 */

namespace Accountancy\Features\UserRegistration;

use Accountancy\AuthenticationPayloadGeneratorInterface;
use Accountancy\Entity\Collection\UserCollection;
use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;
use Accountancy\MailerInterface;

/**
 * Class RegisterUser
 *
 * @package Accountancy\Features\UserRegistration
 */
class RegisterUser
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var MailerInterface
     */
    protected $mailer;

    /**
     * @var UserCollection
     */
    protected $userCollection;

    /**
     * @var AuthenticationPayloadGeneratorInterface
     */
    protected $authenticationPayloadGenerator;

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
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * @param \Accountancy\AuthenticationPayloadGeneratorInterface $authenticationPayloadGenerator
     *
     * @return $this
     */
    public function setAuthenticationPayloadGenerator($authenticationPayloadGenerator)
    {
        $this->authenticationPayloadGenerator = $authenticationPayloadGenerator;

        return $this;
    }

    /**
     * @param \Accountancy\MailerInterface $mailer
     *
     * @return $this
     */
    public function setMailer($mailer)
    {
        $this->mailer = $mailer;

        return $this;
    }


    /**
     * Registers new user
     *
     * @throws \Accountancy\Features\FeatureException
     */
    public function run()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new FeatureException('Email address is invalid');
        }

        if (trim($this->password) === "") {
            throw new FeatureException('Password can not be empty');
        }

        if (strlen(trim($this->password)) < 6) {
            throw new FeatureException("Password should be at least 6 characters long");
        }

        $user = new User();
        $user->setName($this->name);
        $user->setEmail($this->email);
        $user->setPassword($this->password);
        $user->setAuthenticationPayload($this->authenticationPayloadGenerator->generateAuthenticationPayload());

        $body = <<<EOF
Dear%s,
Welcome to Home Accountancy

Your email address needs to be verified.
Please open https://example.com/verify-email/%s in your browser to verify your email address.

Best Regards,

EOF;
        $greeting = "";
        if (trim($user->getName()) !== "") {
            $greeting = " " . trim($user->getName());
        }

        $this->mailer->sendMail($user->getEmail(), "Welcome to Home Accountancy", sprintf($body, $greeting, $user->getAuthenticationPayload()));

        $this->userCollection->addUser($user);
    }
}
