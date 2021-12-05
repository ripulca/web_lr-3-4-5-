<?php

require_once "PDO.php";

class Photo extends DB
{
    public function getPhotosWithOffset($offset)
    {
        $proc = $this->pdo->prepare("
        SELECT P.photo_id, P.photo_name, P.photo_path
            FROM photo AS P
            ORDER BY P.photo_id ASC
            LIMIT ?, 9;
        ");
        $proc->bindValue(1, $offset, PDO::PARAM_INT);
        $proc->execute();
        return $proc;
    }

    public function getPhotoById($id)
    {
        $proc = $this->pdo->prepare("
        SELECT P.photo_id, P.photo_name, P.photo_path
            FROM photo AS P
            WHERE P.photo_id= ?;
        ");
        $proc->bindValue(1, $id, PDO::PARAM_INT);
        $proc->execute();
        return $proc->fetch(PDO::FETCH_ASSOC);
    }
}