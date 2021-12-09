<?php

require_once "PDO.php";

class Post extends DB
{

    function getPostById($id){
        $proc = $this->pdo->prepare("
        SELECT P.photo_id, P.photo_name, P.photo_path
        FROM photo AS P
        WHERE P.photo_id= ?;
    ");

    $proc->bindValue(1, $id, PDO::PARAM_INT);
    $proc->execute();

    return $proc->fetch(PDO::FETCH_ASSOC);
    }

    function add($comment){
        session_start();

        if(!empty($_SESSION)){
            if ($_SESSION['user_id']) {
                $user_id = (int) $_SESSION['user_id'];
            }
            $date=date("Y-m-d");
            try {
                $proc = $this->pdo->prepare("INSERT INTO post (client_id, post_date, post_author_comment) 
                                                VALUES (:client_id, :post_date, :comment); ");

                $save_comment = htmlspecialchars($comment);

                $proc->bindValue(":client_id" , $user_id);
                $proc->bindValue(":post_date" , $date);
                $proc->bindValue(":comment" , $save_comment);

            } catch (PDOException $e) {
                echo "Ошибка сохранения: " . $e->getMessage();
                return false;
            }
        }
        return true;
    }
}