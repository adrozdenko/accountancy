<?php

/**
 *
 */

use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;

trait EmailTrait
{
    /**
     * @Given /^notification email is sent to "([^"]*)" with title "([^"]*)"$/
     */
    public function notificationEmailIsSentToWithTitle($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given /^notification email contains the following text:$/
     */
    public function notificationEmailContainsTheFollowingText(PyStringNode $string)
    {
        throw new PendingException();
    }

}
