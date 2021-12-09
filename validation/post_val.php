<?php

class PostValidation
{
    protected $errors=[];

    protected $name;
    protected $comment;
    protected $format;

    protected $name_pattern="/^[A-Za-zА-Яа-яЁё\s\-]+/";
    protected $comment_pattern="/^[0-9A-Za-zА-Яа-яЁё\s\-]+/";

    public function __construct($name, $comment, $format){
        $this->name=$name;
        $this->comment=$comment;
        $this->format=$format;
    }

    public function validate(){
        $this->checkName();
        $this->checkComment();
        $this->checkFormat();
    }

    public function checkName(){
        if(!empty($this->name)){
            if(preg_match($this->name_pattern,$this->name)){
                return true;
            }
            else{
                array_push($this->errors,'forbidden symbols name');
                return false;
            }
        }
        else{
            array_push($this->errors, 'empty login');
            return false;
        }
    }
    
    public function checkComment(){
        if(preg_match($this->comment_pattern,$this->comment)){
            return true;
        }
        else{
            array_push($this->errors,'forbidden symbols comment');
            return false;
        }
    }

    public function checkFormat(){
        if((($_FILES['photo']['type']!='image/jpeg')&&($_FILES['photo']['type']!='image/png'))||(($this->format!='jpg')&&($this->format!='jpeg'))){
            array_push($this->errors, "Неправильный тип файла\n");
            return false;
        }
        return true;
    }

    public function getErrorMessages(){
        return $this->errors;
    }
}