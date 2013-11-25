<?php
/**
 *
 */

namespace Accountancy;

use Behat\Behat\Context\BehatContext;

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    use AccountTrait, CurrencyTrait, CategoryTrait, CounterpartyTrait, UserTrait, EmailTrait, TransactionTrait;

    /**
     * @var \Accountancy\Features\FeatureException
     */
    protected $lastException;


    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
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
        assertNotInstanceOf('\Exception', $this->lastException, (string) $this->lastException);
    }
}
