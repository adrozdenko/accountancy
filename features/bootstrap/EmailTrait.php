<?php

/**
 *
 */

namespace Accountancy;

use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;

trait EmailTrait
{
    /**
     * @var MailerStub
     */
    protected $mailer;

    /**
     * @param string       $emailAddress
     * @param string       $title
     * @param string       $greeting
     * @param string       $authenticationPayload
     * @param PyStringNode $body
     *
     * @Given /^notification email is sent to "([^"]*)" with title "([^"]*)" and greeting "([^"]*)" and authentication payload "([^"]*)" and body:$/
     */
    public function notificationEmailIsSentToWithTitleAndGreetingAndAuthenticationPayloadAndBody($emailAddress, $title, $greeting, $authenticationPayload, PyStringNode $body)
    {
        $body = strtr($body, array(
            ":GREETING:"               => $greeting,
            ":AUTHENTICATION-PAYLOAD:" => $authenticationPayload,
        ));

        assertEquals($emailAddress, $this->mailer->getTo(), "Email address doesn't match in mailer");
        assertEquals($title, $this->mailer->getTitle(), "Email title doesn't match in mailer");
        assertEquals((string) $body, $this->mailer->getBody(), "Email body doesn't match in mailer");
    }


    /**
     * @param string       $emailAddress
     * @param string       $title
     * @param PyStringNode $body
     *
     * @Given /^notification email is sent to "([^"]*)" with title "([^"]*)" and body:$/
     */
    public function notificationEmailIsSentToWithTitleAndBody($emailAddress, $title, PyStringNode $body)
    {
        assertEquals($emailAddress, $this->mailer->getTo(), "Email address doesn't match in mailer");
        assertEquals($title, $this->mailer->getTitle(), "Email title doesn't match in mailer");
        assertEquals((string) $body, $this->mailer->getBody(), "Email body doesn't match in mailer");
    }

    /**
     * @Given /^notification email should not be sent$/
     */
    public function notificationEmailShouldNotBeSent()
    {
        assertFalse($this->mailer->isMailSent(), "Mail should not be sent");
    }
}
