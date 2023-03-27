<?php
//save the photo to directory
$file = $_FILES['photo'];
$path = '';
if (is_uploaded_file($file['tmp_name'])) {
    $path = 'static/photo/' . time() . '.png';
    if (move_uploaded_file($file['tmp_name'], $path)) {
        echo '<script>alert("Photo saved!")</script>';
    } else {
        echo '<script>alert("Error occurred!")</script>';
    }
} else {
    echo '<script>alert("Upload failed!")</script>';
}

//save photo info to db
include_once "constants.php";
include_once "setupDB.php";
global $link, $table;

//$author_id = $_POST['author_id'];
//$country_id = $_POST['country_id'];
//$city_id = $_POST['city_id'];
//$theme_id = $_POST['theme_id'];
//$figure_id = $_POST['figure_id'];
//$_POST['date'] = date("Y-m-d", strtotime($_POST['date']));
$_POST['desc'] = "'{$_POST['desc']}'";
$_POST['path'] = "'$path'";
sqlInsert($link, $table, $_POST);



header("Location: ./addPhoto.php");
header("refresh:3,addPhoto.php");
