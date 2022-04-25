<?php
// --- login.inc.php - Empfängt Daten aus dem logreg.php Formular bezüglich LOGIN --- //
/*
Wo befindest du dich?
- logreg.php > {DU BIST HIER: login.inc.php} > login-controller.class.php > login.class.php > Dbh

Welcher Inhalt erwartet mich?
- Durch das Klicken des Submitbuttons "Submit-login" des Logins, werden die Daten hierhin gesendet...
- Die Daten kommen aus dem logreg.php über das action="" Attribut des Formulars hierhin als <form action="includes/login.inc.php"

*/ 

if(isset($_POST["submit-login"])) // Entspricht name="" des Buttons
{

    // Daten aus dem Formular entziehen ( name="")
    // 2x da es zwei Formularelemente geben wird..
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    // INSTANZIEREN sowie REFERENZIEREN (linken) der Classes:
    // Reihenfolge wichtig! Die Vererbende Superklasse zuerst, alle erbenden Subklassen nach und nach...
    include "../class/dbh.class.php";
    include "../class/login.class.php";
    include "../class/login-controller.class.php";
    // Object $login kreieren, was auf die Klasse aus login-controller.class.php herausgeht...
    $login = new LoginController($uid, $pwd);

    // ...loginUser() und Error Handler Methode aus login-controller.class.php instanzieren:
    $login->loginUser();

    // Zurück zur Startseite (Kein Error vorhanden beim Registrieren)
    header("location: ../menu.php?error=willkommen");
}


?>