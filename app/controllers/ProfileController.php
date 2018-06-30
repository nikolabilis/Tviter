<?php


class ProfileController implements Controller
{
    private $posts;
    public function handle(Request $request): Response
    {


        if($this->isMyProfile()){
            echo 'Dobrodošao na svoj Tviter profil '. $_SESSION['user'];
        }
        $feed = new FeedService();
        $this->posts = $feed->getTenPosts($feed->choosePage(),$request->getGet()['controller'], false);
        return new EmptyResponse();
    }

    public function showHtml()
    {

        $renderer = new TemplateService('../app/templates');
        echo $renderer->render(
            'mainTemplate.php',
            array(
                'body' => $renderer->render(
                    'feedTemplate.php',
                    array('posts' => $this->posts)
                )
            )
        );
        echo $renderer->render(
            'mainTemplate.php',
            array(
                'title' => $_SESSION['user']. '@tviter',
                'body' => $renderer->render(
                    'submitControllerTemplate.php',
                    array('values' => ['Početna', 'Privatne poruke', 'Promjena lozinke', 'Odjava'])
                )
            )


        );
    }
    public function showForm()
    {
        // TODO: Implement showForm() method.
    }
    private function isMyProfile(): bool{
        return $_SESSION['user']===$_GET['controller'];
    }
}