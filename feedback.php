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
            <!-- <li style="float:right"><a class="dark_mode" href="">About</a></li>
            <li style="float:right">
                <div class="dropdown">
                    <a id="mode_dropdown" class="dark_mode">Dark Mode</a>
                    <div class="dropdown_content">
                        <a class="dark_mode" onclick="setLightMode()">Light Mode</a>
                        <a class="dark_mode" onclick="setDarkMode()">Dark Mode</a>
                        <a class="dark_mode" onclick="setOLEDMode()">OLED Mode</a>
                    </div>
                </div>
            </li> -->
        </ul>
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
                <textarea
                    id="comments" name="comments" rows="5" cols="40"
                ></textarea>
            </div>

            <div style="margin:8px 0px 8px 0px">
                <label>Enter your email: </label>
                <input id="email" type="text" name="email" size="40">
            </div>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>