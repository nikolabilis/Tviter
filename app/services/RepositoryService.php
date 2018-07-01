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
    public function isFollowing(string $user1, string $user2): bool {
        $isFollowing = false;
        $sql = <<<'SQL'
       SELECT * FROM followingTracker WHERE userWhoFollows = :user1 AND followedUser = :user2
SQL;
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user1', $user1, PDO::PARAM_STR);
        $stmt->bindValue(':user2', $user2, PDO::PARAM_STR);
        $stmt->execute();
        foreach($stmt as $row) {
            if(!empty($row)){
                $isFollowing=true;
                break;
            }
        }
        return $isFollowing;
    }

    public function follow(String $user1, String $user2): void{
        $sql = <<<'SQL'
       INSERT INTO followingTracker VALUE(:user1, :user2)
SQL;
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user1', $user1, PDO::PARAM_STR);
        $stmt->bindValue(':user2', $user2, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function unfollow(String $user1, String $user2): void{
        $sql = <<<'SQL'
       DELETE FROM followingTracker WHERE userWhoFollows = :user1 and followedUser = :user2
SQL;
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user1', $user1, PDO::PARAM_STR);
        $stmt->bindValue(':user2', $user2, PDO::PARAM_STR);
        $stmt->execute();
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

