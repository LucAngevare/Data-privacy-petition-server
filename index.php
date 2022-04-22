<?php
$requestedpage = $_SERVER["REQUEST_URI"];
if ($requestedpage === "/") {
  include "index1.php";
  exit;
} else if ($requestedpage === "/admin") {
  include "admin.php";
  exit;
} else {
  include "404.php";
  exit;
}