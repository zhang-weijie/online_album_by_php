<?php
$db = "`master_slave_replication_db`";
$table = "$db.`photo`";
$options = array('id', 'author', 'country', 'city', 'theme', 'figure', 'date', 'desc', 'manage');
$idOptions = array('author', 'country', 'city', 'theme', 'figure');
$redisHost = "127.0.0.1";
$redisPort = 6379;

//function to execute SQL query like 'select * from db where key = value'
//$column='*': parameter with default value must be at last
function sqlSelect($link, $table, $condition=[], $column='*') : array
{
    $sql = "SELECT $column FROM $table WHERE ";
    foreach ($condition as $key => $val){
        $sql .= "`$key` = $val AND ";
    }
    if (str_ends_with($sql, " WHERE ")){
        $sql = substr($sql, 0, -7);
    } else {// str ends with " AND "
        $sql = substr($sql, 0, -5);
    }
    return mysqli_fetch_all(mysqli_query($link, $sql));
}

function sqlInsert($link, $table, $condition) : void
{
    $sql = "INSERT INTO $table(";
    $keys = array_keys($condition);
    foreach ($keys as $key) {
        $sql .= "`$key`, ";
    }
    $sql = rtrim($sql, ", ");
    $sql .= ") VALUES(";
    foreach ($condition as $key => $val){
        $sql .= ($key == "date") ? "STR_TO_DATE('$val', '%Y-%m-%d'), " : "$val, ";
    }
    $sql = substr($sql, 0, -2);
    $sql .= ")";
    mysqli_query($link, $sql);
}

function sqlUpdate($link, $table, $keyVals, $condition) : void
{
    $sql = "UPDATE $table SET ";
    foreach ($keyVals as $key => $val) {
        $sql .= ($key == "date") ? "`$key` = STR_TO_DATE('$val', '%Y-%m-%d'), " : "`$key` = $val, ";
    }
    $sql = substr($sql, 0, -2);
    $sql .= " WHERE ";
    foreach ($condition as $key => $val){
        $sql .= "`$key` = $val AND ";
    }
    $sql = substr($sql, 0, -5);
    echo $sql;
    mysqli_query($link, $sql);
}



function drawOptions($conn, $params = [], $required = false): void
{
    global $idOptions;
    foreach ($idOptions as $option) {
        echo "$option: ";
        echo $required ? "<select required name='{$option}_id' id='$option'>" : "<select name='{$option}_id' id='$option'>";
        echo "<option value=''>---Select---</option>";

        $subKeys = $conn->lRange($option, 0, -1);

        foreach ($subKeys as $subKey => $subVal) {
            //indices in array begins at 0, ids in db begins at 1
            $tmp = $subKey + 1;
            $valID = "{$option}_id";
            echo ($params[$valID] == $tmp) ? "<option value='$tmp' selected>$subVal</option>" : "<option value='$tmp'>$subVal</option>";
        }
        echo "</select>";
    }
}

function updateRedis($link, $conn, $idOption) : void
{
    $conn->del($idOption);
    $idOptionVals = sqlSelect($link, $idOption, column: "`name`");
    foreach ($idOptionVals as $idOptionVal) {
        $conn->rPush("$idOption", $idOptionVal[0]);
    }
}