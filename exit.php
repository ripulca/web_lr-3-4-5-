<?php

session_start();

if(!empty($_SESSION)){
    if ($_SESSION['user_id']) {
        unset($_SESSION['user_id']);
        unset($_SESSION['count']);
    }
}
header("Refresh:0; url=index.php");