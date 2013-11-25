<?php
/**
 *
 */

namespace Accountancy\Features\UserRegistration;

use Accountancy\AuthenticationPayloadGeneratorInterface;
use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\UsersGatewayInterface;
use Accountancy\MailerInterface;

/**
 * Class RegisterUser
 *
 * @package Accountancy\Features\UserRegistration
 */
class RegisterUser implements FeatureInterface
{
    /**
     * @var MailerInterface
     */
    protected $mailer;

    /**
     * @var AuthenticationPayloadGeneratorInterface
     */
    protected $authenticationPayloadGenerator;

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
     * @param Array $input
     *
     * @throws \Accountancy\Features\FeatureException
     * @return Array
     */
    public function run(Array $input)
    {
        if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            throw new FeatureException('Email address is invalid');
        }

        if (trim($input['password']) === "") {
            throw new FeatureException('Password can not be empty');
        }

        if (strlen(trim($input['password'])) < 6) {
            throw new FeatureException("Password should be at least 6 characters long");
        }

        $user = new User();
        $user->setName($input['name']);
        $user->setEmail($input['email']);
        $user->setPassword($input['password']);
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

        $this->users->addUser($user);

        return array();
    }
}
