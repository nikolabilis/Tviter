<?php


class ProfileController implements Controller
{
    private $repositoryService;
    private $currentUser;
    private $viewedUser;
    private $posts;

    public function __construct(RepositoryService $repositoryService)
    {
        $this->repositoryService=$repositoryService;
    }

    public function handle(Request $request): Response
    {
        $this->currentUser = $_SESSION['user'];
        $this->viewedUser = $request->getGet()['controller'];
        echo 'Dobrodošao na profil korisnika '. $this->viewedUser ;
        $feed = new FeedService();
        $this->posts = $feed->getTenPosts($feed->choosePage(),$this->viewedUser, false);

        if($request->getMethod()==='POST'){
            if($request->getPost()['controller'] === 'prati'){
            $feed->follow($this->currentUser, $this->viewedUser);
        }
            else if($request->getPost()['controller'] === 'odprati'){
                $feed->unfollow($this->currentUser, $this->viewedUser);
            }
        }
        return new EmptyResponse();
    }

    public function showHtml()
    {


    }
    public function showForm()
    {
        $renderer = new TemplateService('../app/templates');
        if(!$this->isMyProfile()) {
            ?>
            <form method="post">
                <input type="hidden" value="<? echo $_GET['controller']; ?>" name="controller"/>
                <input type="submit" value="<?
                       echo $this->repositoryService->isFollowing($this->currentUser, $this->viewedUser)
                                   ?  'odprati' : 'prati'?>"
                                    name="controller">
            </form>
            <?


        }


        echo $renderer->render(
            'mainTemplate.php',
            array(
                'title' => $_GET['controller']. '@tviter',
                'body' => $renderer->render(
                    'submitControllerTemplate.php',
                    array('values' => ['Početna', 'Privatne poruke', 'Promjena lozinke', 'Odjava'])
                )
            )


        );


        echo $renderer->render(
            'mainTemplate.php',
            array(
                'body' => $renderer->render(
                    'feedTemplate.php',
                    array('posts' => $this->posts)
                )
            )
        );

    }
    private function isMyProfile(): bool{
        return $_SESSION['user']===$_GET['controller'];
    }
}