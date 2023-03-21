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
    <title>AddPhoto</title>
</head>
<body>
<div class="queryTable">
    <form action="savePhoto.php" method="post" enctype="multipart/form-data">
        <?php
        include_once 'setupRedis.php';
        draw_options($conn);
        ?>
        date: <input name="date" type="date">
        desc：<input name="desc" placeholder="Leave some notes~">
        <br>
        <br>
        <br>
        <div class="btn">
            Select a photo：<input type="file" name="photo" required>
            <input type="submit" value="Add" style="background-color: lawngreen">
            <button style="background-color: aqua"><a href="index.php">Home</a></button>
        </div>
    </form>
</div>
</body>
</html>