<?php



class IndexController implements Controller
{
    public function handle(Request $request): Response
    {
        return new EmptyResponse();
    }
    public function showForm()
    {
        echo '<h1>Dobrodošli na tviter!</h1>';


        $renderer = new TemplateService('../app/templates');
        echo $renderer->render(
            'main.php',
            array(
                'title' => 'Tviter',
                'body' => $renderer->render(
                    'submitController.php',
                    array('values' => isset($_SESSION['user']) ? ['Profil', 'Pratitelji', 'Pratiš', 'Odjava']: ['Prijava','Registracija'])
                )
            )


        );
    }


    public function showHtml()
    {



    }


}