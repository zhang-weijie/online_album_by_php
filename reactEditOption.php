<?php
include_once "setupRedis.php";
global $conn;

$optionVals = $conn->lRange($_GET["option"], 0, -1);
echo "Option Value：<select id='optionValId' required><option disabled selected>---Check/Select---</option>";
foreach ($optionVals as $optionKey => $optionVal) {
    //indices in array begins at 0, ids in db begins at 1
    $idInDB = $optionKey + 1;
    echo "<option value='$idInDB'>$optionVal</option>";
}
echo "</select><br>";

echo "<form action='executeEditOption.php' method='post'>";
$inputType = ($_GET["option"] == "date") ? "date" : "text";
switch ($_GET["operation"]) {
    case "add":
        echo "Add a new value: <input type='$inputType' id='newOptionValId' required><br><button type='submit' style='background: lawngreen'>confirm</button><button type='reset' style='background: aqua'>reset<button";
        break;
    case "rename":
        echo "Enter a new value: <input type='$inputType' id='newOptionValId' required><br><button type='submit' style='background: lawngreen'>confirm</button><button type='reset' style='background: aqua'>reset<button";
        break;
    case "delete":
        echo "<button type='submit' style='background: lawngreen'>confirm</button><button type='reset' style='background: aqua'>reset<button";
        break;
    default:
}
echo "</form>";
