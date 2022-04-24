<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Data privacy burgerinitiatief</title>
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
        $conn = new mysqli("remotemysql.com", getenv('username'), getenv('password'), getenv('username'));
        if ($conn->connect_error) {
          echo "<h1>Something went wrong... Please try again!</h1>";
        }
        if ($result = $conn->query("SELECT * FROM registrations")) {
          $rowcount = mysqli_num_rows($result); // get number of rows
        }
        $conn->close();
        ?>
        <script src="script.js"></script>
        <div class="main-content">
            <div class="main-info" id="main-info">
                <h1>Het recht om data privacy te testen</h1>
                <p class="date">Luc Angevare, 28/01/2022</p>
                <img src="assets/img/banner-image.png" draggable="false" alt="Placeholder banner image" name="Placeholder" class="banner"/>
                <div class="summary"><p>Stel je voor, je bent diep in de avond met school bezig, je moet morgen een project inleveren en bent dus nu nog bezig. Je bent klaar om wat slaap te pakken om morgen weer veel te doen aan hetzelfde project, en opeens krijg je een appje van een vriend(in) waar een link naar een of andere website genaamd FaceMash.com. Je klikt erop, geïnteresseerd naar wat het is, en ziet jouw eigen gezicht naast dat van uw huisgenoot, met de tekst “Wie is er knapper? Klik om te kiezen.”. Je kunt je niet herinneren dat je hiervoor toestemming gegeven hebt, alleen dat die foto van jouw universiteitswebsite is gekomen.</p>

                <p>Dit is helaas wat ontelbare jongedames mee hebben moeten maken in 2003. De door Facebook bekend gemaakte Mark Zuckerberg was het gelukt om binnen een paar uurtjes alle foto’s van websites van de grote huisvestingen in Harvard te downloaden, en dat met één commando en één script. Iedereen die iets ervaring heeft met het programmeren van websites zou weten hoe ze dit zouden moeten doen. Dit is niet het enige incident waarin dit gebeurd is; er zijn enorm veel gevallen waarin mensen hun privacy is misbruikt alleen omdat het programma niet goed is getest en erg kwetsbaar is. Daarom deze petitie, om ervoor te zorgen dat mensen in ieder geval de macht hebben om te kunnen testen waar ze hun data invoeren.</p></div>
                <div class="content">
                    <p>Ik ben Luc Angevare, programmeur en ethisch hacker. Daarnaast ben ik een 4e-jaars Vwo-leerling voor een digitale school, het Corlaer College. Daar heb ik meegemaakt hoe het is om blind te moeten vertrouwen op programma’s die totaal niet beveiligd zijn. In plaats van te doen wat de wet voorstelt – eerst toestemming te vragen en dan lekken te vinden, heb ik ervoor gekozen eerst te kijken of er datalekken zijn. Uiteindelijk heeft het mij voor alledrie de keren dat ik een datalek gevonden heb meer dan 72 uur gekost om het te melden, alleen omdat ik bang was aangeklaagd te worden, omdat ik van tevoren geen toestemming had gevraagd.</p>

                    <p>Dit wetsvoorstel en petitie betoogt dat het mogelijk moet zijn om, vooral voor studenten en jongeren, te kijken of de data die u invoert wel veilig bewaard blijft. Het stelsel is nu dat men eerst toestemming moet vragen om datalekken te vinden, en dat wil ik veranderen. Steeds meer techbedrijven kiezen ervoor geen klantenservice of contactinformatie te hebben, waardoor een datalek melden onmogelijk is. Daarbij kunnen bedrijven zich voorbereiden bij de a priori vraag voor toestemming, waardoor alle zoektochten naar datalekken onbruikbaar worden gemaakt. De AVG zorgt ervoor dat bedrijven hun data moeten beveiligen, maar als ze niet weten of en waar er lekken zijn, kunnen die ook niet beveiligd worden. Doordat mensen niet durven datalekken te melden of ervoor te zoeken, kunnen mensen zonder goede intenties die datalekken gebruiken om data te stelen of schade aan te richten. Zonder deze wetswijziging kan er heel gemakkelijk een nieuwe FaceMash ontstaan. Om het internet veiliger te maken, is deze wettekst nodig, en om die in te dienen, heb ik uw hulp nodig. Onderteken nu!</p>
                    <p>Voor meer informatie, <a href="https://weerstand.lucangevare.nl/Assets/Voorstel_van_wet-1.pdf" target="_blank">klik hier voor de wetsvoorstel</a>;</p>
                    <p>of <a href="https://weerstand.lucangevare.nl/Assets/Memorie_van_toelichting-2.pdf" target="_blank">hier voor de memorie van toelichting</a></p>
                    <p>Voor meer informatie over FaceMash.com, <a href="https://en.wikipedia.org/wiki/History_of_Facebook#FaceMash" target="_blank">klik hier</a></p>
                </div>
                <button class="readmore" id="readmore">Read more...</button>
            </div>
            <div class="signature">
                <div class="parent-counter"><span class="counter">
                <?php
                echo number_format((int)$rowcount, 0, ',', '.'); // format so it's humanly readable
                ?>
                </span>&nbsp;keer ondertekend</div>
                <p class="burgerinitiatief-tekst">
                  Wij, burgers van Nederland, constaterende dat wij verandering aan willen gaan aan de huidige computervredebreuk wettenstelsel in ruil voor een veiliger internet, verzoeken de Tweede Kamer het voorgestelde computervredebreukstelsel af te wegen.<br/>Teken hier het burgerinitiatief.</br/>De gegevens die we vragen zijn wettelijk vereist. Dit is een Burgerinitiatief, geen petitie.
                </p>
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
                    <input type="text" name="SignDate" id="empy_input" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly/>
                    <input type="text" name="Captcha" placeholder="Captcha"/>
                    <img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'><br><p>Twijfelt u eraan of u misschien dan toch een robot bent? Klik <a href="javascript:refreshCaptcha()">hier</a> om een nieuwe Captcha te genereren</p>
                    <input type="submit" value="Onderteken!" onclick="return validate();"/>
                </form>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5 h-100" id="cookieModal">
            <div class="d-flex align-items-center align-self-center card p-3 text-center cookies"><img src="https://i.imgur.com/Tl8ZBUe.png" width="50"><span class="mt-2">Deze website gebruikt o.a. technieken zoals cookies om ervoor te zorgen dat mensen niet meerdere keren ondertekenen. Door de petitie in te vullen of hieronder op "Accepteer" te klikken, gaat u akkoord hiermee.</span><a class="d-flex align-items-center" href="javascript:historyBackWFallback()">Weiger<i class="fa fa-angle-right ml-2"></i></a> <button class="btn btn-dark mt-2" type="button" onclick="acceptCookies()";>Accepteer</button> </div>
        </div>
      </div>
    </body>
</html>