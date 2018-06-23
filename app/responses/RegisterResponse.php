<?php
include_once '../app/UserRepositoryService.phpice.php';
class RegisterResponse implements Response
{



    public function send(): void
    {
        echo 'Registracija uspješna';
    }
}