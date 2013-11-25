<?php

/**
 *
 */

namespace Accountancy;

use Accountancy\Entity\User;
use Accountancy\Features\UserRegistration\Authentication;
use Accountancy\Features\UserRegistration\ChangePassword;
use Accountancy\Features\UserRegistration\ForgotPassword;
use Accountancy\Features\UserRegistration\RegisterUser;
use Accountancy\Features\UserRegistration\UpdateProfile;
use Accountancy\Gateway\InMemory\UsersGateway;
use Accountancy\Gateway\UsersGatewayInterface;
use Behat\Gherkin\Node\TableNode;

trait UserTrait
{
    /**
     * @var UsersGatewayInterface
     */
    protected $users;

    /**
     * @var int
     */
    protected $signedInUserId;

    /**
     * @var AuthenticationPayloadGeneratorStub
     */
    protected $authenticationPayloadGenerator;

    /**
     * @return \Accountancy\UsersGatewayInterface
     */
    public function getUsersGateway()
    {
        if ($this->users === null) {
            $this->users = new UsersGateway();
        }

        return $this->users;
    }

    /**
     * @param TableNode $usersTable
     *
     * @Given /^there are registered Users:$/
     */
    public function thereAreRegisteredUsers(TableNode $usersTable)
    {
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
            $this->getUsersGateway()->addUser($newUser);
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
        $feature->setUsers($this->getUsersGateway())
            ->setMailer($this->mailer)
            ->setAuthenticationPayloadGenerator($this->authenticationPayloadGenerator);

        try {
            $output = $feature->run(array(
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @Given /^I\'m not signed in$/
     */
    public function iMNotSignedIn()
    {
        $this->signedInUserId = null;
    }

    /**
     * @param integer $userId
     *
     * @Given /^I become signed in User with Id "([^"]*)"$/
     */
    public function iBecomeSignedInUserWithId($userId)
    {
        assertEquals($userId, $this->signedInUserId, "User was not signed in");
    }

    /**
     * @param TableNode $usersTable
     *
     * @Then /^registered Users should be:$/
     */
    public function registeredUsersShouldBe(TableNode $usersTable)
    {
        foreach ($usersTable->getHash() as $row) {
            foreach ($row as $key => $value) {
                $row[$key] = substr($value, 1, -1);
            }

            assertArrayHasKey("email", $row, "'email' field must be present in 'registered Users should be' table");
            $user = $this->getUsersGateway()->findUserByEmail($row['email']);
            assertInstanceOf("\\Accountancy\\Entity\\User", $user, sprintf("User with email '%s' doesn't exist", $row['email']));


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

        $feature->setUsers($this->getUsersGateway());

        try {
            $output = $feature->run(array(
                'email' => $email,
                'password' => $password,
            ));
            $this->signedInUserId = $output['signed_in_user_id'];
        } catch (\Exception $e) {
            $this->lastException = $e;
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

        $feature->setUsers($this->getUsersGateway())
            ->setAuthenticationPayload($authenticationPayload);

        try {
            $output = $feature->run(array(
                'authentication_payload' => $authenticationPayload,
            ));
            $this->signedInUserId = $output['signed_in_user_id'];
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @Then /^I should not become an authenticated User$/
     */
    public function iShouldNotBecomeAnAuthenticatedUser()
    {
        assertNull($this->signedInUserId, "User should not be signed in");
    }

    /**
     * @param string $newPassword
     *
     * @When /^I change my password to "([^"]*)"$/
     */
    public function iChangeMyPasswordTo($newPassword)
    {
        $feature = new ChangePassword();
        $feature->setUsers($this->getUsersGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'password' => $newPassword,
            ));
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
        $feature->setUsers($this->getUsersGateway())
            ->setMailer($this->mailer)
            ->setAuthenticationPayloadGenerator($this->authenticationPayloadGenerator);

        try {
            $output = $feature->run(array(
                'email' => $emailAddress,
            ));

            $this->signedInUserId = $output['signed_in_user_id'];
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
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
        $feature->setUsers($this->getUsersGateway());

        try {
            $output = $feature->run(array(
                'user_id' => $this->signedInUserId,
                'name' => $newName,
            ));
        } catch (\Exception $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @param int $userId
     *
     * @Given /^I am signed in as User with Id "([^"]*)"$/
     */
    public function iAmSignedInAsUserWithId($userId)
    {
        $this->signedInUserId = $userId;
    }

}
