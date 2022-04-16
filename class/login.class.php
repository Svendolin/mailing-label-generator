<?php
// --- login.class.php -  --- //
/*
Wo befindest du dich?
- logreg.php > login.inc.php > login-controller.class.php > {DU BIST HIER: login.class.php} > Dbh

Welcher Inhalt erwartet mich?
- Änderungen und Aufgaben (Tasks) in unserer Datenbank drin bitte hier eintragen.
*/

// Login wird SUBKLASSE von unserer Dbh in dbh.class.php:
class Login extends Dbh {

    // --- Methode, um USER ZU KRIEGEN (selecten, damit er user_pwd Column aus users checkt. Der Nutzername oder die Email müssen zum eingegeben Passwort passen!) --- //
    protected function getUser($uid, $pwd) {
        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_uid = ? OR users_email = ?;');

        // ! = Wenn dieses Statement fehlschlägt, ausgeführt zu werden, dann...
        if(!$stmt->execute(array($uid, $pwd))) {
            $stmt = null;
            header("location: ../logreg.php?error=stmtfailed"); 
            exit(); //...wird das Statement gestoppt, wir erhalten den Fehler und werden rausbefödert!
        }
        // Wenn wir 0 Anfragen / Resultate bekommen, dann hauen wir diese Meldung raus...
        if($stmt->rowCount() == 0)
        {
            $stmt = null; //...Statement wird beendet...
            header("location: ../logreg.php?error=usernotfound"); //...und der User rausgeführt!
            exit();
        }
        // ABER: Passt alles, nehmen wir das PASSWORT, was der User uns gegeben hat...
        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC); // Die Daten wollen wir als Assoziatives Array zurückbringen
        //...und prüfen das gesetzte Passwort mit dem Passwort, was der User uns mitgegeben hat...
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]); // Wichtig: Exakt gleiche Column-Spalte nennen wie in der Datenbank!
        //...und als TRUE ausgegeben wird. Falls nicht, dann:

        // A) Prüfen, ob das Angegebene Passwort nicht das Gleiche ist wie notiert!
        if($checkPwd == false)
        {
            $stmt = null;
            header("location: ../logreg.php?error=wrongpassword");
            exit();
        }
        // B) Ist das Passwort gleich wie angegeben, kommen wir eine Runde weiter:
        elseif($checkPwd == true) {
            // Wie oben, nur prüfen wir dieses Mal: Username oder Email aus unserer Tabelle müssen mit dem Passwort übereinstimmen:
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?;');
            // ! = Wenn dieses Statement fehlschlägt, ausgeführt zu werden, dann...
            if(!$stmt->execute(array($uid, $uid, $pwd))) { // Zweimal $uid, da der User entweder oder Email / Username eingibt.
                $stmt = null;
                header("location: ../logreg.php?error=stmtfailed");
                exit(); //...wird das Statement gestoppt, wir erhalten den Fehler und werden rausbefödert!
            }
            // Wenn wir 0 Anfragen / Resultate bekommen, dann hauen wir diese Meldung raus...
            if($stmt->rowCount() == 0)
            {
                $stmt = null; //...Statement wird beendet...
                header("location: ../logreg.php?error=usernotfound");
                exit(); //...und auch hier wird das Statement gestoppt, wir erhalten den Fehler und werden rausbefödert!
            }
            // ABER: Passt alles, nehmen wir den NUTZERDATEN $user um die Session zu starten:
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC); // Die Daten wollen wir als Assoziatives Array zurückbringen

            // 1) Session starten...
            session_start();

            // 2) Hier bereiten wir Session-Variablen zu anhand der users-Tabelle
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["useruid"] = $user[0]["users_uid"];

            $stmt = null;

          
         
        }
    }

}