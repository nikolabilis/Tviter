<?php

class DMcontroller implements Controller
{
    public function handle(Request $request): Response
    {
        if($request->getPost()['controller'] === 'Nova poruka'){
            $this->showNewMessageForm();
        }
        else {

        }
    }
    public function showForm()
    {
        // TODO: Implement showForm() method.
    }
    public function showNewMessageForm()
    {
        ?>
        <form method="post">
            Naslov poruke: <input type = "text" name="naslov"><br>
            Primatelj: <input type = "text" name="primatelj"><br>
            Poruka: <br><textarea name="ulaz" rows="5" cols="50"></textarea>
            <input type = "submit" value="pošalji">
        </form>
        <?
    }
    public function showHtml()
    {
        // TODO: Implement showHtml() method.
    }
}