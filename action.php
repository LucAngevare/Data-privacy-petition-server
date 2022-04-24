<?php
$conn = new mysqli("remotemysql.com", getenv('username'), getenv('password'), getenv('username'));

if (isset($_POST["NewValue"]) && $_POST["action"]==="UPDATE") {
  // if both the update value is selected and the new value corresponding to the update value are filled, continue, to be sure that nothing is empty or incorrect
  $query = $_POST["action"]." registrations SET ".$_POST["Column"]."=\"".$_POST["NewValue"]."\" WHERE ".$_POST["Column"]."=\"".$_POST["Value"]."\"";
  // declaritively generate the UPDATE SQL query
} else if (strlen($_POST["NewValue"])==0 xor $_POST["action"]==="UPDATE") {
  // Something's wrong, either no new value was filled in with update selected, or someone entered a new value with only having selected update as the action.
  if ($_POST["action"]==="DELETE") {
    $query = $_POST["action"]." FROM registrations WHERE ".$_POST["Column"]."=\"".$_POST["Value"]."\"";    
    // if nothing was wrong and it was actually just a delete value, also declaritively generated
  } else {
    echo "<script>history.back()</script>";
    // something genuinely is wrong or nothing was filled in, so we just pull some JavaScript to go back
  }
} else {
  echo "<script>history.back()</script>";
}

$res = mysqli_query($conn, $query);

echo $query."<br/>".$res;
echo "<script>setTimeout(history.back(), 3000)</script>";