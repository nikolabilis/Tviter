<?php

class LoginResponse implements Response
{
    private $username;

    public function __construct($username)
    {
        $this->username = $username;

    }

    public function send(): void
    {
        $_SESSION['user'] = $this->username;
        header('Location: index.php');

    }
}