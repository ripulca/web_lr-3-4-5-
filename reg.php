<?php

require "validation/redirect.php";
redirectIfUserLogged();

header("Content-Type: application/json");

require_once "validation/reg_val.php";
require_once "models/User.php";

$data = $_POST;
$validation_obj = new RegValidation($data);
$validation_obj->validate();

$errors = $validation_obj->getErrorMessages();

if (empty($errors)) {
    $user_obj = new User();

    if ($user_obj->isEmailFree($data['email'])) {
        $save_result = $user_obj->save($data['login'], $data['email'], $data['phone'], $data['password']);

        if ($save_result) {
            session_start();
            $_SESSION['user_id'] = $user_obj->getUserIdByLogin($data['login']);
            if (!isset($_SESSION['count'])) {
                $_SESSION['count'] = 0;
             } else {
                $_SESSION['count']++;
             }
             
        } else {
            array_push($errors, "Не удалось создать пользователя");
        }
    } else {
        array_push($errors, "Пользователь с таким email уже существует");
    }
    $response =[
        "status" =>true
    ];
}
else {
    $response =[
        "status" =>false,
        "errors" =>$errors
    ];
}
echo json_encode($response);