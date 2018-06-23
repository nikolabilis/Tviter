<?php

include_once 'Response.php';

class StringResponse implements Response
{
    private $string;
    public function __construct(string $string)
    {

        $this->string=$string;
    }
    public function send(): void
    {
        echo $this->string;
    }
}