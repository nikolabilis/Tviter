<?php

include_once 'db.php';
class RegistrationService extends UserRepositoryService
{

    public function __construct()
    {
        parent::__construct();
    }


    public function validateUserData(User $user, string $passwordConfirm): bool {
        return !(
            mb_strlen($user->username()) <= 24
            &&
            preg_match('/^[\w-]*[A-Za-z\p{L}]+[\w-]*$/u', $this->username)
            &&
            $user->password()===$passwordConfirm
            &&
            mb_strlen($user->password()) >= 6);
    }
    public function usernameAlreadyExists(string $username): bool{
        return !empty($this->findByUsername($username));
    }


    public function persist(User $userData): void
    {
        $usr = $userData->username();
        $pswrd = password_hash($userData->password(),PASSWORD_ARGON2I);

        $sql = 'INSERT INTO users VALUE (:user, :pass)';

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(
            ':user',
            $usr,
            PDO::PARAM_STR
        );
        $stmt->bindParam(
            ':pass',
            $pswrd);
        $stmt->execute();

    }


}