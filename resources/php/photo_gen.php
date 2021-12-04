<?php
    require_once "models/Photo.php";

    if (!array_key_exists('page', $_GET)) {
        return;
    }
    $page_num = (int)$_GET['page'];
    $photos_per_page = 9;
    $offset = $page_num * $photos_per_page;

    $photo_obj = new Photo();
    $photos = $photo_obj->getPhotosWithOffset($offset);
?>
<?php foreach ($photos as $photo): ?>
    <a href="photo_page.php?photo_id=<?php echo $photo['photo_id'];?>">
        <img class="photo_card" src="<?php echo $photo['photo_path'];?>" width="400" height="auto" data-id="<?php echo $photo['photo_id'];?>">
    </a>
<?php endforeach;