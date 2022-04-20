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

<section class="index-login">
  <div class="emptyspace">
    <div class="image-container">
      <img src="images/logreg-logo.jpg" alt="Menu Logo" height="140px">
    </div>
  </div>

  <!-- // -------- Registrierungsformular -------- // -->
  <div class="index-signup">
    <div class="title">
      <h2>Hier registrieren:</h2>
      <h3>Nutzen Sie die Vorteile eines Nutzerprofils</h3>
    </div>
    <div class="begleittext">
      <p>Speichern Sie Ihre Lieblingsetiketten für eine permanente Nutzung!<br>
        Behalten Sie den Überblick Ihrer Empfängerliste und wählen diese im Menu aus ohne die Adresse mühsam abtippen zu müssen!<br>
        Wählen Sie aus den von Ihnen gespeicherten Absenderadressen ohne diese jedes Mal neu einzugeben!</p>
    </div>

    <!-- 
              1) form-tag mit action="" () und method="" ()
              2) <label> und <input> eingebettet in input-field Boxen
              3) for="" des <labels> entspricht der id="" des <inputs>
              4) <input> name="" ist Zugehörigkeit zum isset-Affenschwanz durchgang
              5) <input> value="" bettet php-Werte ein, z.B: <input type="hidden" name="ID" value="< ?php echo $ID; ?>">
            -->

    <form action="includes/signup.inc.php" method="post" enctype="multipart/form-data">
      <div class="input-field">
        <label for="username"></label>
        <input type="text" id="username" name="uid" value="" placeholder="Nutzername">
      </div>

      <div class="input-field">
        <label for="password"></label>
        <input type="password" id="password" name="pwd" value="" placeholder="Passwort">
      </div>

      <div class="input-field">
        <label for="pwdrepeat"></label>
        <input type="password" id="pwdrepeat" name="pwdrepeat" value="" placeholder="Passwort wiederholen">
      </div>

      <div class="input-field">
        <label for="email"></label>
        <input type="text" id="email" name="email" value="" placeholder="E-mail (Keine Werbezwecke)">
      </div>

      <button type="submit" name="submit-signup">Los geht's!</button>
    </form>
  </div>
  <hr>
  <!-- /!/ -------- Registrierungsformular -------- /!/ -->


  <!-- // -------- Login-Formular -------- // -->

  <div class="index-signin">

    <div class="title">
      <h2>Hier einloggen:</h2>
      <h3>Anmelden und losstarten!</h3>
    </div>

    <!-- 
              1) form-tag mit action="" () und method="" ()
              2) <label> und <input> eingebettet in input-field Boxen
              3) for="" des <labels> entspricht der id="" des <inputs>
              4) <input> name="" ist Zugehörigkeit zum isset-Affenschwanz durchgang
              5) <input> value="" bettet php-Werte ein, z.B: <input type="hidden" name="ID" value="< ?php echo $ID; ?>">
            -->
    <form action="includes/login.inc.php" method="post" enctype="multipart/form-data">
      <div class="input-field">
        <label for="username"></label>
        <input type="text" id="username" name="uid" value="" placeholder="Nutzername">
      </div>

      <div class="input-field">
        <label for="password"></label>
        <input type="password" id="password" name="pwd" value="" placeholder="Passwort">
      </div>

      <button type="submit" name="submit-login">Login</button>
    </form>
  </div>
  <hr>
  <!-- /!/ -------- Login-Formular -------- /!/ -->
</section>





<!---------- footer ----------------------------------------------------------------------------------------------------->
<?php
include('includes/html/footer.html.php');
?>
<!-----x---- footer ----x------------------------------------------------------------------------------------------------>