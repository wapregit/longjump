<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Runner</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
    }

    #numberDisplay {
        font-size: 48px;
        margin-bottom: 20px;
    }

    #runButton {
        font-size: 16px;
        padding: 10px 20px;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <h1>Number Runner</h1>
    <div id="numberDisplay">0</div>
    <button id="runButton" onclick="runNumber()">Run Number</button>

    <script>
    function runNumber() {
        let numberDisplay = document.getElementById('numberDisplay');
        let number = parseInt(numberDisplay.innerText);
        number++;
        if (number > 10) { // กำหนดเลขที่ต้องการ
            number = 1; // เมื่อเลขถึง 10 ให้เริ่มนับใหม่ที่ 1
        }
        numberDisplay.innerText = number;
    }
    </script>
</body>

</html>