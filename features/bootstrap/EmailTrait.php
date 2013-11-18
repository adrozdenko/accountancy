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
     * @param string $emailAddress
     * @param string $title
     *
     * @Given /^notification email is sent to "([^"]*)" with title "([^"]*)"$/
     */
    public function notificationEmailIsSentToWithTitle($emailAddress, $title)
    {
        throw new PendingException();
    }

    /**
     * @param PyStringNode $body
     *
     * @Given /^notification email contains the following text:$/
     */
    public function notificationEmailContainsTheFollowingText(PyStringNode $body)
    {
        throw new PendingException();
    }

}
