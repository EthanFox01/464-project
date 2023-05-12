<?php
session_start();

function checkNameState()
{
    if (!isset($_SESSION['name'])) {
        $_SESSION['name'] = "Ethan";
    }
    echo $_SESSION['name'];
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "image_storing";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "images/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $caption = $_POST["caption"];

    if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database
                $insert = $conn->query("INSERT INTO images (file_name, caption, user) VALUES (\"" . $fileName . "\", \"" . $caption . "\", \"" . $_SESSION['name'] . "\")");
            }
        }
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
        <li><a class="dark_mode" href="index.php">Home</a></li>
        <li><a class="dark_mode active_tab" href="upload.php">Upload</a></li>
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
    <br><br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <input type="file" id="file" name="file"><br><br>
        <label>Caption: </label>
        <input type="text" id="caption" name="caption" value=""><br><br>
        <input type="submit" name="submit" value="Upload">
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