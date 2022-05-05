<?php
// --- login-controller.class.php - Enthält Klassen bezüglich Änderungen IN unserer Ettikator Datenbank --- //
/*
Wo befindest du dich?
- logreg.php > login.inc.php > {DU BIST HIER: login-controller.class.php} > login.class.php > Dbh

Welcher Inhalt erwartet mich?
- Änderungen und Aufgaben (Tasks) in unserer Datenbank drin bitte hier eintragen.
*/

// LoginController WIRD SUBKLASSE (= extends) von Login
class loginController extends Login
{

    private $uid;
    private $pwd;

    public function __construct($uid, $pwd)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    // LoginUser-Methode:
    public function loginUser()
    {
        // 1) Errorhandler-IF-Statement.
        if ($this->emptyInput() == false) {
            // echo "Empty input!";
            header("location: ../logreg.php?error=leereLoginFelder");
            exit();
        }
        // 0) Mehr Error-Handlers hierbei anfügen, falls gewünscht...


        // Passt alles: Instanzierung der Methode getUser(), was wir aus login.class.php definiert haben (Methode um User zu kriegen)
        // ->Properties ohne $
        $this->getUser($this->uid, $this->pwd);
    }

    // Selbiges Prinzip wie im Signup, jedoch angepasst an nur 2 Inputfeldern für Check
    // Wir dürfen den selben Namen der Methode verweden emtpyInput(), beziehen uns aber auf loginUser() im Unterschied zu signupUser()
    private function emptyInput()
    {
        if (empty($this->uid) || empty($this->pwd)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
