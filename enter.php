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
        $_SESSION["user_id"]=$user['client_id'];
        if (!isset($_SESSION['count'])) {
            $_SESSION['count'] = 0;
        } else {
            $_SESSION['count']++;
        }
        $response =[
            "status" =>true,
            "user_login"=>$user['client_login']
        ];
        echo json_encode($response);
        return;
    } else {
        array_push($errors, "Неверный логин или пароль");
    }
}
$response =[
    "status" =>false,
    "errors" =>$errors
];
echo json_encode($response);