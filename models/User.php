<?php

require_once "PDO.php";

class User extends DB
{
    public function getUserById($id)
    {
        $proc = $this->pdo->prepare("SELECT * 
                                    FROM client
                                    WHERE client_id=?; ");

        $proc->bindValue(1, $id, PDO::PARAM_INT);
        $proc->execute();
        return $proc->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email)
    {
        $proc = $this->pdo->prepare("SELECT * 
                                    FROM client
                                    WHERE client_email=:email; ");
        $proc->execute(array(":email" => $email));

        return $proc->fetch();
    }

    public function getUserIfPasswordVerify($login, $password)
    {
        $id = $this->getUserIdByLogin($login);
        $user = $this->getUserById($id);
        if ($user) {
            if (password_verify($password, $user['client_pwd'])) {
                return $user;
            }
        }
        return false;
    }

    public function getUserIdByLogin($login)
    {
        $proc = $this->pdo->prepare("SELECT client_id 
                                    FROM client
                                    WHERE client_login=:client_login; ");
        $proc->execute(array(":client_login" => $login));

        return $proc->fetch()[0];
    }

    public function isEmailFree($email)
    {
        $proc = $this->pdo->prepare("SELECT COUNT(*) 
                                    FROM client 
                                    WHERE client_email=:email; ");
        $proc->execute(array(":email" => $email));
        $count = (int) $proc->fetch()[0];
        if($count===0){
            return true;
        }
        return false;
    }

    public function save($name, $email, $phone, $password)
    {
        try {
            $proc = $this->pdo->prepare("INSERT INTO client (client_login, client_pwd, client_email, client_phone) 
                                            VALUES (:client_login, :password_hash, :email, :phone); ");

            $save_name = htmlspecialchars($name);
            $save_email = htmlspecialchars($email);
            $save_phone = htmlspecialchars($phone);
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $proc->bindValue(":client_login" , $save_name);
            $proc->bindValue(":password_hash" , $password_hash);
            $proc->bindValue(":email" , $save_email);
            $proc->bindValue(":phone" , $save_phone);
            
            $proc->execute();
        } catch (PDOException $e) {
            echo "Ошибка сохранения: " . $e->getMessage();
            return false;
        }
        return true;
    }
}