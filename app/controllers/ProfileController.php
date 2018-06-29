<?php


class ProfileController implements Controller
{
    public function handle(Request $request): Response
    {
        return new EmptyResponse();
    }

    public function showHtml()
    {
        echo 'Dobrodošao na svoj Tviter profil '.  $_SESSION['user'];
        $renderer = new TemplateService('../app/templates');
        echo $renderer->render(
            'main.php',
            array(
                'title' => $_SESSION['user']. '@tviter',
                'body' => $renderer->render(
                    'submitController.php',
                    array('values' => ['Početna', 'Privatne poruke', 'Promjena lozinke', 'Odjava'])
                )
            )


        );
    }
    public function showForm()
    {
        // TODO: Implement showForm() method.
    }
}