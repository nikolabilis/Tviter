<?php
class RegisterResponse implements Response
{



    public function send(): void
    {
        echo 'Registracija uspješna';
        $renderer = new TemplateService('../app/templates');
        echo $renderer->render('main.php',
            array('title'=>'Registracija@tviter',
                'body'=> $renderer->render('submitController.php',
                    array('values'=>['Početna'])
                )
            )
        );

    }
}