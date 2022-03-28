<?php
// --- signup.class.php - Enthält Klassen bezüglich unserer Ettikator Datenbank --- //

/*
Info:
- logreg.php > signup.inc.php > SignupController > DU BIST HIER: Signup > Dbh
- Queries / Prepared Statements und sonstige Angaben zur Datenbank bitte hier eintragen.
*/

// Signup WIRD SUBKLASSE (= extends) vo Dbh:
class Signup extends Dbh {

  protected function setUser($uid, $pwd, $email) {
      $stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_pwd, users_email) VALUES (?, ?, ?);');

      $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

      if(!$stmt->execute(array($uid, $hashedPwd, $email))) {
          $stmt = null;
          header("location: ../index.php?error=stmtfailed");
          exit();
      }

      $stmt = null;
  }

  protected function checkUser($uid, $email) {
      $stmt = $this->connect()->prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;');

      if(!$stmt->execute(array($uid, $email))) {
          $stmt = null;
          header("location: ../index.php?error=stmtfailed");
          exit();
      }

      
      if($stmt->rowCount() > 0) {
          $resultCheck = false;
      }
      else {
          $resultCheck = true;
      }

      return $resultCheck;
  }

}

?>