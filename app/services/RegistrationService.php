<?php

include_once 'db.php';
class RegistrationService extends UserRepositoryService
{

    public function __construct()
    {
        parent::__construct();
    }


    public function validateUserData(User $user, string $passwordConfirm): bool {
        return (
            mb_strlen($user->getUsername()) <= 24
            &&
            preg_match('/^[\w-]*[A-Za-z\p{L}]+[\w-]*$/u', $user->getUsername())
            &&
            $user->getPassword()===$passwordConfirm
            &&
            mb_strlen($user->getPassword()) >= 6);
    }
    public function usernameAlreadyExists(string $username): bool{
        return !empty($this->findByUsername($username));
    }


    public function persist(User $userData): void
    {
        $usr = $userData->getUsername();
        $pswrd = password_hash($userData->getPassword(),PASSWORD_ARGON2I);

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
    public function changePassword(User $userData): void
    {
        $usr = $userData->getUsername();
        $pswrd = password_hash($userData->getPassword(),PASSWORD_ARGON2I);

        $sql = 'UPDATE users
                SET pass = :pass
                WHERE user = :user';

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