<?php
include_once 'setupRedis.php';
global $conn;
$opName = $_GET['opName'];
$required = ($opName === 'add') ? '' : 'required';
$hint = ($opName === 'rename') ? 'select an item to rename' : 'check all items';
$disabled = ($opName === 'add') ? 'disabled' : '';
$response = "<form action='reactEditOption.php' method='post' id='form_id'>
            option: <select $required name='optionItem'>
                        <option disabled selected value=''>---$hint---</option>";
$option = $_GET['option'];
$optionItems = $conn->lRange($option, 0, -1);
foreach ($optionItems as $item) {
    $response .= "<option value='$item' $disabled>$item</option>";
}
$response .= "</select>";
$placeholder = ($opName === 'add') ? 'enter the new item' : 'enter the new name';
$inputOfForm = "<input name='opName' value='$opName' hidden><input name='option' value='$option' hidden>";
$inputOfForm .= ($opName === 'delete') ? '' : "<input placeholder='$placeholder' name='input' required>";
$response .= "$inputOfForm
                <button type='submit'>$opName</button>
            </form>";
echo $response;
