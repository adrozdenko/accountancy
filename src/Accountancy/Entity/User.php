<?php

/**
 *
 */

namespace Accountancy\Entity;

use Accountancy\Entity\Operation;

/**
 * User Entity
 */
class User
{
    public $id;
    public $categories = array();
    public $payees = array();
    public $balance = 0;

    /**
     * Registers operation
     * @param  Operation $operation
     * @return void
     */
    public function registerOperation(Operation $operation) {
        $this->balance = $operation->apply($this->balance);
    }
}
