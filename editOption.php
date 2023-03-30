<!DOCTYPE html>
<html lang="en">
<style>
    .infoTable {
        position: absolute;
        left: 35%;
        top: 40%;
    }

    .mask {
        position: fixed;
        left: 0;
        top: 0;
        /*background: #000;*/
        background: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100%;
        /*opacity: 0.5;*/
    }

    .popup {
        position: relative;
        background: #fff;
        width: 25%;
        height: 25%;
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
    <form action="#">
    Option：
        <select id="optionId" name="optionName" required>
        <option disabled selected value="not selected">---Select---</option>
        <?php
        include_once 'setupRedis.php';
        global $conn;
        $options = $conn->lRange('option', 0, -1);
        foreach ($options as $option) {
            echo "<option value='$option'>$option</option>";
        } ?>
    </select>
    Operation：
    <button name="add" onclick="addOptionVal()" style="background-color: lawngreen">add</button>
    <button name="rename" onclick="renameOptionVal()" style="background-color: yellow">rename</button>
    <button name="delete" onclick="deleteOptionVal()" style="background-color: red">delete</button>
    </form>
    <button style="background-color: aqua"><a href="index.php">Home</a></button>
</div>

<div class="mask" id="mask_id" style="display: none">
    <div class="popup">
        <div id="header">
            <div id="header-right" onclick="hideMask()">x</div>
            <div id="actionExe" class="actionDiv">

            </div>
        </div>
    </div>
</body>
<script src="static/js/jquery-3.5.1.min.js"></script>
<!--popup controller-->
<script>
    function showMask() {
        // $("#mask_id").style.display = "";
        document.getElementById("mask_id").style.display = "";
    }

    function hideMask() {
        // $("#actionExe").innerHTML = "";
        // $("#mask_id").style.display = "none";
        document.getElementById("actionExe").innerHTML = "";
        document.getElementById("mask_id").style.display = "none";
    }
</script>
<script>
    function optionIsSelected(){
        // return $("#optionId").find("option:selected").length > 0;
        // return $("#optionId").has("option:selected");
        return $("#optionId").find("option:selected").attr("value") !== "not selected";
    }

    function loadOptionVal(operation) {
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
                // $("#actionExe").innerHTML = xmlHttp.responseText;
            }
        }
        // let option = document.getElementById("optionId").find("option:selected").attr("value");
        let option = $("#optionId").find("option:selected").attr("value");
        xmlHttp.open("GET", "reactEditOption.php?operation=" + operation + "&option=" + option, true);
        xmlHttp.send();
    }

    function addOptionVal() {
        if (optionIsSelected()){
            showMask();
            loadOptionVal("add");
        }
    }

    function renameOptionVal() {
        showMask();
        loadOptionVal("rename");
    }

    function deleteOptionVal() {
        showMask();
        loadOptionVal("delete");
    }
</script>
</html>