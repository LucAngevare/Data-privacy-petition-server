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
        // Check to see whether the captcha is correct
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
    // Number of rows filled, to get the amount of signed petitions, to check how many petitions still need to be signed

    if (count($_POST) === 0) echo "<script>changeTitle('Geen gegevens ingevuld')</script>"; //Because why the heck would PHP have any syntax available to redirect a user
    if (!(bool)preg_match('/^\S+@\S+\.\S+$/i', $_POST["Email"])) echo "<script>changeTitle('Het e-mail-adres is niet valide')</script>";
    //Check to see whether an e-mail-address fits in the regular expression, otherwise it is not a supported format

    $keys = array();
    $values = array();
    $index = 0;
    $data = "";
    // initializing empty arrays for the keys and values so an manipulating an SQL query is just a matter of using a join function (oh wait no that's called implode here because of course)
    foreach($_POST as $key => $value) {
      // Get all the keys and values from every POST variable, every name of every value in the index page is equal to a column name, so every key from POST is the name of an SQL column, so everything can be programmed declaritively.
      if (strlen($value) === 0) echo "<script>changeTitle('". $key ." niet ingevuld')</script>";
      // Every value is one that needs to be filled in
      if ($key === "Captcha") continue;
      // Captcha is not a value that should be put in the SQL database obviously, so if we get that key, we should skip to the next key/value pair in the object
      $data .= $key .": ". $value ."<br/>";
      // String manipulation so we can portray all the data in a string to the user
      $keys[$index] = str_replace("_", " ", $key);
      // Because names can't have spaces (or at least I didn't feel like doing the research to check whether they can), just replace every underscore with the space
      $values[$index] = "'". $value ."'";
      if ($key === "Birth") $values[$index] = date_format(date_create($value), 'Ymd'); // PHP is so unbelievably dumb that even within a string, using a minus symbol or backslash for date formats, it decides to just subtract or divide instead of using string interpolation... oh my god
        // Format the retrieved date to YYYYMMDD because of the previous reason and that's the only format MySQL accepts
      $index++;
    }
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    } // Check which IP address is the correct one because headers are different for each OS/browser/etc, but this is the most reliable method as far as my research tells me
    array_push($keys, 'IP');
    array_push($values, "\"".$ip."\"");

    if ($conn->query("INSERT INTO registrations(". implode(", ", $keys) .") VALUES (". implode(", ", $values) .");") !== TRUE) { //This is so unbelievably insecure I hate PHP so much, the only injection prevention they sort of had became deprecated in v5.5
      echo "<script>changeTitle(\"".$conn->error."\")</script>";
    }
    mail($_POST["Email"], "Uw handtekening is gezet!", wordwrap("Beste ".strtok($_POST['Name'], " ").",\r\n\r\nDank u wel voor uw handtekening op de petitie voor data privacy! Er zijn nu nog maar ".number_format(40000 - (int)$rowcount, 0, ',', '.')." handtekeningen nodig, maar we houden u op de hoogte!", 70)); // Send confirmation e-mail to the person signing the petition, in ideal situations this works but PHP requires the pointer to the executable to send the email, and that's not possible in Replit
    ?>
    <h1 id="message">Dank u wel voor uw handtekening!</h1>
    <p id="extra-info"></p>
    <p>Er zijn nog maar <?php echo number_format(40000 - (int)$rowcount, 0, ',', '.');?> handtekeningen nodig</p>
    <h3>Uw informatie:</h3>
    <p><?php echo $data?></p>
  </body>
</html>