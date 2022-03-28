<?php
// --- dbh.class.php - Aufbau Superklasse Dbh (Datenbank) --- //
/*
Infos: 
- logreg.php > signup.inc.php > SignupController > Signup > DU BIST HIER: Dbh
- Datenbank klasse, was eine Datenbankverbindung aufbauen wird
- ...

*/

// Dbh ist die Superklasse, Signup wiederum die Subklasse etc...
class Dbh {
    
    // Methode (Kurzversion) zum Datenbankaufbau:
    protected function connect() {
        // try: "versuche Kommendes auszuführen" oder fange (catch) den Error ab und zeige ihn:
        try {
            // (Übernimmt prefs > crendetials) Lokale-DB-Credentials von XAMPP:
            $user = "root";
            $passwd = "";
            //dbh = Database Handler (NOTE: mysql bezieht sich auf die Datenbank, nicht auf eine PHP-Funktion. Daher kein mysqli)
            $dbh = new PDO('mysql:host=localhost;dbname=ettikator', $user, $passwd);
            return $dbh;
        } 
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}