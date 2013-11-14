<?php

/**
 *
 */

namespace Accountancy\Entity;

use Accountancy\Entity\Account;
use Accountancy\Entity\Counterparty;

/**
 * User Entity
 */
class User
{
    protected $accounts = array();

    protected $categories = array();

    protected $counterparties = array();

    /**
     * @param array $accounts
     *
     * @return User
     */
    public function setAccounts(Array $accounts)
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * @return Array
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param integer $accountId
     *
     * @return Account|null
     */
    public function findAccountById($accountId)
    {
        foreach ($this->accounts as $account) {

            if ($account->getId() === $accountId) {
                return $account;
            }
        }

        return null;
    }

    /**
     * @param string $accountName
     *
     * @return Account|null
     */
    public function findAccountByName($accountName)
    {
        foreach ($this->accounts as $account) {

            if ($account->getName() === $accountName) {
                return $account;
            }
        }

        return null;
    }

    /**
     * @param Account $account
     *
     * @throws \LogicException
     * @return $this
     */
    public function addAccount(Account $account)
    {
        $this->accounts[] = $account;

        return $this;
    }

    /**
     * @param int $accountId
     *
     * @throws \LogicException
     * @return $this
     */
    public function deleteAccount($accountId)
    {
        $deleted = false;

        foreach ($this->accounts as $index => $account) {
            if ($account->getId() === (int) $accountId) {
                unset($this->accounts[$index]);
                $deleted = true;
                break;
            }
        }

        if (!$deleted) {
            throw new \LogicException("Account doesn't exist");
        }

        return $this;
    }

    /**
     * @param Array $categories
     *
     * @return $this
     */
    public function setCategories(Array $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param Category $category
     *
     * @return $this
     */
    public function addCategory(Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * @param integer $categoryId
     *
     * @return null|Category
     */
    public function findCategoryById($categoryId)
    {
        foreach ($this->categories as $category) {

            if ($category->getId() === $categoryId) {
                return $category;
            }
        }

        return null;
    }

    /**
     * @param string $categoryName
     *
     * @return null|Category
     */
    public function findCategoryByName($categoryName)
    {

        foreach ($this->categories as $category) {

            if ($category->getName() === $categoryName) {
                return $category;
            }
        }

        return null;
    }

    /**
     * @param integer $categoryId
     *
     * @return $this
     */
    public function deleteCategory($categoryId)
    {
        $deleted = false;

        foreach ($this->categories as $key => $category) {

            if ($category->getId() === $categoryId) {
                unset($this->categories[$key]);
                $deleted = true;
                break;
            }
        }

        if (!$deleted) {
            throw new \LogicException("Category doesn't exist");
        }

        return $this;
    }

    /**
     * @param Counterparty $counterparty
     *
     * @return $this
     */
    public function addCounterparty(Counterparty $counterparty)
    {
        $this->counterparties[] = $counterparty;

        return $this;
    }

    /**
     * @param Array $counterparties
     *
     * @return $this
     */
    public function setCounterparty(Array $counterparties)
    {
        $this->counterparties = $counterparties;

        return $this;
    }

    /**
     * @return Array
     */
    public function getCounterparties()
    {
        return $this->counterparties;
    }

    /**
     * @param integer $counterpartyId
     *
     * @return null|Counterparty
     */
    public function findCounterpartyById($counterpartyId)
    {
        foreach ($this->counterparties as $counterparty) {

            if ($counterparty->getId() === $counterpartyId) {
                return $counterparty;
            }
        }

        return null;
    }

    /**
     * @param string $counterpartyName
     *
     * @return null|Counterparty
     */
    public function findCounterpartyByName($counterpartyName)
    {
        foreach ($this->counterparties as $counterparty) {

            if ($counterparty->getName() === $counterpartyName) {
                return $counterparty;
            }
        }

        return null;
    }

    /**
     * @param integer $counterpartyId
     *
     * @return $this
     */
    public function deleteCounterparty($counterpartyId)
    {
        $deleted = false;

        foreach ($this->counterparties as $key => $counterparty) {

            if ($counterparty->getId() === $counterpartyId) {
                unset($this->counterparties[$key]);
                $deleted = true;
                break;
            }
        }

        if (!$deleted) {
            throw new \LogicException("Counterparty doesn't exist");
        }

        return $this;
    }
}
