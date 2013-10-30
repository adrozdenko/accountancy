<?php

/**
 *
 */

namespace Accountancy\Entity;

/**
 * Operation Entity
 */
class Operation
{

    const OP_TYPE_INCOME = 'income';
    const OP_TYPE_EXPENSE = 'expemse';

    public $type;
    public $value;

    /**
     * Applies value
     *
     * @param double $balance
     *
     * @return double
     */
    public function apply($balance)
    {
        switch ($this->type) {
            case self::OP_TYPE_INCOME:
                $balance += $this->value;
                break;

            case self::OP_TYPE_EXPENSE:
                $balance -= $this->value;
                break;
        }

        return $balance;
    }
}
