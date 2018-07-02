<?php


class Message
{
    private $sender;
    private $recipient;
    private $title;
    private $msg;
    private $dateTime;
    public function __construct(String $sender, String $recipient, String $title, String $msg, DateTime $datetime)
    {
        $this->msg=$msg;
        $this->recipient=$recipient;
        $this->sender = $sender;
        $this->title = $title;
        $this->dateTime = $datetime;
    }

    /**
     * @return array
     */
    public function getMsg(): String
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

    /**
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

}