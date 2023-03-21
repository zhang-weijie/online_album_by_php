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
<!--<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>-->
<script type="text/javascript" src="jquery-3.5.1.min.js"></script>
<script>
    //在不使用模板引擎的情况下获得后端ModelAndView传递的参数,
    //参见：https://blog.csdn.net/qq_41495525/article/details/101343675
    function getQueryVariable(variable) {
        let query = window.location.search.substring(1);
        // console.log("query:");
        // console.log(query);
        let lets = query.split("&");
        // console.log("lets:");
        // console.log(lets);
        for (let i = 0; i < lets.length; i++) {
            let pair = lets[i].split("=");
            console.log("pair:");
            console.log(pair);
            if (pair[0] == variable) {
                return decodeURI(pair[1]);
            }
        }
        return null;
    }

    //加载页面时填充选项栏
    function loadOption(variables) {
        $.post(
            "/loadOption",

            function (returnData) {
                let optionMap = JSON.parse(returnData);
                // console.log(optionMap);
                // console.log(optionMap.creditTo);
                // console.log(optionMap.creditTo[1]);
                //调用initializeOption
                initializeOption(optionMap, variables);
            });
    }

    function initializeOption(optionMap, variables) {

        //向query中注入<option></option>
        for (let itemKey in optionMap) {
            let itemVal = optionMap[itemKey];
            let tmpHtml = "";
            for (let subItemKey in itemVal) {
                let subItemVal = itemVal[subItemKey];
                // console.log(subItemVal);
                // console.log("variables[itemKey.slice(1,-2)]:");
                // console.log(itemKey);
                // console.log(variables[itemKey + "Id"]);
                if (subItemKey === variables[itemKey + "Id"]) {
                    tmpHtml += "<option selected value='" + subItemKey + "'>" + subItemVal + "</option>"
                } else {
                    tmpHtml += "<option value='" + subItemKey + "'>" + subItemVal + "</option>"
                }
            }
            $("#" + itemKey).html(tmpHtml);
        }
    }

</script>
<!--从url中获取id,然后通过ajax从后端获取-->
<script>
    let variables = {
        creditToId: null,
        createDateId: null,
        createCountryId: null,
        createCityId: null,
        themeId: null,
        figureId: null,
    }

    //通过ajax获取此id对应的数据并注入到photoInfo中
    $(document).ready(function () {
        variables.creditToId = getQueryVariable("creditToId");
        variables.createDateId = getQueryVariable("createDateId");
        variables.createCityId = getQueryVariable("createCityId");
        variables.createCountryId = getQueryVariable("createCountryId");
        variables.themeId = getQueryVariable("themeId");
        variables.figureId = getQueryVariable("figureId");
        // console.log("variables:");
        // console.log(variables);

        loadOption(variables);

        // let desc = getQueryVariable("desc");
        // console.log(desc);

        $("#id").val(getQueryVariable("id"));
        $("#descId").val(getQueryVariable("desc"));
    });

</script>
<script>
    function addSuccess() {
        alert("添加成功！");
    }

    function back() {
        //回退
        window.history.back();
    }
</script>
</html>
