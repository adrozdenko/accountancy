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

    public function testAddAccountFailsWhenNameIsNotUnique()
    {
        $this->setExpectedException('\LogicException');

        $account = new Account();
        $account->setName('Not Unique');

        $user = new User();

        $user->addAccount($account);
        $user->addAccount($account);
    }
}
