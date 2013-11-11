<?php
/**
 *
 */

namespace Accountancy\Features\CounterpartyManagement;

use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;

/**
 * Class EditCategory
 *
 * @package Accountancy\Features\CounterpartyManagement
 */
class EditCounterparty
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var integer
     */
    protected $counterpartyId;

    /**
     * @param integer $counterpartyId
     *
     * @return $this
     */
    public function setCounterpartyId($counterpartyId)
    {
        $this->counterpartyId = (int) $counterpartyId;

        return $this;
    }

    /**
     * @param string $newName
     *
     * @return $this
     */
    public function setNewCounterpartyName($newName)
    {
        $this->newName = (string) $newName;

        return $this;
    }

    /**
     * @param \Accountancy\Entity\User $user
     *
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @throws \Accountancy\Features\FeatureException
     */
    public function run()
    {

        if (empty($this->counterpartyId)) {
            throw new FeatureException("Counterparty id can not be empty");
        }

        $counterparty = $this->user->findCounterpartyById($this->counterpartyId);

        if (is_null($counterparty)) {
            throw new FeatureException("Counterparty doesn't exist");
        }

        if (trim($this->newName) == '') {
            throw new FeatureException("Name of Counterparty can not be empty");
        }

        $counterparty->setName($this->newName);

        $counterparties = $this->user->getCounterparties();

        foreach ($counterparties as $key => $value) {

            if ($value->getId() === $this->categoryId) {
                $counterparties[$key] = $counterparty;
            }
        }

        $this->user->setCounterparties($counterparty);
    }
}
