<?php

class RegValidation
{
    protected $errors=[];

    protected $login;
    protected $password;
    protected $email;
    protected $phone;

    protected $login_pattern="/^[А-Яа-яЁё\s\-]+/";
    protected $email_pattern="/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-0-9A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})/";
    protected $phone_pattern="/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?/";

    public function __construct($data){
        $this->login=$data['login'];
        $this->password=$data['password'];
        $this->email=$data['email'];
        $this->phone=$data['phone'];
    }

    public function validate(){
        $this->checkLogin();
        $this->checkPassword();
        $this->checkEmail();
        $this->checkPhone();
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
            return true;
        }
        else{
            array_push($this->errors, 'empty password');
            return false;
        }
    }

    private function checkEmail(){
        if(!empty($this->email)){
            if(preg_match($this->email_pattern,$this->email)){
                return true;
            }
            else{
                array_push($this->errors,'forbidden symbols email');
                return false;
            }
        }
        else{
            array_push($this->errors, 'empty email');
            return false;
        }
    }

    private function checkPhone(){
        if(!empty($this->phone)){
            if(preg_match($this->phone_pattern,$this->phone)){
                return true;
            }
            else{
                array_push($this->errors,'forbidden symbols phone');
                return false;
            }
        }
        else{
            return true;
        }
    }

    public function getErrorMessages(){
        return $this->errors;
    }
}