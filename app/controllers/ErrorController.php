<?php


class ErrorController implements Controller
{
    public function handle(Request $request): Response
    {

        return new ErrorResponse('Zatražena stranica ne postoji na ovom serveru');
    }
    public function showForm()
    {


    }
    public function showHtml()
    {

    }

}