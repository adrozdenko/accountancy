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
     * @param string $to
     * @param string $title
     * @param string $body
     */
    public function sendMail($to, $title, $body)
    {
        $this->to = $to;
        $this->title = $title;
        $this->body = $body;
    }
}
