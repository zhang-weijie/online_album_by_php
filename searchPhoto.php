<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
</head>
<body>
<table style="border: 1px black">
    <?php
    $options = array('id', 'author', 'country', 'city', 'theme', 'figure', 'date', 'desc', 'photo');
    echo '<tr>';
    foreach ($options as $option){
        echo '<th>' . $option . '</th>';
    }
    echo '</tr>';

    include_once 'setupDB.php';
    $idOptions = array('author', 'country', 'city', 'theme', 'figure');
    function getItemById($conn ,$option, $id) : string
    {
        return $conn->lIndex($option, $id);
    }

    function drawPhotoId($link): string
    {
        $data = '';
        $result = mysqli_query($link, 'select * from master_slave_replication_db.photo');
        $rows = mysqli_fetch_all($result);
        $cnt = 1;
        foreach ($rows as $row) {
            $data .= '<tr>';
            foreach ($row as $item) {
                $val = '';

                $data .= '<td>' . $val . '</td>>';
            }
            $data .= '</tr>';
        }
        return $data;
    }

//    echo draw_photo_td($link);
    ?>
</table>
</body>

