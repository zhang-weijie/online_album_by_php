<!DOCTYPE html>
<html lang="en">
<style>
    .queryTable {
        position: absolute;
        left: 111px;
        top: 222px
    }

    .btn {
        position: absolute;
        left: 30%;
        top: 50%;
    }
</style>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="queryTable">
    <form action="executeUpdatePhoto.php" method="post" enctype="multipart/form-data">
        <?php
        include_once 'setupRedis.php';
        global $conn;
        echo "<input name='id' value='{$_GET["id"]}' hidden>";
        echo "<img src='{$_GET["path"]}' alt='{$_GET["desc"]}' style='width: 25%; height: 25%'>";
        echo "<br>";
        drawOptions($conn, $_GET);
        $date = date("Y-m-d", strtotime($_GET["date"]));
        echo "date: <input name='date' type='date'value='$date'>";
        echo "desc：<input name='desc' value= '{$_GET["desc"]}'>";
        echo "<input name='path', value='{$_GET["path"]}' hidden>";
        echo "<div class='btn'>
            Upload a new photo：<input type='file' name='photo' src='{$_GET["path"]}' accept='.png'>
            <input type='submit' value='Update' style='background-color: lawngreen'>
            <button style='background-color: lightblue'><a href='javascript: history.back()'>Back</a></button>
            <button style='background-color: aqua'><a href='index.php'>Home</a></button>
        </div>";
        ?>
    </form>
</div>
</body>
</html>
