<!DOCTYPE html>
<html lang="en">

<head>
  <!-- close here to clean the code visually -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-------------------------------------- BASIC HTML5 TAG FOR RESPONSIVENESS -------------------------------------->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-------------------------------------- META TAG -------------------------------------->
  <meta name="keywords" content="Postadresseneditor, Postpaketadressator, Postetikettenadressator">
  <meta name="description" content="Siehe readme.md">
  <meta name="author" content="Svendolin">
  <title>Postpaketadressator</title>
  <!-------------------------------------- CDN FONTAWESOME ICONS (Keep me updated) -------------------------------------->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-------------------------------------- TODO: GOOGLE FONTS LINK -------------------------------------->

  <!-------------------------------------- TODO: OWL-CAROUSEL -------------------------------------->
  <link rel="stylesheet" type="text/css" media="screen" href="themes/css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" media="screen" href="themes/css/owl.theme.default.min.css">
  <!-------------------------------------- TODO: AOS Library CSS ---------------------------------->
  <!-- (Animate on scroll) https://michalsnik.github.io/aos/ > download > dist > copy aos.js and aos.css -->
  <link rel="stylesheet" href="themes/css/aos.css">
  <!-------------------------------------- CSS LINKS -------------------------------------->
  <link rel="stylesheet" type="text/css" media="screen" href="themes/css/variables.css">
  <link rel="stylesheet" type="text/css" media="screen" href="themes/css/style.css">

  <!-------------------------------------- CSS LINK TO SEPERATE MEDIA QUERY PAGE -------------------------------------->
  <link rel="stylesheet" type="text/css" media="screen" href="themes/css/mediaqueries.css">
  <!-------------------------------------- TODO: Favicon -------------------------------------->
  <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-------------------------------------- JQUERY / JAVASCRIPT CONNECTION -------------------------------------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
  <!-------------------------------------- TODO: OWL-CAROUSEL JQUERY -------------------------------------->
  <script src="themes/js/owl.carousel.min.js" defer></script>
  <!-------------------------------------- TODO: AOS Library JS -------------------------------------->
  <script src="themes/js/aos.js" defer></script>
  <!-------------------------------------- ANIMATION JS CONNECTION -------------------------------------->
  <script src="themes/js/animation.js" defer></script>
  <!-------------------------------------- JS CONNECTION -------------------------------------->
  <script src="themes/js/main.js" defer></script>
</head>

<body>
  <!--------- NAVIGATION ------------------------------------------------------------------------------------------>

  <nav class="nav">
    <div class="nav-menu">
      <div class="nav-brand">
        <img src="images/doggy.png" alt="doggo" height="50px">
      </div>
      <!-- [toggle burger] -->
      <div class="toggle-collapse">
        <div class="toggle-icons">
          <i class="menu-toggle-btn fas fa-bars"></i> <!-- fa-times = x-symbol -->
        </div>
      </div>
      <div>
        <ul class="nav-items">
          <!-- [Startseite] -->
          <li class="nav-link">
            <a href="index.php" class="home">Startseite</a>
          </li>
          <!-- [Adressübersicht] -->
          <?php
          // Ist der User eingeloggt, dann zeige DAS: 
          if (isset($_SESSION["useruid"])) {
            echo '<div class="adresse">
                    <li class="nav-link">
                      <a href="menu.php">Adressübersicht</a>
                    </li>
                  </div>';
          } //...ansonsten wird dieser Teil nicht angezeigt!
          ?>
        </ul>
      </div>
      <!-- [LOGOUT und LOGIN] -->
      <?php
      // Ist der User eingeloggt, dann zeige DAS:
      if (isset($_SESSION["useruid"])) {  // ...If so, the user is logged in! (btw useruid is the referenced username from functions.inc.php)
        echo '<button class="login" type="button" name="logoutreg"><a href="includes/logout.inc.php">Logout</a></button>';
      }
      // Ist der User NICHT eingeloggt, dann zeige DAS:
      else {
        echo '<button class="login" type="button" name="logreg"><a href="logreg.php">Login / Registrierung</a></button>';
      }
      ?>
    </div>
  </nav>
  <hr>
  <!---x----- NAVIGATION -----x------------------------------------------------------------------------------------>