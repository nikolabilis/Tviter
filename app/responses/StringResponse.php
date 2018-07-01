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
        echo $this->string.'<br>';

        $renderer = new TemplateService('../app/templates');
        echo $renderer->render(
            'mainTemplate.php',
            array(
                'title' => 'Tviter',
                'body' => $renderer->render(
                    'submitControllerTemplate.php',
                    array('values' => ['Početna'])
                )
            )


        );
    }
}