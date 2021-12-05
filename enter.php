<?php

require "validation/redirect.php";
redirectIfUserLogged();

header("Content-Type: application/json");

require_once "validation/enter_val.php";
require_once "models/User.php";

$data = $_POST;
$validation_obj = new EnterValidation($data);
$validation_obj->validate();

$errors = $validation_obj->getErrorMessages();
if (empty($errors)) {
    $user_obj = new User();
    $user = $user_obj->getUserIfPasswordVerify($data['login'], $data['password']);

    if ($user) {
        session_start();
        $_SESSION['user_id'] = $user['client_id'];
    } else {
        array_push($errors, "Неверный логин или пароль");
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