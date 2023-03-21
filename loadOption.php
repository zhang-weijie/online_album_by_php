<?php
    header('Content-Type:application/json');

    $arr = array();

    $conn = new Redis();
    $conn->connect('127.0.0.1', 6379);
    $keys = $conn->lRange('option',0,-1);
    foreach($keys as $key => $val){
        $subArr = array();
        $subKeys = $conn->lRange($val,0,-1);
        foreach($subKeys as $subKey => $subVal){
            //without +1 the index of subarray wouldn't be stored in json explicitly
            $subArr[$subKey + 1] = $subVal;
        }
        $arr[$val] = $subArr;
    }
    echo json_encode($arr);