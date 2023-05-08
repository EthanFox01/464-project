<?php
session_start();

function checkNameState()
{
    if(!isset($_SESSION['name']))
    {   
        echo "Ethan";
    } else {
        echo $_SESSION['name'];
    }
}


if ($_SERVER['REQUEST_METHOD'] == $_POST)
{
    $_SESSION['name'] = $_POST['name'];
    echo $_SESSION['name'];
}

function pullImages()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "image_storing";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $query = $conn->query("SELECT * FROM images WHERE user=".$_SESSION['name']." ORDER BY id DESC");

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
                <!-- <button class="dropbtn"><?php checkNameState()?></button> -->
                <button class="dropbtn">Log In</button>
                <div class="dropdown-content">
                    <button class="dark_mode dropbtn" onclick="handleUserSelection('Ethan')" >Ethan</button>
                    <button class="dark_mode dropbtn"onclick="handleUserSelection('Mike')">Mike</button>
                    <button class="dark_mode dropbtn" >+ Add New User</button>
                </div>
            </div>
        </li>
    </ul>
    <div class="home_flex_container">
        <?php pullImages() ?>
    </div>

    <script>
        function handleUserSelection(name) {
            console.log(name);
            var message = name;
            var url = "index.php?name=" + name;
            request = new XMLHttpRequest();
            request.open("POST", url, true);
            request.send(JSON.stringify({name: name}));
        }
    </script>
</body>

</html>