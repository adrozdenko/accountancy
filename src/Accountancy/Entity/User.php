<?php

/**
 *
 */

namespace Accountancy\Entity;

use Accountancy\Entity\Collection\AccountCollection;
use Accountancy\Entity\Collection\CategoryCollection;
use Accountancy\Entity\Collection\CounterpartyCollection;

/**
 * User Entity
 */
class User
{
    protected $accounts;

    protected $categories;

    protected $counterparties;

    /**
     * @param AccountCollection $accounts
     *
     * @return User
     */
    public function setAccounts(AccountCollection $accounts)
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * @return AccountCollection
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param CategoryCollection $categories
     *
     * @return $this
     */
    public function setCategories(CategoryCollection $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return CategoryCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param CounterpartyCollection $counterparties
     *
     * @return $this
     */
    public function setCounterparties(CounterpartyCollection $counterparties)
    {
        $this->counterparties = $counterparties;

        return $this;
    }

    /**
     * @return CounterpartyCollection
     */
    public function getCounterparties()
    {
        return $this->counterparties;
    }
}
