<?php
session_start();

if (isset($_POST['name'])) {
  $_SESSION['name'] = $_POST['name'];
  echo $_SESSION['name'];
}
?>
