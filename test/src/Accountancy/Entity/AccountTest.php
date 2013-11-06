<?php
/**
 *
 */

namespace Accountancy\Entity;

/**
 * Tests for Account Entity
 *
 * @package Accountancy\Entity
 */
class AccountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Successful scenario
     */
    public function testIncreaseBalance()
    {
        $account = new Account();
        $account->setBalance(0.5);
        $account->increaseBalance(13.48);

        $this->assertEquals(13.98, $account->getBalance());
    }

    /**
     * Increasing balance by negative amount is not acceptable
     */
    public function testIncreaseBalanceAcceptsOnlyPositiveAmount()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $account = new Account();
        $account->increaseBalance(0.0);
    }

    /**
     * Successful scenario
     */
    public function testDecreaseBalance()
    {
        $account = new Account();
        $account->setBalance(14.32);
        $account->decreaseBalance(2.32);

        $this->assertEquals(12.0, $account->getBalance());
    }

    /**
     * Decreasing balance by negative amount is not acceptable
     */
    public function testDecreaseBalanceAcceptsOnlyPositiveAmount()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $account = new Account();
        $account->setBalance(12.45);
        $account->decreaseBalance(0.0);
    }

    /**
     * Balance cant be decreased when it will become negative
     */
    public function testDecreaseBalanceIsNotPermittedWhenBalanceBecomesNegative()
    {
        $this->setExpectedException('\LogicException');

        $account = new Account();
        $account->setBalance(4.0);
        $account->decreaseBalance(20.0);
    }

    /**
     * Name of Account cant be an empty string
     */
    public function testSetNameDoesntAllowEmptyValues()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $account = new Account();
        $account->setName('    ');
    }
}
