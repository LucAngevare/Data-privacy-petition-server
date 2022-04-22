<!DOCTYPE html>
<?php
error_reporting(0); 
if (isset($_COOKIE["signed"])) {echo "<script>changeTitle('Duplicate entry')</script>";} else {
  setcookie("signed", "TRUE");
}
?>
<html>
  <head>
    <title>Petition</title>
    <link rel="stylesheet" href="styles.css"/>
    <link rel="stylesheet" href="fonts.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>
    <script src="script.js"></script>
    <?php
    if(isset($_POST['Submit'])){
      if (empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0) {
        echo "<script>changeTitle('Captcha failed')</script>";
      }
      echo $_SESSION['captcha_code'];
    }

    $conn = new mysqli("remotemysql.com", getenv('username'), getenv('password'), getenv('username'));
    if ($conn->connect_error) {
      echo "<h1>Er is iets foutgegaan... Probeer het alstublieft opnieuw!</h1>
      <p>U wordt in 5 seconden teruggestuurd.</p>
      <script>changeTitle('Verbinding verbroken')</script>";
    }

    if ($result = $conn->query("SELECT * FROM registrations")) {
      $rowcount = mysqli_num_rows($result);
    }

    if (count($_POST) === 0) echo "<script>changeTitle('Geen gegevens ingevuld')</script>"; //Because why the heck would PHP have any syntax available to redirect a user
    if (!(bool)preg_match('/^\S+@\S+\.\S+$/i', $_POST["Email"])) echo "<script>changeTitle('Het e-mail-adres is niet valide')</script>";

    $keys = array();
    $values = array();
    $index = 0;
    $data = "";
    foreach($_POST as $key => $value) {
      if (strlen($value) === 0) echo "<script>changeTitle('". $key ." niet ingevuld')</script>";
      if ($key === "Captcha") continue;
      $data .= $key .": ". $value ."<br/>";
      $keys[$index] = str_replace("_", " ", $key);
      $values[$index] = "'". $value ."'";
      if ($key === "Birth") $values[$index] = date_format(date_create($value), 'Ymd'); // PHP is so unbelievably dumb that even within a string, using a minus symbol or backslash for date formats, it decides to just subtract or divide instead of using string interpolation... oh my god
        // attempt to overwrite by using the same index in the array, see how well PHP handles that
      $index++;
    }
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    array_push($keys, 'IP');
    array_push($values, "\"".$ip."\"");
    echo "INSERT INTO registrations(". implode(", ", $keys) .") VALUES (". implode(", ", $values) .");";

    if ($conn->query("INSERT INTO registrations(". implode(", ", $keys) .") VALUES (". implode(", ", $values) .");") !== TRUE) { //This is so unbelievably insecure I hate PHP so much, the only injection prevention they sort of had became deprecated in v5.5
      echo "<script>changeTitle(\"".$conn->error."\")</script>";
    }
    mail($_POST["Email"], "Uw handtekening is gezet!", wordwrap("Beste ".strtok($_POST['Name'], " ").",\r\n\r\nDank u wel voor uw handtekening op de petitie voor data privacy! Er zijn nu nog maar ".number_format(40000 - (int)$rowcount, 0, ',', '.')." handtekeningen nodig, maar we houden u op de hoogte!", 70));
    ?>
    <h1 id="message">Dank u wel voor uw handtekening!</h1>
    <p id="extra-info"></p>
    <p>Er zijn nog maar <?php echo number_format(40000 - (int)$rowcount, 0, ',', '.');?> handtekeningen nodig</p>
    <h3>Uw informatie:</h3>
    <p><?php echo $data?></p>
  </body>
</html>