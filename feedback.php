<?php
session_start();

function checkNameState()
{
    if (!isset($_SESSION['name'])) {
        $_SESSION['name'] = "Ethan";
    }
    echo $_SESSION['name'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="scripts/toggleModes.js"></script>
</head>

<body class="dark_mode">
    <h1 class="Header" id="first_header">464 Project</h1>
    <ul id="na">
        <li><a class="dark_mode" href="index.php">Home</a></li>
        <li><a class="dark_mode" href="upload.php">Upload</a></li>
        <li><a class="dark_mode active_tab" href="feedback.php">Feedback</a></li>
        <li style="float:right">
            <div class="dropdown">
                <button id="dropbtn" class="dropbtn">
                    <?php checkNameState() ?>
                </button>
                <div class="dropdown-content">
                    <button class="dark_mode dropbtn" onclick="handleUserSelection('Ethan')">Ethan</button>
                    <button class="dark_mode dropbtn" onclick="handleUserSelection('Demo User')">Demo User</button>
                </div>
            </div>
        </li>
    </ul>
    <br><br><br>
    <form id="feedback_form" onsubmit="feedbackProcess()">
        <div class="radio_rating">
            <label>Please give a rating for the site: </label>
            <label>
                <input type="radio" name="rating" value="1">1
            </label>
            <label>
                <input type="radio" name="rating" value="2">2
            </label>
            <label>
                <input type="radio" name="rating" value="3">3
            </label>
            <label>
                <input type="radio" name="rating" value="4">4
            </label>
            <label>
                <input type="radio" name="rating" value="5">5
            </label>
        </div>

        <div style="margin:8px 0px 8px 0px">
            <label>Please provide any comments you have about the site:</label><br>
            <textarea id="comments" name="comments" rows="5" cols="40"></textarea>
        </div>

        <div style="margin:8px 0px 8px 0px">
            <label>Enter your email: </label>
            <input id="email" type="text" name="email" size="40">
        </div>
        <input type="submit" value="Submit">
    </form>

    <script>
        function handleUserSelection(name) {
            var message = name;
            var url = "users.php";
            var params = "name=" + name;
            request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var dropbtn = document.getElementById("dropbtn");
                    response = request.responseText;
                    dropbtn.innerHTML = response;
                    window.location = window.location;
                }
            }
            request.open("POST", url, true);
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            request.send(params);
        }
    </script>
</body>

</html>