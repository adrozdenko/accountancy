<?php
/**
 *
 */

namespace Accountancy\Features\CounterpartyManagement;


use Accountancy\Entity\User;
use Accountancy\Features\FeatureException;

/**
 * Class DeleteCounterparty
 *
 * @package Accountancy\Features\CounterpartyManagement
 */
class DeleteCounterparty
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var int
     */
    protected $counterpartyId;

    /**
     * @param int $counterpartyId
     *
     * @return $this
     */
    public function setCounterpartyId($counterpartyId)
    {
        $this->counterpartyId = (int) $counterpartyId;

        return $this;
    }

    /**
     * @param \Accountancy\Entity\User $user
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @throws \Accountancy\Features\FeatureExceptions
     */
    public function run()
    {
        try {
            $this->user->getCounterparties()->deleteCounterparty($this->counterpartyId);
        } catch (\LogicException $e) {
            throw new FeatureException("Counterparty doesn't exit");
        }
    }
}
