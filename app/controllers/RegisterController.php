<?php


class RegisterController implements Controller
{

    public function handle(Request $request): Response
    {

        if($request->getMethod()==="GET") {
            $this->showHtml();
        }
        if($request->getMethod()==="POST") {
            if (empty($_POST)) {
                throw new InvalidArgumentException('Uneseni podaci nisu kako treba.');
            }

            $user = new User($request->getPost()['username'], $request->getPost()['password1']);
            $regService = new RegistrationService();



            if(!$regService->validateUserData($user,$request->getPost()['password2']))
            {
                throw new InvalidArgumentException('Podaci nisu u ispravnom obliku');
            }

            if($regService->UsernameAlreadyExists($user->getUsername()))
            {
                throw new InvalidArgumentException('Korisničko ime već postoji');
            }

            $regService->persist($user);

            return new RegisterResponse();

        }
        return new EmptyResponse();
    }

    public function showHtml(): void {
        include_once ('../app/Templating.php');
        $renderer=new TemplateService('../app/templates');
        echo $renderer->render('mainTemplate.php',
            array('title'=>'Registracija')
        );
    }

    public function showForm(): void {
        ?>
        <form>
            <input type="submit" value="Početna" name="controller">
        </form>
        <form method="post">
            <h4>Unesite željeno jedinstveno korisničko ime i lozinku:</h4><br>
            <label>Korisničko ime: <input type="text" name="username" value=<?= $this->username ?? ""?>> </label><br>
            <label>Lozinka:        <input type="password" name="password1" value=<?= $this->password ?? ""?>> </label><br>
            <label>Ponovi lozinku: <input type="password" name="password2" value=<?= $this->password ?? ""?>></label><br>
            <input type="submit" value="Registracija">
        </form>

        <?php
    }




}