<?php
$params = $_POST;
//distinguish different operations according to length of array $params and names of its elements
//examples: output of var_dump($params)
//add:      array(3) { ["opName"]=> string(3) "add" ["option"]=> string(6) "author" ["input"]=> string(7) "newItem" }
//rename:   array(4) { ["optionItem"]=> string(6) "weijie" ["opName"]=> string(6) "rename" ["option"]=> string(6) "author" ["input"]=> string(7) "newItem" }
//delete:   array(3) { ["optionItem"]=> string(6) "weijie" ["opName"]=> string(6) "delete" ["option"]=> string(6) "author" }
if  (count($params) === 4){

} else {
    if (array_key_exists('optionItem',$params)){

    } else {

    }
}