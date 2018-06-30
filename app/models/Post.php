<?php

declare(strict_types=1);

class Post
{
    private $user;
    private $text;
    private $dateTime;

    public function __construct(String $user, String $text, DateTime $dateTime)
    {
        $this->user = $user;
        $this->text = $text;
        $this->dateTime = $dateTime;

    }


    public function getText(): String
    {
        return $this->text;
    }

    public function getUser(): String
    {
        return $this->user;
    }


    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }
}