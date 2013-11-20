<?php
/**
 *
 */

namespace Accountancy;

/**
 * Interface MailerInterface
 *
 * @package Accountancy
 */
interface MailerInterface
{
    /**
     * @param string $to
     * @param string $title
     * @param string $body
     *
     * @return null
     */
    public function sendMail($to, $title, $body);
}
