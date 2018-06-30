<?php

class PasswordChangeResponse implements Response
{
    public function send(): void
    {
        echo 'Promjena lozinke uspješna';
        $renderer = new TemplateService('../app/templates');
        echo $renderer->render('mainTemplate.php',
            array('title'=>'Tviter',
                'body'=> $renderer->render('submitControllerTemplate.php',
                    array('values'=>['Početna'])
                )
            )
        );

    }
}