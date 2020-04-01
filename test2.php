<!DOCTYPE html>

<html>

    <head>

        <title>HTML</title>

	<script>

function openTextFile() {

    var input = document.createElement("input");



    input.type = "file";

    input.accept = "text/plain";



    input.onchange = function (event) {

        processFile(event.target.files[0]);

    };



    input.click();

}



function processFile(file) {

    var reader = new FileReader();



    reader.onload = function () {

        output.innerText = reader.result;

    };



    reader.readAsText(file, /* optional */ "euc-kr");

}

	</script>

    </head>



    <body>

        <h1>HTML</h1>

        <p>

<button onclick="openTextFile()">Open</button>

<div id='output'>...</div>

	</p>

    </body>

</html>
