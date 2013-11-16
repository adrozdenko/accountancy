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

  /**
     * @When /^I sign in using email "([^"]*)" and password "([^"]*)"$/
     */
    public function iSignInUsingEmailAndPassword($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I become a User with the following properties:$/
     */
    public function iBecomeAUserWithTheFollowingProperties(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When /^I sign in using authentication payload "([^"]*)"$/
     */
    public function iSignInUsingAuthenticationPayload($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should not become an authenticated User$/
     */
    public function iShouldNotBecomeAnAuthenticatedUser()
    {
        throw new PendingException();
    }

    /**
     * @Given /^I am a User with the following properties:$/
     */
    public function iAmAUserWithTheFollowingProperties(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When /^I change my password to "([^"]*)"$/
     */
    public function iChangeMyPasswordTo($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When /^I request password reset email for "([^"]*)"$/
     */
    public function iRequestPasswordResetEmailFor($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^authentication payload is created "([^"]*)"$/
     */
    public function authenticationPayloadIsCreated($arg1)
    {
        throw new PendingException();
    }
}
