<?php
/**
 *
 */

namespace Accountancy\Features\UserRegistration;

use Accountancy\AuthenticationPayloadGeneratorInterface;
use Accountancy\Entity\User;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\UsersGatewayInterface;
use Accountancy\MailerInterface;

/**
 * Class ForgotPassword
 *
 * @package Accountancy\Features\UserRegistration
 */
class ForgotPassword implements FeatureInterface
{
    /**
     * @var UsersGatewayInterface
     */
    protected $users;

    /**
     * @var MailerInterface
     */
    protected $mailer;

    /**
     * @var AuthenticationPayloadGeneratorInterface
     */
    protected $authenticationPayloadGenerator;

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
     * Tries to find user by email address, creates authentication payload and sends a link to change password form
     * @param Array $input
     *
     * @return Array
     */
    public function run(Array $input)
    {
        $user = $this->users->findUserByEmail($input['email']);

        if (!$user instanceof User) {
            return;
        }

        $user->setAuthenticationPayload($this->authenticationPayloadGenerator->generateAuthenticationPayload());

        $body = <<<EOF
Dear%s,

Open https://example.com/change-password/%s in your browser to reset your password.

EOF;
        $greeting = "";
        if (trim($user->getName()) !== "") {
            $greeting = " " . trim($user->getName());
        }

        $this->mailer->sendMail($user->getEmail(), "Password Reset", sprintf($body, $greeting, $user->getAuthenticationPayload()));

        $this->users->updateUser($user);

        return array();
    }
}
