<?php
    require_once "models\Post.php";
    require_once "models\Photo.php";
    require_once "validation\post_val.php";
 
    if(isset($_POST['photo_name'])){
        $name=$_POST['photo_name'];
        $comment=$_POST['photo_comment'];

        $info = new SplFileInfo($_FILES['photo']['name']);
        $format=$info->getExtension();

        $validation_obj = new PostValidation($name, $comment, $format);
        $validation_obj->validate();

        $errors = $validation_obj->getErrorMessages();
        if(!empty($errors)){
            $response =[
                "status" =>false,
                "errors" =>$errors
            ];
            echo json_encode($response);
            return;
        }
        $uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR;
        $bddir=DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR;
        $files=$_FILES['photo']['name'];
        // echo json_encode($files);
        $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
        $bddir=$bddir.basename($_FILES['photo']['name']);

        $post=new Post();
        if($post->add($comment)){
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
                $old_filename=$uploadfile;
                $uploadfile=imagecreatefromjpeg($uploadfile);
                unlink( $old_filename );
                move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
                $photo=new Photo();
                if($photo->add($name, $bddir, $format)){
                    $response =[
                        "status" =>true,
                    ];
                } else {
                    array_push($errors, "Ошибка добавления фото\n");
                }
            } else {
                array_push($errors, "Ошибка сохранения на сервер\n");
            }
        } else {
            array_push($errors, "Ошибка создания поста\n");
        }
        if (!empty($errors)) {
            $response =[
                "status" =>false,
                "errors" =>$errors
            ];
        }
        echo json_encode($response);
    }