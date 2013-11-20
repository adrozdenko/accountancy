<?php
/**
 *
 */

namespace Accountancy\Features\UserRegistration;

use Accountancy\AuthenticationPayloadGeneratorInterface;
use Accountancy\Entity\Collection\UserCollection;
use Accountancy\Entity\User;
use Accountancy\MailerInterface;

/**
 * Class ForgotPassword
 *
 * @package Accountancy\Features\UserRegistration
 */
class ForgotPassword
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var UserCollection
     */
    protected $usersCollection;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var MailerInterface
     */
    protected $mailer;

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
     * @param \Accountancy\Entity\Collection\UserCollection $usersCollection
     *
     * @return $this
     */
    public function setUsersCollection($usersCollection)
    {
        $this->usersCollection = $usersCollection;

        return $this;
    }

    /**
     * @return \Accountancy\Entity\User
     */
    public function getUser()
    {
        return $this->user;
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
     */
    public function run()
    {
        $this->user = $this->usersCollection->findUserByEmail($this->email);

        if (!$this->user instanceof User) {
            return;
        }

        $this->user->setAuthenticationPayload($this->authenticationPayloadGenerator->generateAuthenticationPayload());

        $body = <<<EOF
Dear%s,

Open https://example.com/change-password/%s in your browser to reset your password.

EOF;
        $greeting = "";
        if (trim($this->user->getName()) !== "") {
            $greeting = " " . trim($this->user->getName());
        }

        var_dump($this->user);

        $this->mailer->sendMail($this->user->getEmail(), "Password Reset", sprintf($body, $greeting, $this->user->getAuthenticationPayload()));

    }
}
