<?php
declare(strict_types=1);

class SearchService extends RepositoryService
{
    /**
     * @param String $string - username koji se traži ili čiji se followeri ili followinzi traže
     * @param int $type - 0 traže se korisnici kojima ime odgovara stringu
     *                  - 1 traže se korisnikovi followeri
     *                  - 2 traže se korisnici koje korisnik followa
     *
     * @return array
     */
    public function findUsers(String $string, int $type) :array{
        switch ($type) {
            case 0:
                $string = "%".$string."%";
                $sql = <<<'SQL'
                SELECT user from users WHERE users.user LIKE :string
SQL;
                break;
            case 1:
                $sql = <<<'SQL'
                SELECT userWhoFollows from followingTracker WHERE followedUser = :string
SQL;
                break;
            case 2:
                $sql = <<<'SQL'
                SELECT followedUser from followingTracker WHERE userWhoFollows = :string
SQL;
                break;
            default:
                throw new InvalidArgumentException('Takva naredba ne postoji');
                break;
        }


        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':string',  $string, PDO::PARAM_STR);
        $stmt->execute();

        $userArray = array();
        if($type === 0) {
            foreach ($stmt as $row) {

                array_push($userArray, $row['user']);

            }
        }
        if($type === 1) {
            foreach ($stmt as $row) {
                array_push($userArray, $row['userWhoFollows']);

            }
        }
        if($type === 2) {
            foreach ($stmt as $row) {
                array_push($userArray, $row['followedUser']);

            }
        }

        return $userArray;

    }

    public function findPostsWithHashtag($string): array{
        return array();
    }
}