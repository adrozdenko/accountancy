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
    /**
     * @var AccountCollection
     */
    protected $accounts;

    /**
     * @var CategoryCollection
     */
    protected $categories;

    /**
     * @var CounterpartyCollection
     */
    protected $counterparties;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var bool
     */
    protected $emailVerified;

    /**
     * @var bool
     */
    protected $authenticated;

    /**
     * @var string
     */
    protected $authenticationPayload;

    /**
     * @param string $authenticationPayload
     */
    public function setAuthenticationPayload($authenticationPayload)
    {
        $this->authenticationPayload = $authenticationPayload;
    }

    /**
     * @return string
     */
    public function getAuthenticationPayload()
    {
        return $this->authenticationPayload;
    }

    /**
     * @param boolean $authenticated
     */
    public function setAuthenticated($authenticated)
    {
        $this->authenticated = $authenticated;
    }

    /**
     * @return boolean
     */
    public function isAuthenticated()
    {
        return $this->authenticated;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param boolean $emailVerified
     */
    public function setEmailVerified($emailVerified)
    {
        $this->emailVerified = $emailVerified;
    }

    /**
     * @return boolean
     */
    public function isEmailVerified()
    {
        return $this->emailVerified;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


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
