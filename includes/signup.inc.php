<?php 
// --- signup.inc.php - Empfängt Daten aus dem logreg.php Formular bezüglich SIGNUP --- //

/*
WO befindest du dich?
- logreg.php > {DU BIST HIER: signup.inc.php} > SignupController > Signup > Dbh

Welcher Inhalt erwartet mich?
- Durch das Klicken des Submitbuttons "submit-signup" der Registrierung, werden die Daten hierhin gesendet...
- Die Daten kommen aus dem logreg.php über das action="" Attribut des Formulars hierhin als <form action="includes/signup.inc.php"

*/
if(isset($_POST["submit-signup"])) // Entspricht name="" des Buttons
{
    // Daten aus dem Formular entziehen ( name="")
    // 4x da es vier Formularelemente geben wird..
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $email = $_POST["email"];

    // INSTANZIEREN sowie REFERENZIEREN (linken) der Classes:
    // Reihenfolge wichtig! Die Vererbende Superklasse zuerst, alle erbenden Subklassen nach und nach...
    include "../class/dbh.class.php"; 
    include "../class/signup.class.php";
    include "../class/signup-controller.class.php";
    // Object $signup kreieren, was auf die Klasse aus signup-controller.class.php herausgeht...
    $signup = new SignupController($uid, $pwd, $pwdRepeat, $email); // (B) Data-Properties des Users aus signup-controller.class.php einbauen

    // ...signupUser() und Error Handler Methode aus signup-controller.class.php instanzieren:
    $signup->signupUser(); 

    // Zurück zur Startseite (Kein Error vorhanden beim Registrieren)
    header("location: ../logreg.php?error=erfolg");
}

?>

<!-- -->