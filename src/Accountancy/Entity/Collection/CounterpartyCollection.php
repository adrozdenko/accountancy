<?php
/**
 *
 */

namespace Accountancy\Entity\Collection;

use Accountancy\Entity\Counterparty;

/**
 * Class CounterpartyCollection
 *
 * @package Accountancy\Entity\Collection
 */
class CounterpartyCollection
{

    /**
     * @var Array
     */
    protected $counterparties = array();

    /**
     * @param Array $counterparties
     *
     * @return $this
     */
    public function setCounterparties(Array $counterparties)
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
     * @param Counterparty $counterparty
     */
    public function updateCounterparties(Counterparty $counterparty)
    {
        foreach ($this->counterparties as $key => $value) {

            if ($value->getId() === $counterparty->getId()) {
                $this->counterparties[$key] = $counterparty;
            }
        }
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
