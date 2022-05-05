<?php
// --- signup.class.php - Enthält Klasse / Methoden bezüglich unserer Ettikator Datenbank --- //

/*
Wo befindest du dich?
- logreg.php > signup.inc.php > SignupController > {DU BIST HIER: Signup} > Dbh

Welcher Inhalt erwartet mich?
- Methoden einbauen um Datenbank abzufragen (to query Database)
- Interagieren mit der Datenbank
- Prepared Statements und sonstige Angaben zur Datenbank bitte hier eintragen
*/

// Signup WIRD SUBKLASSE (= extends) vo Dbh:
class Signup extends Dbh {


  // --- Methode, um USER ZU SETZEN (inserten, damit er in die Datenbank aufgenommen wird) --- //
  protected function setUser($uid, $pwd, $email) {
      // Wichtig: SQL > Create Table aus generalinfo.txt mit dem passenden Table Name "users" und die Spaltennamen einbauen:
      $stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_pwd, users_email) VALUES (?, ?, ?);');
      // Sicherheitstechnisch: $pwd zu $hashedPwd ersetzen - Passwort muss vorher gehashed werden, bevor wir es inserten!
      $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
      // ! = Wenn dieses Statement fehlschlägt, ausgeführt zu werden...
      if(!$stmt->execute(array($uid, $hashedPwd, $email))) {
          $stmt = null;
          header("location: ../logreg.php?error=stmtfailed");
          exit();
      }
      // Beendet das Statement:
      $stmt = null;
  }



  // --- Methode um zu prüfen: GIBT ES BEREITS den Nutzernamen (users_uid aus der Datenbankspalte) sowie die Email (user_email aus der Datenbankspalte)? --- //
  protected function checkUser($uid, $email) { // (B) Data-Properties aus der signup-controller.class.php
    // $stmt = Prepared Statement in diese Variable packen / instanzieren und ausführen (connect() = Methode aus dbh.class.php):
      $stmt = $this->connect()->prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;');

      // ! = Wenn dieses Statement fehlschlägt, ausgeführt zu werden, dann...
      if(!$stmt->execute(array($uid, $email))) { // array(), da es sich mehr als nur um ein Datenstück handelt
          $stmt = null; //...wird Statement beendet...
          header("location: ../logreg.php?error=stmtfailed"); //...und rausgeschmissen!
          exit();
      }
      // Statement mit methode: Gibt es Reihen, die aus dieser Abfrage zurückkommen?
       if($stmt->rowCount() > 0) {
          $resultCheck = false; // Falsch, es existiert bereits sowas in der Datenbank
      }
      else {
          $resultCheck = true; // Richtig, ss exisitert noch nichts bereits in der Datenbank
      }

      return $resultCheck;
  }

}
