<?php

declare(strict_types=1);

class DMcontroller implements Controller
{
    private $messages;
    public function handle(Request $request): Response
    {
        $messageService = new MessageService();
        if($request->getMethod()==='POST') {
            if (isset($request->getPost()['sending'])) {
                if($messageService->checkInput($request)) {
                    $messageService->sendMessage($request);
                    return new StringResponse('Poruka poslana');
                }
            }
            echo ' Pokušajte ponovno.';
            $this->showNewMessageForm();

        }

        else {
            $this->messages = $messageService->getTenMessages($messageService->choosePage(), $_SESSION['user']);
        }

        return new EmptyResponse();
    }
    public function showForm()
    {
        $renderer = new TemplateService('../app/templates');

        echo $renderer->render(
            'mainTemplate.php',
            array(
                'title'=>'DMs@Tviter',
                'body' => $renderer->render(
                    'submitControllerTemplate.php',
                    array('values' => ['Početna'])
                )
            )
        );
        if(!$_POST){
            ?>
            <form method="post">
                <input type="submit" value="Nova poruka"><br><br>
            <?
            echo $renderer->render(
                    'mainTemplate.php',
                    array(
                        'body' => $renderer->render(
                            'messageFeedTemplate.php',
                            array('messages' => $this->messages)
                        )
                    )
                );
        }
    }


    public function showNewMessageForm()
    {
        ?>
        <form method="post">
            Naslov poruke: <input type = "text" name="naslov"><br>
            Primatelj: <input type = "text" name="primatelj"><br>
            Poruka: <br><textarea name="ulaz" rows="5" cols="50"></textarea>
            <input type = "submit" value="pošalji" name="sending">
        </form>
        <?
    }
    public function showHtml()
    {
        // TODO: Implement showHtml() method.
    }
}