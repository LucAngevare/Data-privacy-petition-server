<?php
$conn = new mysqli("remotemysql.com", getenv('username'), getenv('password'), getenv('username'));

if (isset($_POST["NewValue"]) && $_POST["action"]==="UPDATE") {
  $query = $_POST["action"]." registrations SET ".$_POST["Column"]."=\"".$_POST["NewValue"]."\" WHERE ".$_POST["Column"]."=\"".$_POST["Value"]."\"";
} else if (strlen($_POST["NewValue"])==0 xor $_POST["action"]==="UPDATE") {
  #Something's wrong, either no new value was filled in with update selected, or someone entered a new value with only having selected update as the action.
  if ($_POST["action"]==="DELETE") {
    $query = $_POST["action"]." FROM registrations WHERE ".$_POST["Column"]."=\"".$_POST["Value"]."\"";    
  } else {
    echo "<script>history.back()</script>";
  }
} else {
  echo "<script>history.back()</script>";
}

$res = mysqli_query($conn, $query);

echo $query."<br/>".$res;
echo "<script>setTimeout(history.back(), 3000)</script>";