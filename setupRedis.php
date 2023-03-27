<?php
include_once "constants.php";
include_once "setupDB.php";
global $idOptions, $link, $redisHost, $redisPort;

$conn = new Redis();
$conn->connect($redisHost, $redisPort);
$conn->del("option");
foreach ($idOptions as $idOption) {
    $conn->rPush("option", $idOption);
    updateRedis($link, $conn, $idOption);
}

