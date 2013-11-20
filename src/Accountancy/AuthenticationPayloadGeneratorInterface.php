<?php
/**
 *
 */

namespace Accountancy;

/**
 * Interface AuthenticationPayloadGeneratorInterface
 *
 * @package Accountancy
 */
interface AuthenticationPayloadGeneratorInterface
{
    /**
     * Generates authentication payload string
     *
     * @return string
     */
    public function generateAuthenticationPayload();
}
