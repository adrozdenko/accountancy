<?php
/**
 *
 */

namespace Accountancy;

/**
 * Class AuthenticationPayloadGeneratorStub
 *
 * @package Accountancy
 */
class AuthenticationPayloadGeneratorStub implements AuthenticationPayloadGeneratorInterface
{
    /**
     * @var string
     */
    protected $payload = "";

    /**
     * @param string $payload
     *
     * @return $this
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @return string
     */
    public function generateAuthenticationPayload()
    {
        return $this->payload;
    }
}
