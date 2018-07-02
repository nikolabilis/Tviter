<?php

session_start();

class IndexController implements Controller
{
    private $posts;
    public function handle(Request $request): Response
    {
        $feed = new FeedService();
        $this->posts = $feed->getTenPosts($feed->choosePage(), $_SESSION['user'] ?? '');

        if($request->getMethod()==='POST'){
            $postService = new PostService();
            $postService->handle($request->getPost()['ulaz']);


        }
        return new EmptyResponse();
    }
    public function showForm()
    {
        echo '<h1>Dobrodošli na tviter!</h1>';

        ?>

        <form method="post"  action="index.php?controller=search">
            Tražilica: <input type="text" name="search">
            <input type = "submit" value="traži">
        </form>

        <?


        $renderer = new TemplateService('../app/templates');
        echo $renderer->render(
            'mainTemplate.php',
            array(
                'title' => 'Tviter',
                'body' => $renderer->render(
                    'submitControllerTemplate.php',
                    array('values' => isset($_SESSION['user']) ? ['Profil', 'Pratitelji', 'Pratiš', 'Odjava']: ['Prijava','Registracija'])
                )
            )


        );
        if(isset($_SESSION['user'])){
            ?>
            <form method="post">
                <textarea name="ulaz" rows="3" cols="50">Što ti je na umu?</textarea>
                <input type = "submit" value="pošalji">
            </form>
            <?

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



    }


    public function showHtml()
    {



    }


}