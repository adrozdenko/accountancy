<?php
/**
 * Created by PhpStorm.
 * User: Petro_Svintsitskyi
 * Date: 11/19/13
 * Time: 5:44 PM
 */

namespace Accountancy;

/**
 * Class MailerStub
 *
 * @package Accountancy
 */
class MailerStub implements MailerInterface
{
    /**
     * @var string
     */
    protected $to;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var bool
     */
    protected $mailSent = false;

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return boolean
     */
    public function isMailSent()
    {
        return $this->mailSent;
    }



    /**
     * @param string $to
     * @param string $title
     * @param string $body
     */
    public function sendMail($to, $title, $body)
    {
        $this->to = $to;
        $this->title = $title;
        $this->body = $body;
        $this->mailSent = true;
    }
}
