<?php
// Login / Registrierungsformular
session_start();

// Subklass instanzieren (Superklasse muss wie gelernt nicht instanziert werden)
require('class/menu.class.php');

?>

<!---------- Header + Navigation ---------------------------------------------------------------------------------------->
<?php
include('includes/html/header.html.php');
?>
<!-----x---- Header + Navigation ----x----------------------------------------------------------------------------------->

<section>
  <div class="emptyspace">
    <div class="image-container">
      <img src="images/logreg-logo.jpg" alt="Menu Logo" height="140px">
    </div>
  </div>

  <!-- Registrierung ERROR und SUCCESSMELDUNGEN 
      = SIGNUP-Fehler sind Teil der SignupController Klasse aus signup-controller.class.php
  -->
  <?php
  if (isset($_GET["error"])) {
    if ($_GET["error"] == "leereFelder") {
      echo "
        <div class='errormessage'>
          <p class='errortext'><i class='fas fa-exclamation-circle'></i> Bitte lassen Sie keine Felder leer!</p>
        </div>
        ";
    } else if ($_GET["error"] == "falscherNutzername") {
      echo "
        <div class='errormessage'>
          <p class='errortext'><i class='fas fa-exclamation-circle'></i> Bitte nur Zahlen und Buchstaben verwenden!</p>
        </div>
        ";
    } else if ($_GET["error"] == "falscheEmail") {
      echo "
        <div class='errormessage'>
          <p class='errortext'><i class='fas fa-exclamation-circle'></i> Bitte geben Sie eine korrekte Email-Adresse ein!</p>
        </div>
      ";
    } else if ($_GET["error"] == "falschesPasswort") {
      echo "
        <div class='errormessage'>
          <p class='errortext'><i class='fas fa-exclamation-circle'></i> Die Passwörter stimmen nicht überein!</p>
        </div>
      ";
    } else if ($_GET["error"] == "nutzerOderEmailVergeben") {
      echo "
        <div class='errormessage'>
          <p class='errortext'><i class='fas fa-exclamation-circle'></i> Nutzername oder Email bereits vergeben!</p>
        </div>
      ";
    } else if ($_GET["error"] == "stmtfailed") {
        echo "
          <div class='errormessage'>
            <p class='errortext'><i class='fas fa-exclamation-circle'></i> Datenbankeintrag fehlgeschlagen!</p>
          </div>
        ";
    // ERFOLGSMELDUNG
    } else if ($_GET["error"] == "erfolg") {              
      echo "
        <div class='successmessage'>
          <p class='successtext'><i class='fa-solid fa-circle-check'></i> Sie haben sich erfolgreich registriert!</p>
        </div>
      ";
    }
  }
  ?>
  <!--x-- Registrierung Error- Successmessages --x-->

    <!-- LOGIN ERROR und SUCCESSMELDUNGEN 
      = LOGIN-Fehler sind Teil der Login Klasse aus login.class.php
  -->
  <?php
  if (isset($_GET["error"])) {
    if ($_GET["error"] == "leereLoginFelder") {
      echo "
        <div class='errormessage'>
          <p class='errortext'><i class='fas fa-exclamation-circle'></i> Bitte lassen Sie keine Felder leer!</p>
        </div>
        ";
    } else if ($_GET["error"] == "nutzerNichtGefunden") {
      echo "
        <div class='errormessage'>
          <p class='errortext'><i class='fas fa-exclamation-circle'></i> Nutzer konnte nicht gefunden werden!</p>
        </div>
        ";
    } else if ($_GET["error"] == "falschesLoginPasswort") {
      echo "
        <div class='errormessage'>
          <p class='errortext'><i class='fas fa-exclamation-circle'></i> Die Passwörter stimmen nicht überein!</p>
        </div>
      ";
    } else if ($_GET["error"] == "stmtfailed") {
        echo "
          <div class='errormessage'>
            <p class='errortext'><i class='fas fa-exclamation-circle'></i> Datenbankeintrag fehlgeschlagen!</p>
          </div>
        "; 
    // ERFOLGSMELDUNG
    } else if ($_GET["error"] == "willkommen") {           
      echo "
        <div class='successmessage'>
          <p class='successtext'><i class='fa-solid fa-circle-check'></i> Herzlich Willkommen, ". filter_var($_SESSION["useruid"], FILTER_SANITIZE_STRING) ."!</p>
        </div>
      ";
    }
  }
  ?>
  <!--x-- Login Error- Successmessages --x-->

  <!-- // -------- Registrierungsformular -------- // -->
  <div class="grid-logreg-container">
    <div class="grid-reg">
      <!-- 
              1) form-tag mit action="" () und method="" ()
              2) <label> und <input> eingebettet in input-field Boxen
              3) for="" des <labels> entspricht der id="" des <inputs>
              4) <input> name="" ist Zugehörigkeit zum isset-Affenschwanz durchgang
              5) <input> value="" bettet php-Werte ein, z.B: <input type="hidden" name="ID" value="< ?php echo $ID; ?>">
            -->
      <form action="includes/signup.inc.php" method="post" enctype="multipart/form-data">
        <div class="title">
          <h1>REGISTRIERUNG:</h1>
        </div>

        <div class="begleittext">
          <p><strong>Nutzen Sie die Vorteile eines Nutzerprofils:</strong></p>
          <li> Führen Sie Ihr persönliches Adressbuch</li>
          <li> Bearbeiten und löschen Sie Ihre Adresseinträge nach Belieben</li>
          <li> Nutzen Sie die Vorteile von GOOGLE MAPS mithilfe des Karten- und Geolocation Profils</li>
        </div>
        <div class="user-details">
          <div class="input-box">
            <label for="username">Nutzername:</label>
            <input type="text" id="username" name="uid" value="" placeholder="(Nur Zahlen und Buchstaben)">
          </div>

          <div class="input-box">
            <label for="password">Passwort:</label>
            <input type="password" id="password" name="pwd" value="" placeholder="********">
          </div>

          <div class="input-box">
            <label for="pwdrepeat">Passwort wiederholen:</label>
            <input type="password" id="pwdrepeat" name="pwdrepeat" value="" placeholder="********">
          </div>

          <div class="input-box">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="" placeholder="(Keine Werbezwecke)">
          </div>
        </div>

        <button class="btn" type="submit" name="submit-signup">Jetzt registrieren!</button>
      </form>
    </div>

    <!-- /!/ -------- Registrierungsformular -------- /!/ -->


    <!-- // -------- Login-Formular -------- // -->
    <div class="grid-log">
      <!-- 
              1) form-tag mit action="" () und method="" ()
              2) <label> und <input> eingebettet in input-field Boxen
              3) for="" des <labels> entspricht der id="" des <inputs>
              4) <input> name="" ist Zugehörigkeit zum isset-Affenschwanz durchgang
              5) <input> value="" bettet php-Werte ein, z.B: <input type="hidden" name="ID" value="< ?php echo $ID; ?>">
            -->
      <form action="includes/login.inc.php" method="post" enctype="multipart/form-data">
        <div class="title">
          <h1>LOGIN:</h1>
        </div>
        <div class="begleittext">
          <p><strong>Haben Sie sich bereits registriert?</strong></p>
          <p><strong>Hier anmelden und losstarten!</strong></p>
        </div>
        
        <div class="user-details log">
          <div class="input-box log">
            <label for="username"></label>
            <input type="text" id="username" name="uid" value="" placeholder="Nutzername">
          </div>

          <div class="input-box log">
            <label for="password"></label>
            <input type="password" id="password" name="pwd" value="" placeholder="Passwort">
          </div>
          <div class="input-box">
            <button class="btn login" type="submit" name="submit-login">Login</button>
          </div>
        </div>


      </form>
    </div>
  </div>
  <!-- /!/ -------- Login-Formular -------- /!/ -->
</section>





<!---------- footer ----------------------------------------------------------------------------------------------------->
<?php
include('includes/html/footer.html.php');
?>
<!-----x---- footer ----x------------------------------------------------------------------------------------------------>