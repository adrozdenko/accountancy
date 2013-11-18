<?php

/**
 *
 */

namespace Accountancy;

use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;

trait UserTrait
{
    /**
     * @param TableNode $usersTable
     *
     * @Given /^there are registered Users:$/
     */
    public function thereAreRegisteredUsers(TableNode $usersTable)
    {
        throw new PendingException();
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     *
     * @When /^I register using name "([^"]*)" email "([^"]*)" password "([^"]*)"$/
     */
    public function iRegisterUsingNameEmailPassword($name, $email, $password)
    {
        throw new PendingException();
    }

    /**
     * @param TableNode $usersTable
     *
     * @Then /^registered Users should be:$/
     */
    public function registeredUsersShouldBe(TableNode $usersTable)
    {
        throw new PendingException();
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @When /^I sign in using email "([^"]*)" and password "([^"]*)"$/
     */
    public function iSignInUsingEmailAndPassword($email, $password)
    {
        throw new PendingException();
    }

    /**
     * @param TableNode $userTable
     *
     * @Then /^I become a User with the following properties:$/
     */
    public function iBecomeAUserWithTheFollowingProperties(TableNode $userTable)
    {
        throw new PendingException();
    }

    /**
     * @param string $authenticationPayload
     *
     * @When /^I sign in using authentication payload "([^"]*)"$/
     */
    public function iSignInUsingAuthenticationPayload($authenticationPayload)
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
     * @param TableNode $userTable
     *
     * @Given /^I am a User with the following properties:$/
     */
    public function iAmAUserWithTheFollowingProperties(TableNode $userTable)
    {
        throw new PendingException();
    }

    /**
     * @param string $newPassword
     *
     * @When /^I change my password to "([^"]*)"$/
     */
    public function iChangeMyPasswordTo($newPassword)
    {
        throw new PendingException();
    }

    /**
     * @param string $emailAddress
     *
     * @When /^I request password reset email for "([^"]*)"$/
     */
    public function iRequestPasswordResetEmailFor($emailAddress)
    {
        throw new PendingException();
    }

    /**
     * @param string $authenticationPayload
     *
     * @Then /^authentication payload is created "([^"]*)"$/
     */
    public function authenticationPayloadIsCreated($authenticationPayload)
    {
        throw new PendingException();
    }

    /**
     * @param string $newName
     *
     * @When /^I update my profile, set name "([^"]*)"$/
     */
    public function iUpdateMyProfileSetName($newName)
    {
        throw new PendingException();
    }
}
