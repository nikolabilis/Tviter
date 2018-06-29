<?php

class PasswordChangeResponse implements Response
{
    public function send(): void
    {
        echo 'Promjena lozinke uspješna';
        $renderer = new TemplateService('../app/templates');
        echo $renderer->render('main.php',
            array('title'=>'Tviter',
                'body'=> $renderer->render('submitController.php',
                    array('values'=>['Početna'])
                )
            )
        );

    }
}