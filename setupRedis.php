<?php
include_once 'setupDB.php';
$showTables = mysqli_query($link,'show tables');
$fetchedTables = mysqli_fetch_all($showTables);
$tables = array();
foreach ($fetchedTables as $key){
    if ($key[0] !== 'photo'){
        $tables[] = $key[0];
    }
}

$conn = new Redis();
$conn->connect('127.0.0.1', 6379);
$conn->del('option');
foreach ($tables as $option){
    $sql = "select `name` from $option";
    $fetchedOptionTables = mysqli_query($link,$sql);
    $conn->rPush('option',$option);
    $conn->del($option);
    foreach ($fetchedOptionTables as $key){
        $conn->rPush("$option",$key['name']);
    }
}

function draw_options($conn): void
{
    $options = $conn->lRange('option', 0, -1);
    foreach ($options as $val) {
        echo $val . ': ';
        echo "<select required name='{$val}_id' id='$val'>";
        echo '<option disabled selected value="">---Select---</option>';

        $subKeys = $conn->lRange($val, 0, -1);
        foreach ($subKeys as $subKey => $subVal) {
            //indices in array begins with 0, ids in db begins with 1
            $tmp = $subKey + 1;
            echo "<option value='$tmp'>$subVal</option>";
        }
        echo '</select>';
    }
}


