<?php
/**
 * Created by PhpStorm.
 * User: nikolabilis
 * Date: 23.06.18.
 * Time: 18:01
 */

class LoginService extends RepositoryService
{
    public function __construct()
    {
        parent::__construct();
    }
    public function verifyUserData(User $userData): bool {
        $dbUser = $this->findByUsername($userData->getUsername());
        if(empty($dbUser) ){
            return false;
        }


        return password_verify($userData->getpassword(), $dbUser->getPassword()) ?? false;


    }

}