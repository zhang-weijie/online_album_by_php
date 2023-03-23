<?php
    header('Content-type:text/html;charset=utf-8');
    $link = mysqli_connect('localhost:3306','root','166414');
    if (!$link){
        die('Connection failed!');
    }

    //set charset
    mysqli_query($link,'set names utf8');

    //select db
    mysqli_query($link,'use `master_slave_replication_db`');

//test
//$res = mysqli_query($link, 'show tables');
//var_dump($res);
//mysqli_close($link);