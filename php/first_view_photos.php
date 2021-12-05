<?php
    require_once "models/Photo.php";

    $photo_obj = new Photo();
    $photos = $photo_obj->getPhotosWithOffset(0);
?>

<?php foreach ($photos as $photo): ?>
    <a href="/photo_page.php?photo_id=<?php echo $photo['photo_id'];?>">
        <img class="photo_card" src="<?php echo $photo['photo_path'];?>" width="400" height="auto" data-id="<?php echo $photo['photo_id'];?>">
    </a>
<?php endforeach;