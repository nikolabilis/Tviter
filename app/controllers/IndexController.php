<?php

include_once 'autoload.php';

class IndexController implements Controller
{
    public function handle(Request $request): Response
    {
        return new EmptyResponse();
    }
    public function showForm()
    {
        $renderer = new TemplateService('../app/Templates.php');
        $renderer->render('submitController.php', array('Profil', 'Pratitelji', 'Pratiš', 'Odjava'));

    }


    public function showHtml()
    {



        $renderer = new TemplateService('../app/templates');
        echo $renderer->render(
            'main.php',
                array(
                    'title' => 'Tviter',
                    'body' => $renderer->render(
                                'submitController.php',
                                array('values' => ['Profil', 'Pratitelji', 'Pratiš', 'Odjava'])
                                )
                     )


        );
    }


}