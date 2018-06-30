<?php

include_once 'db.php';

class RepositoryService
{
   protected $db;

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




    function isLoggedInNow(): bool{
        return isset($_SESSION['user']);
    }
}

