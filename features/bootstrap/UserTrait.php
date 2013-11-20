<?php

/**
 *
 */

namespace Accountancy;

use Accountancy\Entity\Collection\UserCollection;
use Accountancy\Entity\User;
use Accountancy\Features\UserRegistration\Authentication;
use Accountancy\Features\UserRegistration\ChangePassword;
use Accountancy\Features\UserRegistration\ForgotPassword;
use Accountancy\Features\UserRegistration\RegisterUser;
use Accountancy\Features\UserRegistration\UpdateProfile;
use Behat\Behat\Event\OutlineExampleEvent;
use Behat\Behat\Exception\BehaviorException;
use Behat\Behat\Exception\ErrorException;
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
     * @var AuthenticationPayloadGeneratorStub
     */
    protected $authenticationPayloadGenerator;

    /**
     * @param TableNode $usersTable
     *
     * @Given /^there are registered Users:$/
     */
    public function thereAreRegisteredUsers(TableNode $usersTable)
    {
        $this->registeredUsers = new UserCollection();
        foreach ($usersTable->getHash() as $row) {
            foreach ($row as $key => $value) {
                $row[$key] = substr($value, 1, -1);
            }

            $newUser = new User();
            if (isset($row['id'])) {
                $newUser->setId($row['id']);
            }
            if (isset($row['email'])) {
                $newUser->setEmail($row['email']);
            }
            if (isset($row['name'])) {
                $newUser->setName($row['name']);
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
        $feature = new RegisterUser();
        $feature->setName($name)
            ->setEmail($email)
            ->setPassword($password)
            ->setUserCollection($this->registeredUsers)
            ->setMailer($this->mailer)
            ->setAuthenticationPayloadGenerator($this->authenticationPayloadGenerator);

        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @param TableNode $usersTable
     *
     * @Then /^registered Users should be:$/
     */
    public function registeredUsersShouldBe(TableNode $usersTable)
    {
        $usersByEmail = array();
        foreach ($this->registeredUsers->getUsers() as $user) {
            $usersByEmail[$user->getEmail()] = $user;
        }

        foreach ($usersTable->getHash() as $row) {
            foreach ($row as $key => $value) {
                $row[$key] = substr($value, 1, -1);
            }

            assertArrayHasKey("email", $row, "'email' field must be present in 'registered Users should be' table");
            assertArrayHasKey($row['email'], $usersByEmail, sprintf("User with email '%s' doesn't exist", $row['email']));
            $user = $usersByEmail[$row['email']];


            if (isset($row['id'])) {
                assertEquals($row['id'], $user->getId(), sprintf("Id does not match for user '%s'", $row['email']));
            }

            if (isset($row['password'])) {
                assertEquals($row['password'], $user->getPassword(), sprintf("Password does not match for user '%s'", $row['email']));
            }

            if (isset($row['name'])) {
                assertEquals($row['name'], $user->getName(), sprintf("Name does not match for user '%s'", $row['name']));
            }

            if (isset($row['is_authenticated'])) {
                assertEquals($row['is_authenticated'] === 'true', $user->isAuthenticated(), sprintf("is_authenticated flag does not match for user '%s'", $row['email']));
            }

            if (isset($row['is_email_verified'])) {
                assertEquals($row['is_email_verified'] === 'true', $user->isEmailVerified(), sprintf("is_email_verified flag does not match for user '%s'", $row['email']));
            }

            if (isset($row['authentication_payload'])) {
                assertEquals($row['authentication_payload'], $user->getAuthenticationPayload(), sprintf("Authentication payload does not match for user '%s'", $row['email']));
            }
        }

        $expected = count($usersTable->getHash());
        $actual = count($usersByEmail);
        assertEquals($expected, $actual, sprintf("Expected %s registered users, got %s", $expected, $actual));
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

        foreach ($row as $key => $value) {
            $row[$key] = substr($value, 1, -1);
        }

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

        if (isset($row['name'])) {
            assertEquals($row['name'], $this->signedInUser->getName(), 'Name doesn\'t match for signed in user');
        }

        if (isset($row['is_authenticated'])) {
            assertEquals($row['is_authenticated'] === 'true', $this->signedInUser->isAuthenticated(), 'Authentication flag doesn\'t match');
        }

        if (isset($row['is_email_verified'])) {
            assertEquals($row['is_email_verified'] === 'true', $this->signedInUser->isEmailVerified(), 'Email verification flag doesn\'t match');
        }

        if (isset($row['authentication_payload'])) {
            assertEquals($row['authentication_payload'], $this->signedInUser->getAuthenticationPayload(), 'Authentication payload doesn\'t match for signed in user');
        }
    }

    /**
     * @param string $authenticationPayload
     *
     * @When /^I sign in using authentication payload "([^"]*)"$/
     */
    public function iSignInUsingAuthenticationPayload($authenticationPayload)
    {
        $feature = new Authentication();

        $feature->setUserCollection($this->registeredUsers)
            ->setAuthenticationPayload($authenticationPayload);

        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }

        $this->signedInUser = $feature->getUser();
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
        $hash = $userTable->getHash();

        $row = $hash[0];

        foreach ($row as $key => $value) {
            $row[$key] = substr($value, 1, -1);
        }

        $this->signedInUser = $this->registeredUsers->findUserByEmail($row['email']);

        if (!$this->signedInUser instanceof User) {
            throw new BehaviorException(sprintf("User '%s' should be registered using 'there are registered users table'", $row['email']));
        }

        if (isset($row['id'])) {
            $this->signedInUser->setId($row['id']);
        }

        if (isset($row['password'])) {
            $this->signedInUser->setPassword($row['password']);
        }

        if (isset($row['email'])) {
            $this->signedInUser->setEmail($row['email']);
        }

        if (isset($row['is_authenticated'])) {
            $this->signedInUser->setAuthenticated($row['is_authenticated'] === 'true');
        }

        if (isset($row['is_email_verified'])) {
            $this->signedInUser->setEmailVerified($row['is_email_verified'] === 'true');
        }
    }

    /**
     * @param string $newPassword
     *
     * @When /^I change my password to "([^"]*)"$/
     */
    public function iChangeMyPasswordTo($newPassword)
    {
        $feature = new ChangePassword();
        $feature->setUser($this->signedInUser)
            ->setNewPassword($newPassword);

        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @param string $emailAddress
     *
     * @When /^I request password reset email for "([^"]*)"$/
     */
    public function iRequestPasswordResetEmailFor($emailAddress)
    {
        $feature = new ForgotPassword();
        $feature->setEmail($emailAddress)
            ->setUsersCollection($this->registeredUsers)
            ->setMailer($this->mailer)
            ->setAuthenticationPayloadGenerator($this->authenticationPayloadGenerator);

        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }

        $this->signedInUser = $feature->getUser();
    }

    /**
     * @param string $authenticationPayload
     *
     * @Then /^authentication payload is created "([^"]*)"$/
     */
    public function authenticationPayloadIsCreated($authenticationPayload)
    {
    }

    /**
     * @param string $authenticationPayload
     *
     * @Given /^authentication payload "([^"]*)" is going to be created$/
     */
    public function authenticationPayloadIsGoingToBeCreated($authenticationPayload)
    {
        $this->authenticationPayloadGenerator = new AuthenticationPayloadGeneratorStub();
        $this->authenticationPayloadGenerator->setPayload($authenticationPayload);
    }


    /**
     * @param string $newName
     *
     * @When /^I update my profile, set name "([^"]*)"$/
     */
    public function iUpdateMyProfileSetName($newName)
    {
        $feature = new UpdateProfile();
        $feature->setUser($this->signedInUser)
            ->setNewName($newName);

        try {
            $feature->run();
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }
}
