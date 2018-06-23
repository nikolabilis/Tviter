<?php

include_once('User.php');
require_once 'db.php';

class UserRepositoryService
{
   private $db;

   public function __construct()
   {
       try {
           $this->db = createDbConnection();
       }
       catch (DatabaseConnectionException $e){
           echo 'Ne može se stvoriti veza s bazom podataka.';
       }
   }
    public function findByUsername(string $username): ?User
    {
        $sql = 'SELECT * FROM users WHERE user = :user limit 1';

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(
            ':user',
            $username,
            PDO::PARAM_STR
        );
        $stmt->execute();
        foreach ($stmt as $row) {
            if($row !== null){
                $user = new User($row['user'], $row['pass']);
            }
            break;
        }
        return $user ?? null;

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
    public function verify(User $userData): bool {
            $dbUser = $this->findByUsername($userData->username());
            if(empty($dbUser) ){
                return false;
            }


            return password_verify($userData->password(), $dbUser->password()) ?? false;


    }

    function isLoggedInNow(): bool{
        return isset($_SESSION['user']);
    }
}
