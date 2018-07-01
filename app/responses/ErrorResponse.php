<?php

class ErrorResponse implements Response
{
     private $msg;
     public function __construct(string $msg)
     {
         $this->msg=$msg;
         http_response_code(404);
     }

    public function send(): void
     {

         echo $this->msg;
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