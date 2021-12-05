<?php
    require_once 'validation/redirect.php';
    redirectIfUserNotLogged();
    require_once 'models/Photo.php';
    $photo_id=$_GET["photo_id"];
    $photo_obj=new Photo();
    $photo=$photo_obj->getPhotoById($photo_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="resources/css/page_style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/header_style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/main_style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/footer_style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/modal_win_style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/page_style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/rating_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;400&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
    <body>
        <div class="app">
            <?php require 'resources/views/header.php'; ?>
            <main class="main">
                <div class='main_photo_container'>
                    <img src="<?php echo $photo['photo_path'];?>" width="30%" height="auto"/>;
                </div>
                <div class='main_photo_info' style="font-weight:bold; font-size: 30px; text-trnsform: uppercase;">
                    <div class='main_photo_info_interactive'>
                        <div>
                            <p><?php echo $photo['photo_name'];?></p>
                        </div>
                        <div class="main_photo_info_buttons">
                            <div class="rating rating_set">
                                <div class="rating_body">
                                    <div class="rating_active"></div>
                                    <div class="rating_items">
                                        <input type="radio" class="rating_item" name="rating" value="5">
                                        <input type="radio" class="rating_item" name="rating" value="4">
                                        <input type="radio" class="rating_item" name="rating" value="3">
                                        <input type="radio" class="rating_item" name="rating" value="2">
                                        <input type="radio" class="rating_item" name="rating" value="1">
                                    </div>
                                </div>
                                <div class="rating_value">3</div>
                            </div>
                            <!-- <button class="post_btn"><svg width="30" height="21" viewBox="0 0"><path d="M6.83 15.75c.2-.23.53-.31.82-.2.81.3 1.7.45 2.6.45 3.77 0 6.75-2.7 6.75-6s-2.98-6-6.75-6S3.5 6.7 3.5 10c0 1.21.4 2.37 1.14 3.35.1.14.16.31.15.49-.04.76-.4 1.78-1.08 3.13 1.48-.11 2.5-.53 3.12-1.22zM3.24 18.5a1.2 1.2 0 01-1.1-1.77A10.77 10.77 0 003.26 14 7 7 0 012 10c0-4.17 3.68-7.5 8.25-7.5S18.5 5.83 18.5 10s-3.68 7.5-8.25 7.5c-.92 0-1.81-.13-2.66-.4-1 .89-2.46 1.34-4.35 1.4z" id="message_outline_20__Icon-Color" fill="currentColor" fill-rule="nonzero"></path></svg> Comment</button> -->
                        </div>
                    </div>
                    <p class="photo_author">TestUser</p>
                </div>
                <div class='main_comments neomorf_flat'>
                    <div>
                        <p><b>testProfile</b></p>
                        <p>test comment</p>
                        <p>12.09.2045</p>
                    </div>
                </div>
            </main>
            <?php require 'resources/views/footer.php'; ?>
            <?php require 'resources/views/modal_win.php'; ?>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="resources/js/buttons.js"></script>
    <script src="resources/js/modal_win_buttons.js"></script>
    <script src="resources/js/validation.js"></script>
    <script src="resources/js/rating.js"></script>
    </body>
</html>