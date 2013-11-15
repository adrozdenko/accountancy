<?php

/**
 *
 */

use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;

trait UserTrait
{
    /**
     * @Given /^there are registered Users:$/
     */
    public function thereAreRegisteredUsers(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When /^I register using name "([^"]*)" email "([^"]*)" password "([^"]*)"$/
     */
    public function iRegisterUsingNameEmailPassword($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }

    /**
     * @Then /^registered Users should be:$/
     */
    public function registeredUsersShouldBe(TableNode $table)
    {
        throw new PendingException();
    }
}
