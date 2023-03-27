<!DOCTYPE html>
<html lang="en">
<style>
    .queryTable {
        position: absolute;
        left: 111px;
        top: 222px
    }

    .btn1 {
        position: absolute;
        left: 45%;
        top: 50%;
    }

    .btn2 {
        position: absolute;
        left: 55%;
        top: 50%;
    }
</style>
<head>
    <meta charset="UTF-8">
    <title>Index</title>
</head>
<body>
<div class="queryTable">
    <form action="searchPhoto.php" method="post">
        <?php
        include_once 'setupRedis.php';
        global $conn;
        drawOptions($conn);
        ?>
        date: <input name="date" type="date">
        <input type="submit" value="Search" style="background-color: lawngreen">
        <br>
        <br>
        <br>
        <div class="btn">
            <button class="btn1"><a href="editOption.php">Edit Options</a></button>
            <button class="btn2"><a href="addPhoto.php">Upload Photo</a></button>
        </div>
    </form>
    <br>
</div>
</body>
</html>