<?php

/**
 *
 */

namespace Accountancy;

use Accountancy\Entity\Collection\UserCollection;
use Accountancy\Entity\User;
use Accountancy\Features\UserRegistration\Authentication;
use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;

trait UserTrait
{
    /**
     * @var UserCollection
     */
    protected $registeredUsers;

    /**
     * @var User
     */
    protected $signedInUser;

    /**
     * @param TableNode $usersTable
     *
     * @Given /^there are registered Users:$/
     */
    public function thereAreRegisteredUsers(TableNode $usersTable)
    {
        $this->registeredUsers = new UserCollection();
        foreach ($usersTable->getHash() as $row) {
            $newUser = new User();
            if (isset($row['id'])) {
                $newUser->setId($row['id']);
            }
            if (isset($row['email'])) {
                $newUser->setEmail($row['email']);
            }
            if (isset($row['password'])) {
                $newUser->setPassword($row['password']);
            }
            if (isset($row['is_authenticated'])) {
                $newUser->setAuthenticated($row['is_authenticated'] === "true");
            }
            if (isset($row['is_email_verified'])) {
                $newUser->setEmailVerified($row['is_email_verified'] === "true");
            }
            if (isset($row['authentication_payload'])) {
                $newUser->setAuthenticationPayload($row['authentication_payload']);
            }
            $this->registeredUsers->addUser($newUser);
        }
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
        $feature = new Authentication();

        $feature->setUserCollection($this->registeredUsers)
            ->setEmail($email)
            ->setPassword($password);

        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }

        $this->signedInUser = $feature->getUser();
    }

    /**
     * @param TableNode $userTable
     *
     * @Then /^I become a User with the following properties:$/
     */
    public function iBecomeAUserWithTheFollowingProperties(TableNode $userTable)
    {
        $hash = $userTable->getHash();

        $row = $hash[0];

        assertInstanceOf('\\Accountancy\\Entity\\User', $this->signedInUser, 'User wasn\'t signed in');

        if (isset($row['id'])) {
            assertEquals($row['id'], $this->signedInUser->getId(), 'Id doesn\'t match for signed in user');
        }

        if (isset($row['password'])) {
            assertEquals($row['password'], $this->signedInUser->getPassword(), 'Password doesn\'t match for signed in user');
        }

        if (isset($row['email'])) {
            assertEquals($row['email'], $this->signedInUser->getEmail(), 'Email doesn\'t match for signed in user');
        }

        if (isset($row['is_authenticated'])) {
            assertEquals($row['is_authenticated'] === 'true', $this->signedInUser->isAuthenticated(), 'Authentication flag doesn\'t match');
        }

        if (isset($row['is_email_verified'])) {
            assertEquals($row['is_email_verified'] === 'true', $this->signedInUser->isEmailVerified(), 'Email verification flag doesn\'t match');
        }

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
        assertNotInstanceOf('\\Accountancy\\Entity\\User', $this->signedInUser);
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
