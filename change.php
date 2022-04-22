<link rel="stylesheet" href="admin_page.css">
<link rel="stylesheet" href="fonts.css"/>
<?php
$conn = new mysqli("remotemysql.com", getenv('username'), getenv('password'), getenv('username'));

$res = mysqli_query($conn, "SELECT 1 FROM users WHERE user=\"".preg_replace('/[^A-Za-z0-9\-]/', '', $_GET["username"])."\" AND password=\"".md5($_GET["password"])."\";");

if (!(mysqli_fetch_all($res)[0][0]==1)) {
  header("Location: https://petitie.lucangevare.nl/");
  die();
}

if (isset($_POST["Save"])) {
  mysqli_query($conn, "UPDATE registrations SET Name='".$_POST['Name']."', Birth='".$_POST['Birth']."', Email='".$_POST['Email']."', Street='".$_POST['Street']."', Address='".$_POST['Address']."', Zipcode='".$_POST['Zipcode']."', City='".$_POST['City']."', Country='".$_POST['Country']."', IP='".$_POST['IP']."' WHERE IP='".$_GET["ip"]."';");
  echo "<script>window.location = '/admin.php?username=".$_GET["username"]."&password=".$_GET["password"]."'</script>";
}

$row = mysqli_query($conn, "SELECT * FROM registrations WHERE IP='".$_GET["ip"]."';");

while($r = mysqli_fetch_array($row)) {
  echo "<title>".explode(" ", $r["Name"])[0]."'s handtekening aanpassen</title>"
?>
<form method="POST" action="">
  <table>
    <tr><th>Naam</th><th>Verjaardag</th><th>E-mail-adres</th><th>Straatnaam</th><th>Huisnummer</th><th>Postcode</th><th>Stad</th><th>Land</th><th>IP-adres</th><th></th></tr>
    <tr>
      <td><input type="text" name="Name" value="<?php echo $r['Name']; ?>"></td>
      <td><input type="text" name="Birth" value="<?php echo $r['Birth']; ?>"></td>
      <td><input type="text" name="Email" value="<?php echo $r['Email']; ?>"></td>
      <td><input type="text" name="Street" value="<?php echo $r['Street']; ?>"></td>
      <td><input type="text" name="Address" value="<?php echo $r['Address']; ?>"></td>
      <td><input type="text" name="Zipcode" value="<?php echo $r['Zipcode']; ?>"></td>
      <td><input type="text" name="City" value="<?php echo $r['City']; ?>"></td>
      <td><input type="text" name="Country" value="<?php echo $r['Country']; ?>"></td>
      <td><input type="text" name="IP" value="<?php echo $r['IP']; ?>"></td>
      <td><input type="submit" name="Save" value="Verander"></td>
    </tr>
  </table>
</form>
<?php
}
?>