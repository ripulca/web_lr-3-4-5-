<?php

class EnterValidation
{
    protected $errors=[];

    protected $login;
    protected $password;

    protected $login_pattern="/^[А-Яа-яЁё\s\-]+/";

    public function __construct($data){
        $this->login=$data['login'];
        $this->password=$data['password'];
    }
    
    public function validate(){
        $this->checkLogin();
        $this->checkPassword();
    }

    private function checkLogin(){
        if(!empty($this->login)){
            if(preg_match($this->login_pattern,$this->login)){
                return true;
            }
            else{
                array_push($this->errors,'forbidden symbols login');
                return false;
            }
        }
        else{
            array_push($this->errors, 'empty login');
            return false;
        }
    }

    private function checkPassword(){
        if(!empty($this->password)){
            if(strlen($this->password)>6){
                return true;
            }
            else{
                array_push($this->errors, 'pwd length must be over 6 characters');
                return false;
            }
        }
        else{
            array_push($this->errors, 'empty password');
            return false;
        }
    }

    public function getErrorMessages(){
        return $this->errors;
    }
}