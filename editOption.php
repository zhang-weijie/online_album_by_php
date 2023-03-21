<!DOCTYPE html>
<html lang="en">
<style type="text/css">
    .infoTable {
        position: absolute;
        left: 35%;
        top: 40%;
    }

    .mask {
        position: fixed;
        left: 0px;
        top: 0px;
        /*background: #000;*/
        background: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100%;
        /*opacity: 0.5;*/
    }

    .popup {
        position: relative;
        background: #fff;
        width: 50%;
        height: 80%;
        border-radius: 5px;
        margin: 5% auto;
    }

    #header {
        height: 40px;
    }

    #header-right {
        position: absolute;
        width: 25px;
        height: 25px;
        border-radius: 5px;
        background: red;
        color: #fff;
        right: 5px;
        top: 5px;
        text-align: center;
    }

    .actionDiv {
        position: absolute;
        left: 20%;
        top: 50%;
        text-align: center;
    }
</style>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="infoTable">
    option：
    <select id="optionId" name="optionName" required>
        <option disabled selected value="">---Select---</option>
        <?php
        include_once 'setupRedis.php';
        $options = $conn->lRange('option', 0, -1);
        foreach ($options as $option) {
            echo "<option value='$option'>$option</option>";
        } ?>
    </select>
    operation：
    <button name="add" onclick="edit('add')" style="background-color: lawngreen">add</button>
    <button name="rename" onclick="edit('rename')" style="background-color: yellow">rename</button>
    <button name="delete" onclick="edit('delete')" style="background-color: red">delete</button>
    <button><a href="index.php">Home</a></button>
</div>

<div class="mask" id="mask_id">
    <div class="popup">
        <div id="header">
            <span id="actionName"></span>
            <div id="header-right" onclick="hider()">x</div>
            <div id="actionExe" class="actionDiv">

            </div>
        </div>
    </div>
</div>
</body>
<script src="static/js/jquery-3.5.1.min.js"></script>
<!--popup controller-->
<script>
    document.getElementById("mask_id").style.display = "none";

    function clickme() {
        document.getElementById("mask_id").style.display = "";
    }

    function hider() {
        document.getElementById("actionExe").innerHTML = "";
        document.getElementById("mask_id").style.display = "none";
    }
</script>
<!--operations on options-->
<script>
    function edit(opName) {
        clickme();
        let xmlHttp;
        if (window.XMLHttpRequest) {
            //for IE7+, Firefox, Chrome, Opera, Safari
            xmlHttp = new XMLHttpRequest();
        } else {
            //for IE6, IE5
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {
                document.getElementById("actionExe").innerHTML = xmlHttp.responseText;
            }
        }
        let option = $("#optionId").find("option:selected").attr("value");
        xmlHttp.open("GET", "reactToEditOption.php?opName=" + opName + "&option=" + option, true);
        xmlHttp.send();
    }
</script>
</html>