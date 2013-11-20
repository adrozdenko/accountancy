<?php
/**
 *
 */

namespace Accountancy;

use Accountancy\Entity\Collection\AccountCollection;
use Accountancy\Entity\Collection\CategoryCollection;
use Accountancy\Entity\Collection\CounterpartyCollection;
use Accountancy\Entity\Collection\CurrencyCollection;
use Accountancy\Entity\User;
use Behat\Behat\Context\BehatContext;

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    use AccountTrait, CurrencyTrait, CategoryTrait, CounterpartyTrait, UserTrait, EmailTrait, TransactionTrait;

    /**
     * @var Accountancy\Entity\User
     */
    protected $user;

    /**
     * @var \Accountancy\Features\FeatureException
     */
    protected $lastException;

    /**
     * @var CurrencyCollection
     */
    protected $currencyCollection;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->user = new User();
        $this->user->setAccounts(new AccountCollection());
        $this->user->setCategories(new CategoryCollection());
        $this->user->setCounterparties(new CounterpartyCollection());
        $this->currencyCollection = new CurrencyCollection();

        $this->mailer = new MailerStub();
    }

    /**
     * @param string $errorMessage
     *
     * @Then /^I should receive "([^"]*)" error$/
     */
    public function iShouldReceiveError($errorMessage)
    {
        if (!$this->lastException instanceof \Accountancy\Features\FeatureException) {
            echo (string) $this->lastException;
        }

        assertInstanceOf('\Accountancy\Features\FeatureException', $this->lastException, 'I should Receive an Error');
        assertEquals($errorMessage, $this->lastException->getMessage());
        $this->lastException = null;
    }

    /**
     * @Then /^I should not receive any error$/
     */
    public function iShouldNotReceiveAnyError()
    {
        throw new PendingException();
    }
}
