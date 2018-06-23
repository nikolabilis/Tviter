<?php


class ErrorController implements Controller
{
    public function handle(Request $request): Response
    {
        http_response_code(404);
        return new StringResponse('Zatražena stranica ne postoji na ovom serveru');
    }
    public function showForm()
    {

    }
    public function showHtml()
    {

    }

}