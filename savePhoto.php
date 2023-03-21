<?php
    //save the photo to directory
    $file = $_FILES['photo'];
    $path = '';
    if (is_uploaded_file($file['tmp_name'])){
        $path = 'static/photo/' . time() . $file['name'];
        if (move_uploaded_file($file['tmp_name'],$path)){
            echo '<script>alert("Photo saved!")</script>';
        } else {
            echo '<script>alert("Error occurred!")</script>';
        }
    } else {
        echo '<script>alert("Upload failed!")</script>';
    }

    //save photo info to db
    include_once 'setupDB.php';
    $author_id = $_POST['author_id'];
    $country_id = $_POST['country_id'];
    $city_id = $_POST['city_id'];
    $theme_id = $_POST['theme_id'];
    $figure_id = $_POST['figure_id'];
    $date = date("Y-m-d",strtotime($_POST['date']));
    $desc = $_POST['desc'];

    $sql = "insert into master_slave_replication_db.photo(`author_id`, `country_id`, `city_id`, `theme_id`, `figure_id`, `date`, `desc`, `path`) values($author_id,$country_id,$city_id,$theme_id,$figure_id,'$date','$desc','$path')";
    echo $sql;
    mysqli_query($link,$sql);

//    header("Location: ./addPhoto.php");
//    header("refresh:3,addPhoto.php");
