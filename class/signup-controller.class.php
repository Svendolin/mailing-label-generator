<?php
// --- signup-controller.class.php - Enthält Klassen bezüglich Änderungen IN unserer Ettikator Datenbank --- //
/*
Info:
- logreg.php > signup.inc.php > DU BIST HIER: SignupController > Signup > Dbh
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
  // (TODO: Error Handlers dazu passend in logreg.php einbauen)
  // (Die einzelnen Methoden, welche den Sachverhalt prüfen, sind unten aufgeführt)
  // Hier RUFEN WIR DIE METHODEN AUF:
  public function signupUser() {
      if($this->emptyInput() == false) {
          // 1) echo "Empty input!";
          header("location: ../index.php?error=emptyinput");
          exit();
      }
      if($this->invalidUid() == false) {
          // 2) echo "Invalid username!";
          header("location: ../index.php?error=username");
          exit();
      }
      if($this->invalidEmail() == false) {
          // 3) echo "Invalid email!";
          header("location: ../index.php?error=email");
          exit();
      }
      if($this->pwdMatch() == false)
      {
          // 4) echo "Passwords don't match!";
          header("location: ../index.php?error=passwordmatch");
          exit();
      }
      if($this->uidTakenCheck() == false)
      {
          // 5) echo "Username or email taken!";
          header("location: ../index.php?error=useroremailtaken");
          exit();
      }

      $this->setUser($this->uid, $this->pwd, $this->email);
  }

  /* 
  Wenn der User das Formular Submitted hat:
    - Prüfen, ob die Poperties in der Klasse leer sind oder nicht
    - Das heisst, der User muss in jedem Feld seine Daten übermitteln
    - Falls etwas fehlt, wird das jeweilige IF-Statement den erfolgreichen Prozess stoppen

  */

  // 1) Methode: "Sind die Inputfelder leer?"
  private function emptyInput() {
      if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)) {
          $result = false;
      }
      else {
          $result = true;
      }
      return $result;
  }

  // 2) Methode: "Ist UserUID gültig, valid (existieren solche Zeichen)?"
  private function invalidUid() {
      if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) // preg_match = Checkt den String für einen bestimmten Zeicheninhalt
      {
          $result = false;
      }
      else 
      {
          $result = true;
      }
      return $result;
  }
  
  // 3) Methode: "Entspricht die Email nicht den Vorgaben?"
  private function invalidEmail() {
      if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) // Validierung der Email-Adresse, prüfen, ob sie nicht der Norm entspricht
      {
          $result = false; // falsch. D.h sie entspricht der Norm
      }
      else 
      {
          $result = true; // richtig. Die Email entspricht nicht der Norm.
      }
      return $result;
  }

  // 4) Methode: "Entspricht Passwort dem wiederholten Passwort?"
  private function pwdMatch() {
      if ($this->pwd !== $this->pwdRepeat) // Prüfen, ob die Beiden nicht passen
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
      if (!$this->checkUser($this->uid, $this->email)) // Prüfen, ob User / Email nicht existieren
      {
          $result = false; // falsch. Username / Email existieren bereits.
      }
      else 
      {
          $result = true; // richtig. Username / Email existieren noch nicht!
      }
      return $result;
  }

}




?>