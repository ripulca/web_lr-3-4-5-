<?php
    require_once "models\Post.php";
    require_once "models\Photo.php";
    $errors=[];
 
    if(isset($_POST['photo_name'])){
        $name=$_POST['photo_name'];
        $info = new SplFileInfo($_FILES['photo']['name']);
        if(($_FILES['photo']['type']!='image/jpeg')||(($info->getExtension()!='jpg')&&($info->getExtension()!='jpeg'))){
            array_push($errors, "Неправильный тип файла\n");
            $response =[
                "status" =>false,
                "errors" =>$errors
            ];
            echo json_encode($response);
            return;
        }
        $format=$info->getExtension();
        $uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR;
        $files=$_FILES['photo']['name'];
        // echo json_encode($files);
        $uploadfile = $uploaddir . basename($_FILES['photo']['name']);

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
            $response =[
                "status" =>true,
            ];
        } else {
            array_push($errors, "Возможная атака с помощью файловой загрузки!\n");
        }
        if (!empty($errors)) {
            $response =[
                "status" =>false,
                "errors" =>$errors
            ];
        }
        echo json_encode($response);
        // echo $out;
    }