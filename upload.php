<?php
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
                $insert = $conn->query("INSERT INTO images (file_name, caption, user) VALUES (\"" . $fileName . "\", \"" . $caption . "\", \"Ethan\")");
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
        <li><a class="dark_mode active_tab" href="index.php">Home</a></li>
        <li><a class="dark_mode" href="upload.php">Upload</a></li>
        <li><a class="dark_mode" href="feedback.php">Feedback</a></li>
    </ul>
    <br><br><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <input type="file" id="file" name="file"><br><br>
        <label>Caption: </label>
        <input type="text" id="caption" name="caption" value=""><br><br>
        <input type="submit" name="submit" value="Upload">
    </form>
</body>

</html>