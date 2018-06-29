<?php


class LoginController implements Controller
{
    private $svrha;
    public function handle(Request $request): Response
    {


        $logService = new LoginService();
        if ($request->getMethod() === "GET") {
            $this->svrha = $request->getGet()['controller'];

            $this->showHtml();
            if (ucfirst($this->svrha) === 'Odjava' || $this->svrha=== 'Registracija') {
                $_SESSION = [];
                session_destroy();

                return new EmptyResponse();
            }
        }

        if ($request->getMethod() === "POST") {

            if (empty($_POST)) {
                throw new InvalidArgumentException('Uneseni podaci nisu kako treba');
            }

            $user = new User($request->getPost()['username'], $request->getPost()['password']);

            if (empty($user->getUsername()) || empty($user->getPassword())) {
                throw new InvalidArgumentException('Uneseni podaci nisu kako treba');
            }
            if (!$logService->verifyUserData($user)) {
                throw new InvalidArgumentException("Pogrešno uneseno korisničko ime ili lozinka");
            }

            return new LoginResponse($user->getUsername());

        }
        return new EmptyResponse();
    }
    public function showHtml(): void {
        $this->svrha = ucfirst($this->svrha);
        $renderer=new TemplateService('../app/templates');
        echo $renderer->render('main.php',
            array('title'=>$this->svrha)
        );
    }

    public function showForm(): void {
        ?>
        <form method="post">
            <label>Korisničko ime: <input type="text" name="username" value=<?= $this->username ?? ""?>> </label>
            <label>Lozinka: <input type="password" name="password" value=""> </label>
            <input type="submit" value="prijavi se">

        </form>
        <form method="get">
            Nemate korisnički račun?
            <input type="submit" value="Registracija" name="controller">
        </form>

        <?php
    }
}




