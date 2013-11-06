<?php

/**
 *
 */

namespace Accountancy\Entity;

/**
 * Tests for User Entity
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Successful scenario
     */
    public function testAddAccount()
    {
        $account1 = new Account();
        $account1->setId(1)
            ->setName("Account #1");

        $account2 = new Account();
        $account2->setId(2)
            ->setName("Account #2");

        $user = new User();
        $this->assertEquals(array(), $user->getAccounts());

        $user->addAccount($account1);
        $this->assertEquals(array($account1), $user->getAccounts());

        $user->addAccount($account2);
        $this->assertEquals(array($account1, $account2), $user->getAccounts());
    }

    /**
     * Account name should be unique per user
     */
    public function testAddAccountFailsWhenNameIsNotUnique()
    {
        $this->setExpectedException('\LogicException');

        $account = new Account();
        $account->setName('Not Unique');

        $user = new User();

        $user->addAccount($account);
        $user->addAccount($account);
    }

    /**
     * Successful scenario
     */
    public function testDeleteAccount()
    {
        $user = new User;
        $user->setAccounts(array(
            (new Account)
                ->setId(1)
                ->setName("Account #1"),
            (new Account)
                ->setId(2)
                ->setName("Account #2"),
            (new Account)
                ->setId(3)
                ->setName("Account #3"),
        ));

        $user->deleteAccount(2);

        $this->assertEquals(array(
            (new Account)
                ->setId(1)
                ->setName("Account #1"),
            (new Account)
                ->setId(3)
                ->setName("Account #3"),
        ), array_values($user->getAccounts()));
    }

    /**
     * Should fail when input is invalid
     */
    public function testDeleteAccountThrowsExceptionWhenAccountDoesntExist()
    {
        $this->setExpectedException('\LogicException');

        $user = new User;

        $user->setAccounts(array(
            (new Account)
                ->setId(1)
                ->setName("Account #1"),
            (new Account)
                ->setId(2)
                ->setName("Account #2"),
            (new Account)
                ->setId(3)
                ->setName("Account #3"),
        ));

        $user->deleteAccount(40);
    }

    /**
     * Should be able to find accounts by Id, name or Account
     */
    public function testFindAccountAcceptsIdNameOrAccount()
    {
        $user = new User;

        $user->setAccounts(array(
            (new Account)
                ->setId(1)
                ->setName("Account #1"),
            (new Account)
                ->setId(2)
                ->setName("Account #2"),
            (new Account)
                ->setId(3)
                ->setName("Account #3"),
        ));

        $this->assertEquals(
            (new Account)
                ->setId(3)
                ->setName("Account #3"),
            $user->findAccount(3)
        );

        $this->assertEquals(
            (new Account)
                ->setId(2)
                ->setName("Account #2"),
            $user->findAccount("Account #2")
        );

        $this->assertEquals(
            (new Account)
                ->setId(1)
                ->setName("Account #1"),
            $user->findAccount(
                (new Account)
                    ->setId(1)
                    ->setName("Account #1")
            )
        );

        $this->assertFalse($user->findAccount(150));
        $this->assertFalse($user->findAccount("Foo"));
        $this->assertFalse($user->findAccount(
            (new Account)
                ->setId(20)
                ->setName("Bar")
        ));
    }
}
