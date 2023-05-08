<?php
session_start();
if (!isset($_SESSION["counter"])) {
    $_SESSION["counter"] = 0;
}

if (strlen($_GET["message"]) > 0) {
    $_SESSION["counter"]++;
    $file = fopen("counter.txt", "a") or die("Unable to open file");
    fwrite($file, $_GET["message"]);
    fwrite($file, "\n");
    fclose($file);
}

$last_line = "";

$file = "counter.txt";
try {
    $lines = file($file);
    $last_line = trim(end($lines));
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
echo $_SESSION["counter"],":",$last_line;
?>