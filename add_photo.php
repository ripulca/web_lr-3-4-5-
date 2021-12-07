<?php

    echo $_FILES;

    // $errors=[];

    // $uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR;
    // $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

    // if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    //     array_push($errors, "Файл корректен и был успешно загружен.\n");
    // } else {
    //     array_push($errors, "Возможная атака с помощью файловой загрузки!\n");
    // }
    // if(empty($errors)){
    //     $response =[
    //         "status" =>true
    //     ];
    // }else{
    //     $response =[
    //         "status" =>false
    //     ];
    // }
    // echo json_encode($response);