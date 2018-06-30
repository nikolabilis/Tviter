<?php
class RegisterResponse implements Response
{



    public function send(): void
    {
        echo 'Registracija uspješna';
        $renderer = new TemplateService('../app/templates');
        echo $renderer->render('mainTemplate.php',
            array('title'=>'Registracija@tviter',
                'body'=> $renderer->render('submitControllerTemplate.php',
                    array('values'=>['Početna'])
                )
            )
        );

    }
}