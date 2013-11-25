<?php
/**
 *
 */

namespace Accountancy\Features;

/**
 * Interface FeatureInterface
 *
 * @package Accountancy\Features
 */
interface FeatureInterface
{
    /**
     * Executes business logic and returns data for UI
     *
     * @param Array $input Data received from UI
     *
     * @return Array
     */
    public function run(Array $input);
}
