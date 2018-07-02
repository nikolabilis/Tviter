<?php

declare(strict_types=1);

class MessageService extends FeedService
{
    public function sendMessage(Request $request ){
        if($request->getMethod()==='POST') {
            $sql = <<<'SQL'
                INSERT INTO DMs
    VALUE (:sender, :receiver,:title, :message,  now());
SQL;


            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':sender', $_SESSION['user'] ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':receiver', $request->getPost()['primatelj'], PDO::PARAM_STR);
            $stmt->bindValue(':title', $request->getPost()['naslov'], PDO::PARAM_STR);
            $stmt->bindValue(':message', $request->getPost()['ulaz'], PDO::PARAM_STR);

            $stmt->execute();
        }
    }

    public function checkInput( Request $request): bool {
        if(mb_strlen($request->getPost()['naslov'])>64 || mb_strlen($request->getPost()['primatelj'])>64){
            echo 'primatelj/naslov ne smiju imati više od 64 znaka.';
            return false;
        }
        $searchService = new SearchService();
        if(!$searchService->isFollowing($_SESSION['user']??'', $request->getPost()['primatelj'])){
            echo 'Korisnik ne postoji ili ga ne pratite.';
            return false;
        }
        return true;

    }

    public function getTenMessages(int $cnt, String $username = ''): array{
            $sql = <<<'SQL'
                SELECT * FROM DMs
        WHERE receiver = :user
        ORDER BY time DESC
        LIMIT 10 OFFSET :cnt
SQL;


        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':cnt', $cnt, PDO::PARAM_INT);
        $stmt->bindValue(':user', $username, PDO::PARAM_STR);

        $stmt->execute();
        $msgArray = array();
        foreach ($stmt as $row) {

            $date = date_create_from_format('Y-m-d H:i:s', $row['time']);
            $message= new Message($row['sender'], $row['receiver'], $row['title'], $row['message'], $date);

            array_push($msgArray,$message);
        }
        return $msgArray;

    }
}