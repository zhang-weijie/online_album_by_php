<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<button onmouseover="displayImg()" onmouseout="vanishImg()" onclick="displayImgOp()">view</button>
<div id="imageWindow">
    <img id="image" src="static/photo/cat.png">
    <div id="imageOp" style="display: none">
        <button>full image</button>
        <button>download</button>
        <button>close</button>
    </div>
</div>
</body>
<script>
    function displayImg() {
        let img = document.getElementById("image");

        let x = event.clientX + document.body.scrollLeft + 20;
        let y = event.clientY + document.body.scrollTop - 5;

        img.style.left = x + "px";
        img.style.top = y + "px";
        img.style.display = "block";
    }
    function displayImgOp() {
        displayImg();
        let op = document.getElementById("imageOp");
        op.style.display = "";
    }
    function vanishImg() {
        let img = document.getElementById("image");
        img.style.display = "none";
    }
</script>
</html>
