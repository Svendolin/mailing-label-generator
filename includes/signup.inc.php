<?php 
// --- signup.inc.php - Empfängt Daten aus dem logreg.php Formular bezüglich SIGNUP --- //

/*
Infos: 
- logreg.php > DU BIST HIER: signup.inc.php > SignupController > Signup > Dbh
- Durch das Klicken des Submitbuttons "submit-signup" der Registrierung, werden die Daten hierhin gesendet...
- Die Daten kommen aus dem logreg.php über das action="" Attribut des Formulars hierhin als <form action="includes/signup.inc.php"

*/
if(isset($_POST["submit-signup"])) // Entspricht name="" des Button
{

    // Daten aus dem Formular entziehen ( name="")
    // 4x da es vier Formularelemente geben wird..
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $email = $_POST["email"];

    // INSTANZIEREN sowie REFERENZIEREN (linken) der Classes:
    include "../class/dbh.class.php"; // ../ = aus den Includes raus in den Root und von da Ordnerschritt zu Ordnerschritt
    include "../class/signup.class.php";
    include "../class/signup-controller.class.php";
    // Object $signup instanzieren, was auf die Klasse aus signup-controller.class.php herausgeht
    $signup = new SignupController($uid, $pwd, $pwdRepeat, $email); // (B) Data-Properties des Users aus signup-controller.class.php einbauen

    // User Signup und Error Handlers laufenlassen:
    $signup->signupUser(); // Methode "runnen" aus signup-controller.class.php fürs Errorhandling

    // Zurück zur Startseite
    header("location: ../index.php?error=none");
}

?>

<!-- -->