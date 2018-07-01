<?php


class SearchController implements Controller
{
    private $users;
    private $searchString;
    public function handle(Request $request): Response
    {
        $this->searchString = $request->getPost()['search'];
        $searchService = new SearchService();
        try {
            $this->users = $searchService->findUsers($this->searchString, 0);
        }
        catch (TypeError $exc){
            echo $exc;
            return new ErrorResponse('Zatražena stranica ne postoji na ovom serveru');

        }
        return new EmptyResponse();
    }
    public function showForm()
    {
        $renderer = new TemplateService('../app/templates');
        echo $renderer->render(
            'mainTemplate.php',
            array(
                'title' => 'Tražilica@Tviter',
                'body' => $renderer->render(
                    'submitControllerTemplate.php',
                    array('values' => ['Početna'])
                )
            )
        );

        echo '<h2>Rezultati pretrage za: "' . $this->searchString . '"';
        echo '<h3>Korisnici</h3>';
        echo $renderer->render(
            'mainTemplate.php',
            array(

                'body' => $renderer->render(
                    'userSearchTemplate.php',
                    array('users' => $this->users)
                )
            )
        );

        echo '<h3>Postovi</h3>';
        $renderer = new TemplateService('../app/templates');
        echo $renderer->render(
            'mainTemplate.php',
            array(

                'body' => $renderer->render(
                    'userSearchTemplate.php',
                    array('users' => $this->users)
                )
            )
        );
    }
    public function showHtml()
    {
        // TODO: Implement showHtml() method.
    }
}