<?php
/**
 *
 */

namespace Accountancy\Features\AccountManagement;

use Accountancy\Entity\Account;
use Accountancy\Features\FeatureException;
use Accountancy\Features\FeatureInterface;
use Accountancy\Gateway\AccountsGatewayInterface;
use Accountancy\Gateway\CurrenciesGatewayInterface;

/**
 * Class CreateAccount
 *
 * @package Accountancy\Features\AccountManagement
 */
class CreateAccount implements FeatureInterface
{
    /**
     * @var CurrenciesGatewayInterface
     */
    protected $currencies;

    /**
     * @var AccountsGatewayInterface
     */
    protected $accounts;

    /**
     * @param \Accountancy\Gateway\CurrenciesGatewayInterface $currencies
     *
     * @return $this
     */
    public function setCurrencies(CurrenciesGatewayInterface $currencies)
    {
        $this->currencies = $currencies;

        return $this;
    }

    /**
     * @param AccountsGatewayInterface $accounts
     *
     * @return $this
     */
    public function setAccounts(AccountsGatewayInterface $accounts)
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * @param array $input
     *
     * @throws \Accountancy\Features\FeatureException
     *
     * @return Array
     */
    public function run(Array $input)
    {
        if (trim($input['account_name']) == '') {
            throw new FeatureException("Name of Account can not be empty");
        }

        if ($this->accounts->findAccountByUserIdAndName($input['user_id'], $input['account_name'])) {
            throw new FeatureException(sprintf("Account '%s' already exists", $input['account_name']));
        }

        if (!$this->currencies->hasCurrency($input['currency_id'])) {
            throw new FeatureException("Invalid currency provided");
        }

        $account = new Account();

        $account->setUserId($input['user_id']);
        $account->setName($input['account_name']);
        $account->setCurrencyId($input['currency_id']);

        $this->accounts->addAccount($account);

        return array('id' => $account->getId());
    }
}
