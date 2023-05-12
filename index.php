<?php
session_start();

function checkNameState()
{
    if (!isset($_SESSION['name'])) {
        $_SESSION['name'] = "Ethan";
    }
    echo $_SESSION['name'];
}

function pullImages($name)
{
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "image_storing";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = $conn->query("SELECT * FROM images WHERE user=\"" . $name . "\" ORDER BY id DESC");

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $imageURL = 'images/' . $row["file_name"];
            ?>
            <div class="dash_image_card">
                <img src="<?php echo $imageURL ?>" width="400" height=auto>
                <div class="card_caption">
                    <h4><b>
                            <?php echo $row["caption"] ?>
                        </b></h4>
                </div>
            </div>
        <?php }
    }
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
        <li><a class="dark_mode active_tab" href="index.php">Home</a></li>
        <li><a class="dark_mode" href="upload.php">Upload</a></li>
        <li><a class="dark_mode" href="feedback.php">Feedback</a></li>
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
    <div id="image_div" class="home_flex_container">
        <?php pullImages($_SESSION['name']) ?>
    </div>

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