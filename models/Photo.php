<?php

require_once "PDO.php";

class Photo extends DB
{
    public function getPhotosWithOffset($offset)
    {
        $proc = $this->pdo->prepare("SELECT P.photo_id, P.photo_name, P.photo_path
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
        $proc = $this->pdo->prepare("SELECT P.photo_id, P.photo_name, P.photo_path
                                    FROM photo AS P
                                    WHERE P.photo_id= ?;
        ");
        $proc->bindValue(1, $id, PDO::PARAM_INT);
        $proc->execute();
        return $proc->fetch(PDO::FETCH_ASSOC);
    }

    function add($name, $path, $format){
        try{
            $proc = $this->pdo->prepare("INSERT INTO photo (photo_name, photo_path, photo_format) 
                                            VALUES (:photo_name, :photo_path, :photo_format); ");

            $proc->bindValue(":photo_name" , $name);
            $proc->bindValue(":photo_path" , $path);
            $proc->bindValue(":photo_format" , $format);
            
            $proc->execute();
        } catch (PDOException $e) {
            echo "Ошибка сохранения: " . $e->getMessage();
            return false;
        }
        return true;
    }
}