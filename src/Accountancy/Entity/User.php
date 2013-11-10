<?php

/**
 *
 */

namespace Accountancy\Entity;

use Accountancy\Entity\Account;

/**
 * User Entity
 */
class User
{
    protected $accounts = array();

    protected $categories = array();

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
     * @param mixed $account
     *
     * @return Account|bool
     */
    public function findAccount($account)
    {
        foreach ($this->accounts as &$existingAccount) {

            if ($account === $existingAccount->getId()) {
                return $existingAccount;
            } elseif ($account === $existingAccount->getName()) {
                return $existingAccount;
            }

            if ($account instanceof Account && $account->getName() === $existingAccount->getName()) {
                return $existingAccount;
            }
        }

        return false;
    }

    /**
     * @param Account $account
     *
     * @throws \LogicException
     * @return $this
     */
    public function addAccount(Account $account)
    {
        if ($this->findAccount($account)) {
            throw new \LogicException('Name of Account should be unique');
        }

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
        $foundedCategory = null;

        foreach ($this->categories as $category) {

            if ($category->getId() === $categoryId) {
                $foundedCategory = $category;
                break;
            }
        }

        return $foundedCategory;
    }

    /**
     * @param string $categoryName
     *
     * @return null|Category
     */
    public function findCategoryByName($categoryName)
    {
        $foundedCategory = null;

        foreach ($this->categories as $category) {

            if ($category->getName() === $categoryName) {
                $foundedCategory = $category;
                break;
            }
        }

        return $foundedCategory;
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
}
