<?php
//1.usage of redis in php
//install redis extension on php
//https://pecl.php.net/package/redis
//download ddl from https://pecl.php.net/package/redis/5.3.7/windows
//the version of dll must correspond to local php
//extract zip file and copy php_redis.dll file to ext directory of php

//initialize redis

/*$conn = new Redis();
$conn->connect('127.0.0.1', 6379);
$conn->del('option','author','country','city','theme','figure');
$conn->rPush('option','author','country','city','theme','figure');
$conn->rPush('author','weijie','yifan');
$conn->rPush('country','China','Germany');
$conn->rPush('city','Beijing','Chongqing','Lu\'an','Berlin','Frankfurt');
$conn->rPush('theme','campus','travel','landscape','animal');
$conn->rPush('figure','weijie','yifan','weijie and yifan','classmates','friends');*/


//convert arrays to json
//$arr = array('a' => 'apple', 'b' => 'banana', 'c' => 'cat', 'd' => 'dog', 'e' => 'elephant');
//echo json_encode($arr);
