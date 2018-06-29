<?php

class PasswordChangeController implements Controller
{
    public function handle(Request $request): Response
    {

        if($request->getMethod()==="POST") {
            if (empty($_POST)) {
                throw new InvalidArgumentException('Uneseni podaci nisu kako treba.');
            }

            $oldUser = new User($request->getPost()['username'], $request->getPost()['oldPassword']);
            $newUser = new User($request->getPost()['username'], $request->getPost()['newPassword1']);
            $regService = new RegistrationService();
            $logService = new LoginService();



            if(!$logService->verifyUserData($oldUser)){
                throw new InvalidArgumentException('Stara lozinka je krivo unesena.');
            }

            if(!$regService->validateUserData($newUser,$request->getPost()['newPassword2']))
            {
                throw new InvalidArgumentException('Podaci nisu u ispravnom obliku');
            }

            $regService->changePassword($newUser);


            return new PasswordChangeResponse();

        }
        return new EmptyResponse();
    }
    public function showForm()
    {
        ?>
        <form method="post">
            <input type="hidden" name="username" value=<?=$_SESSION['user']?>
            <label>Stara lozinka: <input type="password" name="oldPassword" value=""> </label><br>
            <label>Nova lozinka: <input type="password" name="newPassword1" value=""> </label><br>
            <label>Ponovi novu lozinka: <input type="password" name="newPassword2" value=""> </label><br>
            <input type="submit" value="Promijeni lozinku">


        </form>
        <?
    }

    public function showHtml()
    {
        // TODO: Implement showHtml() method.
    }
}