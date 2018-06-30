<?php


class PostService extends RepositoryService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(String $ulaz){
        date_default_timezone_set('Europe/Zagreb');
        $post = new Post($_SESSION['user'], $ulaz, new DateTime('now',new DateTimeZone('Europe/Zagreb')));
        $this->persist($post);
    }
    public function persist(Post $post): void
    {

        $sql = 'INSERT INTO posts VALUE (:user, :post, now())';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(
            ':user',
            $post->getUser(),
            PDO::PARAM_STR
        );

        $stmt->bindParam(
            ':post',
            $post->getText(),
            PDO::PARAM_STR);

        $stmt->execute();
        header('location: index.php');

    }

}