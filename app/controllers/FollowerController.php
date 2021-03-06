<?php
/**
 * Created by PhpStorm.
 * User: nikolabilis
 * Date: 23.06.18.
 * Time: 21:28
 */

class FollowerController implements Controller
{
    private $svrha;
    private $user;
    private $users;
    public function handle(Request $request): Response
    {

        $searchService = new SearchService();
        if(empty($_SESSION['user'])){
            return new ErrorResponse('Niste logirani, ne biste se smjeli nači tu gdje se nalazite');
        }
        $this->svrha=$request->getGet()['controller'];
        if($this->svrha === 'Pratiš') {
            $type = 2;
        }
        else if ($this->svrha === 'Pratitelji'){
            $type = 1;
        }
        else {
            throw new InvalidArgumentException('Nepropisan ulaz za type');
        }
        $this->user = $_SESSION['user'];
        $this->users = $searchService->findUsers($this->user, $type);
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

        if($this->svrha === 'Pratiš') {
            echo '<h3>Korisnici koje prati korisnik '. $this->user .'</h3>';
        }
        else if ($this->svrha === 'Pratitelji'){
            echo '<h3>Pratitelji korisnika '. $this->user .'</h3>';
        }


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