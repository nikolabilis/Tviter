<?php


class Message
{
    private $sender;
    private $recipient;
    private $title;
    private $msg;
    public function __construct(String $sender, String $recipient, String $title, array $msg)
    {
        $this->msg=$msg;
        $this->recipient=$recipient;
        $this->sender = $sender;
        $this->title = $title;

    }

    /**
     * @return array
     */
    public function getMsg(): array
    {
        return $this->msg;
    }

    /**
     * @return String
     */
    public function getRecipient(): String
    {
        return $this->recipient;
    }

    /**
     * @return String
     */
    public function getTitle(): String
    {
        return $this->title;
    }

    /**
     * @return String
     */
    public function getSender(): String
    {
        return $this->sender;
    }

}