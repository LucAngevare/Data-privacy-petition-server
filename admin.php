<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php
$conn = new mysqli("remotemysql.com", getenv('username'), getenv('password'), getenv('username'));

$res = mysqli_query($conn, "SELECT 1 FROM users WHERE user=\"".preg_replace('/[^A-Za-z0-9\-]/', '', $_GET["username"])."\" AND password=\"".md5($_GET["password"])."\";"); //Ik haat hoe onveilig dit is, iemand kan alle inlogs bekijken door `?username=";SELECT * FROM users;/*` te doen... het is toch ongelooflijk triest dat er in een functie voor SQL er geen beveiliging is tegen SQL injections? stel ik had geen MD5 gebruikt maar een andere encryptie-methode die wel speciale tekens had gebruikt, was het onmogelijk geweest dit te doen. Natuurlijk had ik dit kunnen veranderen door eerst alle logins op te vragen en dat dan te controleren met de ingevulde gegevens, maar dat brengt nog veel meer kwetsbaarheden. Nu moet ik dus vertrouwen op RegEx van alle dingen om een hele server op te bouwen? yikes...

if (!(mysqli_fetch_all($res)[0][0]==1)) {
  header("Location: https://petitie.lucangevare.nl/");
  die();
}

if (!(count($_POST)==0)) {
  if (!isset($_POST["SQL_Query"])) return;
  $res = mysqli_query($conn, $_POST["SQL_Query"]);
  if ($res instanceof mysqli_result) {
    echo "<p class='code-output'>>>> ".mysqli_fetch_all($res)[0][0]."</p>";
  } else {
    echo "<p class='code-output'>>>> ".(string)$res."</p>";
  }
}
?>
<html>
  <head>
    <title>Admin page</title>
    <link rel="stylesheet" href="admin_page.css">
    <link rel="stylesheet" href="fonts.css"/>
  </head>
  <body>
    <h1>Admin stuff en dingen I suppose</h1>
    <?php
//well I guess this kinda like... exists
  $conn = new mysqli("remotemysql.com", "oBQslgIbMv", base64_decode("YzUwR1VoNU1qTQ=="), "oBQslgIbMv");

  $res = mysqli_query($conn, "SELECT * FROM registrations");
  if (mysqli_num_rows($res) > 0) {
    echo "<table>";
    echo "<tr><th>Naam</th><th></th><th>E-mail-adres</th><th>Straatnaam</th><th>Huisnummer</th><th>Postcode</th><th>Stad</th><th>Land</th><th>IP-adres</th><th>Delete</th><th>Update</th></tr>";
    while ($row = mysqli_fetch_array($res)) {
      echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["Birth"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["Street"] . "</td><td>" . $row["Address"] . "</td><td>" . $row["Zipcode"] . "</td><td>" . $row["City"] . "</td><td>" . $row["Country"] . "</td><td>" . $row["IP"] . "</td><td><a href=\"del.php?ip=".$row["IP"]."&username=".$_GET["username"]."&password=".$_GET["password"]."\">Delete</a></td><td><a href=\"change.php?ip=".$row["IP"]."&username=".$_GET["username"]."&password=".$_GET["password"]."\">Change</a></td></tr>";
    }
    echo "</table>";
  }

  $graph_x_values_res = mysqli_query($conn, "SELECT SUBSTRING(SignDate,1,10), COUNT(*) FROM registrations GROUP BY SUBSTRING(SignDate,1,10);");
  $arraypoints = array(
    array("Datum", "Gezette handtekeningen")
  );
  while($r = mysqli_fetch_array($graph_x_values_res, MYSQLI_ASSOC)) {
    $arraypoints[] = array($r["SUBSTRING(SignDate,1,10)"], (int)$r["COUNT(*)"]);
  }
  
  mysqli_close($conn);
    ?>
  <form method="POST">
    <input type="text" placeholder="Voer je MySQL-query in, want dat is veel makkelijker dan een beetje lopen kutten met een GUI!" name="SQL_Query"/>
    <input type="submit" value="Uitvoeren"/>
  </form>
  <script>
    window.onload = function() {
      console.log(<?php echo json_encode($arraypoints, JSON_NUMERIC_CHECK); ?>)
      google.load('visualization', '1.1', {packages: ['corechart'], callback: drawChart});

      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo json_encode($arraypoints, JSON_NUMERIC_CHECK); ?>);

        var options = {
          bars: 'vertical',
          title: 'Hoeveelheid gezette handtekeningen per data',
          vAxis: {title: "Hoeveelheid handtekeningen"},
          hAxis: {title: "Datum",  titleTextStyle: {color: '#333'}}
        };
        
        var chart = new google.visualization.LineChart(document.getElementById('chart-div'));
        chart.draw(data, options);
      }
    }
  </script>
  <div id="chart-div" style="height: 370px; width: 100%;"></div>
  </body>
</html>