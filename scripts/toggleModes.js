function setLightMode() {
    var body = document.body;
    body.classList.remove("dark_mode", "oled_mode");
    body.classList.add("light_mode");
    document.getElementById("mode_dropdown").textContent = "Light Mode"
    var buttons = document.getElementsByTagName("a")
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove("dark_mode", "oled_mode");
        buttons[i].classList.add("light_mode");
    }
}

function setDarkMode() {
    var body = document.body;
    body.classList.remove("light_mode", "oled_mode");
    body.classList.add("dark_mode");
    document.getElementById("mode_dropdown").textContent = "Dark Mode"
    var buttons = document.getElementsByTagName("a")
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove("light_mode", "oled_mode");
        buttons[i].classList.add("dark_mode");
    }
}

function setOLEDMode() {
    var body = document.body;
    body.classList.remove("dark_mode", "light_mode");
    body.classList.add("oled_mode");
    document.getElementById("mode_dropdown").textContent = "OLED Mode"
    var buttons = document.getElementsByTagName("a")
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove("dark_mode", "light_mode");
        buttons[i].classList.add("oled_mode");
    }
}