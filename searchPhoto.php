<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
</head>
<body>
<table border="1">
    <?php
    //include_once all needed php files at very beginning, use included variables globally (in function scope as well)
    include_once 'constants.php';
    include_once 'setupDB.php';
    include_once 'setupRedis.php';

    global $options;
    echo "<tr>";
    foreach ($options as $option) {
        echo "<th>$option</th>";
    }

    echo "</tr>";

    function getValueById($option, $id): string
    {
        global $conn;
        //index of a list in redis begins at 0, but printed starting at 1
        return $conn->lIndex($option, $id - 1);
    }

    function drawPhotoTd($condition): void
    {
        global $table ,$options, $idOptions, $link;
        $rows = sqlSelect($link, $table, $condition);
        foreach ($rows as $row) {
            $cnt = 0;
            echo "<tr>";
            foreach ($row as $item) {
                //options stored as id should be mapped to its value
                if (in_array($options[$cnt], $idOptions)) {
                    $item = getValueById($options[$cnt], $item);
                }
                //generate for the photo description a link
                if ($cnt == count($options) - 2) {
                    //deliver "this" as parameter, it refers to the current element
                    $placeholder = (empty($item) || trim($item) == "")? "unknown" : $item;
                    $item = "<a href='{$row[$cnt + 1]}' onmouseover='showThumbnail(this)' onmouseout='hideThumbnail(this)'><img src='{$row[$cnt + 1]}' alt='{$row[$cnt + 1]}' style='display: none'>$placeholder</a>";
                }
                //generate radio buttons for updating photos
                if ($cnt == count($options) - 1) {
                    //add params to the url of <a> tag
                    $item = "<button style='background-color: lawngreen'><a href='updatePhoto.php?id=$row[0]&author_id=$row[1]&city_id=$row[2]&country_id=$row[3]&theme_id=$row[4]&figure_id=$row[5]&date=$row[6]&desc=$row[7]&path=$row[8]'>Update</a></button><button style='background-color: aqua'><a href='$item' download='{$row[$cnt - 1]}'>Download</a></button>";
                }
                $cnt++;
                echo "<td>$item</td>";
            }
            echo "</tr>";
        }
    }
    $condition = array();
    $keys = array_keys($_POST);
    foreach ($keys as $key) {
        if (!empty($_POST[$key])){
            $condition[$key] = $_POST[$key];
        }
    }
    drawPhotoTd($condition);
    ?>
</table>
<button style="background-color: aqua"><a href="javascript: history.back()">Back</a></button>
<button style="background-color: lawngreen"><a href="index.php">Home</a></button>
<script>
    function showThumbnail(ele){
        ele.firstChild.style = "position: absolute;display: block; width: 25%; height: 25%";
    }
    function hideThumbnail(ele){
        ele.firstChild.style.display = "none";
    }
</script>
</body>

