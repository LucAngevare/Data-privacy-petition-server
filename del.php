<?php
$conn = new mysqli("remotemysql.com", getenv('username'), getenv('password'), getenv('username'));

$res = mysqli_query($conn, "SELECT 1 FROM users WHERE user=\"".preg_replace('/[^A-Za-z0-9\-]/', '', $_GET["username"])."\" AND password=\"".md5($_GET["password"])."\";");

if (!(mysqli_fetch_all($res)[0][0]==1)) {
  header("Location: https://petitie.lucangevare.nl/");
  die();
}

mysqli_query($conn, "DELETE FROM registrations WHERE IP='".$_GET['ip']."';");

header("location:admin.php?username=".$_GET["username"]."&password=".$_GET["password"]);