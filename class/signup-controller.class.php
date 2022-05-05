<?php
// --- signup-controller.class.php - Enthält Klassen bezüglich Änderungen IN unserer Ettikator Datenbank --- //
/*
Wo befindest du dich?
- logreg.php > signup.inc.php > {DU BIST HIER: SignupController} > Signup > Dbh

Welcher Inhalt erwartet mich?
- Änderungen und Aufgaben (Tasks) in unserer Datenbank drin bitte hier eintragen.
*/


// SignupController WIRD SUBKLASSE (= extends) von Signup
class SignupController extends Signup {

  // (A) Private Class-Properties (Schalter bleiben geschlossen, muss kein User sehen!)
  private $uid;
  private $pwd;
  private $pwdRepeat;
  private $email;
  
  // Constructor-Method (Grundversorgung) = Submitted Data des Users zu den obigen Properties assignen
  public function __construct($uid, $pwd, $pwdRepeat, $email) { // (B) Data-Properties, die wir vom User erhalten haben in __construct()
      // Definieren, dass Class-Properties (A) = equal sind zu: Data-Properties (B) des Users
      $this->uid = $uid; // (A) = (B)
      $this->pwd = $pwd;
      $this->pwdRepeat = $pwdRepeat;
      $this->email = $email;
  }

  // Usersignup-Methode: Errorhandling-Definition, die nach und nach erfüllt werden müssen, um nicht "hängen zu bleiben"... 
  // (Die einzelnen Methoden, welche den Sachverhalt prüfen, sind unten aufgeführt)
  // Hier RUFEN WIR DIE ERROR-HANDLER-METHODEN AUF:
  public function signupUser() {
      if($this->emptyInput() == false) {
          // 1) echo "Empty input!";
          header("location: ../logreg.php?error=leereFelder");
          exit();
      }
      if($this->invalidUid() == false) {
          // 2) echo "Invalid username!";
          header("location: ../logreg.php?error=falscherNutzername");
          exit();
      }
      if($this->invalidEmail() == false) {
          // 3) echo "Invalid email!";
          header("location: ../logreg.php?error=falscheEmail");
          exit();
      }
      if($this->pwdMatch() == false)
      {
          // 4) echo "Passwords don't match!";
          header("location: ../index.php?error=falschesPasswort");
          exit();
      }
      if($this->uidTakenCheck() == false)
      {
          // 5) echo "Username or email taken!";
          header("location: ../logreg.php?error=nutzerOderEmailVergeben");
          exit();
      }
      // Passt alles: Instanzierung der Methode setUser(), was wir aus signup.class.php definiert haben (Methode um User zu setzen)
      // ->Properties ohne $
      $this->setUser($this->uid, $this->pwd, $this->email);
  }

  /* 
  Wenn der User das Formular Submitted hat:
    - Prüfen, ob die Poperties in der Klasse leer sind oder nicht
    - Das heisst, der User muss in jedem Feld seine Daten übermitteln
    - Falls etwas fehlt, wird das jeweilige IF-Statement den erfolgreichen Prozess stoppen
    - Diese Methoden können wir auf private setzen, da wir sie innerhalb der signupcontroller-Klasse verwenden
  */

  // 1) Methode: "Sind die Inputfelder leer?"
  private function emptyInput() {
      if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)) { // Falls die Felder (oder eines) leer bleibt...
          $result = false; // Falsch, keines der Felder ist leer.
      }
      else {
          $result = true; // Richtig, die Felder (oder eines der Felder) sind leer.
      }
      return $result;
  }

  // 2) Methode: "Ist UserUID gültig, valid (existieren solche Zeichen)?"
  private function invalidUid() {
      // preg_match = Checkt den String für einen bestimmten Zeicheninhalt
      if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) // Falls ungültige Zeichen verwendet wurden...
      {
          $result = false; // Falsch, es wurden gültige Zeichen verwendet!
      }
      else 
      {
          $result = true; // Richtig, es wurden ungültige Zeichen verwendet!
      }
      return $result;
  }
  
  // 3) Methode: "Entspricht die Email nicht den Vorgaben?"
  private function invalidEmail() {
      if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) // Validierung der Email-Adresse. Prüfen, ob sie NICHT der Norm entspricht.
      {
          $result = false; // Falsch, sie entspricht der Norm!
      }
      else 
      {
          $result = true; // Richtig! Die Email entspricht nicht der Norm!
      }
      return $result;
  }

  // 4) Methode: "Entspricht Passwort dem wiederholten Passwort?"
  private function pwdMatch() {
      if ($this->pwd !== $this->pwdRepeat) // Prüfen, ob die Beiden NICHT zueiander passen!
      {
          $result = false; // falsch. Die Passwörter passen zueinander.
      }
      else 
      {
          $result = true; // richtig. Die Passwörter passen nicht zueinander.
      }
      return $result;
  }

  // 5) Methode: "Email und Username existieren bereits?"
  private function uidTakenCheck() {
      if (!$this->checkUser($this->uid, $this->email)) // Prüfen, ob User / Email NICHT bereits existieren
      {
          $result = false; // Falsch: Username / Email existieren bereits.
      }
      else 
      {
          $result = true; // Richtig: Username / Email existieren noch nicht!
      }
      return $result;
  }

}
