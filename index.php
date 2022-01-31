<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Data privacy petitie</title>
        <link rel="stylesheet" href="styles.css"/>
        <link rel="stylesheet" href="fonts.css"/>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <meta name="title" content="Data privacy petition">
        <meta name="description" content="A petition to be able to test your data privacy on a website in the Netherlands.">
        <meta name="keywords" content="Petition, data, privacy, Netherlands">
        <meta name="robots" content="index, nofollow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="Dutch">
        <meta name="author" content="Luc Angevare">
    </head>
    <body>
        <?php
        $rowcount = "";
        $conn = new mysqli("remotemysql.com", "oBQslgIbMv", base64_decode("SHM0M0RqMlE4eg=="), "oBQslgIbMv");
        if ($conn->connect_error) {
          echo "<h1>Something went wrong... Please try again!</h1>";
        }
        if ($result = $conn->query("SELECT * FROM registrations")) {
          $rowcount = mysqli_num_rows($result);
        }
        $conn->close();
        ?>
        <script src="script.js"></script>
        <div class="main-content">
            <div class="main-info" id="main-info">
                <h1>Het recht om data privacy te testen</h1>
                <p class="date">Luc Angevare, 28/01/2022</p>
                <img src="assets/img/banner-image.png" draggable="false" alt="Placeholder banner image" name="Placeholder" class="banner"/>
                <div class="summary"><p>Stelt u het zich voor, u bent diep in de avond met school bezig, u moet morgen een project inleveren en bent dus nu nog bezig. U bent klaar om wat slaap te pakken om morgen weer veel te doen aan hetzelfde project, en opeens krijgt u een appje van een vriend(in) waar een link naar een of andere website genaamd FaceMash.com. U klikt erop, geïnteresseerd naar wat het is, en ziet uw eigen gezicht naast dat van uw huisgenoot, met de tekst “Wie is er knapper? Klik om te kiezen.”. U kunt zich niet herinneren dat u hiervoor toestemming gegeven hebt, alleen dat die foto van uw universiteitswebsite is gekomen.<br/><br/>

                Dit is helaas wat ontelbare jongedames mee hebben moeten maken in 2003. De door Facebook bekend gemaakte Mark Zuckerberg was het gelukt om binnen een paar uurtjes alle foto’s van websites van de grote huisvestingen in Harvard te downloaden, en dat met één commando en één script. Iedereen die iets ervaring heeft met het programmeren van websites zou weten hoe ze dit zouden moeten doen. Dit is niet het enige incident waarin dit gebeurd is; er zijn enorm veel gevallen waarin mensen hun privacy is misbruikt alleen omdat het programma niet goed is getest en erg kwetsbaar is. Daarom deze petitie, om ervoor te zorgen dat mensen in ieder geval de macht hebben om te kunnen testen waar ze hun data invoeren.</p></div>
                <div class="content">
                    <p>
                        Text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text<br/><br/>

                    Text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text
                    </p>
                </div>
                <button class="readmore" id="readmore">Read more...</button>
            </div>
            <div class="signature">
                <div class="parent-counter"><span class="counter">
                <?php
                echo number_format((int)$rowcount, 0, ',', '.');
                ?>
                </span>&nbsp;keer ondertekend</div>
                <form method="post" action="/server.php">
                    <input type="text" name="Name" placeholder="Voor- en achternaam"/>
                    <input type="text" name="Birth" placeholder="Geboortedatum" maxlength="10"/>
                    <input type="text" name="Email" placeholder="E-mailadres"/>
                    <div style="display: inline-block; width: 100%">
                        <input type="text" class="no" placeholder="Straat" name="Street"/>
                        <input type="text" class="no" placeholder="Huisnummer" name="Address"/>
                    </div>
                    <input type="text" name="Zipcode" maxlength="7" placeholder="Postcode"/>
                    <input type="text" name="City" placeholder="Plaats" maxlength="29"/>
                    <input type="text" name="Country" placeholder="Land"/>
                    <input type="text" name="Captcha" placeholder="Captcha"/>
                    <img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'><br><p>Twijfelt u eraan of u misschien dan toch een robot bent? Klik <a href="javascript:refreshCaptcha()">hier</a> om een nieuwe Captcha te genereren</p>
                    <input type="submit" value="Onderteken!" onclick="return validate();"/>
                </form>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5 h-100" id="cookieModal">
            <div class="d-flex align-items-center align-self-center card p-3 text-center cookies"><img src="https://i.imgur.com/Tl8ZBUe.png" width="50"><span class="mt-2">Deze website gebruikt o.a. cookies om ervoor te zorgen dat mensen niet meerdere keren ondertekenen.</span><a class="d-flex align-items-center" href="javascript:history.back()">Weiger<i class="fa fa-angle-right ml-2"></i></a> <button class="btn btn-dark mt-2" type="button" onclick="acceptCookies()";>Accepteer</button> </div>
        </div>
      </div>
    </body>
</html>