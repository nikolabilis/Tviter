<?php

/**
 * Class FeedService
 * $main - feed na glavnoj stranici, stavi true ako hoćeš da se prikažu postovi svih ljudi koje pratiš, false za određeni username
 *
 */

class FeedService extends RepositoryService
{
    public function getTenPosts(int $cnt, String $username = '', bool $main = true): array{
        if(!$main) {
            $sql = <<<'SQL'
                SELECT * FROM posts  WHERE posts.user = :username ORDER BY time DESC
        LIMIT 10 OFFSET :cnt
SQL;
        }
        else {
            $sql = <<<'SQL'
                SELECT * FROM posts
        WHERE posts.user IN (SELECT followedUser FROM  followingTracker WHERE userWhoFollows = :username) OR posts.user = :username
        ORDER BY time DESC
        LIMIT 10 OFFSET :cnt
SQL;
        }

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':cnt', $cnt, PDO::PARAM_INT);

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        $stmt->execute();
        $postArray = array();
        foreach ($stmt as $row) {
            $date = date_create_from_format('Y-m-d H:i:s', $row['time']);
            $post = new Post($row['user'], $row['post'], $date  );

            array_push($postArray,$post);
        }

        return $postArray;
    }
    public function choosePage(): int{
        if($_GET['stranica']==='prethodna') {
            if($_SESSION['cnt']>0) {
                $_SESSION['cnt'] -= 10;
            }
        }
        else if($_GET['stranica']==='sljedeća') {
            $_SESSION['cnt'] += 10;
        }
        else if($_GET['stranica']==='početna'){
            $_SESSION['cnt']=0;
        }
        else{
            $_SESSION['cnt'] = 0;
        }
        return $_SESSION['cnt'];
    }


}